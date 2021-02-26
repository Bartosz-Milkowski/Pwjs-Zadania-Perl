<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//! Ograniczyć ten widok tylko dla STUDENTA 

?>
<div class="com_zaswiadczenia form-odd form">
    <h1 class="form-title">Wniosek o przyjęcie pracy dyplomowej</h1>

    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis1.save') ?>" method="post">
        <div>
            <label>Imię i nazwisko: </label>
            <input name="name" type="text" value="<?php echo $this->user->name ?>">
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
            <label>Specjalność: </label>
            <input name="specialty" type="text">
        </div>

        <div>
            <label>Forma i poziom studiów: </label>
            <input name="form_and_level_of_study" type="text">
        </div>

        <div>
            <label>Nr. tel </label>
            <input name="tel" type="number">
        </div>

        <div>
            <label>Email: </label>
            <input name="email" type="email">
        </div>

        <input type="submit" value="Zapisz">
    </form>
</div>