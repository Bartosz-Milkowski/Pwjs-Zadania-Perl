<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ZaswiadczeniaModelAdd3Promotor extends JModelList
{
    public function getItem()
    {
        $user = JFactory::getUser();
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form3'));

        $conditions = array(
            $db->quoteName('id') . " = " .  $db->quote($id),
            $db->quoteName('promotor_username') . " = " . $db->quote($user->username),
        );

        $query->where($conditions);
        $db->setQuery($query);

        return $db->loadObject();
    }
}
