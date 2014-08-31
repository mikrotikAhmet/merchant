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
 * @version     $Id: deposit.php Jul 5, 2014 ahmet
 * @copyright   Copyright (c) 2014 Semite LLC .
 * @license     http://www.semitepayment.com/license/
 */
/**
 * Description of deposit.php
 *
 * @author ahmet
 */
// Heading
$_['heading_title'] = 'Payment Deposit';

// Text
$_['text_information'] = '<p>
                %s uses <b>PCI DSS Level - 1 3D Secure Transaction System.</b><br/>
                with <b>PCI Complience</b> Compatible.
            </p>
            <p>
                If your card does not support 3D-Secure transaction please register your card to Visa or Master Card.
            </p>';

// Entry
$_['entry_name'] = 'Card Holder Full Name:';
$_['entry_card_number'] = 'Card Number:';
$_['entry_expire_date'] = 'Expire Date:';
$_['entry_cvv'] = 'CVV:';
$_['entry_amount'] = 'Amount:';

// Error
$_['error_cardholder'] = 'Please entry Credit Card Holder Name!';
$_['error_cardnum'] = 'Please entry valid Credit Card Number!';
$_['error_amount'] = 'Minumum Deposit Amount is %s!';
$_['error_cvv'] = 'Please entry vail CVV Number!';
$_['error_expire'] = 'Please entry expire date!';
$_['error_currency'] = 'Please entry valid Currency!';
$_['error_approved'] = '<i class="icon-remove-sign"></i> Your <b>%s</b> has not been approved yet.<br/>In order to start using your %s please <a href="%s">Activate Your Account</a>';

