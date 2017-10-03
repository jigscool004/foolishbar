<?php

/**
 *
 */
class Adpost extends CI_Controller {

    private $tableName = 'adpost';

    function __construct() {
        parent::__construct();
        $this->load->model('Adpost_m');
    }

    public function index() {
        isFrontLoggedIn();
        $data['header'] = 'Post New Ad';
        $data['mainContent'] = 'front/adpost/form';
        $mobileCategoryObj = $this->db->where('status', 1)->select('id,name')->get('mobile_category')->result();
        $cityObj = $this->db->where('status', 1)->select('id,name')->get('city')->result();

        if (isset($_POST['postAd'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('adtitle', 'Ad title', 'trim|required');
            $this->form_validation->set_rules('category', 'Mobile Category', 'trim|required');
            $this->form_validation->set_rules('model', 'model', 'trim|required');
            $this->form_validation->set_rules('price', 'price', 'trim|required|integer');
            $this->form_validation->set_rules('ad_desc', 'Ad description', 'trim|required|min_length[20]');
            ///$this->form_validation->set_rules('ad_tag','Ad tag','trim|required|min_length[20]');
            $this->form_validation->set_rules('adpost_username', 'your full name', 'trim|required');
            $this->form_validation->set_rules('adpost_user_mobile', 'mobile number', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('city', 'city', 'trim|required');
            $this->form_validation->set_rules('location', 'location', 'trim|required');
            $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required');
            if ($this->form_validation->run() == true) {
                $saveDataArr = $_POST;
                unset($saveDataArr['postAd']);
                $saveDataArr['created_on'] = date('Y-m-d H:i:s');
                $saveDataArr['adpost_user_id'] = $this->session->userdata('id');
                if ($this->db->insert($this->tableName, $saveDataArr)) {
                    $insert_id = $this->db->insert_id();
                    $adpost_id = str_pad($insert_id, 8, '0', STR_PAD_LEFT);
                    $this->db->where('id', $insert_id);
                    $this->db->update($this->tableName, ['adpost_id' => $adpost_id]);
                    if (!file_exists(FCPATH . 'assest/upload/adpost_photos/' . $adpost_id)) {
                        mkdir(FCPATH . 'assest/upload/adpost_photos/' . $adpost_id, 0777, true);
                    }
                    $message = 'Your ad is posted successfully. now upload Ad photo to completed this ad.';
                    $type = 'success';
                    $this->session->set_flashdata('message', $message);
                    $this->session->set_flashdata('type', $type);
                    redirect('adpost/upload_photos/' . $insert_id);
                    exit;
                } else {
                    $message = 'Something wrong happened please try again.';
                    $type = 'danger';
                    $this->session->set_flashdata('message', $message);
                    $this->session->set_flashdata('type', $type);
                    redirect('user/dashboard');
                    exit;
                }
            }
        }

        $this->load->helper('form');
        $adpost_data = $this->db->list_fields($this->Adpost_m->tableName);
        $adPostObj = new stdClass;
        foreach ($adpost_data as $key => $field) {
            $adPostObj->$field = "";
        }
        $data['adpost_data'] = $adPostObj;
        $data['formAction'] = site_url('adpost/index');
        $data['mobileCategoryArr'] = objArray($mobileCategoryObj, 'id,name');
        $data['cityArr'] = objArray($cityObj, 'id,name');
        $this->load->view('front/template', $data);
    }

    public function view($id) {
        if (isset($id) && $id != '') {
            $this->load->model('Adpost_m');
            $adpost_dataArr = $this->Adpost_m->getAdDetailByid($id);
            $wishList = array();
            if (checkedLoggedinFront()) {
                $user_id = $this->session->userdata('id');
                $this->db->where('adpost_id', $id);
                $this->db->where('ad_user_id', $user_id);
                $wishList = $this->db->get('ad_wishlist')->row_array();
            }

            $data['wishList'] = $wishList;
            $data['mainContent'] = 'front/adpost/view';
            $data['header'] = $adpost_dataArr->adtitle;
            $photosDataArr = $this->Adpost_m->getDocument(array($adpost_dataArr->id));
            $data['adpost_dataArr'] = $adpost_dataArr;
            $data['photos_dataArr'] = $photosDataArr;
            $this->load->view('front/template', $data);
        } else {
            echo '404';
        }
    }

    private function adpostById($id) {
        return $this->db->where('id', $id)->get('adpost')->row();
    }

    public function upload_photos($id) {
        isFrontLoggedIn();
        if (isset($id) && $id != "" && count($this->adpostById($id)) > 0) {
            $adpostDetail = $this->adpostById($id);
            $data['folderName'] = $adpostDetail->adpost_id;
            $data['header'] = 'Post New Ad';
            $data['mainContent'] = 'front/adpost/upload_photos';
            $adImagesArr = $this->db->where('adpost_id', $id)->get('document')->result();
            $data['adImagesArr'] = $adImagesArr;
            $this->load->helper('form');
            $data['adpost_id'] = $id;
            $this->load->view('front/template', $data);
        } else {
            echo '404';
        }
    }

    public function edit($id) {
        isFrontLoggedIn();
        if ($id != '' && $this->Adpost_m->isEdit($id)) {
            $this->load->helper('form');
            $mobileCategoryObj = $this->db->where('status', 1)->select('id,name')->get('mobile_category')->result();
            $cityObj = $this->db->where('status', 1)->select('id,name')->get('city')->result();
            $data['adpost_id'] = $id;
            $data['mobileCategoryArr'] = objArray($mobileCategoryObj, 'id,name');
            $data['cityArr'] = objArray($cityObj, 'id,name');
            $data['header'] = 'Edit Your post';
            $data['mainContent'] = 'front/adpost/form';
            if (isset($_POST['postAd'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('adtitle', 'Ad title', 'trim|required');
                $this->form_validation->set_rules('category', 'Mobile Category', 'trim|required');
                $this->form_validation->set_rules('model', 'model', 'trim|required');
                $this->form_validation->set_rules('price', 'price', 'trim|required|integer');
                $this->form_validation->set_rules('ad_desc', 'Ad description', 'trim|required|min_length[20]');
                ///$this->form_validation->set_rules('ad_tag','Ad tag','trim|required|min_length[20]');
                $this->form_validation->set_rules('adpost_username', 'your full name', 'trim|required');
                $this->form_validation->set_rules('adpost_user_mobile', 'mobile number', 'trim|required|exact_length[10]');
                $this->form_validation->set_rules('city', 'city', 'trim|required');
                $this->form_validation->set_rules('location', 'location', 'trim|required');
                $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $saveDataArr = $_POST;
                    unset($saveDataArr['postAd']);
                    $saveDataArr['updated_on'] = date('Y-m-d H:i:s');
                    $this->db->where('id', $id);
                    if ($this->db->update($this->tableName, $saveDataArr)) {
                        $message = 'Your adpost is successfully saved.';
                        $type = 'success';
                    } else {
                        $message = 'Something wrong happened please try again.';
                        $type = 'danger';
                    }

                    $this->session->set_flashdata('message', $message);
                    $this->session->set_flashdata('type', $type);
                    redirect('adpost/view/' . $id);
                    exit;
                }
            }
            $data['formAction'] = site_url('adpost/edit/' . $id);
            $adpost_data = $this->db->where('id', $id)->get('adpost')->row();
            $data['adpost_data'] = $adpost_data;
            $this->load->view('front/template', $data);
        }
    }

    public function updatestatus($id) {
        isFrontLoggedIn();
        if (isset($_POST['status']) && $id != "") {
            $this->db->where('id', $id);
            $isUpdate = $this->db->update($this->Adpost_m->tableName, array('status' => $_POST['status']));
            if ($isUpdate) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    public function delete_image($id) {
        isFrontLoggedIn();
        if (isset($_POST['ajax'], $_POST['folderName']) && $_POST['ajax'] = 1) {
            $document = $this->db->where('id', $id)->get('document')->row();
            if (count($document) > 0) {
                $file_path = FCPATH . 'assest/upload/adpost_photos/' . $_POST['folderName'] . '/' . $document->save_name;
                $this->db->where('id', $id);
                if ($this->db->delete('document')) {
                    unlink($file_path);
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 'Invalid request';
        }
    }

    public function do_upload($id) {
        isFrontLoggedIn();
        if (isset($id) && $id != "") {
            $adPostDetail = $this->adpostById($id);
            $countNumberDocUploaded = $this->db->select('id')->where('adpost_id', $id)->get('document')->num_rows();
            if (count($adPostDetail) > 0) {
                $config['upload_path'] = './assest/upload/adpost_photos/' . $adPostDetail->adpost_id . '/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 100000;
                $files = $_FILES;

                $count = count($_FILES['photos']['name']);
                if (!isset($_FILES['photos'])) {
                    echo json_encode(array('error' => array('Please select images')));
                    exit;
                } else if (($countNumberDocUploaded + $count) > 5) {
                    echo json_encode(array('error' => array('You can only upload a maximum of 5 photos')));
                    exit;
                }


                $data = array();
                for ($i = 0; $i < $count; $i++) {
                    $_FILES['photos']['name'] = $files['photos']['name'][$i];
                    $_FILES['photos']['type'] = $files['photos']['type'][$i];
                    $_FILES['photos']['tmp_name'] = $files['photos']['tmp_name'][$i];
                    $_FILES['photos']['error'] = $files['photos']['error'][$i];
                    $_FILES['photos']['size'] = $files['photos']['size'][$i];
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('photos') == true) {
                        $uploadData = $this->upload->data();
                        $fileName = $uploadData['file_name'];


                        $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $uploadData['full_path'],
                            'maintain_ratio' => TRUE,
                            //'create_thumb' => TRUE,
                            'width' => 400,
                            'height' => 700,
                        );
                        $this->load->library('image_lib');
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();
                        
                        $saveDataArr = array(
                            'adpost_id' => $id,
                            'document_name' => $fileName,
                            'type' => 'adpost',
                            'save_name' => $fileName,
                            'created_on' => date('Y-m-d H:i:s'),
                            'created_by' => $this->session->userdata('id')
                        );

                        if ($this->db->insert('document', $saveDataArr)) {
                            $insert_id = $this->db->insert_id();
                            $data['success'][$i] = array(
                                'file_name' => $fileName,
                                'id' => $insert_id
                            );
                        }
                    } else {
                        $data['error'][$i] = $_FILES['photos']['name'] . " : " . $this->upload->display_errors();
                    }
                }
                echo json_encode($data);
            }
        }
    }
    
    public function addMessage($id) {
        if (isset($id) && $id != '') {
            $this->load->model('Adpost_m');
            $adpost_dataArr = $this->Adpost_m->getAdDetailByid($id);
            $data['adpost_dataArr'] = $adpost_dataArr;
            $data['id'] = $id;
            if (isset($_POST['subject'])) {
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('subject', 'subject', 'trim|required');
                $this->form_validation->set_rules('message_body', 'message', 'trim|required');
                 if ($this->form_validation->run() == false) {
                    $data['error'] = 1;
                    echo $this->load->view('front/message/_sendMessage', $data, true);
                    exit;
                } else {
                     $saveData = array(
                        'subject' => $this->input->post('subject'),
                        'message_body' => $this->input->post('message_body'),
                        'adpost_user_id' => $this->session->userdata('id'),
                        'adpost_id' => $id,
                        'created_on' => date('Y-m-d H:i:s')
                    );

                    $isSaved = $this->db->insert('ad_message', $saveData);
                    if ($isSaved) {
                        echo 1;
                        exit;
                    } else {
                        echo 0;
                        exit;
                    }
                }
            }
            
            $data['adpost_dataArr'] = $adpost_dataArr;
            $data['id'] = $id;
            $data['error'] = '';
            $this->load->view('front/message/add',$data);
        }
    }

    public function getLocation() {
        isFrontLoggedIn();
        $city_id = $this->input->get('city_id');
        if (isset($city_id) && $city_id != "") {
            $locationDetail = $this->db->where([
                        'city_id' => $city_id,
                        'status' => 1
                    ])->select('id,area')->get('area')->result();
            if (count($locationDetail) > 0) {
                $html = '<option value="">-Select-</option>';
                foreach ($locationDetail as $key => $location) {
                    $select = '';
                    if ($this->input->get('location_id') == $location->id) {
                        $select = 'selected="selected"';
                    }
                    $html .= '<option value="' . $location->id . '" ' . $select . '>' . $location->area . '</option>';
                }

                echo $html;
            }
        }
    }

    public function getZipcode() {
        isFrontLoggedIn();
        $location_id = $this->input->get('location_id');
        if (isset($location_id) && $location_id != "") {
            $locationDetail = $this->db->where([
                        'id' => $location_id,
                        'status' => 1
                    ])->select('zipcode')->get('area')->row();

            echo isset($locationDetail->zipcode) ? $locationDetail->zipcode : '';
        }
    }

    public function archiveAds($id) {
        isFrontLoggedIn();
        if (isset($_POST['status']) && (int) $id > 0) {
            $this->db->where('id', $id);
            $isUpdate = $this->db->update($this->Adpost_m->tableName, array('is_archived' => $_POST['status']));
            if ($isUpdate) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

}

?>
