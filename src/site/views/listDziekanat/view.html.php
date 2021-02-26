<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewListDziekanat extends JViewLegacy
{
    function requireAdmin()
    {
        $user = JFactory::getUser();
        if (!($user->authorise('front.manage', 'com_zaswiadczenia'))) {
            $app = &JFactory::getApplication();
            $app->redirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Brak dostępu. Nie posiadasz uprawnień, by zobaczyć tę część witryny.', 'error');
        }
    }

    function display($tpl = null)
    {
        self::requireAdmin();

        $input = JFactory::getApplication()->input;
        $layout = $input->get('layout', '');
        $model = $this->getModel();

        $this->title1 = "Wnioski o przyjęcie pracy dyplomowej";
        $this->title2 = "Wnioski o dopuszczenie do egzaminu dyplomowego";
        $this->title3 = "Podania o przedłużenie terminu złożenia pracy (Dziekan)";
        $this->title4 = "Podania o przedłużenie terminu złożenia pracy (Prorektor)";

        switch ($layout) {
            case 'printed': {
                    $this->listThesis1 = $model->getList('thesis_form1', '14');
                    $this->listThesis2 = $model->getList('thesis_form2', '14');
                    $this->listThesis3 = $model->getList('thesis_form3', '14');
                    $this->listThesis4 = $model->getList('thesis_form4', '14');
                    break;
                }
            case 'ended': {
                    $this->listThesis1 = $model->getList('thesis_form1', '8,9');
                    $this->listThesis2 = $model->getList('thesis_form2', '8,9');
                    $this->listThesis3 = $model->getList('thesis_form3', '8,9');
                    $this->listThesis4 = $model->getList('thesis_form4', '8,9');
                    break;
                }

            default: {
                    $this->listThesis1 = $model->getList('thesis_form1', '1');
                    $this->listThesis2 = $model->getList('thesis_form2', '1');
                    $this->listThesis3 = $model->getList('thesis_form3', '1');
                    $this->listThesis4 = $model->getList('thesis_form4', '1');
                    break;
                }
        }

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
            return false;
        }
        // Display the view
        parent::display($tpl);
    }
}
