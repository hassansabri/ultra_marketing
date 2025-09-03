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
class m_shop extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getallshops(){
        $query = $this->db->get("shops");
        return $query->result_array();
    }
     public function getallsuppliers(){
            $this->db->where("shop_type",'supplier');
            $query = $this->db->get("shops");
            return $query->result_array();
        }
     public function getallcrediters(){
            $this->db->where("shop_type",'crediter');
            $query = $this->db->get("shops");
            return $query->result_array();
        }
    public function addnewshop($data){

    $this->db->insert('shops',$data);
         }
  public function getshopdetail($shop_id){
$this->db->where("shop_id", $shop_id);
        $query = $this->db->get("shops");
        return $query->result_array();

  }
  public function updateshop($data,$shop_id){
  $this->db->where("shop_id", $shop_id);
        $query = $this->db->update("shops",$data); 

  }
     public function changestatus($shop_id = false, $data = false) {
        $this->db->where('shop_id', $shop_id);
        $this->db->update('shops', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }

    public function getinvoices($shop_id){
        $this->db->select('order_id,order_number');
$this->db->where("shop_id", $shop_id);
        $query = $this->db->get("orders");
        return $query->result_array();

    }

}
  
  
?>