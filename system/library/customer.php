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
    private $username;
    private $email;
    private $telephone;
    private $approved;
    private $fax;
    private $newsletter;
    private $customer_group_id;
    private $address_id;
    private $canSale;

    public function __construct($registry) {
        $this->config = $registry->get('config');
        $this->db = $registry->get('db');
        $this->request = $registry->get('request');
        $this->session = $registry->get('session');

        if (isset($this->session->data['customer_id'])) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $this->session->data['customer_id'] . "' AND status = '1'");

            if ($customer_query->num_rows) {
                $this->customer_id = $customer_query->row['customer_id'];
                $this->firstname = $customer_query->row['firstname'];
                $this->lastname = $customer_query->row['lastname'];
                $this->email = $customer_query->row['email'];
                $this->telephone = $customer_query->row['telephone'];
                $this->fax = $customer_query->row['fax'];
                $this->newsletter = $customer_query->row['newsletter'];
                $this->customer_group_id = $customer_query->row['customer_group_id'];
                $this->address_id = $customer_query->row['address_id'];
                $this->approved = $customer_query->row['approved'];

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int) $this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

                if (!$query->num_rows) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int) $this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
                }
            } else {
                $this->logout();
            }
        }
    }

    public function login($email, $password, $override = false) {
        if ($override) {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer where LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
        } else {
            $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");
        }

        if ($customer_query->num_rows) {
            $this->session->data['customer_id'] = $customer_query->row['customer_id'];

            $this->customer_id = $customer_query->row['customer_id'];
            $this->firstname = $customer_query->row['firstname'];
            $this->lastname = $customer_query->row['lastname'];
            $this->email = $customer_query->row['email'];
            $this->telephone = $customer_query->row['telephone'];
            $this->fax = $customer_query->row['fax'];
            $this->newsletter = $customer_query->row['newsletter'];
            $this->customer_group_id = $customer_query->row['customer_group_id'];
            $this->address_id = $customer_query->row['address_id'];
            $this->approved = $customer_query->row['approved'];

            $this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int) $this->customer_id . "'");

            return true;
        } else {
            return false;
        }
    }

    public function logout() {

        unset($this->session->data['customer_id']);

        $this->customer_id = '';
        $this->firstname = '';
        $this->lastname = '';
        $this->email = '';
        $this->telephone = '';
        $this->fax = '';
        $this->newsletter = '';
        $this->customer_group_id = '';
        $this->approved = '';
    }

    public function isLogged() {
        return $this->customer_id;
    }
    
    public function isApproved() {
        return $this->approved;
    }

    public function getId() {
        return $this->customer_id;
    }

    public function getFirstName() {
        return $this->firstname;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getFax() {
        return $this->fax;
    }
    
    public function getUserName() {
        return $this->firstname.' '.$this->lastname;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }

    public function getCustomerGroupId() {
        return $this->customer_group_id;
    }

    public function getAddressId() {
        return $this->address_id;
    }
    
    public function getCustomerCountryId() {
        
        $query = $this->db->query("SELECT country_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['country_id'];
        } else {
            return false;
        }
    }
    
    public function getDeclineCVC() {
        
        $query = $this->db->query("SELECT decline_cvc FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['decline_cvc'];
        } else {
            return false;
        }
    }
    
    public function getDeclineZIP() {
        
        $query = $this->db->query("SELECT decline_zip FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['decline_zip'];
        } else {
            return false;
        }
    }
    
    public function getCustomerZoneId() {
        
        $query = $this->db->query("SELECT zone_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['zone_id'];
        } else {
            return false;
        }
    }
    
    public function getAvatar(){
        return false;
    }

    public function getBalance() {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".$this->config->get('config_complete_transaction_status_id')."'");
        
        $this->db->query("UPDATE ".DB_PREFIX."customer_account SET balance ='".(float) $query->row['total']."' WHERE customer_id = '".(int) $this->customer_id."'");
        
        return $query->row['total'];
    }
    
    public function getAvailabeBalance() {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".$this->config->get('config_complete_transaction_status_id')."' AND `type` IN('Withdraw','Deposit','Sale','Commision')");
        
        $withdraw = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "withdraw WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".$this->config->get('config_transfer_status_id')."'");
        
        $available_withdraw_balance = $query->row['total'] - str_replace("-", "", $withdraw->row['total']);
        
        return $available_withdraw_balance;
    }
    
    public function getLastWithdraw() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "withdraw WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".(int) $this->config->get('config_complete_transfer_status_id')."' ORDER BY date_proceed DESC");

        return $query->row;
    }
    
    public function getTotalSuccessWithdraw() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "withdraw WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".(int) $this->config->get('config_complete_transfer_status_id')."'");

        if($query->row['total']){ 
        return $query->row['total'];
        } else {
            return 0;
        }
    }
    
    public function getTotalPendingWithdraw() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "withdraw WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".(int) $this->config->get('config_transfer_status_id')."'");

        if($query->row['total']){ 
        return $query->row['total'];
        } else {
            return 0;
        }
    }
    
    public function getTotalTransaction() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".(int) $this->config->get('config_complete_transaction_status_id')."'");

        if($query->row['total']){ 
        return $query->row['total'];
        } else {
            return 0;
        }
    }
    
    public function getNextWithdraw() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "withdraw WHERE customer_id = '" . (int) $this->customer_id . "' AND status = '".(int) $this->config->get('config_transfer_status_id')."' ORDER BY date_added DESC");

        return $query->row;
    }
    

    public function getRewardPoints() {
        $query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int) $this->customer_id . "'");

        return $query->row['total'];
    }
    
    public function getTestSecret(){
        
        $query = $this->db->query("SELECT test_secret_key FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['test_secret_key'];
        } else {
            return false;
        }
    }
    
    public function getTestPublic(){
        
        $query = $this->db->query("SELECT test_public_key FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['test_public_key'];
        } else {
            return false;
        }
    }
    
    public function getLiveSecret(){
        
        $query = $this->db->query("SELECT live_secret_key FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['live_secret_key'];
        } else {
            return false;
        }
    }
    public function getLivePublic(){
        
        $query = $this->db->query("SELECT live_public_key FROM " . DB_PREFIX . "customer_account WHERE customer_id = '" . (int) $this->customer_id . "'");
        
        if ($query){
            return $query->row['live_public_key'];
        } else {
            return false;
        }
    }
    
     public function getSettlementCurrency($bank_id) {
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_bank WHERE customer_id = '" . (int) $this->customer_id . "' AND customer_bank_id = '".(int) $bank_id."'");
        
        if ($query){
            return $query->row['settlement_currency'];
        } else {
            return $this->config->get('config_currency');
        }
    }
    
    public function isSale(){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_group WHERE customer_group_id = '".(int) $this->customer_group_id."'");
        
        return $query->row['sale'];
    }
    
    public function getAccountType(){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_group cg LEFT JOIN ".DB_PREFIX."customer_group_description cgd ON(cg.customer_group_id = cgd.customer_group_id) WHERE cg.customer_group_id = '".(int) $this->customer_group_id."'");
        
        return $query->row['name'];
    }

}
