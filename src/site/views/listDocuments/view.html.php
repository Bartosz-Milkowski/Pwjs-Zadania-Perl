<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewListDocuments extends JViewLegacy
{
    function requireStudent()
    {
        $this->user = JFactory::getUser();
        $pattern = "/^[^0-9]{2}[0-9]{5,}/"; // 2 litery + co najmniej 5 liczb
        $username = $this->user->username;

        if (!preg_match_all($pattern, $username)) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Brak dostępu. Widok ten został ograniczony tylko do roli dyplomanta.', 'error');
        }
    }

    function display($tpl = null)
    {
        self::requireStudent();
        $this->user = JFactory::getUser();
        $this->dyplom = $this->get("Dyplom");
        return parent::display($tpl);
    }
}
