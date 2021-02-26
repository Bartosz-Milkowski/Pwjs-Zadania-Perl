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
            <table class = "text-left active">
                <thead>
                    <tr>
                        <th>Data wysłania</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>  
            EOF;

        foreach ($list as $item) {
            $link = JRoute::_('index.php?option=com_zaswiadczenia&view=item' . $number . '&id=' . $item->id);
            $buttonEdit = "";
            $buttonDelete = "";
            $buttonSend = "";

            if ($item->status_student == 10 || $item->status_student == 11) {
                $buttonSend = '<a class="accept-button button" href="index.php?option=com_zaswiadczenia&task=thesis' . $number . '.send&id=' . $item->id . '">Wyślij</a>';
                $buttonEdit = '<a class="edit-button button" href="index.php?option=com_zaswiadczenia&view=item' . $number . '&layout=edit&id=' . $item->id . '">Edytuj</a>';
            }

            if ($item->status_student == 10) {
                $buttonDelete =  '<a class="reject-button button" href="index.php?option=com_zaswiadczenia&task=thesis' . $number . '.delete&id=' . $item->id . '">Usuń</a>';
            }

            $date = "Nie wysłano";

            if ($item->date != null) {
                $date = $item->date;
            }

            echo <<<EOF
            <tr>
                <td>$date</td>
                <td>$item->statusText</td>
                <td>$buttonSend</td>
                <td>$buttonEdit</td>
                <td>$buttonDelete</td>
                <td class = "text-right"><a href = "$link">Podgląd</a></td>
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