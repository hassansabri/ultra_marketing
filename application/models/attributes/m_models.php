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
class m_models extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($model_id = false, $data = false) {
        $this->db->where('model_id', $model_id);
        $this->db->update('models', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallmodels(){
        $query = $this->db->get("models");
            return $query->result_array();
    }
    public function adddmodel($data){

    $this->db->insert('models',$data);
         }
    public function getmodeldetail($model_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('model_id',$model_id);
        $query = $this->db->get("models");
      
            return $query->result_array();
    }
public function updatemodel($data,$model_id){
  $this->db->where("model_id", $model_id);
        $query = $this->db->update("models",$data); 

  }
} 
  
?>