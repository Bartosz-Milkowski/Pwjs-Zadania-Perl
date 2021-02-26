<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="com_zaswiadczenia form-odd form">
    <h1>Wniosek o przyjęcie pracy dyplomowej - Edycja danych</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis3.edit') ?>" method="post">
        <div>
            <label>Nazwisko i imię: </label>
            <input name="name" type="text" value="<?php echo $this->formData->name; ?>">
        </div>

        <div>
            <label>Numer albumu: </label>
            <input name="nr_album" type="number" value="<?php echo $this->formData->nr_album ?>">
        </div>

        <div>
            <label>Kierunek</label>
            <input name="field_of_study" type="text" value="<?php echo $this->formData->field_of_study ?>">
        </div>

        <div>
            <label>Forma i poziom studiów: </label>
            <input name="form_and_level_of_study" type="text" value="<?php echo $this->formData->form_and_level_of_study; ?>">
        </div>

        <div>
            <label>Adres zamieszkania: </label>
            <input name="address" type="text" value="<?php echo $this->formData->address; ?>">
        </div>

        <div>
            <label>Nr. tel </label>
            <input name="tel" type="number" value="<?php echo $this->formData->tel; ?>">
        </div>

        <div>
            <label>Przedłużenie do dnia: </label>
            <input name="to_date" type="date" value="<?php echo $this->formData->to_date; ?>">
        </div>

        <p>Powód przedłużenia: </p>
        <textarea name="student_reason" rows="5" placeholder="Proszę o wyrażenie zgody na przedłużenie terminu złożenia pracy dyplomowej do dnia [...] z powodu [dokończ]"><?php echo $this->formData->student_reason; ?></textarea>

        <input name="id" type="hidden" value="<?php echo $this->formData->id; ?>">

        <input type="submit" value="Edytuj dane">
    </form>
</div>