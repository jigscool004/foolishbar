<?php

/**
 * Created by PhpStorm.
 * User: Jigar Kumar
 * Date: 7/2/2017
 * Time: 8:08 PM
 */
class Site_m extends CI_Model{
    var $tableName = 'adpost';
    function __construct() {
        parent::__construct();
    }

    private function query() {
        //$this->db->join('(SELECT save_name,id,adpost_id FROM document LIMIT 1) AS d','d.adpost_id = t.id','left');
        $this->db->join('mobile_category mc','mc.id = t.category');
        $this->db->join('city c','c.id = t.city');
        $this->db->where('t.is_deleted',0);
        $this->db->where('t.is_archived',0);
        return $this->db->from($this->tableName . ' t');
    }

    public function record_count($category_id,$searchText) {

        $this->db->select('t.id');
        if ($searchText != null) {
            $this->db->where('(adtitle LIKE "%'.$searchText.'%" OR ad_desc LIKE "%'.$searchText.'%")');
        }

        if((int)$category_id > 0) {
        //if($category_id != 'all' || $category_id != '') {
            $this->db->where('category',$category_id);
        }
        /*if ($category_id != '') {
            $this->db->where('category',$category_id);
        }

        if ($searchText != '') {
            $this->db->like('adtitle',$searchText);   
        }*/
        $data = $this->query()->get()->result();
        return count($data);
    }

    public function getSearchDetail($id,$limit,$start) {
        $this->db->select('t.*,(SELECT save_name FROM document WHERE adpost_id = t.id LIMIT 1) AS save_name ,mc.name AS category_name,c.name as city_name,(SELECT COUNT(id) FROM document WHERE adpost_id = t.id) AS totalPhotos');
        $this->db->distinct();
        $this->db->limit($limit,$start);
        $this->query();
        return $this->db->from($this->tableName)->get()->result();
    }
}