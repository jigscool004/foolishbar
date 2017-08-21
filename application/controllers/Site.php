<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
    
    public $tableName = 'adpost_user';
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {

        if (isset($_REQUEST['submit'])) {
            //$searchText = isset($_REQUEST['search_text']) ? $_REQUEST['search_text'] : '';
            $category_id = isset($_REQUEST['cat']) && $_REQUEST['cat'] != '' ? $_REQUEST['cat'] : 'All';
            $url = 'site/listing/' . $category_id;
            if (isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != ""){
                $url .= '?search_text='. $this->input->get_post('search_text', TRUE);['search_text'];
            }
            redirect($url);
            exit;
        }
        $data['mainContent'] = 'front/home';
        $data['header'] = 'Home';
        $mobileCategory = $this->db->where('status',1)->get('mobile_category')->result();
        
        $data['mobileCategoryArr'] = objArray($mobileCategory,'id,name');
        $data['mobileCategoryObj'] = $mobileCategory;
        $adpostByCategory = $this->db->select("category,COUNT(id) as category_cnt")->group_by('category')->get('adpost')->result();
        $adpostByCategory = objArray($adpostByCategory,'category,category_cnt',false);
        $data['adpostByCategory'] = $adpostByCategory;
        $this->load->view('front/template',$data);
    }

    public function about() {
        $data['mainContent'] = 'front/about';
        $data['header'] = 'About';
        $this->load->view('front/template',$data);
    }

    public function faq() {
        $data['mainContent'] = 'front/faq';
        $data['header'] = 'FAQ';
        $this->load->view('front/template',$data);
    }

    public function signup() {
        $this->load->helper('form');
        if ($this->session->userdata('isFrontLoggedIn')) {
            redirect('user/dashboard');      
            exit;
        }
        if (isset($_POST['Signup'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('email','email','trim|required|valid_email');
            $this->form_validation->set_rules('username','username','trim|required|min_length[5]');
            $this->form_validation->set_rules('password','password','trim|required|min_length[6]');
            $this->form_validation->set_rules('mobile_no','contact number','trim|required|exact_length[10]');
            if ($this->form_validation->run() == true) {
                $submit_dataArr = [
                    'name' => $this->input->post('name'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('username'),
                    'password' => $this->generatePassword($this->input->post('password')),
                    'created_on' => date('Y-m-d H:i:s')
                ];
        
                if ($this->db->insert($this->tableName,$submit_dataArr)) {
                    redirect('site/login');
                    exit;
                } else {
                    redirect('site/signup?fail=1');
                }
            }
        }
        $data['header'] = 'Signup';
        $data['mainContent'] = 'front/user/signup';
        $this->load->view('front/template', $data);
    }

    public function login() {
        $this->load->helper('form');
        //printArray($_POST,true);
        if ($this->session->userdata('isFrontLoggedIn')) {
            redirect('user/dashboard');      
            exit;
        }
        if (isset($_POST['login'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('login_username','username','trim|required');
            $this->form_validation->set_rules('login_password','password','trim|required');
            $this->form_validation->set_rules('login_error','login_error','trim|callback_checklogin');
            if ($this->form_validation->run() == true) {
               $isLoggedIn = $this->userLogin();        
               if ($isLoggedIn == 'success') {
                  redirect('user/dashboard');      
               }
            }
        }
        $data['mainContent'] = 'front/user/login';
        $data['header'] = 'Login';
        $this->load->view('front/template', $data);
    }
    
    private function generatePassword($password) {
        return sha1(md5($password));
    }

    public function checklogin() {
        $message = $this->userLogin(); 
        if ($message != 'success') {
            $this->form_validation->set_message('checklogin', $message);
            return false;
        } else {
            return true;
        }
    }

    public function checkdata() {
        $type = '';
        if (isset($_GET['mobile_no']) && $_GET['mobile_no'] != "") {
            $this->db->where('mobile_no',$_GET['mobile_no']);
            $type = 'Contact Number';
        } else if (isset($_GET['email']) && $_GET['email'] != "") {
            $this->db->where('email',$_GET['email']);
            $type = 'Email';
        } else if (isset($_GET['username']) && $_GET['username'] != "") {
            $this->db->where('username',$_GET['username']);
            $type = 'Username';
        }

        $data = $this->db->select('count(id) as cnt')->get('adpost_user')->row();
        if (isset($_GET['t'],$data->cnt) && $_GET['t'] == 'forgetPwd') {
            if ($data->cnt == 0) {
                echo json_encode($type . ' is not available');
            } else {
                echo json_encode(' ');
            }
        } else if (isset($data->cnt) && $data->cnt > 0) {
            echo json_encode($type . ' is already available');
        }

    }

    private function userLogin() {
        $username = $this->input->post('login_username');
        $login_data = $this->db->where('username',$username)
                ->get('adpost_user')->row();

        if (isset($login_data) && count($login_data)) {
            if ($login_data->password == $this->generatePassword($this->input->post('login_password'))) {
                $dataArr = [
                    'name' => $login_data->name,
                    'username' => $login_data->username,
                    'id' => $login_data->id,
                    'isFrontLoggedIn' => true,
                ];
                $this->session->set_userdata($dataArr);
                return "success";
            } else {
                return 'Invalid username or password';
            }
        } else {
            return 'Invalid Username. ' . $username .' is not available on portal';
        }
    }

    public function logout() {
        $dataArr = array(
            'username' => '',
            'id' => '',
            'name' => '',
            'isFrontLoggedIn' => false,
        );
        $this->session->unset_userdata($dataArr);
        $this->session->sess_destroy();
        redirect('site/login');
    }

    public function listing($id = 'all') {
        //$searchText = isset($_REQUEST['search_text']) && $_REQUEST['search_text'] != "" ? trim($_REQUEST['search_text']) : '';
        $searchText = $this->input->get('search_text');
        $this->load->model('Site_m');
        $perPage = 10;
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config = $this->paginationConfiguaration($id,$perPage,$page);
        $totalCount = $this->Site_m->record_count($id,$searchText);
        $config["total_rows"] = $totalCount;
        $this->load->library("pagination");

        $this->pagination->initialize($config);
        
        $data["links"] = $this->pagination->create_links();
        $serachResult = $this->db->get('adpost')->result();

        if ($searchText != null) {
            $this->db->where('(t.adtitle LIKE "%'.$searchText.'%" OR t.ad_desc LIKE "%'.$searchText.'%")');
        }
        
        if((int)$id > 0) {
            $this->db->where('t.category',$id);
        }
        $serachResult = $this->Site_m->getSearchDetail($id,$config["per_page"], $page);
        //lastQuery(); exit;
        $data['x'] = (int)$page + 1;
        if (($page + $perPage) >  $totalCount) {
            $data['y'] = (int)$totalCount;
        } else {
            $data['y'] = $page + $perPage;
        }
        $data['category_id'] = $id;
        $data['searchText'] = $searchText;
        $data['searchResult'] = $serachResult;
        $data['totalCount'] = $totalCount;
        $data['header'] = 'Search';
        $data['mainContent'] = 'front/site/listing';
        $mobileCategory = $this->db->where('status',1)->get('mobile_category')->result();
        $data['mobileCategoryArr'] = objArray($mobileCategory,'id,name');
        $this->load->view('front/template', $data);
    }

    /**
     *
     */
    public function forget_password() {
        if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
            $data = $this->db->where('username',$_REQUEST['username'])->get('adpost_user')->row();

            if ($data === null) {
                echo json_encode(array('type' => 'error', 'message' => 'Username is not available' ));
            } else {
                $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = substr(str_shuffle($string),0,30);
                $html = "Hello {$data->username}
                         Please click on this link and change your password " . site_url('site/changepassword/' . $randomString);
                $html .= " <br>above link will be expire after day complete <br>Thanks <br>Gujjumobi";

                $this->load->library("phpmailer_library");
                $mail = $this->phpmailer_library->load();
                $mail->IsSMTP(); // we are going to use SMTP
                $mail->SMTPAuth   = true; // enabled SMTP authentication
                $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
                $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
                $mail->Port       = 465;                   // SMTP port to connect to GMail
                $mail->Username   = "jigarprajapati496@gmail.com";  // user email address
                $mail->Password   = "__foo496bar__";            // password in GMail
                $mail->SetFrom('jigarprajapati496@gmail.com', 'Gujjumobi');  //Who is sending the email
                $mail->addAddress($data->email,$data->name);  //email address that receives the response
                $mail->Subject    = "Password Recovery";
                $mail->Body      = $html;
                //$mail->AltBody    = "Plain text message";
                if($mail->Send()) {
                    $pwdArr = [
                        'pwd_token' => $randomString,
                        'token_date' => date('Y-m-d H:i:s')
                    ];
                    $this->db->where('id',$data->id);
                    $this->db->update('adpost_user',$pwdArr);
                    echo json_encode(['type' => "success","message" => "Please check your register email address"]);
                } else {
                    echo json_encode(['type' => "error","message" => "Something wrong happen please try again"]);
                }
            }
        }

    }

    public function changepassword($id) {
        if ($id != '') {
            $date = date("Y-m-d H:i:s");
            $this->db->where('token_date <= \'DATE_FORMAT('.$date.',"%Y-%m-%d %H:%i:%s")\'');
            $data = $this->db->where('pwd_token',$id)->get('adpost_user')->row();
            if (count($data)  > 0 ) {

            }
        }
    }

    public function sendEmail() {
        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "jigarprajapati496@gmail.com";  // user email address
        $mail->Password   = "__foo496bar__";            // password in GMail
        $mail->SetFrom('jigarprajapati496@gmail.com', 'Gujjumobi');  //Who is sending the email
        $mail->addAddress("jigarprajapati496@gmail.com","Jigar Prajapati (Freelance Developer)");  //email address that receives the response
        $mail->Subject    = "Gujjumobi Testing";
        $mail->Body      = "Gujjumobi Testing";
        //$mail->AltBody    = "Plain text message";
        return ($mail->Send());
        //$destino = "addressee@example.com"; // Who is addressed the email to
        //$mail->AddAddress($destino, "John Doe");
       /* $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'jigarprajapati496@gmail.com',
            'smtp_pass' => '$$$cockford$$$',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline('\r\n');
        $this->email->clear();
        $this->email->subject('Teting Email by Gujjumobi');
        $this->email->from('jigscool004@gmail.com','Jigar Prajapati (GujjuMobile)');
        $this->email->to(array('jigarprajapati496@gmail.com','mansurinaeem101@gmail.com'));
        $this->email->message('This is testing purpose email');
        if ($this->email->send()) {
            echo "email sent";
        } else {
            echo "not yet sent. sending failed.";
            show_error($this->email->print_debugger());
        }*/
    }

    private function paginationConfiguaration($id,$perPage,$segment) {
        $config = array();
        $config["base_url"] = site_url('site/listing/' . $id);

        $config["per_page"] = $perPage;
        $config["uri_segment"] = $segment;
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tagl_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        return $config;
    }
}
