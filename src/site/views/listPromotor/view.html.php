<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewListPromotor extends JViewLegacy
{
    function requirePromotor()
    {
        $dyplom = $this->getModel()->getDyplom();

        if (!count($dyplom)) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Brak dostępu. Nie jesteś promotorem żadnej pracy dyplomowej', 'error');
        }
    }

    function display($tpl = null)
    {
        self::requirePromotor();

        $input = JFactory::getApplication()->input;
        $layout = $input->get('layout', '');
        $model = $this->getModel();

        $this->title1 = "Wnioski o przyjęcie pracy dyplomowej";
        $this->title3 = "Podania o przedłużenie terminu złożenia pracy (Dziekan)";
        $this->title4 = "Podania o przedłużenie terminu złożenia pracy (Prorektor)";

        switch ($layout) {
            case 'ended': {
                    $this->listThesis1 = $model->getList('thesis_form1', '6,7,8');
                    $this->listThesis3 = $model->getList('thesis_form3', '6,7,8');
                    $this->listThesis4 = $model->getList('thesis_form4', '6,7,8');
                    break;
                }

            default: {
                    $this->listThesis1 = $model->getList('thesis_form1', '1,3,5,10,11,12');
                    $this->listThesis3 = $model->getList('thesis_form3', '1,3,5,10,11,12');
                    $this->listThesis4 = $model->getList('thesis_form4', '1,3,5,10,11,12');
                    break;
                }
        }

        // $this->listThesis3 = $model->getList('thesis_form3');
        // $this->listThesis5 = $model->getList('thesis_form5');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }
        // Display the view
        parent::display($tpl);
    }
}
