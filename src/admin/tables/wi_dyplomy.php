<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaTableWiDyplomy extends JTable
{

    /**
     * Constructor
     *
     * @param   JDatabaseDriver  &$db  A database connector object
     */
    function __construct(&$db)
    {
        parent::__construct('#__wi_dyplomy', 'id', $db);
    }
}
