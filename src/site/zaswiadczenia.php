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

JTable::addIncludePath(JPATH_BASE . '/administrator/components/com_zaswiadczenia/tables');

$document = JFactory::getDocument();
$url = JUri::base() . 'components/com_zaswiadczenia/css/zaswiadczenia.css';

// dołaczenie stylów i javascriptu do komponentu
$document->addStyleSheet($url);
$document->addScript(/*JUri::base() . */'/components/com_zaswiadczenia/js/zaswiadczenia.js');

// Get an instance of the controller
$controller = JControllerLegacy::getInstance('zaswiadczenia');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
