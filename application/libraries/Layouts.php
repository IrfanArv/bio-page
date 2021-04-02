<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layouts {
 
    protected $_CI;

    function __construct() {
        $this->_CI = &get_instance();
    }
 
    function display($layout, $data = null) {
        $data['_content'] = $this->_CI->load->view($layout, $data, true);
        $this->_CI->load->view('layouts/Base', $data);
    }

}


