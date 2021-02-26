<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//! Ograniczyć ten widok tylko do PROMOTORA

?>
<div class="com_zaswiadczenia form-even form">
    <h1>Wniosek o przyjęcie pracy dyplomowej</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis4.saveAsPromotor') ?>" method="post">
        <p class="w100"><span class="text-bold">Temat pracy:</span> <?= $this->item->thesis; ?> <br></p>
        <p class="w100"><span class="text-bold">Student: </span><?= $this->item->name ?></p>

        <div>
            <label>Ocena stopnia zaawansowania pracy: (%) </label>
            <input name="work_progress" type="number" value="<?= $this->item->work_progress ?>">
        </div>

        <div>
            <label for="decision_promotor">Decyzja: </label>
            <select name="decision_promotor" class="w100" id="decision_promotor">
                <option value="0" <?php if ($this->item->decision_promotor == 0) echo 'selected'; ?>>Popieram prośbę studenta</option>
                <option value="1" <?php if ($this->item->decision_promotor == 1) echo 'selected'; ?>>Nie popieram prośby studenta</option>
            </select>
        </div>

        <p>Uzasadnienie: </p>
        <textarea name="substantiation_promotor" rows="5"><?= $this->item->substantiation_promotor ?></textarea>

        <input name="id" type="hidden" value="<?= $this->item->id ?>">
        <input type="submit" value="Zapisz">
    </form>
</div>