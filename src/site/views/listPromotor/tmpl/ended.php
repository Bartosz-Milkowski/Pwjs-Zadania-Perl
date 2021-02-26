<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_zaswiadczenia
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Date\Date;

?>
<div class="com_zaswiadczenia listPromotor">
    <div class="promotor_menu grid">
        <a href="index.php?option=com_zaswiadczenia&view=listPromotor">Aktywne</a>
        <a href="index.php?option=com_zaswiadczenia&view=listPromotor&layout=ended">Zakończone</a>
    </div>

    <?php

    generateStructure($this->listThesis1, 1, $this->title1);
    generateStructure($this->listThesis3, 3, $this->title3);
    generateStructure($this->listThesis4, 4, $this->title4);

    ?>

    <!-- <h2>Podanie o zmianę tematu lub opiekuna pracy dyplomowej</h2> -->
    <!-- <h2>Podanie o przedłużenie terminu złożenia pracy (Dziekan)</h2> -->

</div>


<?php

function generateStructure($list, $number, $title)
{
    if ($list != null) {
        echo <<<EOF
            <h2>$title</h2>
            <table class="text-left ended">
                <thead>
                <tr>
                    <th>Student</th>
                    <th>Status</th>
                    <th>Przysłane</th>
                    <th>Wysłane</th>
                    <th>Zakończone</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>  
            EOF;

        foreach ($list as $item) {
            $reason = "";
            if ($item->status_promotor == 7) {
                if ($item->reject_reason_dziekanat != "") {
                    $reason = $item->reject_reason_dziekanat;
                } else {
                    $reason = 'Nie podano powodu';
                }
            } elseif ($item->status_promotor == 8) {
                if ($item->reject_reason_promotor != "") {
                    $reason = $item->reject_reason_promotor;
                } else {
                    $reason = 'Nie podano powodu';
                }
            }

            $reasonDiv = "";

            if ($item->status_student == 7 || $item->status_student == 4) {
                $reasonDiv = '<div class = "reject_reason" title = "' . $reason . '">Powód</div>';
            }

            $date_format = "d-m-Y";

            $date_to_promotor = JHtml::_('date', new Date($item->date), $date_format);
            $date_to_dziekanat = "";

            if ($item->date_dziekanat != null) {
                $date_to_dziekanat = JHtml::_('date', new Date($item->date_promotor), $date_format);
            }

            if ($item->date_dziekanat != null) {
                $date_finish = JHtml::_('date', new Date($item->date_dziekanat), $date_format);
            } else {
                $date_finish = JHtml::_('date', new Date($item->date_promotor), $date_format);
            }

            $link = JRoute::_('index.php?option=com_zaswiadczenia&view=item' . $number . '&id=' . $item->id . '&layout=pdf');

            echo <<<EOF
                <tr>
                    <td> $item->name</td>
                    <td> $item->statusText</td>

                    <td>$date_to_promotor</td>
                    <td>$date_to_dziekanat</td>
                    <td>$date_finish</td>

                    <td class = "text-right"> $reasonDiv</td>
                    <td class = "text-right">
                        <a class="document" href="$link">
                            PDF
                        </a>
                    </td>
                </tr>
        EOF;
        }
        echo <<<EOF
            </tbody>
        </table>
    EOF;
    }
}

?>