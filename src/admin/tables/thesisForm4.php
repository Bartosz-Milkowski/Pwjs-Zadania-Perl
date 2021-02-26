<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaTableThesisForm4 extends JTable
{

    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct('#__thesis_form4', 'id', $db);
    }
}
