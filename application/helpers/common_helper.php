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


