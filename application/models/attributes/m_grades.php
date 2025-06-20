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
class m_grades extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($grade_id = false, $data = false) {
        $this->db->where('grade_id', $grade_id);
        $this->db->update('grades', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallgrades(){
        $query = $this->db->get("grades");
            return $query->result_array();
    }
    public function adddgrade($data){

    $this->db->insert('grades',$data);
         }
    public function getgradedetail($grade_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('grade_id',$grade_id);
        $query = $this->db->get("grades");
      
            return $query->result_array();
    }
public function updategrade($data,$grade_id){
  $this->db->where("grade_id", $grade_id);
        $query = $this->db->update("grades",$data); 

  }
     public function getgrades(){
       
        $query = $this->db->get("grades");
            return $query->result_array();
    } 
}
?>