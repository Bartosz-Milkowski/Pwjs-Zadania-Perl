<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class ZaswiadczeniaControllerThesis2 extends JControllerLegacy
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
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=' . $view), 'Status dokumentu uniemożliwia wykonanie tej operacji.', 'error');
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
        $dyplom = $this->getModel('add2')->getDyplom();

        if ($dyplom != null) {
            // Student zapisuje dane || Stworzenie pierwszego formularza
            $user = JFactory::getUser();
            $postData = JFactory::getApplication()->input->post;
            $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');
            $array = $postData->getArray();

            // Sprawdzić czy została wysłana poprawna wartość (rodzaj, stopień) 
            $array['status_student'] = 10;
            $array['status_promotor'] = 0;
            $array['status_dziekanat'] = 0;
            $array['reject_reason_dziekanat'] = '';
            $array['promotor_username'] = $dyplom->login;
            $array['promotor_name'] = $dyplom->promotor_title . ' ' . $dyplom->promotor_name . ' ' . $dyplom->promotor;
            $array['thesis'] = $dyplom->tytul;
            $array['user_id'] = $user->id; // Ustawienie user_id po stronie serwera

            if ($form->save($array)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wniosek został przygotowany, oczekuje na wysłanie do dziekanatu.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
            }
        } else {
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=start'), 'Wystąpił błąd zapisu. Tylko dyplomant może stworzyć wniosek.', 'error');
        }
    }

    public function edit()
    {
        $postData = JFactory::getApplication()->input->post;
        $array = $postData->getArray();
        $item = $this->getModel('item')->getItem2ById($array['id']);


        $access = self::checkAccess($item, [10], 'student');

        if ($access == true) {
            $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');
            $array['status_student'] = 10;
            // Pełne prawo do zapisu | Nadpisanie wpisanych danych
            $item->name = $array['name'];
            $item->field_of_study = $array['field_of_study'];
            $item->form_and_level_of_study = $array['form_and_level_of_study'];
            $item->tel = $array['tel'];
            $item->email = $array['email'];
            $item->specialty = $array['specialty'];

            $item->date_accept_promotor = $array['date_accept_promotor'];
            $item->stopien = $array['stopien'];
            $item->rodzaj = $array['rodzaj'];

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wniosek został edytowany, oczekuje na wysłanie do dziekanatu.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function delete()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem2ById($id);

        $access = self::checkAccess($item, [10], 'student');

        if ($access == true) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->delete($db->quoteName('#__thesis_form2'));
            $query->where($db->quoteName('id') . " = " . $item->id);
            $db->setQuery($query);
            $db->query();
            parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wniosek został usunięty.');
        }
    }

    public function send()
    {
        // Student Wysyła lub odsyła wniosek do promotora
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem2ById($id);
        $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');


        $access = self::checkAccess($item, [10, 11], 'student');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date = $date;
            $item->date_promotor = $date;
            $item->status_student = 5; // Wysłany do promotora
            $item->status_dziekanat = 1; // Nowy

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wniosek został wysłany do dziekanatu.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listStudent'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    //! Dziekanat

    public function markAsPrinted()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem2ById($id);
        $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [1], 'dziekanat');

        if ($access == true) {
            $item->status_student = 14; // Wydrukowany
            $item->status_dziekanat = 14; // Wydrukowany

            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_printed = $date;

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat'), 'Wniosek został oznaczony jako wydrukowany.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function accept()
    {
        $input = JFactory::getApplication()->input;
        $id = $input->get('id', 0);
        $item = $this->getModel('item')->getItem2ById($id);
        $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');

        $access = self::checkAccess($item, [14], 'dziekanat');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_dziekanat = $date;

            $item->status_student = 6; // Zaakceptowany w dziekanacie
            $item->status_dziekanat = 9; // Zaakceptowany

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=printed'), 'Wniosek zozstał zaakceptowany.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=printed'), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }

    public function rejectAsDziekanat()
    {
        $user = JFactory::getUser();

        $postData = JFactory::getApplication()->input->post;
        $form = JTable::getInstance('ThesisForm2', 'ZaswiadczeniaTable');
        $array = $postData->getArray();
        $id = $array['id'];
        $reject_reason = $array['reject_reason_dziekanat'];
        $backLayout = $array['backLayout'];
        $item = $this->getModel('item')->getItem2ById($id);

        $access = self::checkAccess($item, [1, 14], 'dziekanat');

        if ($access == true) {
            $date = JFactory::getDate('now +1 hour');
            $date = JHtml::date($date, 'Y-m-d H:i:s');
            $item->date_dziekanat = $date;
            $item->reject_reason_dziekanat = $reject_reason;
            $item->status_student = 7; // Odrzucony w dziekanacie
            $item->status_dziekanat = 8; // Odrzucony

            if ($form->save($item)) {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=' . $backLayout . ''), 'Wniosek zozstał odrzucony.');
            } else {
                parent::setRedirect(JRoute::_('index.php?option=com_zaswiadczenia&view=listDziekanat&layout=' . $backLayout . ''), 'Wystąpił błąd zapisu', 'error');
            }
        }
    }
}
