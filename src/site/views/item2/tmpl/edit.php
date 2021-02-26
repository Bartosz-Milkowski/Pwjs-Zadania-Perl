<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="com_zaswiadczenia  form-even form">
    <h1>Wniosek o dopuszczenie do egzaminu dyplomowego i wyznaczenie jego terminu - Edycja danych</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis2.edit') ?>" method="post">
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

        <div>
            <label>Data przyjęcia pracy przez promotora: </label>
            <input name="date_accept_promotor" type="date" value="<?php echo $this->formData->date_accept_promotor; ?>">
        </div>

        <div>
            <label for="rodzaj">Rodzaj studiów: </label>
            <select name="rodzaj" class="w100" id="rodzaj">
                <option value="0" <?php if ($this->formData->rodzaj == 0) echo "selected" ?>>Studia stacjonarne</option>
                <option value="1" <?php if ($this->formData->rodzaj == 1) echo "selected" ?>>Studia niestacjonarne</option>
            </select>
        </div>

        <div>
            <label for="stopien">Stopień studiów: </label>
            <select name="stopien" class="w100" id="stopien">
                <option value="1" <?php if ($this->formData->stopien == 1) echo "selected" ?>>Pierwszy stopień</option>
                <option value="2" <?php if ($this->formData->stopien == 2) echo "selected" ?>>Drugi stopień</option>
            </select>
        </div>

        <input name="id" type="hidden" value="<?php echo $this->formData->id; ?>">

        <input type="submit" value="Edytuj dane">
    </form>
</div>