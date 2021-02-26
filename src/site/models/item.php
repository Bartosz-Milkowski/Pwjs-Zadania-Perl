<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaModelItem extends JModelList
{
    public function getItem1ById($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form1'));
        $query->where($db->quoteName('id') . " = " . $id);
        $db->setQuery($query);

        return $db->loadObject();
    }

    public function getItem2ById($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form2'));
        $query->where($db->quoteName('id') . " = " . $id);
        $db->setQuery($query);

        return $db->loadObject();
    }

    public function getItem3ById($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form3'));
        $query->where($db->quoteName('id') . " = " . $id);
        $db->setQuery($query);

        return $db->loadObject();
    }

    public function getItem4ById($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form4'));
        $query->where($db->quoteName('id') . " = " . $id);
        $db->setQuery($query);

        return $db->loadObject();
    }

    public function getItem5ById($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__thesis_form5'));
        $query->where($db->quoteName('id') . " = " . $id);
        $db->setQuery($query);

        return $db->loadObject();
    }
}
