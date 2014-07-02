<?php

if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

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
 * Description of user Class
 *
 * @author ahmet
 */
class Customer {
    
    private $customer_id;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $fax;
    private $newsletter;
    private $customer_group_id;
    private $address_id;
    
    public function __construct($customer_object) {
        
        $this->customer_id = $customer_object->customer_id;
    }


    public function isLogged(){
        return $this->customer_id;
    }
}
