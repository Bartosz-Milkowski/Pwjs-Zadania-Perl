<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="com_zaswiadczenia item">
    <h2>Podstawowe informacje</h2>

    <div class="pdf_bar">
        <a href="<?= JRoute::_('&layout=pdf') ?>">PDF</a>
    </div>

    <p><strong>Imie i nazwisko:</strong> <?php echo $this->formData->name; ?></p>
    <p><strong>Kierunek:</strong> <?php echo $this->formData->field_of_study; ?></p>
    <p><strong>Specjalność:</strong> <?php echo $this->formData->specialty; ?></p>
    <p><strong>Forma i poziom studiów:</strong> <?php echo $this->formData->form_and_level_of_study; ?></p>
    <p><strong>Nr tel:</strong> <?php echo $this->formData->tel; ?></p>
    <p><strong>E-mail:</strong> <?php echo $this->formData->email; ?></p>
    <p><strong>Data przyjęcia pracy przez promotora</strong> <?php echo $this->dateDMY; ?></p>

</div>

<script type="text/javascript">

</script>