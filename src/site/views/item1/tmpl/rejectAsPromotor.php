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

// ODRZUCENIE WNIOSKU

?>
<div class="com_zaswiadczenia item">
    <h1>Odrzucenie wniosku studenta</h1>
    <p><span class="text-bold">Student:</span> <?= $this->formData->name ?></p>

    <form method="post" action='index.php?option=com_zaswiadczenia&task=thesis1.rejectAsPromotor'>
        <div>Podaj powód odrzucenia wniosku studenta:</div>
        <textarea name="reject_reason_promotor" rows="5" class="textarea-100"></textarea> <br> <br>
        <input type="hidden" name="id" value="<?= $this->formData->id ?>">
        <input type="hidden" name="backLayout" value="<?= $this->backLayout ?>">
        <input type="submit" value="Odrzuć wniosek" class="rejectButton">
    </form>
</div>