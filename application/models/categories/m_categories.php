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
class m_categories extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
      public function changestatus($category_id = false, $data = false) {
        $this->db->where('category_id', $category_id);
        $this->db->update('categories', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallcategories($status=false){
      if($status){
$this->db->where('category_status',$status);
      }
        
        $query = $this->db->get("categories");
        return $query->result_array();
    }
    public function adddcategory($data){

    $this->db->insert('categories',$data);
         }
  public function getcatgorydetail($catgory_id){
$this->db->where("scatgory_id", $catgory_id);
        $query = $this->db->get("categories");
        return $query->result_array();

  }
  public function updatecategory($data,$catgory_id){
  $this->db->where("category_id", $catgory_id);
        $query = $this->db->update("categories",$data); 

  }
  public function getcategorydetail($category_id){
$this->db->where("category_id", $category_id);
        $query = $this->db->get("categories");
        return $query->result_array();

  }

}
  
  
?>