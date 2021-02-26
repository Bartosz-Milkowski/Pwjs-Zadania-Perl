<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaViewListStudent extends JViewLegacy
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
        // Dostęp WYŁĄCZNIE dla studenta
        self::requireStudent();

        $input = JFactory::getApplication()->input;
        $layout = $input->get('layout', '');
        $model = $this->getModel();

        $this->title1 = "Wnioski o przyjęcie pracy dyplomowej";
        $this->title2 = "Wnioski o dopuszczenie do egzaminu dyplomowego";
        $this->title3 = "Podania o przedłużenie terminu złożenia pracy (Dziekan)";
        $this->title4 = "Podania o przedłużenie terminu złożenia pracy (Prorektor)";

        switch ($layout) {
            case 'ended': {
                    $this->listThesis1 = $model->getList('thesis_form1', '4,6,7');
                    $this->listThesis2 = $model->getList('thesis_form2', '6,7');
                    $this->listThesis3 = $model->getList('thesis_form3', '4,6,7');
                    $this->listThesis4 = $model->getList('thesis_form4', '4,6,7');
                    break;
                }

            default: {
                    $this->listThesis1 = $model->getList('thesis_form1', '2,5,10,11,13,14');
                    $this->listThesis2 = $model->getList('thesis_form2', '5,10,14');
                    $this->listThesis3 = $model->getList('thesis_form3', '2,5,10,11,13,14');
                    $this->listThesis4 = $model->getList('thesis_form4', '2,5,10,11,13,14');
                    break;
                }
        }

        // $this->listThesis4 = $model->getList('thesis_form3');
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
