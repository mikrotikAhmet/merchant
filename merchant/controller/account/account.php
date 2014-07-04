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

    public function index() {

        $this->language->load('account/account');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_decline_cvc'] = $this->language->get('text_decline_cvc');
        $this->data['text_decline_zip'] = $this->language->get('text_decline_zip');

        $this->data['entry_fullname'] = $this->language->get('entry_fullname');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_two_step'] = $this->language->get('entry_two_step');

        $this->data['button_update'] = $this->language->get('button_update');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_password'] = $this->language->get('button_password');
        $this->data['button_enable'] = $this->language->get('button_enable');

        $this->data['tab_general'] = $this->language->get('tab_general');
        
        $this->data['token'] = $this->session->data['token'];

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

        $this->template = 'account/account.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    
    public function updatePassword(){
        $json = array();
        
        $data = $this->request->post;
        
        
        
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

}
