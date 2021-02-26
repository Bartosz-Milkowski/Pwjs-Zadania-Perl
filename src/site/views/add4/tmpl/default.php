<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//! Ograniczyć ten widok tylko dla STUDENTA 

?>
<div class="com_zaswiadczenia form-odd form">
    <h1 class="form-title">Podanie o przesunięcie terminu złożenia pracy dyplomowej</h1>

    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis4.save') ?>" method="post">
        <div>
            <label>Nazwisko i imię: </label>
            <input name="name" type="text" value="<?php echo $this->dyplom->student . ' ' . $this->dyplom->student_name; ?>">
        </div>

        <div>
            <label>Numer albumu: </label>
            <input name="nr_album" type="number" value="<?php echo mb_substr($this->user->username, 2, 10); ?>">
        </div>

        <div>
            <label>Kierunek</label>
            <input name="field_of_study" type="text">
        </div>

        <div>
            <label>Forma i stopień studiów: </label>
            <input name="form_and_level_of_study" type="text">
        </div>

        <div>
            <label>Adres zamieszkania: </label>
            <input name="address" type="text">
        </div>

        <div>
            <label>Nr. tel </label>
            <input name="tel" type="number">
        </div>

        <div>
            <label>Przedłużenie do dnia: </label>
            <input name="to_date" type="date">
        </div>

        <p>Powód przedłużenia: </p>
        <textarea name="student_reason" rows="5" placeholder="Proszę o wyrażenie zgody na przedłużenie terminu złożenia pracy dyplomowej do dnia [...] z powodu [dokończ]"></textarea>

        <input type="submit" value="Zapisz">
    </form>
</div>