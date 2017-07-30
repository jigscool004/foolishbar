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
class City extends CI_Controller {

    public function __construct() {
        parent::__construct();
        isLoggedIn();
        $this->load->model('City_m');
    }

    public function index() {
        $cityData = $this->db->get('city')->result();
        $data['cityData'] = $cityData;
        $data['content'] = 'admin/city/index';
        $this->load->view('admin/template', $data);
    }

    public function getdata() {

        $list = $this->City_m->get_datatables();
        $data = array();
        $no = $_POST['start'];


        foreach ($list as $city) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $city->name;
            $row[] = $city->status == 1 ? 'Active' : 'Inactive';
            //<button type="button" class="btn btn-info btn-xs" data-toggle="ajaxModal" data-target="#myModal">Add New</button>

            $row[] = anchor(site_url('admin/city/edit/' . $city->id), 'Edit', [
                        'class' => 'edit btn btn-primary btn-xs',
                        'id' => $city->id,
                        'data-toggle' => "ajaxModal",
                        'data-target' => "#myModal",
                        'onClick' => 'openModelPopup(this); return false;'
                    ]) . "  " .
                    anchor(site_url('admin/city/delete/' . $city->id), 'Delete', [
                        'class' => 'delete btn btn-danger btn-xs',
                        'id' => $city->id,
                        'onClick' => 'deleteRercord(this); return false;'
            ]);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->City_m->count_all(),
            "recordsFiltered" => $this->City_m->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }

    public function edit($id = '') {
        if ((int) $id != '') {
            $this->load->helper('form');
            $data['id'] = $id;
            $data['city_data'] = $this->City_m->getCityById($id);
            if (isset($_POST['name'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'name', 'trim|required');
                $this->form_validation->set_rules('status', 'status', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $data['url'] = site_url('admin/city/create');
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
                    $isSaved = $this->db->update('city', $saveData);
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
            
            $this->load->view('admin/city/edit', $data);
        } else {
            
        }
    }
    
    public function delete($id) {
        if ($id != '') {
           $this->db->where('id',$id);
           if ($this->db->delete('city')) {
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
                $data['url'] = site_url('admin/city/create');
                $data['button'] = 'Create';
                $data['error'] = 1;
                echo $this->load->view('admin/city/_form', $data, true);
                exit;
            } else {
                $saveData = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('id'),
                    'created_on' => date('Y-m-d H:i:s')
                );

                $isSaved = $this->db->insert('city', $saveData);
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
        $this->load->view('admin/city/create', $data);
    }

}
