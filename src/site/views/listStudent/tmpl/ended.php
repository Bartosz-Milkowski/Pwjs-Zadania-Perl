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

// !Sprawdz czy jestem studentem

use Joomla\CMS\Date\Date;

?>
<div class="com_zaswiadczenia listStudent">
    <div class="student_menu grid">
        <a href="index.php?option=com_zaswiadczenia&view=listStudent">Aktywne</a>
        <a href="index.php?option=com_zaswiadczenia&view=listStudent&layout=ended">Zakończone</a>
    </div>

    <?php

    generateStructure($this->listThesis1, 1, $this->title1);
    generateStructure($this->listThesis2, 2, $this->title2);
    generateStructure($this->listThesis3, 3, $this->title3);
    generateStructure($this->listThesis4, 4, $this->title4);

    ?>


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
                    <th>Data zakończenia</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>  
            EOF;

        foreach ($list as $item) {
            $reason = "";

            if ($item->status_student == 7) {
                if ($item->reject_reason_dziekanat != "") {
                    $reason = $item->reject_reason_dziekanat;
                } else {
                    $reason = 'Nie podano powodu';
                }
            } elseif ($item->status_student == 4) {
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


            $date = "Nie wysłano";

            if ($item->status_student == 4) {
                $date = $item->date_promotor;
            } else if ($item->status_student == 6 || $item->status_student == 7) {
                $date = $item->date_dziekanat;
            }

            $link = JRoute::_('index.php?option=com_zaswiadczenia&view=item' . $number . '&id=' . $item->id . '&layout=pdf');

            echo <<<EOF
            <tr>
                <td>$date</td>
                <td>$item->statusText</td>
                <td class = "text-right">$reasonDiv</td>
                <td class ="text-right"><a href = "$link">Podgląd</a></td>
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