<?php 

	function printArray($data,$isExit = false) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($isExit) exit;
	}

    function getUserDetails() {
    	$ci = & get_instance();
    	$id = $ci->session->userdata('id');
    	$data = $ci->db->where('id',$id)->get('adpost_user')->row();
    	if (count($data)) {
    		return $data;
    	} else {
    		return false;
    	}
    }


    function objArray($object,$fields,$isSelect = true) {
        if (count($object) > 0 && $fields != "") {
           
            list($index,$value) = explode(",", $fields);
            //if (count($fieldsArr) == 2) 
            {
                //echo $fieldsArr[0] . '-----' . $fieldsArr[1];
                $data = ($isSelect == true) ? ['' => '-Select-'] :  [];
                foreach ($object as $key => $obj) {
                    $data[$obj->$index] = $obj->$value;
                }
                return $data;
            } 
            /*else {
                return false;
            }*/
        } else {
            return false;
        }
    }


    function postToArray($postArr = array()) {
        $ci = & get_instance();
        $dataArr = [];
        foreach ($postArr as $key => $value) {
            //$dataArr[$key] = $this->input->post()
        }
    }


    function encrytPassword($password) {
        return sha1(md5($password));
    }

    function lastQuery() {
        $ci = & get_instance();
        echo $ci->db->last_query();
    }

    function convertDate($date,$format = 'd-m-Y') {
         if (isset($date) && $date != '') {
            return date($format,strtotime($date));
         }
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    function frontDashboardCounter($type = 'myads') {
        $ci = & get_instance();
        if ($type == 'wishlist') {
            $ci->db->where('ad_user_id',$ci->session->userdata('id'));
            $result = $ci->db->select('id')->get('ad_wishlist')->result();
            return count($result);
        } else {
            if ($ci->session->userdata('isFrontLoggedIn')) {
                if ($type == 'archived') {
                    $ci->db->where('is_archived',1);
                } else {
                    $ci->db->where('is_archived',0);
                }
                $ci->db->where('is_deleted',0);
                $ci->db->where('adpost_user_id',$ci->session->userdata('id'));
                $result = $ci->db->select('id')->get('adpost')->result();
                return count($result);
            }
        }
    }

    function loadEmailSetting() {
        $ci = & get_instance();
        $ci->load->library("phpmailer_library");
        $mail = $ci->phpmailer_library->load();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "jigarprajapati496@gmail.com";  // user email address
        $mail->Password   = "krishna$%^rama!!!";            // password in GMail
        $mail->SetFrom('jigarprajapati496@gmail.com', 'Gujjumobi');  //Who is sending the email
        $mail->isHtml(true);
        return $mail;
    }

    function paginationConfiguration($settingArr = array()) {
	    if (count($settingArr) > 0) {
            $config = array();
            $config["base_url"] =  isset($settingArr['base_url']) ? $settingArr['base_url'] : '';
            $config["total_rows"] = isset($settingArr['total_item']) ? $settingArr['total_item'] : 0;
            $config["per_page"] = isset($settingArr['perPage']) ? $settingArr['perPage'] : 0;
            $config["uri_segment"] = isset($settingArr['uri_segment']) ? $settingArr['uri_segment'] : 0;
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
        } else {
	        return false;
        }

    }
