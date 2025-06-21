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
class m_colours extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($colour_id = false, $data = false) {
        $this->db->where('colour_id', $colour_id);
        $this->db->update('colours', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallcolours(){
        $query = $this->db->get("colours");
            return $query->result_array();
    }
    public function adddcolour($data){

    $this->db->insert('colours',$data);
         }
    public function getcolourdetail($colour_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('colour_id',$colour_id);
        $query = $this->db->get("colours");
      
            return $query->result_array();
    }
public function updatecolour($data,$colour_id){
  $this->db->where("colour_id", $colour_id);
        $query = $this->db->update("colours",$data); 

  }
     public function getcolours(){
       
        $query = $this->db->get("colours");
            return $query->result_array();
    } 
}
?>