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
    <!-- Wnioski o przyjęcie pracy dyplomowej -->

    <?php

    generateStructure($this->listThesis1, 1, $this->title1);
    generateStructure($this->listThesis3, 3, $this->title3);
    generateStructure($this->listThesis4, 4, $this->title4);

    ?>

    <!-- <h2>Podanie o zmianę tematu lub opiekuna pracy dyplomowej</h2> -->
    <!-- <h2>Podanie o przedłużenie terminu złożenia pracy (Dziekan)</h2> -->
    <!-- <h2>Podanie o przedłużenie terminu złożenia pracy (Prorektor)</h2> -->
</div>

<?php

function generateStructure($list, $number, $title)
{
    if ($list != null) {
        echo <<<EOF
            <h2>$title</h2>
            <table class="text-left active">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Data wysłania</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
            <tbody>  
            EOF;

        foreach ($list as $item) {
            $link_to_pdf = JRoute::_('index.php?option=com_zaswiadczenia&view=item' . $number . '&id=' . $item->id . '&layout=pdf');
            $to_dziekanat = "";
            $from_student = JHtml::_('date', new Date($item->date), 'd-m-Y');

            if ($item->date_promotor == null) {
                $to_dziekanat = "Nie wysłano";
            } else {
                $to_dziekanat = JHtml::_('date', new Date($item->date_promotor), 'd-m-Y');
            }

            $buttonEdit = "";
            $buttonReject = "";
            $buttonReBack = "";
            $buttonSend = "";

            if ($item->status_promotor == 1 || $item->status_promotor == 12 || $item->status_promotor == 10) {
                $buttonEdit = '<a class="edit-button button" href="index.php?option=com_zaswiadczenia&view=add' . $number . 'Promotor&id=' . $item->id . '">Edytuj</a>';
                $buttonReject = '<a class="reject-button button" href="index.php?option=com_zaswiadczenia&view=item' . $number . '&layout=rejectAsPromotor&id=' . $item->id . '">Odrzuć</a>';
                $buttonReBack = '<a class="back-button button" href="index.php?option=com_zaswiadczenia&task=thesis' . $number . '.sendBack&id=' . $item->id . '">Odeślij</a>';
            }

            if ($item->status_promotor == 10 || $item->status_promotor == 12) {
                $buttonSend = '<a class="accept-button button" href="index.php?option=com_zaswiadczenia&task=thesis' . $number . '.sendAsPromotor&id=' . $item->id . '">Wyślij</a>';
            }

            echo <<<EOF
                    <tr>
                        <td>$item->name</td>
                        <td>$to_dziekanat</td>
                        <td>$item->statusText</td>
                        <td>$buttonEdit</td>
                        <td>$buttonReject</td>
                        <td>$buttonReBack</td>
                        <td>$buttonSend</td>
                        <td class = "text-right"><a href = "$link_to_pdf">PDF</a></td>
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