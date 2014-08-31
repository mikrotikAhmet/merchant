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
 * Semite LLC deposit Class
 * Date : Jul 5, 2014
 */

class ControllerPaymentDeposit extends Controller{
    
    private $error = array();


    public function index(){
        $this->language->load('payment/deposit');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->data['text_information'] = sprintf($this->language->get('text_information'), $this->config->get('config_name'));
        
        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_card_number'] = $this->language->get('entry_card_number');
        $this->data['entry_expire_date'] = $this->language->get('entry_expire_date');
        $this->data['entry_cvv'] = $this->language->get('entry_cvv');
        $this->data['entry_amount'] = $this->language->get('entry_amount');
        
        $this->data['button_deposit'] = $this->language->get('button_deposit');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        
        $this->data['home'] = $this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL');
        

        $this->document->setTitle($this->language->get('heading_title'));


        $this->data['heading_title'] = $this->language->get('heading_title');


        $this->data['action'] = $this->url->link('payment/deposit', 'token='.$this->session->data['token'], 'SSL');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
           
        
                
            
            $this->load->model('payment/transaction');

            $this->creditcard->Validate($this->request->post['cardnum'], $this->customer->getId());

            $card_info = $this->creditcard->GetCardInfo();

            if ($card_info['status'] == 'valid') {
                
                $this->model_payment_transaction->addTransaction('Deposit'.($this->customer->isApproved() ? null : ' Test Mode'),$this->creditcard->GetCardInfo(),'',$this->request->post);

                $this->redirect($this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL'));
            }
        }
        
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/deposit', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['cardholder'])) {
            $this->data['error_cardholder'] = $this->error['cardholder'];
        } else {
            $this->data['error_cardholder'] = '';
        }

        if (isset($this->error['cardnum'])) {
            $this->data['error_cardnum'] = $this->error['cardnum'];
        } else {
            $this->data['error_cardnum'] = '';
        }
        
        if (isset($this->error['expire'])) {
            $this->data['error_expire'] = $this->error['expire'];
        } else {
            $this->data['error_expire'] = '';
        }
        
        if (isset($this->error['cvv'])) {
            $this->data['error_cvv'] = $this->error['cvv'];
        } else {
            $this->data['error_cvv'] = '';
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

        $this->data['CARDINFO'] = $this->creditcard->GetCardInfo();
        $this->data['CCV'] = $this->creditcard;

        if (isset($this->request->post['cardholder'])) {
            $this->data['cardholder'] = $this->request->post['cardholder'];
        } else {
            $this->data['cardholder'] = '';
        }

        if (isset($this->request->post['cardnum'])) {
            $this->data['cardnum'] = $this->request->post['cardnum'];
        } else {
            $this->data['cardnum'] = '';
        }

        if (isset($this->request->post['expiredate'])) {
            $this->data['expiredate'] = $this->request->post['expiredate'];
        } else {
            $this->data['expiredate'] = '';
        }


        if (isset($this->request->post['cvv'])) {
            $this->data['cvv'] = $this->request->post['cvv'];
        } else {
            $this->data['cvv'] = '';
        }

        if (isset($this->request->post['amount'])) {
            $this->data['amount'] = $this->request->post['amount'];
        } else {
            $this->data['amount'] = 0;
        }
        
        
        $this->template = 'payment/deposit.tpl';

        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if ((utf8_strlen($this->request->post['cardholder']) < 1) || (utf8_strlen($this->request->post['cardholder']) > 32)) {
            $this->error['cardholder'] = $this->language->get('error_cardholder');
        }

        if ((utf8_strlen($this->request->post['cardnum']) < 12) || (utf8_strlen($this->request->post['cardnum']) > 16)) {
            $this->error['cardnum'] = $this->language->get('error_cardnum');
        }
        
        if ($this->request->post['amount'] < 10 || ($this->request->post['amount']) == 0) {
                       
            $this->error['amount'] = sprintf($this->currency->format('10', $this->config->get('config_currency')),$this->language->get('error_amount'));
        }
        
        if ((utf8_strlen($this->request->post['expire_date']) < 1) || (utf8_strlen($this->request->post['expire_date']) > 5)) {
            $this->error['expire'] = $this->language->get('error_expire');
        }
        
        if ((utf8_strlen($this->request->post['cvv']) < 1) || (utf8_strlen($this->request->post['cvv']) > 4)) {
            $this->error['cvv'] = $this->language->get('error_cvv');
        }
        
        if ($this->request->post['amount'] > 10 && !$this->currency->isCurrency($this->request->post['amount'])){
            $this->error['currency'] = $this->language->get('error_currency');
        }
        
        if (!$this->customer->isApproved()){
            $this->error['warning'] = sprintf($this->language->get('error_approved'), $this->config->get('config_name'),$this->config->get('config_name'),$this->url->link('account/activate', 'token='.$this->session->data['token'],'SSL'));
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}

