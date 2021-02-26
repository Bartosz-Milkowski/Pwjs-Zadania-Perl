<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewAdd1 extends JViewLegacy
{
    public function requireDyplom()
    {
        $this->dyplom = $this->get("Dyplom");

        if ($this->dyplom == null) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Wystąpił błąd zapisu. Tylko dyplomant może stworzyć wniosek.', 'error');
        }
    }

    public function display($tpl = null)
    {
        self::requireDyplom();
        $this->user = JFactory::getUser();
        $this->dyplom = $this->get("Dyplom");
        return parent::display($tpl);
    }
}
