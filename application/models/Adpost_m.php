<?php 
/**
* 
*/
class Adpost_m extends CI_model {
	
	public $tableName = 'adpost';
	function __construct() {
		parent::__construct();
	}

	public function getAdDetailByid($id = '',$isSession = false) {
		$result = $id != '' ? 'row' : 'result';
		if ($id != '') {
			$result = 'row';
			$this->db->where('t.id',$id);
		} else {
			$result = 'result';
		}


		if ($isSession) {
			$this->db->where('adpost_user_id',$this->session->userdata('id'));
		}
		$this->db->select('t.*,c.name AS city_name,a.area,a.zipcode,mc.name as category_name');
		//$this->db->join('document','document.adpost_id = adpost.id','left');
		$this->db->join('city c','c.id = t.city','left');
		$this->db->join('mobile_category mc','mc.id = t.category','left');
		$this->db->join('area a','a.id = t.location','left');
		$data = $this->db->from('adpost t')->get()->$result();
		return $data;
	}

	public function getDocument($idArr = array()) {
		$query = 'SELECT save_name FROM document';
		if (count($idArr) > 0) {
			$id = implode(',',$idArr);
			$query .= ' WHERE adpost_id IN (' . $id . ')';
		}	
		$data = $this->db->query($query);
		return $data->result();
	}

	/**
	 * @author Jigar Prajapati <[jigar.prajapati496@gmail.com]>
	 * @uses below method is checked adpost record is available or not and if it is available than it's check logged in user is edit own adpost. meanwhile it's check logged in user can edit only own adpost.
	 * @param  int adpostId
	 * @return boolean
	 */
	public function isEdit($id) {
		if ($id != '' || $id == NULL) {
			$data = $this->db->where('id',$id)->get($this->tableName)->row();	
			if (count($data) > 0) {
				$currentLoggedinUser = $this->session->userdata('id');
				if ($data->adpost_user_id == $currentLoggedinUser) {
					return true;
				} else {
					return false;
				}
			}
		}
		return false;
	}

	private function query($isLoggedIn = false) {
		//$this->db->join('(SELECT save_name,id,adpost_id FROM document LIMIT 1) AS d','d.adpost_id = t.id','left');
		$this->db->join('mobile_category mc','mc.id = t.category');
		$this->db->join('city c','c.id = t.city');
		if ($isLoggedIn) {
		    $user_id = $this->session->userdata('id');
            $this->db->where('t.adpost_user_id',$user_id);
        }
		return $this->db->from($this->tableName . ' t');
	}
	public function record_count($isLoggedIn = false) {
        $this->db->distinct();
        $this->db->select('t.id');
		$data = $this->query($isLoggedIn)->get()->result();
        return count($data);
    }

    public function getData($limit,$start,$isLoggedIn = false) {
        $this->db->distinct();
        $this->db->select('t.*,(SELECT save_name FROM document WHERE adpost_id = t.id LIMIT 1) AS save_name ,mc.name AS category_name,c.name as city_name');
    	$this->db->limit($limit,$start);
    	return $this->query($isLoggedIn)->get()->result();
    	//return $this->db->from($this->tableName)
    }

    public function getWishListData($limit,$start) {
        $this->db->join('ad_wishlist adw','adw.adpost_id = t.id');
        $this->db->where('adw.ad_user_id',$this->session->userdata('id'));
        $this->db->distinct();
        $this->db->select('adw.id AS wishlist_id,t.*,(SELECT save_name FROM document WHERE adpost_id = t.id LIMIT 1) AS save_name ,mc.name AS category_name,c.name as city_name');
        $this->db->limit($limit,$start);
        return $this->query()->get()->result();
        //return $this->db->from($this->tableName);
        //$data = $this->getData($limit,$start);
        ///return $data;
    }
}

 ?>