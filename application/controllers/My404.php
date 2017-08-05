<?php

/**
 * Created by PhpStorm.
 * User: Jigar Kumar
 * Date: 8/5/2017
 * Time: 10:53 PM
 */
class My404 extends  CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->output->set_status_header('404');
        $checkAdminSide = $this->uri->segment(1);
        if ($checkAdminSide == 'admin') {
            $data['isAdmin'] = true;
            $data['content'] = '404';
            $this->load->view('admin/template',$data);
        } else {
            $data['mainContent'] = '404';
            $data['isAdmin'] = false;
            $data['header'] = '404 Page not found';
            $this->load->view('front/template',$data);
        }

    }
}