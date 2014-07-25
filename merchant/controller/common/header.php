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
 * Description of header
 *
 * @author ahmet
 */
class ControllerCommonHeader extends Controller{
    
    protected function index() {

        $this->data['title'] = $this->document->getTitle();

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $this->data['base'] = HTTPS_SERVER;
        } else {
            $this->data['base'] = HTTP_SERVER;
        }

        $this->data['description'] = $this->document->getDescription();
        $this->data['keywords'] = $this->document->getKeywords();
        $this->data['links'] = $this->document->getLinks();
        $this->data['styles'] = $this->document->getStyles();
        $this->data['scripts'] = $this->document->getScripts();
        $this->data['lang'] = $this->language->get('code');
        $this->data['direction'] = $this->language->get('direction');

        $this->language->load('common/header');

        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['text_dashboard'] = $this->language->get('text_dashboard');
        $this->data['text_account'] = $this->language->get('text_account');
        $this->data['text_activate'] = $this->language->get('text_activate');
        $this->data['text_setting'] = $this->language->get('text_setting');
           

        if (!$this->customer->isLogged() || !isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
            $this->data['logged'] = false;

            $this->data['home'] = $this->url->link('common/login', '', 'SSL');
        } else {
            $this->data['logged'] = $this->language->get('text_logged');
            $this->data['logged_as'] = sprintf($this->language->get('logged_as'), $this->customer->getUserName());
            $this->data['avatar'] = $this->customer->getAvatar();

            $this->data['home'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['account'] = $this->url->link('account/account', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['activate'] = $this->url->link('account/activate', 'token=' . $this->session->data['token'], 'SSL');
            
            $this->data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
        }

        $this->template = 'common/header.tpl';

        $this->render();
    }

}
