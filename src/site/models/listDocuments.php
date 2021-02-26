<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ZaswiadczeniaModelListDocuments extends JModelList
{
    public function getDyplom()
    {
        $user = JFactory::getUser();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('*')->from($db->quoteName('#__wi_dyplomy'));

        $conditions = array(
            $db->quoteName('album') . " = " . $db->quote(mb_substr($user->username, 2, 10))
        );

        $query->where($conditions);
        $db->setQuery($query);
        return $db->loadObject();
    }
}
