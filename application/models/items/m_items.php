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
class m_items extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
     public function changestatus($item_id = false, $data = false) {
        $this->db->where('item_id', $item_id);
        $this->db->update('items', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallitems(){
        $query = $this->db->get("items");
        return $query->result_array();
    }
    public function addnewitems($data){

    $this->db->insert('items',$data);
         }
  public function getitemdetail($items_id){
$this->db->where("item_id", $items_id);
        $query = $this->db->get("items");
        return $query->result_array();

  }
  public function updateitem($data,$items_id){
  $this->db->where("item_id", $items_id);
        $query = $this->db->update("items",$data); 

  }
 public function getallbrands(){
        $query = $this->db->get("brands");
            return $query->result_array();
    }
    public function getbranddetail($brand_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('brand_id',$brand_id);
        $query = $this->db->get("brands");
      
            return $query->result_array();
    }
}
  
  
?>