<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_recipes/tables');

use Joomla\CMS\Date\Date;

class ZaswiadczeniaViewItem3 extends JViewLegacy
{
    function checkAccess()
    {
        $user = JFactory::getUser();
        $id = JFactory::getApplication()->input->getInt('id', 0);
        $formData = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
        $formData->load($id);

        if (!($user->id == $formData->user_id || $user->username == $formData->promotor_username || $user->authorise('front.manage', 'com_zaswiadczenia'))) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Brak uprawnień do tego dokumentu', 'error');
        }
    }

    function display($tpl = null)
    {
        self::checkAccess();

        $this->id = JFactory::getApplication()->input->getInt('id', 0);
        $this->backLayout = JFactory::getApplication()->input->get('backLayout', 'default');

        $form1Data = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
        $form1Data->load($this->id);

        $this->formData = $form1Data;

        $date = new Date($this->formData->to_date);
        $dateYMD = JHtml::_('date', $date, 'Y-m-d');

        $this->dateDMY = JHtml::_('date', $date, 'd.m.Y');

        $this->formData->do_date = $dateYMD;

        parent::display($tpl);
    }
}
