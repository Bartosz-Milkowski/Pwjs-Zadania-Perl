<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaTableThesisForm1 extends JTable
{

    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct('#__thesis_form1', 'id', $db);
    }
}
