<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
ob_start();

use Joomla\CMS\Date\Date;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Wniosek o przyjęcie pracy dyplomowej </title>
    <meta charset="utf-8">

    <style>
        <?php require_once __DIR__  . '/../../../css/zaswiadczenia.css'; ?>
    </style>

</head>

<body>
    <div class="com_zaswiadczenia pdf">
        <div class="text-right">Szczecin, dnia.
            <?php
            if ($this->formData->date_promotor != null) {
                $date = new Date($this->formData->date_promotor);
                echo JHtml::_('date', $date, 'd.m.Y') . ' r.';
            } else {
                echo '…………………… r.';
            }
            ?>
        </div>

        <div><span class="text-bold">Pan/Pani:</span> <?php echo $this->formData->name; ?></div>

        <div>Nr albumu: <?php echo $this->formData->nr_album; ?></div>

        <div class="text-bold">Wydział informatyki</div>

        <div>Kierunek:
            <?php echo $this->formData->field_of_study; ?>
        </div>

        <div>Specjalność: <?php echo $this->formData->specialty; ?></div>

        <div>Forma i poziom studiów: <?php echo $this->formData->form_and_level_of_study; ?></div>

        <br>

        <div>Nr tel: <?php echo $this->formData->tel; ?></div>

        <div>E-mail: <?php echo $this->formData->email; ?></div>

        <div class="w300 ml380">
            <div class="text-bold text-center pb5">Dziekan Wydziału Informatyki</div>
            <div class="text-bold text-center pb30">dr hab. inż. Jerzy Pejaś</div> <br><br>
        </div>

        <div class="text-center text-bold">WNIOSEK</div>
        <div class="text-center text-bold pb20">o przyjęcie pracy dyplomowej</div> <br>
        <div>Proszę o przyjęcie mojej pracy dyplomowej pt. <?php echo $this->formData->thesis; ?></div> <br>
        <div>Oświadczam, iż przedłożoną pracę dyplomową napisałem samodzielnie.
            Oznacza to, iż przy pisaniu pracy poza niezbędnymi konsultacjami nie korzystałem z pomocy innych
            osób, a w szczególności nie zleciłem opracowania pracy lub jej części innym osobom oraz
            nie przypisałem sobie autorstwa istotnego fragmentu lub innych elementów cudzego utworu lub
            ustalenia naukowego.
        </div> <br><br>

        <div class="w200 ml400">
            <div class>.....................................................</div>
            <div class="text-center text-small">data i podpis studenta</div>
        </div>
        <br>
        <div class="pb5">Opinia opiekuna pracy dyplomowej: <?php echo $this->formData->opinia_promotora; ?>
        </div>

        <div>Proponowany przez opiekuna recenzent pracy: <?php echo $this->formData->proponowany_recenzent; ?></div> <br>

        <div class="w200 ml400">
            <div>.....................................................</div>
            <div class="text-center text-small">podpis opiekuna pracy</div> <br><br>
        </div>

        <br><br>
        <div class="w200 ml400">
            <div class="text-center text-bold">Zgoda Dziekana:</div> <br><br>
            <div>.....................................................</div>
            <div class="text-small text-center">podpis Dziekana</div> <br>
        </div>

        <div class="pt-50 w240">
            <div class=>................................................................</div>
            <div class="text-small text-center">data wpływu wniosku do dziekanatu</div>
        </div>
</body>

</html>





<?php
$html = ob_get_contents();
ob_end_clean();
require_once __DIR__ . '/../../../vendor/autoload.php';
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'setAutoTopMargin' => 'stretch',
    'setAutoBottomMargin' => 'stretch',
    'autoMarginPadding' => 5,
    //        'fontDir' => array_merge($fontDirs, [
    //            __DIR__ . '/../../../fonts',
    //        ]),
    //        'fontdata' => $fontData + [
    //            'librefranklin' => [
    //                'R' => 'librefranklin-regular.ttf',
    //                'B' => 'librefranklin-bold.ttf',
    //            ]
    //        ],
    //        'default_font' => 'librefranklin'
]);
$mpdf->SetHTMLHeader('<p style="text-align: center"></p>');
$mpdf->SetHTMLFooter('
<table width="100%" style="font-size: 80%; color: #666; ">
    <tr>
        <!-- <td width="33%">{DATE j-m-Y}</td> -->
        <td width="15%"><img src="/templates/wizut/assets/images/logo/wi.png" style="height: 1.0cm;"></td>
        <td width="70%" style="text-align: center;">
        Faculty of Computer Science and Information Technology<br>
        Żołnierska 49, 71-210 Szczecin, Poland
        </td>
        <td width="15%" align="right">{PAGENO}/{nbpg}</td>        
    </tr>
</table>');


$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>