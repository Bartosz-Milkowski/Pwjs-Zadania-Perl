<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

//! Ograniczyć ten widok tylko dla STUDENTA 

?>
<div class="com_zaswiadczenia form-even form">
    <h1 class="form-title">Wniosek o dopuszczenie do egzaminu dyplomowego i wyznaczenie jego terminu</h1>
    <form class="flex" action="<?= JRoute::_('index.php?option=com_zaswiadczenia&task=thesis2.save') ?>" method="post">
        <div>
            <label>Imię i nazwisko: </label>
            <input name="name" type="text" value="<?php echo $this->user->name ?>">
        </div>

        <div>
            <label>Numer albumu: </label>
            <input name="nr_album" type="number" value="<?php echo mb_substr($this->user->username, 2, 10); ?>">
        </div>

        <div>
            <label>Kierunek: </label>
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
            <label>Nr. tel: </label>
            <input name="tel" type="number">
        </div>

        <div>
            <label>Email: </label>
            <input name="email" type="email">
        </div>

        <div>
            <label>Data przyjęcia pracy przez promotora: </label>
            <input name="date_accept_promotor" type="date">
        </div>

        <div>
            <label for="rodzaj">Rodzaj studiów: </label>
            <select name="rodzaj" class="w100" id="rodzaj">
                <option value="0">Studia stacjonarne</option>
                <option value="1">Studia niestacjonarne</option>
            </select>
        </div>

        <div>
            <label for="stopien">Stopień studiów: </label>
            <select name="stopien" class="w100" id="stopien">
                <option value="1">Pierwszy stopień</option>
                <option value="2">Drugi stopień</option>
            </select>
        </div>

        <input type="submit" value="Zapisz">
    </form>
</div>