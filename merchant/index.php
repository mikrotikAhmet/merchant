<?php

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
 * @package     EGC Services Ltd
 * @version     $Id: index.php Jul 1, 2014 ahmet
 * @copyright   Copyright (c) 2014 EGC Services Ltd .
 * @license     http://www.egamingc.com/license/
 */
/**
 * Description of index.php
 *
 * @author ahmet
 */
define('VERSION', '1.5.6.3');

// Basic setup

defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('PS') || define('PS', PATH_SEPARATOR);


defined('_ENGINE') || define('_ENGINE', true);
defined('_ENGINE_REQUEST_START') ||
        define('_ENGINE_REQUEST_START', microtime(true));
defined('APPLICATION_PATH_COR') ||
        define('APPLICATION_PATH_COR', realpath(dirname(__DIR__)) . '/');

// Configuration
if (file_exists(APPLICATION_PATH_COR . 'system/config/merchant.php')) {
    require_once(APPLICATION_PATH_COR . 'system/config/merchant.php');
} else {
    trigger_error('Configuration file con not be located!');
}


// Startup
if (file_exists(DIR_SYSTEM . 'startup.php')) {
    require_once(DIR_SYSTEM . 'startup.php');
} else {
    trigger_error('Startup file can not be located!'. DIR_SYSTEM);
}

// Registry
$registry = new Registry();


// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$registry->set('config', $config);

// Get Application Setting via API
// Settings

$setting_data = file_get_contents('http://api.semitepayment.com/index.php?route=setting/setting/getApplicationSettings');

$settings = json_decode($setting_data);

// Register Setting Data to Config
$config->set('config', $settings);

// Url
$url = new Url(HTTP_SERVER, $config->get('config')->config_secure ? HTTPS_SERVER : HTTP_SERVER);	
$registry->set('url', $url);

// Log
$log = new Log($config->get('config')->config_error_filename);
$registry->set('log', $log);

function error_handler($errno, $errstr, $errfile, $errline) {
	global $log, $config;
	
	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}
		
	if ($config->get('config')->config_error_display) {
		echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
	}
	
	if ($config->get('config')->config_error_log) {
		$log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	return true;
}

// Error Handler
set_error_handler('error_handler');

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response); 

// Cache
$cache = new Cache();
$registry->set('cache', $cache); 

// Session
$session = new Session();
$registry->set('session', $session); 

// Language
$language_info = file_get_contents('http://api.semitepayment.com/index.php?route=setting/setting/getLanguageByCode');

$language_data = json_decode($language_info);

$config->set('config_language_id', $language_data->language_id);

// Language	
$language = new Language($language_data->directory);
$language->load($language_data->filename);	
$registry->set('language', $language);

// Document
$registry->set('document', new Document()); 	

// User
if (is_readable('http://api.semitepayment.com/index.php?route=authentication/auth/authenticate')) {
    $customer_object = file_get_contents('http://api.semitepayment.com/index.php?route=authentication/auth/authenticate');
} else {
    $customer_object = null;
}
$registry->set('customer', new Customer(json_decode($customer_object))); 

// Encryption
$registry->set('encryption', new Encryption($config->get('config')->config_encryption));

// Front Controller
$controller = new Front($registry);

// Login
$controller->addPreAction(new Action('common/home/login'));

// Router
if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}

// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();