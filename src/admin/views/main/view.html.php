<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewMain extends JViewLegacy {

    /**
     * Display the Hello World view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null) {

        if (JFactory::getUser()->authorise('core.admin', 'com_zaswiadczenia')) {
            $this->addToolBar();
        }
        // Display the template
        parent::display($tpl);
        
        $this->setDocument();
    }

    protected function addToolBar() {
        $title = 'Zaświadczenia Dziekanatu';

        JToolBarHelper::title($title, 'zaswiadczenia');
//        JToolBarHelper::addNew('helloworld.add');
//        JToolBarHelper::editList('helloworld.edit');
//        JToolBarHelper::deleteList('', 'helloworlds.delete');
        JToolBarHelper::preferences('com_zaswiadczenia');
    }

    protected function setDocument() {
        $document = JFactory::getDocument();
        $document->setTitle('Zaświadczenia - konfiguracja');
    }

}
