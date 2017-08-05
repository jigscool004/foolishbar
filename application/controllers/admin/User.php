<?php

/**
 * Created by PhpStorm.
 * User: jigar
 * Date: 4/11/17
 * Time: 8:54 PM
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->model('User_m');
       
    }

    public function login() {
        $this->load->helper('form');
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
            exit;
        }
        
        if (isset($_POST['mysubmit']) && $_POST['mysubmit'] != '') {
            $this->load->library('form_validation');    
            $rule = $this->User_m->_rules;


             //$this->form_validation->set_rules($rule);
            $this->form_validation->set_rules('username','username','trim|required');
            $this->form_validation->set_rules('password','password','trim|required|callback_checklogin');
            
            if ($this->form_validation->run() == true) {
                $isLogin = 1; 
                if ($isLogin == 1) {
                    redirect('admin/dashboard');
                    exit;
                }    
            }
        }
        
        $this->load->view('admin/user/login');
    }
    
    public function checklogin($password) {
        $message = $this->User_m->login(); 
        if ($message == 0) {
            $this->form_validation->set_message('checklogin', 'Invalid username or password');
            return false;
        } else {
            return true;
        }
    }

    /**
     * @author Jigar Prajapati
     * @use logout current logged in user and unset whole session data and redirect it to 
     *      user login screen
     * @date 13-04-2017
     */
    public function logout() {
        $dataArr = array(
            'username' => '',
            'id' => '',
            'email' => '',
            'logged_in' => false,
        );
        $this->session->unset_userdata($dataArr);
        $this->session->sess_destroy();
        redirect('admin/user/login');
    }

    public function home() {
       isLoggedIn();
       echo 'hello you are logged in success fully';
        
    }

}
