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
class m_types extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($type_id = false, $data = false) {
        $this->db->where('type_id', $type_id);
        $this->db->update('types', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getalltypes(){
        $query = $this->db->get("types");
            return $query->result_array();
    }
    public function adddtype($data){

    $this->db->insert('types',$data);
         }
    public function gettypedetail($type_id,$status=false){
        if($status){$this->db->where('status',1);}
        
        $this->db->where('type_id',$type_id);
        $query = $this->db->get("types");
      
            return $query->result_array();
    }
public function updatetype($data,$type_id){
  $this->db->where("type_id", $type_id);
        $query = $this->db->update("types",$data); 

  }
     public function gettypes(){
       
        $query = $this->db->get("types");
            return $query->result_array();
    } 
}