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
                This part will work with <b>PCI DSS Level - 1 3D Secure.</b><br/>
                Hosting of this Application should be <b>PCI Complience</b> Supported.
            </p>
            <p>
                Also Payment Gateway API will be design after application has <b><i>Online Payment Gateway</i></b> SMS Gateway will be integrated to simulate 3D-Secure system for internal payments.
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
$_['error_amount'] = 'Minumum Deposit Amount is 10EUR!';
$_['error_cvv'] = 'Please entry vail CVV Number!';
$_['error_expire'] = 'Please entry expire date!';

