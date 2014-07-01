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
 * Description of home Class
 *
 * @author ahmet
 */
class ControllerCommonHome extends Controller{
    
    
    public function index(){
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST')){
            $data = file_get_contents('http://api.semitepayment.com/index.php?route=customer/customer/customer&cid='.$this->request->post['cid']);

            if ($data){
                echo '<pre>';
                print_r(json_decode($data));
            } else {
                echo 'No Result';
            }
            
            
        } 
        
        $this->template = 'common/home.tpl';

        $this->response->setOutput($this->render());
    }
}
