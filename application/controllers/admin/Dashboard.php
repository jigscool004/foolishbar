<?php

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        isLoggedIn();
    }
    
    /**
     *  @use landing page after user logged in successfully.
     */
    public function index() {
       $data['content'] = 'admin/dashboard/index';
       $this->load->view('admin/template',$data);
    }
}
