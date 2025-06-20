<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_users
 *
 * @author Hassan
 */
class m_brands extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($brand_id = false, $data = false) {
        $this->db->where('brand_id', $brand_id);
        $this->db->update('brands', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallbrands(){
        $query = $this->db->get("brands");
            return $query->result_array();
    }
    public function adddbrand($data){

    $this->db->insert('brands',$data);
         }
    public function getbranddetail($brand_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('brand_id',$brand_id);
        $query = $this->db->get("brands");
      
            return $query->result_array();
    }
public function updatebrand($data,$brand_id){
  $this->db->where("brand_id", $brand_id);
        $query = $this->db->update("brands",$data); 

  }


}
  
?>