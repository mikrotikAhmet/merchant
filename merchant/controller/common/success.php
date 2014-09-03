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
 * Description of success Class
 *
 * @author ahmet
 */
class ControllerCommonSuccess extends Controller {  
	public function index() {
            
		$this->language->load('common/success');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),       	
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_success'),
			'href'      => $this->url->link('account/success'),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');


                $this->data['text_message'] = sprintf($this->language->get('text_message'),$this->currency->format($this->request->get['amount'], $this->config->get('config_currency')), $this->url->link('account/transaction','token='.$this->session->data['token'],'SSL'));

		$this->data['button_continue'] = $this->language->get('button_continue');

                $this->data['continue'] = $this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL');

		$this->template = 'common/success.tpl';

		$this->children = array(
			'common/footer',
			'common/header'	
		);

		$this->response->setOutput($this->render());				
	}
}
