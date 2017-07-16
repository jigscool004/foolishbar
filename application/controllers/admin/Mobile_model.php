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
class Mobile_model extends CI_Controller {

    public function __construct() {
        parent::__construct();
        isLoggedIn();
        $this->load->model('Mobilemodel_m');
    }

    public function index() {
        $data['content'] = 'admin/mobile_model/index';
        $this->load->view('admin/template', $data);
    }

    public function getdata() {

        $list = $this->Mobilemodel_m->get_datatables();
        $data = array();
        $no = $_POST['start'];


        foreach ($list as $model) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $model->name;
            $row[] = $model->category;
            $row[] = $model->status;
            //<button type="button" class="btn btn-info btn-xs" data-toggle="ajaxModal" data-target="#myModal">Add New</button>

            $row[] = anchor(site_url('admin/mobile_model/edit/' . $model->id), 'Edit', [
                        'class' => 'edit btn btn-primary btn-xs',
                        'id' => $model->id,
                        'data-toggle' => "ajaxModal",
                        'data-target' => "#myModal",
                        'onClick' => 'openModelPopup(this); return false;'
                    ]) . "  " .
                    anchor(site_url('admin/mobile_model/delete/' . $model->id), 'Delete', [
                        'class' => 'delete btn btn-danger btn-xs',
                        'id' => $model->id,
                        'onClick' => 'deleteRercord(this); return false;'
            ]);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mobilemodel_m->count_all(),
            "recordsFiltered" => $this->Mobilemodel_m->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

    public function edit($id = '') {
        if ((int) $id != '') {
            $this->load->helper('form');
            $data['id'] = $id;
            $data['category_data'] = $this->Mobilemodel_m->getModelById($id);
            $data['categroyDataArr'] = $this->getCategoryData();
            if (isset($_POST['name'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                $this->form_validation->set_rules('category_id', 'category', 'trim|required');
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
                    $isSaved = $this->db->update($this->Mobilemodel_m->table, $saveData);
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
            
            $this->load->view('admin/mobile_model/edit', $data);
        } else {
            
        }
    }
    
    public function delete($id) {
        if ($id != '') {
           $this->db->where('id',$id);
           if ($this->db->delete($this->Mobilemodel_m->table)) {
               echo 1;
           } else {
               echo 0;
           }
        } else {
            echo 0;
        }
    }

    private function getCategoryData() {
		$modelData = $this->db->where('status',1)->select('id,name')->get('mobile_category')->result();
        $modelDataArr = array('' => '-Select-') ;
        foreach($modelData as $key => $model) {
        	$modelDataArr[$model->id] = $model->name;
        }
        return $modelDataArr;
	}

    public function create() {
        $this->load->helper('form');
        $data['categroyDataArr'] = $this->getCategoryData();
        $model_data = (object)['id' => '','category_id' => '','name' => '','status' => ''];
        $data['model_data'] = $model_data;
        if (isset($_POST['name'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('category_id', 'category', 'trim|required');
            $this->form_validation->set_rules('status', 'status', 'trim|required');
            if ($this->form_validation->run() == false) {
                $data['url'] = site_url('admin/mobile_model/create');
                $data['button'] = 'Create';
                $data['error'] = 1;
                echo $this->load->view('admin/mobile_model/_form', $data, true);
                exit;
            } else {
                $saveData = array(
                    'name' => $this->input->post('name'),
                    'category_id' => $this->input->post('category_id'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('id'),
                    'created_on' => date('Y-m-d H:i:s')
                );

                $isSaved = $this->db->insert($this->Mobilemodel_m->table, $saveData);
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
        $this->load->view('admin/mobile_model/create', $data);
    }

}
