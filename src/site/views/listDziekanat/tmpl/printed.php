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

// WYDRUKOWANE WNIOSKI

?>
<div class="com_zaswiadczenia listDziekanat">
    <div class="dziekanat_menu grid">
        <a href="index.php?option=com_zaswiadczenia&view=listDziekanat">Nowe</a>
        <a href="index.php?option=com_zaswiadczenia&view=listDziekanat&layout=printed">Wydrukowane</a>
        <a href="index.php?option=com_zaswiadczenia&view=listDziekanat&layout=ended">Zakończone</a>
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
            <table class = "text-left printed">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Data przysłania</th>
                        <th>Data wydrukowania</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr> 
                </haed>
                <tbody>
            EOF;

        foreach ($list as $item) {


            $link = JRoute::_('index.php?option=com_zaswiadczenia&view=item' . $number . '&id=' . $item->id . '&layout=pdf');

            $acceptButton = '<a class="accept-button button" href="index.php?option=com_zaswiadczenia&task=thesis' . $number . '.accept&id=' . $item->id . '">Przyjmij</a>';
            $rejectButton = '<a class="reject-button button" href="index.php?option=com_zaswiadczenia&view=item' . $number . '&backLayout=printed&layout=rejectAsDziekanat&id=' . $item->id . '">Odrzuć</a>';

            echo <<<EOF
                <tr>
                    <td>$item->name</td>
                    <td>$item->date_promotor</td>
                    <td>$item->date_printed</td>
                    <td>$acceptButton</td>
                    <td>$rejectButton</td>
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
