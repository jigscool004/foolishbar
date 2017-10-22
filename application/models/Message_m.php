<?php
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 08-10-2017
 * Time: 17:22
 */

class Message_m extends CI_Model {

    public $tableName = 'ad_message';
    public function __construct() {
        parent::__construct();
    }

    private function query($isLoggedIn) {
        $this->db->join('adpost ap','ap.id = t.`adpost_id`');
        $this->db->join('adpost_user au','au.id = t.`adpost_user_id`');
        $user_id = $this->session->userdata('id');
        $this->db->where('ap.adpost_user_id',$user_id);
        $this->db->group_by('t.adpost_id,t.adpost_user_id');
        return $this->db->from($this->tableName . ' t');
    }
    public function record_count($isLoggedIn = false) {
        $this->db->distinct();
        //$this->db->select('t.id,COUNT(t.adpost_id) AS msgCount');
        $this->db->select('t.id');
        $data = $this->query($isLoggedIn)->get()->result();
        return count($data);
    }

    public function getData($limit,$start,$isLoggedIn = false) {
        $this->db->distinct();
        $this->db->select('t.*,COUNT(t.adpost_id) AS msgCount,MAX(t.created_on) as created,ap.adtitle,au.name');
        $this->db->limit($limit,$start);
        return $this->query($isLoggedIn)->get()->result();
        //return $this->db->from($this->tableName);
    }

}