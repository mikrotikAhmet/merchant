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
 * Description of account Class
 *
 * @author ahmet
 */
class ControllerAccountAccount extends Controller {

    private $error = array();

    public function index() {

        $this->language->load('account/account');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getForm();
    }

    public function update() {
        $this->language->load('account/account');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('account/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_account_customer->editCustomerAccount($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('account/account', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->getForm();
    }

    protected function getForm() {
        
                
        $this->data['title_bank'] = $this->language->get('title_bank');

        $this->data['text_information_bank'] = $this->language->get('text_information_bank');

        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_decline_cvc'] = $this->language->get('text_decline_cvc');
        $this->data['text_decline_zip'] = $this->language->get('text_decline_zip');
        $this->data['text_no_bank'] = $this->language->get('text_no_bank');
        $this->data['text_success_payment'] = $this->language->get('text_success_payment');

        $this->data['entry_fullname'] = $this->language->get('entry_fullname');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_two_step'] = $this->language->get('entry_two_step');

        $this->data['entry_test_sk'] = $this->language->get('entry_test_sk');
        $this->data['entry_test_pk'] = $this->language->get('entry_test_pk');
        $this->data['entry_live_sk'] = $this->language->get('entry_live_sk');
        $this->data['entry_live_pk'] = $this->language->get('entry_live_pk');
        
         $this->data['entry_currency'] = $this->language->get('entry_currency');
        $this->data['entry_bank'] = $this->language->get('entry_bank');
        $this->data['entry_holder_name'] = $this->language->get('entry_holder_name');
        $this->data['entry_iban'] = $this->language->get('entry_iban');
        $this->data['entry_bic'] = $this->language->get('entry_bic');
        
        $this->data['entry_email_me'] = $this->language->get('entry_email_me');
        $this->data['entry_email_customer'] = $this->language->get('entry_email_customer');
        $this->data['entry_business_name'] = $this->language->get('entry_business_name');
        $this->data['entry_business_url'] = $this->language->get('entry_business_url');
        $this->data['entry_business_mail'] = $this->language->get('entry_business_mail');
        
        // Banking Form Variables
        
        $this->data['column_bank_name'] = $this->language->get('column_bank_name');
        $this->data['column_currency'] = $this->language->get('column_currency');
        $this->data['column_ahn'] = $this->language->get('column_ahn');
        $this->data['column_iban'] = $this->language->get('column_iban');
        $this->data['column_swift'] = $this->language->get('column_swift');
        $this->data['column_status'] = $this->language->get('column_status');

        $this->data['button_update'] = $this->language->get('button_update');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_password'] = $this->language->get('button_password');
        $this->data['button_enable'] = $this->language->get('button_enable');
        $this->data['button_add_new'] = $this->language->get('button_add_new');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_preview'] = $this->language->get('button_preview');

        $this->data['tab_general'] = $this->language->get('tab_general');

        $this->data['action'] = $this->url->link('account/account/update', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }

        if (isset($this->error['country_id'])) {
            $this->data['error_country'] = $this->error['country_id'];
        } else {
            $this->data['error_country'] = '';
        }

        if (isset($this->error['zone_id'])) {
            $this->data['error_zone'] = $this->error['zone_id'];
        } else {
            $this->data['error_zone'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('account/account', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['country_id'] = $this->customer->getCustomerCountryId();
        $this->data['zone_id'] = $this->customer->getCustomerZoneId();

        // Load Countries
        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        $this->data['home'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
        
        // Load Customer Banks
        $this->data['banks'] = array();
        
        $this->load->model('account/customer');
        
        $banks = $this->model_account_customer->getCustomerBanks($this->customer->getId());
        
        $this->load->model('localisation/transaction_status');
        
        foreach ($banks as $bank){
            
            $transaction_status = $this->model_localisation_transaction_status->getTransactionStatus($bank['status']);
            
            if ($bank['status'] == $this->config->get('config_complete_bankaccount_status_id')){
            
                    $verification = '<span class="icon-check">' .$transaction_status['name'].'</span>';
                
                } else {
                    $verification = $transaction_status['name'] ;
                }
            
            $this->data['banks'][] = array(
                'customer_bank_id'=>$bank['customer_bank_id'],
                'bank_name'=>$bank['bank_name'],
                'settlement_currency'=>$bank['settlement_currency'],
                'account_holder'=>$bank['account_holder'],
                'iban'=>$bank['iban'],
                'swift'=>$bank['swift'],
                'status'=>$bank['status'],
                'verified'=>$verification
            );
        }
        
        // Load Currencies
        
        $this->load->model('localisation/currency');
        
        $this->data['currencies'] = $this->model_localisation_currency->getCurrencies();
        
        // Load Customer Statement
        
        $this->data['statement'] = $this->model_account_customer->getStatement();
        
        $this->data['isSale'] = $this->customer->isSale();
        
        $this->data['customer'] =  $this->model_account_customer->getCustomerAccount();

        $this->template = 'account/account.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function updatePassword() {
        $json = array();

        $data = $this->request->post;

        $this->load->model('account/customer');

        $result = $this->model_account_customer->updatePassword($data['oldpassword'], $data['newpassword']);

        if ($result) {
            $json = $this->language->get('password_success');
        } else {
            $json = $this->language->get('password_faild');
        }

        $this->response->setOutput(json_encode($json));
    }

    public function country() {
        $json = array();

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

        if ($country_info) {
            $this->load->model('localisation/zone');

            $json = array(
                'country_id' => $country_info['country_id'],
                'name' => $country_info['name'],
                'iso_code_2' => $country_info['iso_code_2'],
                'iso_code_3' => $country_info['iso_code_3'],
                'address_format' => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone' => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                'status' => $country_info['status']
            );
        }

        $this->response->setOutput(json_encode($json));
    }

    protected function validateForm() {

        if (!$this->request->post['country_id']) {
            $this->error['country_id'] = $this->language->get('error_country');
        }

        if (!$this->request->post['zone_id']) {
            $this->error['zone_id'] = $this->language->get('error_zone');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

        $current_customer = $this->customer->getId();

        if (!isset($current_customer)) {
            if ($customer_info) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        } else {
            if ($customer_info && ($current_customer != $customer_info['customer_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function generateKeys() {
        $json = array();
        
        $type = $this->request->post;
        
        $this->load->model('account/customer');
        
        switch ($type['type']) {
            case 'tsk':
                $json = $this->config->get('config_test_secretkey_api_prefix').$this->encryption->encrypt(time());
                $this->model_account_customer->setTestSecretKey($json);
                break;
            case 'tpk':
                $json = $this->config->get('config_test_publickey_api_prefix').$this->encryption->encrypt(time());
                $this->model_account_customer->setTestPublicKey($json);
                break;
            case 'lsk':
                $json = $this->config->get('config_live_secretkey_api_prefix').$this->encryption->encrypt(time());
                $this->model_account_customer->setLiveSecretKey($json);
                break;
            case 'lpk':
                $json = $this->config->get('config_live_publickey_api_prefix').$this->encryption->encrypt(time());
                $this->model_account_customer->setLivePublicKey($json);
                break;
        }

        
        
                
        $this->response->setOutput(json_encode($json));
    }
    
    public function addBank() {
        $json = array();

        $data = $this->request->post;

        $this->load->model('account/customer');

        $this->model_account_customer->addBank($data);

        $this->response->setOutput(json_encode($json));
    }
    
    public function removeBank() {
        $json = array();

        $bank_id = $this->request->get['customer_bank_id'];

        $this->load->model('account/customer');

        $this->model_account_customer->removeBank($bank_id);

        $this->response->setOutput(json_encode($json));
    }
    
    public function settlement() {
        $json = array();

        $settlement_data = $this->request->post;

        $this->load->model('account/customer');

        $this->model_account_customer->setSettlement($settlement_data);

        $this->response->setOutput(json_encode($json));
    }
    
    public function upload() {
		
        $this->language->load('account/upload');

		$json = array();

		if (!isset($json['error'])) {
			if (!empty($this->request->files['file']['name'])) {
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}

		if (!isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$ext = md5(mt_rand());

				$json['filename'] = $filename . '.' . $ext;
				$json['mask'] = $filename;

				move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $filename . '.' . $ext);
			}

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->setOutput(json_encode($json));
	}

}
