<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * @package     Semite LLC
 * @version     $Id: withdraw.php Jul 5, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of withdraw.php
 *
 * @author ahmet
 */

// Heading
$_['heading_title'] = 'Payment Withdraw';

// Text
$_['text_balance'] = 'Available Balance';
$_['text_balance_withdraw'] = 'Available Withdraw Balance';

// Entry
$_['entry_account'] = 'Bank Account';
$_['entry_amount'] = 'Amount';
$_['entry_comment'] = 'Comment';

// Error
$_['error_currency'] = 'Please entry valid Currency!';
$_['error_bank'] = 'Please select valid Bank Account!';
$_['error_amount'] = 'Minumum Withdraw Amount is %s!';
$_['error_balance'] = 'Insufficient Amount';
$_['error_approved'] = '<i class="icon-remove-sign"></i> Your <b>%s</b> has not been approved yet.<br/>In order to start using your %s please <a href="%s">Activate Your Account</a>';