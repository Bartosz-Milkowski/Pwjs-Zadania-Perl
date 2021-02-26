<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//! Ograniczyć ten widok tylko do PROMOTORA

?>
<div class="com_zaswiadczenia form form-odd">
    <h1>Wniosek o przyjęcie pracy dyplomowej</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis1.saveAsPromotor') ?>" method="post">
        <p class="w100"><span class="text-bold">Temat pracy:</span> <?= $this->item->thesis; ?> <br></p>
        <p class="w100"><span class="text-bold">Student: </span><?= $this->item->name ?></p>

        <div>
            <label>Proponowany przez opiekuna recenzent pracy:</label>
            <input name="proponowany_recenzent" type="text" value="<?= $this->item->proponowany_recenzent ?>">
        </div>

        <p>Opinia opiekuna pracy dyplomowej: </p>
        <textarea rows="5" name="opinia_promotora"><?= $this->item->opinia_promotora ?></textarea>

        <input name="id" type="hidden" value="<?= $this->item->id ?>">

        <input type="submit" value="Zapisz">
    </form>
</div>