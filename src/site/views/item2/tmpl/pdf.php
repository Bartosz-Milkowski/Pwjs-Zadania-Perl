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
            if ($this->formData->date != null) {
                $date = new Date($this->formData->date);
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
        <br><br>
        <div class="w300 ml380">
            <div class="text-bold text-center pb5">Dziekan Wydziału Informatyki</div>
            <div class="text-bold text-center pb30">dr hab. inż. Jerzy Pejaś</div> <br><br><br>
        </div>

        <div class="text-center text-bold">WNIOSEK</div>
        <div class="text-center text-bold pb20 ">o dopuszczenie do egzaminu dyplomowego i wyznaczenie jego terminu</div> <br><br><br>

        <div class="pb5">Wszystkie przedmioty przewidziane w planie i programie studiów </div>
        <div class="pb5">na studiach
            <span class="<?php if ($this->formData->rodzaj == 0) echo "underline" ?>">stacjonarnych</span>/
            <span class="<?php if ($this->formData->rodzaj == 1) echo "underline" ?>">niestacjonarnych</span>*
            <span class="<?php if ($this->formData->stopien == 1) echo "underline" ?>">pierwszego</span>/
            <span class="<?php if ($this->formData->stopien == 2) echo "underline" ?>">drugiego</span>*
            stopnia
        </div>
        <div>na kierunku <span class="text-bold"><?php echo $this->formData->field_of_study; ?></span> zostały przeze mnie zaliczone.</div> <br><br>

        <div class="w200 ml400">
            <div class>.....................................................</div>
            <div class="text-center text-small">data i podpis studenta</div>
        </div>

        <br>

        <div>Moja praca dyplomowa została przyjęta przez opiekuna pracy <span class="text-bold"><?php echo $this->formData->promotor_name; ?></span></div>
        <div>w dniu <?php echo $this->dateDMY; ?></div>

        <br>
        <hr>
        <br><br><br>

        <div class="pb5"><span class="text-bold">Decyzja Dziekana: </span>dopuszczam/ nie dopuszczam* do egzaminu dyplomowego</div>
        <div class="pb5">Uwagi: .........................................................................................................................................................</div>
        <div>Ustalam termin egzaminu dyplomowego na dzień: ..................................... godz. ..................................... </div>

        <br><br><br><br>

        <div class="w200 ml400">
            <div>.....................................................</div>
            <div class="text-small text-center">podpis Dziekana</div> <br>
        </div>


        <div class="text-left text-italic text-small"> * właściwe podkreślić</div>
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