<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="com_zaswiadczenia form-odd form">
    <h1>Wniosek o przyjęcie pracy dyplomowej - Edycja danych</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis1.edit') ?>" method="post">
        <div>
            <label>Imię i nazwisko: </label>
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
            <label>Specjalność: </label>
            <input name="specialty" type="text" value="<?php echo $this->formData->specialty; ?>">
        </div>

        <div>
            <label>Forma i poziom studiów: </label>
            <input name="form_and_level_of_study" type="text" value="<?php echo $this->formData->form_and_level_of_study; ?>">
        </div>

        <div>
            <label>Nr. tel </label>
            <input name="tel" type="number" value="<?php echo $this->formData->tel; ?>">
        </div>

        <div>
            <label>Email: </label>
            <input name="email" type="email" value="<?php echo $this->formData->email; ?>">
        </div>


        <input name="id" type="hidden" value="<?php echo $this->formData->id; ?>">
        <input type="submit" value="Edytuj dane">
    </form>
</div>