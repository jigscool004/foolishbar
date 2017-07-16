<?php 

/**
* 
*/
class Location extends CI_controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model('Location_m');
	}


	public function index() {
		$data['content'] = 'admin/location/index';
        $this->load->view('admin/template', $data);
	}

	private function getCityData() {
		$cityData = $this->db->where('status',1)->select('id,name')->get('city')->result();
        $cityDataArr = array('' => '-Select-') ;
        foreach($cityData as $key => $city) {
        	$cityDataArr[$city->id] = $city->name;
        }
        return $cityDataArr;
	}

	 public function create() {
        $this->load->helper('form');
        
        $data['city_dataArr'] = $this->getCityData();
        $location_data = (object)['area' => '','status' => '','city_id' => '','zipcode' => ''];
        $data['location_data'] = $location_data;
        if (isset($_POST['area'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('area', 'area', 'trim|required');
            $this->form_validation->set_rules('city_id', 'city', 'trim|required');
            $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required|integer|exact_length[6]');
            $this->form_validation->set_rules('status', 'status', 'trim|required');
            if ($this->form_validation->run() == false) {
                $data['url'] = site_url('admin/location/create');
                $data['button'] = 'Create';
                $data['error'] = 1;
                echo $this->load->view('admin/location/_form', $data, true);
                exit;
            } else {
                $saveData = array(
                    'area' => $this->input->post('area'),
                    'city_id' => $this->input->post('city_id'),
                    'zipcode' => $this->input->post('zipcode'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('id'),
                    'created_on' => date('Y-m-d H:i:s')
                );
               

                $isSaved = $this->db->insert('area', $saveData);
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
        $this->load->view('admin/location/create', $data);
    }
    
    public function getdata() {

        $list = $this->Location_m->get_datatables();
        $data = array();
        $no = $_POST['start'];


        foreach ($list as $location) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $location->area;
            $row[] = $location->name;
            $row[] = $location->zipcode;
            $row[] = $location->status == 1 ? 'Active' : 'Inactive';
            //<button type="button" class="btn btn-info btn-xs" data-toggle="ajaxModal" data-target="#myModal">Add New</button>

            $row[] = anchor(site_url('admin/location/edit/' . $location->id), 'Edit', [
                        'class' => 'edit btn btn-primary btn-xs',
                        'id' => $location->id,
                        'data-toggle' => "ajaxModal",
                        'data-target' => "#myModal",
                        'onClick' => 'openModelPopup(this); return false;'
                    ]) . "  " .
                    anchor(site_url('admin/location/delete/' . $location->id), 'Delete', [
                        'class' => 'delete btn btn-danger btn-xs',
                        'id' => $location->id,
                        'onClick' => 'deleteRercord(this); return false;'
            ]);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Location_m->count_all(),
            "recordsFiltered" => $this->Location_m->count_filtered(),
            "data" => $data,
        );


        //output to json format
        echo json_encode($output);
    }
    
    public function edit($id = '') {
        if ((int) $id != '') {
            $this->load->helper('form');
            $data['id'] = $id;
            $data['city_dataArr'] = $this->getCityData();
            $data['location_data'] = $this->Location_m->getCityById($id);
            if (isset($_POST['area'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('area', 'area', 'trim|required');
                $this->form_validation->set_rules('city_id', 'city', 'trim|required');
                $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required');
                $this->form_validation->set_rules('status', 'status', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $data['url'] = site_url('admin/location/edit');
                    $data['button'] = 'Edit';
                    $data['error'] = 1;
                    echo $this->load->view('admin/location/_form', $data, true);
                    exit;
                } else {
                    $saveData = array(
                        'area' => $this->input->post('area'),
                        'city_id' => $this->input->post('city_id'),
                        'zipcode' => $this->input->post('zipcode'),
                        'status' => $this->input->post('status'),
                        'updated_by' => $this->session->userdata('id'),
                        'updated_on' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('id',$id);
                    $isSaved = $this->db->update('area', $saveData);
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
            
            $this->load->view('admin/location/edit', $data);
        } else {
            
        }
    }
    
    public function delete($id) {
        if ($id != '') {
           $this->db->where('id',$id);
           if ($this->db->delete($this->Location_m->table)) {
               echo 1;
           } else {
               echo 0;
           }
        } else {
            echo 0;
        }
    }
}
 ?>