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
 * Description of footer Class
 *
 * @author ahmet
 */
class ControllerCommonFooter extends Controller{
    
    
    protected function index(){
        
        $this->language->load('common/footer');

        $this->data['text_footer'] = sprintf($this->language->get('text_footer'), VERSION);

        if (file_exists(DIR_SYSTEM . 'config/svn/svn.ver')) {
            $this->data['text_footer'] .= '.r' . trim(file_get_contents(DIR_SYSTEM . 'config/svn/svn.ver'));
        }

        $this->template = 'common/footer.tpl';

        $this->render();
    }
}
