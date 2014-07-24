<?php

if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * SEMITE LTD
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		SemitePROJECT
 * @author		SemitePROJECT Dev Team
 * @copyright	Copyright (c) 2008 - 2011, Semite LLC.
 * @license		http://semiteproject.com/user_guide/license.html
 * @link		http://semiteproject.com
 * @since		Version 1.0.14
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * SemitePROJECT {$name} Class
 *
 * 
 *
 * @package		SemitePROJECT
 * @subpackage	
 * @category	
 * @author		SemitePROJECT Dev Team
 * @link		http://semiteproject.com/license-default.html
 */

/**
 * Description of {$name}
 *
 * @author {$name}
 */
class ModelPaymentTransaction extends Model {

    public function addTransaction($type,$card_data, $description = '', $data) {

        $this->load->model('account/customer');
        $this->load->helper('creditcard');

                $digits = 7;
                $transaction_id = rand(pow(10, $digits-1), pow(10, $digits)-1);
        

        $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());

        if ($customer_info) {
            $autocapture = $this->config->get('config_transaction_autocapture');
            $this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int) $this->customer->getId() . "', transaction_id = '" . (int) $transaction_id . "', type='".$this->db->escape($type)."',description = '" . $this->db->escape($this->config->get('config_name')) . "', amount = '" . (float) $data['amount'] . "',card_type = '".$this->db->escape($card_data['type'])."', card_number = '".$this->db->escape($card_data['substring'])."', date_added = NOW(), status = '".(isset($autocapture) ? (int) $this->config->get('config_complete_transaction_status_id') : $this->config->get('config_transaction_status_id'))."'");
        }
    }
    
    public function addTransactionWithdraw($data){
        
        $this->load->model('localisation/currency');

        $currency_info = $this->model_localisation_currency->getCurrencyByCode($this->config->get('config_currency'));

        if ($currency_info) {
                $currency_id = $currency_info['currency_id'];
                $currency_code = $currency_info['code'];
                $currency_value = $currency_info['value'];
        } else {
                $currency_id = 0;
                $currency_code = $this->config->get('config_currency');
                $currency_value = 1.00000;			
        }
        
        $invoice_prefix = $this->config->get('config_invoice_prefix');
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $forwarded_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        
        
        $this->db->query("INSERT INTO ".DB_PREFIX."withdraw SET customer_id = '".(int) $this->customer->getId()."', invoice_prefix = '".$this->db->escape($invoice_prefix)."' ,firstname = '".$this->db->escape($this->customer->getFirstName())."',lastname = '".$this->db->escape($this->customer->getLastName())."', currency_code = '".$this->db->escape($currency_code)."',currency_value = '".(float) $currency_value."', commission = '".(float) $this->config->get('config_commission')."', ip = '".$this->db->escape($ip)."',forwarded_ip = '".$this->db->escape($forwarded_ip)."',user_agent = '".$this->db->escape($user_agent)."',accept_language = '".$this->db->escape($accept_language)."',date_added = NOW(), amount = '-".(float) $data['amount']."', to_account = '".(int) $data['bank_id']."', comment = '".$this->db->escape($data['comment'])."',status = '".(int) $this->config->get('config_transfer_status_id')."'");
        
        $transaction_id = $this->db->getLastId();
        
        $this->db->query("INSERT INTO ".DB_PREFIX."customer_transaction SET transaction_id = '".(int) $transaction_id."', `type`= 'Withdraw', customer_id = '".(int) $this->customer->getId()."', description = 'Wire Transfer', amount = '-".(float) $data['amount']."', date_added = NOW(), status = '".(int)$this->config->get('config_transfer_status_id')."' ");
        
        $withdraw_id = $this->db->getLastId();
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "withdraw_history SET withdraw_id = '" . (int)$withdraw_id . "', withdraw_status_id = '" . (int)$this->config->get('config_transfer_status_id') . "', notify = '0', comment = '', date_added = NOW()");
    }
    
    public function getRecentTransactions($limit = 10) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $this->customer->getId() . "' ORDER BY date_added DESC LIMIT ".$limit);
        
        return $query->rows;
    }

    public function getTransactions($data = array()) {
        
        $sql = "SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $this->customer->getId() . "'";

        $sort_data = array(
            'amount',
            'description',
            'date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY date_added";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalTransactions() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $this->customer->getId() . "'");

        return $query->row['total'];
    }

    public function getTotalAmount() {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int) $this->customer->getId() . "' GROUP BY customer_id");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

}

?>
