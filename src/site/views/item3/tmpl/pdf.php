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

        <div class="w280 pb10">
            <div class="text-center pb-10"><?php echo $this->formData->name; ?></div>
            <div class="text-center text-small">.........................................................................................</div>
            <div class="text-center text-small">nazwisko i imię</div>
        </div>

        <div class="w280 pb10">
            <div class="text-center pb-10"><?php echo $this->formData->nr_album; ?></div>
            <div class="text-center text-small">.........................................................................................</div>
            <div class="text-center text-small">nr albumu</div>
        </div>

        <div class="w280 pb10">
            <div class="text-center pb-10 text-very-small"><?php echo $this->formData->field_of_study . ', ' . $this->formData->form_and_level_of_study; ?></div>
            <div class="text-center text-small">.........................................................................................</div>
            <div class="text-center text-small">kierunek, formia i stopień studiów</div>
        </div>

        <div class="w280 pb10">
            <div class="text-center text-very-small pb-10"><?php echo $this->formData->address; ?>, tel: <?php echo $this->formData->tel ?></div>
            <div class="text-center text-small">.........................................................................................</div>
            <div class="text-center text-small">adres zamieszkania/telefon</div>
        </div>


        <div class="w300 ml300">
            <div class="text-bold">Prodziekan ds. Studenckich i kształcenia</div>
            <div class="text-bold">Wydział Informatyki Zachodniopomorskiego</div>
            <div class="text-bold">Uniwersytetu Technologicznego w Szczecinie</div>
            <div class="text-bold">dr inż. Anna Barcz/ dr. inż. Piotr Błaszyński*</div>
        </div>

        <br><br>

        <div class="text-center text-bold">Podanie o przesunięcie terminu złożenia pracy dyplomowej</div><br>
        <div>Proszę o wyrażenie zgody na przedłużenie terminu złożenia pracy dyplomowej do dnia <?php echo $this->dateDMY ?> z powodu <?php echo $this->formData->student_reason; ?></div>
        <br>

        <div>Temat: <?php echo $this->formData->thesis; ?></div>
        <div>Opiekun pracy: <?php echo $this->formData->promotor_name_with_title ?></div> <br>

        <div class="w200 ml400">
            <div class>.....................................................</div>
            <div class="text-center text-small">podpis studenta</div>
        </div>
        <br>
        <div>Opinia opiekuna pracy dyplomowej: </div>
        <div>1) Ocena stopnia zaawansowania pracy: <?php echo $this->formData->work_progress; ?>%</div>
        <div>2) Uzasadnienie: <?php echo $this->formData->substantiation_promotor; ?></div>
        <br><br>

        <div class="ml50">
            <input type="text" size="3" value="<?php if ($this->formData->decision_promotor == 0) echo "X" ?>"> popieram prośbę studenta
            <input type="text" size="3" value="<?php if ($this->formData->decision_promotor == 1) echo "X" ?>"> nie popieram prośby studenta
        </div>
        <br>

        <div class="w200 ml400">
            <div class>.....................................................</div>
            <div class="text-center text-small">podpis opiekuna pracy</div>
        </div>
        <br>
        <div>
            <div class="pb5 text-bold">Decyzja:  Wyrażam zgodę/ nie wyrażam zgody*</div>
        </div>
        <br>
        <div class="w200 ml400">
            <div class>.....................................................</div>
            <div class="text-center text-small">podpis Prodziekana</div>
        </div>
        <div class="text-left text-small">*niepotrzebne skreślić</div>
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