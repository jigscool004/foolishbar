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
            $fields = explode(",", $fields);
            if (count($fields) == 2) {

                $data = ($isSelect == true) ? ['' => '-Select-'] : [];
                foreach ($object as $key => $obj) {
                    $data[$obj->$fields[0]] = $obj->$fields[1];
                }
                return $data;
            } else {
                return false;
            }
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
