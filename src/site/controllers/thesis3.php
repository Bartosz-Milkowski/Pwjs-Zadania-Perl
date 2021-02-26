<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaControllerThesis3 extends JControllerLegacy
{
    public function checkAccess($item, $statusArray, $role)
    {
        $user = JFactory::getUser();
        $statusError = true; // True - Brak możliwości edycji

        switch ($role) {
            case 'student': {
                $view = 'listStudent';
                $statusItem = $item->status_student;
                break;
            }

            case 'promotor': {
                $view = 'listPromotor';
                $statusItem = $item->status_promotor;
                break;
            }

            case 'dziekanat': {
                $view = 'listDziekanat';
                $statusItem = $item->status_dziekanat;
                break;
            }
        }


        for ($i = 0; $i < count($statusArray); $i++) {
            if ($statusItem == $statusArray[$i]) {
                $statusError = false; // False - Możliwość edycji
            }
        }

        if ($item == null) {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Wskazany dokument nie istnieje.', 'error');
            return false;
        }

        if ($statusError == true) {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Status dokumentu uniemożliwia wykonanie tej operacji', 'error');
            return false;
        }

        switch ($role) {
            case 'student': {
                if ($user->id != $item->user_id) {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Brak uprawnień do wykonania tej operacji.', 'error');
                    return false;
                }
                break;
            }

            case 'promotor': {
                if ($item->promotor_username != $user->username) {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Brak uprawnień do wykonania tej operacji.', 'error');
                    return false;
                }
                break;
            }

            case 'dziekanat': {
                if (!($user->authorise('front.manage', 'com_zaswiadczenia'))) {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Brak uprawnień do wykonania tej operacji.', 'error');
                    return false;
                }
                break;
            }
        }

        return true;
    }


    public function save()
    {
        $dyplom = $this->getModel('add3')->getDyplom();

        if ($dyplom != null)
        {
            // Student zapisuje dane || Stworzenie pierwszego formularza
            $user = JFactory::getUser();
            $postData = JFactory::getApplication()->input->post;
            $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
            $array = $postData->getArray();

            $array['status_student'] = 10;
            $array['status_promotor'] = 0;
            $array['status_dziekanat'] = 0;

            $array['reject_reason_dziekanat'] = '';
            $array['reject_reason_promotor'] = '';
            $array['work_progress'] = '';
            $array['substantiation_promotor'] = '';
            $array['decision_promotor'] = '';


            $array['promotor_username'] = $dyplom->login;
            $array['user_id'] = $user->id; // Ustawienie user_id po stronie serwera
            $array['promotor_name_with_title'] = $dyplom->promotor_title . ' ' . $dyplom->promotor_name . ' ' . $dyplom->promotor;
            $array['thesis'] = $dyplom->tytul;

            if ($form->save($array))
            {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Podanie zostało przygotowane, oczekuje na wysłanie do promotora.');
            }
            else
                {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
            }
        }
        else {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Wystąpił błąd zapisu. Tylko dyplomant może stworzyć wniosek.', 'error');
        }
    }

    public function edit()
    {
        $postData = JFactory::getApplication()->input->post;
        $array = $postData->getArray();
        $item = $this->getModel('item')->getItem3ById($array['id']);

        $access = self::checkAccess($item, [10, 11], 'student');

        if ($access == true) {
            $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
            $array['status_student'] = 10;
            $item->name = $array['name'];
            $item->field_of_study = $array['field_of_study'];
            $item->form_and_lebbel_of_study = $array['form_and_lebbel_of_study'];
            $item->tel = $array['tel'];
            $item->address = $array['address'];
            $item->to_date = $array['to_date'];
            $item->student_reason = $array['student_reason'];

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Podanie zostało edytowane, oczekuje na wysłanie do promotora.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }


    public function delete()
    {
        $input = JFactory::getApplication()->input;
        $index = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($index);

        $access = self::checkAccess($item, [10], 'student');

        if ($access == true) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->delete($db->quoteName('#__thesis_form3'));
            $query->where($db->quoteName('id') . " = " . $item->id);
            $db->setQuery($query);
            $db->query();
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Podanie zostało usunięte.');
        }
    }

    public function send()
    {
        // Student Wysyła lub odsyła podanie do promotora
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($id);
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [10, 11], 'student');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date = $date;

            if ($item->status_student == 10) { // Oczekuje na wysłanie
                // Pierwsze wysłanie | Dokument jeszcze ani razu nie został wysłany
                $item->status_student = 2; // Wysłany do promotora
                $item->status_promotor = 1; // Nowy
                if ($form->save($item)) {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Podanie zostało wysłane do promotora.');
                } else {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
                }
            } elseif ($item->status_student == 11) { // Do poprawy
                // Edycja ze względu na to, że promotor odesłał dokument do poprawy
                $item->status_student = 13; // Odesłany do promotora
                $item->status_promotor = 12; // Poprawiony

                if ($form->save($item)) {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Podanie zostało odesłane do promotora.');
                } else {
                    parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
                }
            }
        }
    }

    //! Promotor

    public function saveAsPromotor()
    {
        $postData = JFactory::getApplication()->input->post;
        $array = $postData->getArray();
        $item = $this->getModel('item')->getItem3ById($array['id']);

        $access = self::checkAccess($item, [1, 10, 12], 'promotor');

        if ($access == true) {
            $item->work_progress = $array['work_progress'];
            $item->substantiation_promotor = $array['substantiation_promotor'];
            $item->decision_promotor = $array['decision_promotor'];
            $item->status_promotor = 10;

            $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Podanie zostało przygotowane, oczekuje na wysłanie do dziekanatu.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function sendBack()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($id);

        $access = self::checkAccess($item, [1, 10, 12], 'promotor');

        if ($access == true) {
            $item->status_promotor = 3;
            $item->status_student = 11;

            $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Podanie zostało odesłane do dyplomanta');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function sendAsPromotor()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($id);
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [10, 12], 'promotor');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_promotor = $date;

            $item->status_student = 5; // Wysłany do dziekanatu
            $item->status_promotor = 5; // Wysłany do dziekanatu
            $item->status_dziekanat = 1; // Nowy

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Podanie zostało wysłane do dziekanatu');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function rejectAsPromotor()
    {
        $postData = JFactory::getApplication()->input->post;
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
        $array = $postData->getArray();
        $id = $array['id'];
        $reject_reason = $array['reject_reason_promotor'];
        $item = $this->getModel('item')->getItem3ById($id);


        $access = self::checkAccess($item, [1, 10, 12], 'promotor');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_promotor = $date;
            $item->reject_reason_promotor = $reject_reason;

            $item->status_student = 4; // Odrzucony przez promotora
            $item->status_promotor = 8; // Odrzucony

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Podanie dyplomanta zostało odrzucone.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listPromotor'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    //! Dziekanat

    public function markAsPrinted()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($id);
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [1], 'dziekanat');

        if ($access == true) {
            $item->status_student = 14; // Wydrukowany
            $item->status_promotor = 14; // Wydrukowany
            $item->status_dziekanat = 14; // Wydrukowany

            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_printed = $date;

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat'), 'Podanie zostało oznaczone jako wydrukowane.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function accept()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem3ById($id);
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [14], 'dziekanat');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_dziekanat = $date;

            $item->status_student = 6; // Zaakceptowany w dziekanacie
            $item->status_promotor = 6; // Zaakceptowany w dziekanacie
            $item->status_dziekanat = 9; // Zaakceptowany

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=printed'), 'Podanie zozstało zaakceptowane.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=printed'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function rejectAsDziekanat()
    {
        $user = JFactory::getUser();

        $postData = JFactory::getApplication()->input->post;
        $form = JTable::getInstance('ThesisForm3', 'ZaswiadczeniaTable');
        $array = $postData->getArray();
        $id = $array['id'];
        $reject_reason = $array['reject_reason_dziekanat'];
        $backLayout = $array['backLayout'];
        $item = $this->getModel('item')->getItem3ById($id);

        $access = self::checkAccess($item, [1, 14], 'dziekanat');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_dziekanat = $date;
            $item->reject_reason_dziekanat = $reject_reason;
            $item->status_student = 7; // Odrzucony w dziekanacie
            $item->status_promotor = 7; // Odrzucony w dziekanacie
            $item->status_dziekanat = 8; // Odrzucony

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=' . $backLayout . ''), 'Podanie zozstało odrzucone.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=' . $backLayout . ''), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }
}
