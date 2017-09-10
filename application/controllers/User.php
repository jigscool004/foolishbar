<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author jigar
 */
class User extends CI_Controller {
    
    
    public function __construct() {
        parent::__construct();
        isFrontLoggedIn();
    }

    private $tableName = 'adpost_user';

    public function dashboard() {
      $data['header'] = 'Dashboard';
      $data['mainContent'] = 'front/user/dashboard';
      $this->load->view('front/template',$data);
    }
    

    public function profile() {
        $this->load->helper('form');
        $data['mainContent'] = 'front/user/profile';
        $user_dataArr = getUserDetails();
        $data['user_dataArr'] = $user_dataArr;

        if (isset($_POST['saveProfile'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('full_name','name','trim|required');
            $this->form_validation->set_rules('mobile_no','contact number','trim|required|callback_uniquecheck[mobile_no]');    
            $this->form_validation->set_rules('email','email address','trim|required|callback_uniquecheck[email]');    
            if ($this->form_validation->run() == true) {
                $saveData = [
                    'name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                ];
                $this->db->where('id',$this->session->userdata('id'));
                if ($this->db->update($this->tableName,$saveData)) {
                    $this->session->set_flashdata('msg','Your profile detail is updated');
                    $this->session->set_flashdata('btn','success');
                } else {
                    $this->session->set_flashdata('msg','Something wrong happen. Please try again.');
                    $this->session->set_flashdata('btn','danger');
                }
                redirect('user/profile');
             }
        } else if (isset($_POST['changePassword'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('current_password','current password','required|callback_checkPwd');
            $this->form_validation->set_rules('newpassword','password','required|min_length[6]');
            $this->form_validation->set_rules('confirm_password','confirm password','required');
            if ($this->form_validation->run() == true) {
                 $saveData = [
                    'password' => encrytPassword($this->input->post('current_password')),
                ];
                $this->db->where('id',$this->session->userdata('id'));
                if ($this->db->update($this->tableName,$saveData)) {
                    $this->session->set_flashdata('msg','Password is changed successfully.');
                    $this->session->set_flashdata('btn','success');
                    $mail = loadEmailSetting();
                    $mail->addAddress($user_dataArr->email,$user_dataArr->name);  //email address that receives the response
                    $mail->Subject    = "Password Change Notification";
                    $dataArr = [
                        'name' => $user_dataArr->name
                    ];
                    $html = $this->load->view('email_templates/change_password',$dataArr,true);
                    $mail->Body  = $html;
                    $mail->send();
                } else {
                    $this->session->set_flashdata('msg','Something wrong happen. Please try again.');
                    $this->session->set_flashdata('btn','danger');
                }
                redirect('user/profile');
            }
          
        }

        $data['header'] = "User Profile :: " . $user_dataArr->name;
        $this->load->view('front/template',$data);
    }

    public function checkPwd() {
        $current_password = $this->input->post('current_password');
        $current_password = sha1(md5($current_password));    ;
        $data = $this->db->where('password',$current_password)
                ->get('adpost_user')->row();
        if ($data == NULL) {
            $this->form_validation->set_message('checkPwd', 'Current password is wrong');
            return false;
        }       
        return true; 
    }

    public function uniquecheck($data,$field_name) {
        $fieldNameString = $field_name == 'email' ? 'email address' : 'contact number';
        $this->db->where($field_name,$data);
        $this->db->where('id !=',$this->session->userdata('id'));
        $data = $this->db->get($this->tableName)->row();
        if (count($data) > 0) {
            $this->form_validation->set_message('checklogin', $fieldNameString . ' is already taken.');
            return false;
        } else {
            return true;
        }
    }

    public function changeProfile() {
         $config['upload_path']   = './assest/upload/user_profile/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100000; 
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
         if ($this->upload->do_upload('upload') == true) {
                @chmod($config['upload_path'], 0755);
                $uploadData = $this->upload->data();
                $fileName = $uploadData['file_name'];
                $data = [
                    'profile_pic' => $fileName
                ];
                $user_data = getUserDetails();
                //$file_path = site_url('assest/upload/user_profile/') . $user_data->profile_pic;    
                $file_path = FCPATH. 'assest/upload/user_profile/' . $user_data->profile_pic;   
                if ($file_path != "" && file_exists($file_path)) {
                    @unlink($file_path);
                }

                $isUpdated = $this->db->where('id',$this->session->userdata('id'))->update('adpost_user',$data);
                if ($isUpdated) {
                    echo 'success';    
                }
         } else {
            echo $this->upload->display_errors();
         }
    }

    public function archived_ads() {
        $this->myads(1);
    }

    public function myads($isArchived = 0) {
        $this->load->model('Adpost_m');
        $this->load->library("pagination");
        $data['mainContent'] = 'front/user/myads';
        $data['isArchived'] = $isArchived;
        $data['header'] = $isArchived ? "My Archived Ads" : "My Ads";
        $config = paginationConfiguration([
            'total_item' => $this->Adpost_m->record_count(true),
            'per_page' => 10,
            'uri_segment' => 3,
            'base_url' => site_url('user/myads'),
        ]);
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Adpost_m->getData($config["per_page"], $page,true);
        $data["links"] = $this->pagination->create_links();
       //  echo $this->db->last_query();         exit;
        $this->load->view('front/template',$data);
    }

    public function checkpassword() {
        //$this->load->model('Adpost_m');
        if(isset($_GET['current_password']) && $_GET['current_password'] != "") {

            $current_password = sha1(md5($_GET['current_password']));    
            $this->db->where('password',$current_password);
            $isCorrentPassword = $this->db->select('count(id) as id')->get('adpost_user')->row();
            if (isset($isCorrentPassword->id) && $isCorrentPassword->id > 0) {
                echo true;
            } else {
                echo json_encode('Currnet Password is not matched');
            }
        } else {
            echo json_encode('Currnet Password is required');
        }
    }

    public function wishlist() {
        $this->load->model('Adpost_m');
        $this->load->library("pagination");
        $data['mainContent'] = 'front/user/wishlist';
        $data['header'] = 'Wishlist';
        $config = paginationConfiguration([
            'total_item' => $this->Adpost_m->record_count(true),
            'per_page' => 10,
            'uri_segment' => 3,
            'base_url' => site_url('user/favads'),
        ]);
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Adpost_m->getWishListData($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        //  echo $this->db->last_query();         exit;
        $this->load->view('front/template',$data);
    }
}
