<?php

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


if (!defined('DIR_APPLICATION'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author ahmet
 */
class ControllerCommonHome extends Controller {

    public function index() {

        $this->language->load('common/home');

        $this->document->setTitle($this->config->get('config_name'));

        $this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['text_last_transfer'] = $this->language->get('text_last_transfer');
        $this->data['text_next_transfer'] = $this->language->get('text_next_transfer');
        $this->data['text_withdraw'] = $this->language->get('text_withdraw');
        $this->data['text_balance'] = $this->language->get('text_balance');
        
        $this->data['button_withdraw'] = $this->language->get('button_withdraw');
        $this->data['button_deposit'] = $this->language->get('button_deposit');
        
        // Get Customer Balance
        
        $this->data['balance'] = $this->currency->format($this->customer->getBalance(), $this->config->get('config_currency'));
        
        $withdraw_data = $this->customer->getLastWithdraw();
        $withdraw_next = $this->customer->getNextWithdraw();
        
        $this->data['last_transfer'] = $this->currency->format((isset($withdraw_data['amount']) ? str_replace('-',"",$withdraw_data['amount']) : 0), $this->config->get('config_currency'));
        $this->data['next_transfer'] = $this->currency->format((isset($withdraw_next['amount']) ? str_replace("-", "", $withdraw_next['amount']) : 0), $this->config->get('config_currency'));
        
        if ($withdraw_next){
            $this->data['date'] = date($this->language->get('date_format_short'), strtotime($withdraw_next['date_added']));
        } else {
            $this->data['date'] = null;
        }
        // Check install directory exists
        if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
            $this->data['error_install'] = $this->language->get('error_install');
        } else {
            $this->data['error_install'] = '';
        }

        // Check cache directory is writable
        $file = DIR_CACHE . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_cache'] = sprintf($this->language->get('error_image_cache'), DIR_CACHE);
        } else {
            $this->data['error_cache'] = '';

            unlink($file);
        }

        // Check download directory is writable
        $file = DIR_DOWNLOAD . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_download'] = sprintf($this->language->get('error_download'), DIR_DOWNLOAD);
        } else {
            $this->data['error_download'] = '';

            unlink($file);
        }

        // Check logs directory is writable
        $file = DIR_LOGS . 'test';

        $handle = fopen($file, 'a+');

        fwrite($handle, '');

        fclose($handle);

        if (!file_exists($file)) {
            $this->data['error_logs'] = sprintf($this->language->get('error_logs'), DIR_LOGS);
        } else {
            $this->data['error_logs'] = '';

            unlink($file);
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['token'] = $this->session->data['token'];

        if ($this->config->get('config_currency_auto')) {
            $this->load->model('localisation/currency');

            $this->model_localisation_currency->updateCurrencies();
        }
        
        if (!$this->customer->isApproved()){
            $this->data['error_approved'] = $this->language->get('error_approved');
        } else {
            $this->data['error_approved'] = '';
        }
        
        $this->data['deposit'] = $this->url->link('payment/deposit','token='.$this->session->data['token'],'SSL');
        $this->data['withdraw'] = $this->url->link('payment/withdraw','token='.$this->session->data['token'],'SSL');
        
        // Transactions
        
        $this->data['transactions'] = array();
        
        $this->load->model('account/customer');
        
        $transactions = $this->model_account_customer->getTransactions();
        
        foreach ($transactions as $transaction){
            
            $action = array();
            
            $this->data['transactions'][] = array(
                'transaction_id'=>$transaction['transaction_id'],
                'type'=>$transaction['type'],
                'description'=>$transaction['description'],
                'status'=>$transaction['status'],
                'action'=>$action
            );
        }
        
        $this->template = 'common/home.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function login() {
        $route = '';

        if (isset($this->request->get['route'])) {
            $part = explode('/', $this->request->get['route']);

            if (isset($part[0])) {
                $route .= $part[0];
            }

            if (isset($part[1])) {
                $route .= '/' . $part[1];
            }
        }

        $ignore = array(
            'common/login',
            'common/forgotten',
            'common/reset'
        );

        if (!$this->customer->isLogged() && !in_array($route, $ignore)) {
            return $this->forward('common/login');
        }

        if (isset($this->request->get['route'])) {
            $ignore = array(
                'common/login',
                'common/logout',
                'common/forgotten',
                'common/reset',
                'error/not_found',
                'error/permission'
            );

            $config_ignore = array();

            if ($this->config->get('config_token_ignore')) {
                $config_ignore = unserialize($this->config->get('config_token_ignore'));
            }

            $ignore = array_merge($ignore, $config_ignore);

            if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
                return $this->forward('common/login');
            }
        } else {
            if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
                return $this->forward('common/login');
            }
        }
    }

    public function permission() {
        if (isset($this->request->get['route'])) {
            $route = '';

            $part = explode('/', $this->request->get['route']);

            if (isset($part[0])) {
                $route .= $part[0];
            }

            if (isset($part[1])) {
                $route .= '/' . $part[1];
            }

            $ignore = array(
                'common/home',
                'common/login',
                'common/logout',
                'common/forgotten',
                'common/reset',
                'error/not_found',
                'error/permission'
            );

            if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
                return $this->forward('error/permission');
            }
        }
    }

}
