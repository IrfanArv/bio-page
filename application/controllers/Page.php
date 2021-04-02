<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
    }

    public function user($url) {
        $url=$this->uri->segment(1);
        if($this->Pages_model->getURL($url)){
            $data['pagetitle'] = 'Bio Page';
            $data['fetchUser'] = $this->Pages_model->getUserBio($url);
            $data['fetchLink'] = $this->Pages_model->getBio($url);
            $this->layouts->display('Bio', $data);
        }else{
            show_404();
        }
    }
}