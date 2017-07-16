<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author jigar
 */
class Mobile_category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        isLoggedIn();
        $this->load->model('Mobilecategory_m');
    }

    public function index() {
        $data['content'] = 'admin/mobile_category/index';
        $this->load->view('admin/template', $data);
    }

    public function getdata() {

        $list = $this->Mobilecategory_m->get_datatables();
        $data = array();
        $no = $_POST['start'];


        foreach ($list as $category) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $category->name;
            $row[] = $category->status == 1 ? 'Active' : 'Inactive';
            //<button type="button" class="btn btn-info btn-xs" data-toggle="ajaxModal" data-target="#myModal">Add New</button>

            $row[] = anchor(site_url('admin/mobile_category/edit/' . $category->id), 'Edit', [
                        'class' => 'edit btn btn-primary btn-xs',
                        'id' => $category->id,
                        'data-toggle' => "ajaxModal",
                        'data-target' => "#myModal",
                        'onClick' => 'openModelPopup(this); return false;'
                    ]) . "  " .
                    anchor(site_url('admin/mobile_category/delete/' . $category->id), 'Delete', [
                        'class' => 'delete btn btn-danger btn-xs',
                        'id' => $category->id,
                        'onClick' => 'deleteRercord(this); return false;'
            ]);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mobilecategory_m->count_all(),
            "recordsFiltered" => $this->Mobilecategory_m->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

    public function edit($id = '') {
        if ((int) $id != '') {
            $this->load->helper('form');
            $data['id'] = $id;
            $data['category_data'] = $this->Mobilecategory_m->getCategoryById($id);
            if (isset($_POST['name'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                $this->form_validation->set_rules('status', 'status', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $data['url'] = site_url('admin/mobile_category/edit' . $id);
                    $data['button'] = 'Edit';
                    $data['error'] = 1;
                    echo $this->load->view('admin/city/_form', $data, true);
                    exit;
                } else {
                    $saveData = array(
                        'name' => $this->input->post('name'),
                        'status' => $this->input->post('status'),
                        'updated_by' => $this->session->userdata('id'),
                        'updated_on' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('id',$id);
                    $isSaved = $this->db->update($this->Mobilecategory_m->table, $saveData);
                    if ($isSaved) {
                        echo 1;
                        exit;
                    } else {
                        echo 0;
                        exit;
                    }
                }
            }

            $data['error'] = 0;
            
            $this->load->view('admin/mobile_category/edit', $data);
        } else {
            
        }
    }
    
    public function delete($id) {
        if ($id != '') {
           $this->db->where('id',$id);
           if ($this->db->delete($this->Mobilecategory_m->table)) {
               echo 1;
           } else {
               echo 0;
           }
        } else {
            echo 0;
        }
    }

    public function create() {
        $this->load->helper('form');
        if (isset($_POST['name'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('status', 'status', 'trim|required');
            if ($this->form_validation->run() == false) {
                $data['url'] = site_url('admin/mobile_category/create');
                $data['button'] = 'Create';
                $data['error'] = 1;
                echo $this->load->view('admin/mobile_category/_form', $data, true);
                exit;
            } else {
                $saveData = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('id'),
                    'created_on' => date('Y-m-d H:i:s')
                );

                $isSaved = $this->db->insert($this->Mobilecategory_m->table, $saveData);
                if ($isSaved) {
                    echo 1;
                    exit;
                } else {
                    echo 0;
                    exit;
                }
            }
        }

        $data['error'] = 0;
        $this->load->view('admin/mobile_category/create', $data);
    }

}
