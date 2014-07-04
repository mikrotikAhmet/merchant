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
class ControllerAccountAccount extends Controller{
    
    public function index(){
        
        $this->language->load('account/account');

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->data['tab_general'] = $this->language->get('tab_general');
        
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
        
        // Load Countries
        $this->load->model('localisation/country');
        
        $this->data['countries'] = $this->model_localisation_country->getCountries();
        
        
        
        $this->data['home'] = $this->url->link('common/home','token='.$this->session->data['token'],'SSL');
        
        $this->template = 'account/account.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
}
