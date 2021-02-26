<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaControllerZaswiadczenia extends JControllerLegacy
{
    // Nie używane
    public function save_form1()
    {
        // $id = JFactory::getApplication()->input->getInt('id', 0);
        $postData = JFactory::getApplication()->input->post;
        $form = JTable::getInstance('Form1', 'ZaswiadczeniaTable');

        if ($form->save($postData->getArray())) {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia'), 'Dane zostały zapisane');
        } else {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia'), 'Wystąpił błąd zapisu', 'error');
        }
    }

    public function yo()
    {
        echo 'yo!';
    }
}
