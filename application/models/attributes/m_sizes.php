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
class m_sizes extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($size_id = false, $data = false) {
        $this->db->where('size_id', $size_id);
        $this->db->update('sizes', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallsizes(){
        $query = $this->db->get("sizes");
            return $query->result_array();
    }
    public function adddsize($data){

    $this->db->insert('sizes',$data);
         }
    public function getsizedetail($size_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('size_id',$size_id);
        $query = $this->db->get("sizes");
      
            return $query->result_array();
    }
public function updatesize($data,$size_id){
  $this->db->where("size_id", $size_id);
        $query = $this->db->update("sizes",$data); 

  }
     public function getsizes(){
       
        $query = $this->db->get("sizes");
            return $query->result_array();
    } 
}
?>