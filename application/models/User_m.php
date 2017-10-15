<?php

    /**
     * Created by PhpStorm.
     * User: jigar
     * Date: 4/11/17
     * Time: 10:03 PM
     */
    class User_m extends  CI_Model{
        
        public $_rules = [
            [
                'name' => 'username',
                'label' => 'username',
                'rules' => 'trim|xss_clean|required',   
            ], 
            [
                'name' => 'password',
                'label' => 'password',
                'rules' => 'trim|xss_clean|required',   
            ], 
        ];
        
        public function __construct() {
           parent::__construct();

        }

        public function login() {
            $data = $this->db->where('username',$_POST['username'])
                    ->get('user')->row();
            
            if (count($data) > 0) {
                if ($data->password_hash == $this->password_hash($_POST['password'])) {
                    $dataArr = array(
                       'username' => ucfirst($data->username),
                        'id' => $data->id,
                        'email' => $data->email,
                        'logged_in' => true,
                    );
                    $this->session->set_userdata($dataArr);
                    return 1;
                } else {
                    return 0;//'Invalid password';
                }
            } else {
                return 0;//'Invalid username';
            }
        }


        public function password_hash($password) {
            return sha1(md5($password));
        }

    }