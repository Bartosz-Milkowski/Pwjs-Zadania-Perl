<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaController extends JControllerLegacy
{

    protected $default_view = 'start';

    function __construct($default_view)
    {
        parent::__construct();
    }

    public function yo()
    {
        echo 'yo task ';
        //        parent::setRedirect(JRoute::_('index.php?view=list'), null, null);
    }

    public function jsonTest()
    {
        $myObj = new stdClass();
        $myObj->name = "John";
        $myObj->age = 30;
        $myObj->city = "New York";
        echo new JResponseJson($myObj);
        exit();
    }
}
