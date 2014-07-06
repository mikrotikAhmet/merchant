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

/*
 * Copyright (C) 2014 ahmet
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/*
 * Semite LLC withdraw Class
 * Date : Jul 5, 2014
 */

class ControllerPaymentWithdraw extends Controller {
    
    private $error = array();
    
    public function index(){
        
        $this->language->load('payment/withdraw');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->data['text_select']= $this->language->get('text_select');
        
        $this->data['entry_account']= $this->language->get('entry_account');
        $this->data['entry_amount']= $this->language->get('entry_amount');
        
        $this->data['text_balance'] = $this->language->get('text_balance');
        $available_balance = $this->customer->getBalance();
        
        $this->data['balance'] = $this->currency->format((isset($available_balance) ? $available_balance : 0), $this->config->get('config_currency'));
        
        $this->data['button_withdraw'] = $this->language->get('button_withdraw');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        
        $this->data['home'] = $this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL');
        
        $this->data['action'] = $this->url->link('payment/withdraw', 'token='.$this->session->data['token'], 'SSL');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
            $this->load->model('payment/transaction');
            
            $this->model_payment_transaction->addTransactionWithdraw($this->request->post);
            
            $this->redirect($this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['bank'])) {
            $this->data['error_bank'] = $this->error['bank'];
        } else {
            $this->data['error_bank'] = '';
        }
        
        if (isset($this->error['amount'])) {
            $this->data['error_amount'] = $this->error['amount'];
        } else {
            $this->data['error_amount'] = '';
        }
        
        if (isset($this->error['currency'])) {
            $this->data['error_currency'] = $this->error['currency'];
        } else {
            $this->data['error_currency'] = '';
        }
        
        
        $this->data['token'] = $this->session->data['token'];
        // Load Customer Banks
        $this->load->model('account/customer');
        
        $this->data['banks'] = $this->model_account_customer->getCustomerBanks($this->customer->getId());
        
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/withdraw', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        $this->template = 'payment/withdraw.tpl';

        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    
    public function currencyChange(){
        $json = array();
        
        $data = $this->request->post;
        
        $balance = $this->customer->getBalance();
        
        if ($data['curr'] != 'undefined'){
        
            $available_balance = $this->currency->convert($balance, $this->config->get('config_currency'), $data['curr']);

            $json[] = $this->currency->format(($available_balance ? $available_balance : 0), $data['curr']);
        } else {
            $json[] = $this->currency->format(($balance ? $balance : 0), $this->config->get('config_currency'));
        }
        $this->response->setOutput(json_encode($json));
    }
    
    protected function validateForm() {
        
        if (!$this->request->post['bank_id']){
            $this->error['bank'] = $this->language->get('error_bank');
        }
        
        // Check Bank Account Currency
        $bank_id = $this->request->post['bank_id'];
        
        if ($bank_id){
        
        $settlement_currency = $this->customer->getSettlementCurrency($bank_id);
        
        } else {
            $settlement_currency = $this->config->get('config_currency');
        }
        
        $currency = $this->currency->convert(100, $this->config->get('config_currency'), $settlement_currency);
        
        if ($this->request->post['amount'] < 100 || ($this->request->post['amount']) == 0) {
            $this->error['amount'] = sprintf($this->currency->format($currency, $settlement_currency),$this->language->get('error_amount'));
        }
        
        if ($this->request->post['amount'] > 100 && !$this->currency->isCurrency($this->request->post['amount'])){
            $this->error['currency'] = $this->language->get('error_currency');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}

