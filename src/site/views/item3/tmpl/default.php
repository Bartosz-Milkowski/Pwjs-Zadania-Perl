<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="com_zaswiadczenia item">
    <h2>Podstawowe informacje</h2>

    <div class="pdf_bar">
        <a href="<?= JRoute::_('&layout=pdf') ?>">PDF</a>
    </div>

    <p><strong>Nazwisko i imię:</strong> <?php echo $this->formData->name; ?></p>
    <p><strong>Kierunek:</strong> <?php echo $this->formData->field_of_study; ?></p>
    <p><strong>Forma i poziom studiów:</strong> <?php echo $this->formData->form_and_level_of_study; ?></p>
    <p><strong>Temat pracy dympomowej:</strong> <?php echo $this->formData->thesis; ?></p>
    <p><strong>Numer telefonu:</strong> <?php echo $this->formData->tel; ?></p>
    <p><strong>Adres zamieszkania: </strong><?php echo $this->formData->address; ?></p>
    <p><strong>Przedłużenie do dnia: </strong><?php echo $this->dateDMY; ?></p>
    <p><strong>Powód przedłużenia: </strong><?php echo $this->formData->student_reason; ?></p>

    <h2>Dane podane przez promotora</h2>
    <p><strong>Ocena stopnia zaawansowania pracy:</strong> <?php echo $this->formData->work_progress; ?>%</p>
    <p><strong>Uzasadnienie: </strong> <?php echo $this->formData->substantiation_promotor; ?></p>
    <p><strong>Decyzja: </strong>
        <?php if ($this->formData->decision_promotor == 0) : ?>
            Popieram prośbę studenta
        <?php else : ?>
            Nie popieram prośby studenta
        <?php endif ?>
    </p>
</div>

<script type="text/javascript">

</script>