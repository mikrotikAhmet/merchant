<?php

class ModelAccountCustomer extends Model {
    
    public function addBank($data=array()){
        
        if (isset($data)) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "customer_bank SET customer_id = '" . (int) $this->customer->getId() . "', bank_name = '" . $this->db->escape(strtoupper($data['bank_name'])) . "', settlement_currency = '".$this->db->escape($data['settlement_currency'])."',account_holder = '" . $this->db->escape(strtoupper($data['account_holder_name'])) . "', iban = '" . $this->db->escape($data['iban']) . "', swift = '" . $this->db->escape($data['swift']) . "'");
        }
    }
    
    public function removeBank($bank_id){
        $this->db->query("DELETE FROM ".DB_PREFIX."customer_bank WHERE customer_id = '".(int) $this->customer->getId()."' AND customer_bank_id = '".(int) $bank_id."'");
    }

    public function editCustomerAccount($data = array()){
        
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET email = '" . $this->db->escape($data['email']) . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        
        $this->db->query("UPDATE " . DB_PREFIX . "customer_account SET decline_cvc = '" . (isset($data['decline_cvc']) ? (int)$data['decline_cvc'] : 0) . "', decline_zip = '".(isset($data['decline_zip']) ? (int)$data['decline_zip'] : 0)."' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
        
        $this->db->query("UPDATE " . DB_PREFIX . "address SET country_id = '" . (int) $data['country_id'] . "',zone_id = '" . (int) $data['zone_id'] . "' WHERE customer_id = '" . (int) $this->customer->getId() . "' AND address_id = '".(int) $this->customer->getAddressId()."'");
    }

    public function editToken($customer_id, $token) {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int) $customer_id . "'");
    }
    
    public function updatePassword($oldpassword, $newpassword) {
        
        $customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($oldpassword) . "'))))) OR password = '" . $this->db->escape(md5($oldpassword)) . "') AND status = '1'");
        
        if ($customer_query->row) {
            $this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($newpassword)))) . "' WHERE customer_id = '" . (int) $this->customer->getId() . "'");
            return $customer_query->row;
        } else {
            return false;
        }
    }

    public function getCustomer($customer_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row;
    }

    public function getCustomerByEmail($email) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function getCustomers($data = array()) {
        $sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name, cgd.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

        $implode = array();

        if (!empty($data['filter_name'])) {
            $implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        }

        if (!empty($data['filter_email'])) {
            $implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        }

        if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
            $implode[] = "c.newsletter = '" . (int) $data['filter_newsletter'] . "'";
        }

        if (!empty($data['filter_customer_group_id'])) {
            $implode[] = "c.customer_group_id = '" . (int) $data['filter_customer_group_id'] . "'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $implode[] = "c.status = '" . (int) $data['filter_status'] . "'";
        }

        if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
            $implode[] = "c.approved = '" . (int) $data['filter_approved'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        if ($implode) {
            $sql .= " AND " . implode(" AND ", $implode);
        }

        $sort_data = array(
            'name',
            'c.email',
            'customer_group',
            'c.status',
            'c.approved',
            'c.date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
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

    public function getAddress($address_id) {
        $address_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int) $address_id . "'");

        if ($address_query->num_rows) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $address_query->row['country_id'] . "'");

            if ($country_query->num_rows) {
                $country = $country_query->row['name'];
                $iso_code_2 = $country_query->row['iso_code_2'];
                $iso_code_3 = $country_query->row['iso_code_3'];
                $address_format = $country_query->row['address_format'];
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $address_query->row['zone_id'] . "'");

            if ($zone_query->num_rows) {
                $zone = $zone_query->row['name'];
                $zone_code = $zone_query->row['code'];
            } else {
                $zone = '';
                $zone_code = '';
            }

            return array(
                'address_id' => $address_query->row['address_id'],
                'customer_id' => $address_query->row['customer_id'],
                'firstname' => $address_query->row['firstname'],
                'lastname' => $address_query->row['lastname'],
                'company' => $address_query->row['company'],
                'company_id' => $address_query->row['company_id'],
                'tax_id' => $address_query->row['tax_id'],
                'address_1' => $address_query->row['address_1'],
                'address_2' => $address_query->row['address_2'],
                'postcode' => $address_query->row['postcode'],
                'city' => $address_query->row['city'],
                'zone_id' => $address_query->row['zone_id'],
                'zone' => $zone,
                'zone_code' => $zone_code,
                'country_id' => $address_query->row['country_id'],
                'country' => $country,
                'iso_code_2' => $iso_code_2,
                'iso_code_3' => $iso_code_3,
                'address_format' => $address_format
            );
        }
    }

    public function getAddresses($customer_id) {
        $address_data = array();

        $query = $this->db->query("SELECT address_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");

        foreach ($query->rows as $result) {
            $address_info = $this->getAddress($result['address_id']);

            if ($address_info) {
                $address_data[$result['address_id']] = $address_info;
            }
        }

        return $address_data;
    }

    public function getTotalAddressesByCustomerId($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }
    
     public function getTotalCustomersByEmail($mail) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE email = '" . $this->db->escape($mail) . "'");

        return $query->row['total'];
    }

    public function getTotalAddressesByCountryId($country_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE country_id = '" . (int) $country_id . "'");

        return $query->row['total'];
    }

    public function getTotalAddressesByZoneId($zone_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int) $zone_id . "'");

        return $query->row['total'];
    }

    public function getTotalCustomersByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int) $customer_group_id . "'");

        return $query->row['total'];
    }

    public function getHistories($customer_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT comment, date_added FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int) $customer_id . "' ORDER BY date_added DESC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    public function getTotalHistories($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_history WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }
    
    public function getCustomerAccount($customer_id){
        
        $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."customer_account WHERE customer_id = '".(int) $customer_id."'");

        return $query->row;
        
        }

    public function addTransaction($customer_id, $description = '', $amount = '', $order_id = 0) {
        $customer_info = $this->getCustomer($customer_id);

        if ($customer_info) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int) $customer_id . "', order_id = '" . (int) $order_id . "', description = '" . $this->db->escape($description) . "', amount = '" . (float) $amount . "', date_added = NOW()");

            $this->language->load('mail/customer');

            if ($customer_info['store_id']) {
                $this->load->model('setting/store');

                $store_info = $this->model_setting_store->getStore($customer_info['store_id']);

                if ($store_info) {
                    $store_name = $store_info['name'];
                } else {
                    $store_name = $this->config->get('config_name');
                }
            } else {
                $store_name = $this->config->get('config_name');
            }

            $message = sprintf($this->language->get('text_transaction_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
            $message .= sprintf($this->language->get('text_transaction_total'), $this->currency->format($this->getTransactionTotal($customer_id)));

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->hostname = $this->config->get('config_smtp_host');
            $mail->username = $this->config->get('config_smtp_username');
            $mail->password = $this->config->get('config_smtp_password');
            $mail->port = $this->config->get('config_smtp_port');
            $mail->timeout = $this->config->get('config_smtp_timeout');
            $mail->setTo($customer_info['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('text_transaction_subject'), $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
            $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $mail->send();
        }
    }

    public function deleteTransaction($order_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int) $order_id . "'");
    }

    public function getTransactions($customer_id, $start = 0, $limit = 10) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 10;
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $customer_id . "' ORDER BY date_added DESC LIMIT " . (int) $start . "," . (int) $limit);

        return $query->rows;
    }

    public function getTotalTransactions($customer_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total  FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTransactionTotal($customer_id) {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->row['total'];
    }

    public function getTotalTransactionsByOrderId($order_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int) $order_id . "'");

        return $query->row['total'];
    }

    public function getIpsByCustomerId($customer_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int) $customer_id . "'");

        return $query->rows;
    }

    public function getTotalCustomersByIp($ip) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($ip) . "'");

        return $query->row['total'];
    }
    public function getCustomerBanks($customer_id){
        
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_bank WHERE customer_id = '".(int) $customer_id."'");
        
        return $query->rows;
    }
    
    public function getCustomerCards($customer_id){
        
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."customer_card WHERE customer_id = '".(int) $customer_id."'");
        
        return $query->rows;
    }
    
    public function setTestSecretKey($key){
        
        $this->db->query("UPDATE ".DB_PREFIX."customer_account SET test_secret_key = '".$this->db->escape($key)."' WHERE customer_id = '".(int) $this->customer->getId()."'");
        
    }
    
    public function setTestPublicKey($key){
        
        $this->db->query("UPDATE ".DB_PREFIX."customer_account SET test_public_key = '".$this->db->escape($key)."' WHERE customer_id = '".(int) $this->customer->getId()."'");
        
    }
    
    public function setLiveSecretKey($key){
        
        $this->db->query("UPDATE ".DB_PREFIX."customer_account SET live_secret_key = '".$this->db->escape($key)."' WHERE customer_id = '".(int) $this->customer->getId()."'");
        
    }
    
    public function setLivePublicKey($key){
        
        $this->db->query("UPDATE ".DB_PREFIX."customer_account SET live_public_key = '".$this->db->escape($key)."' WHERE customer_id = '".(int) $this->customer->getId()."'");
        
    }

}
