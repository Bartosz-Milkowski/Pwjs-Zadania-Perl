<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaTableForm1 extends JTable {

    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db) {
        parent::__construct('#__zaswiadczenia_form1', 'id', $db);
    }

}
