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
 * Semite LLC activate Class
 * Date : Aug 16, 2014
 */

class ControllerAccountActivate extends Controller{
    
    private $error = array();
    
    public function index(){
        
        $this->language->load('account/activate');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->getForm();
    }
    
    protected function getForm(){
        
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        
        $this->data['entry_fullname'] = $this->language->get('entry_fullname');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_country'] = $this->language->get('entry_country');
        
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
            'href' => $this->url->link('account/activate', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        
         $this->data['country_id'] = $this->customer->getCustomerCountryId();
        $this->data['zone_id'] = $this->customer->getCustomerZoneId();
        
         // Load Countries
        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();
        
        $this->template = 'account/activate.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
}

