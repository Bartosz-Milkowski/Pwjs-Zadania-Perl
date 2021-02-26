<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ZaswiadczeniaModelListStudent extends JModelList
{
    public function getList($table, $status)
    {
        $user = JFactory::getUser();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*');
        $query->from($db->quoteName('#__' . $table . ''));
        $query->order($db->quoteName('id') . ' DESC');

        $conditions = array(
            $db->quoteName('nr_album') . " = " . $db->quote(mb_substr($user->username, 2, 10)),
            $db->quoteName('status_student') . ' IN (' . $status . ')'
        );

        $query->where($conditions);

        $db->setQuery($query);
        $list =  $db->loadObjectList();

        for ($i = 0; $i < count($list); $i++) {
            $list[$i]->statusText = self::getStatusText($list[$i]);
        }

        return $list;
    }

    public static function getStatusText($item)
    {
        $status_id = $item->status_student;

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_status'));
        $query->where($db->quoteName('status_id') . " = " . $status_id);

        $db->setQuery($query);
        $status =  $db->loadObject();

        return $status->text;
    }
}
