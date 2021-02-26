<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewAdd1Promotor extends JViewLegacy
{
    public function display($tpl = null)
    {
        $this->user = JFactory::getUser();
        $this->item = $this->get('item');

        if ($this->item == null) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Brak dostępu do tego dokumentu,', 'error');
        }

        return parent::display($tpl);
    }
}
