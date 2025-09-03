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
class m_country extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
      public function changestatus($country_id = false, $data = false) {
        $this->db->where('country_id', $country_id);
        $this->db->update('countries', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
      public function changestatestatus($state_id = false, $data = false) {
        $this->db->where('state_id', $state_id);
        $this->db->update('state', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
      public function changecitystatus($city_id = false, $data = false) {
        $this->db->where('city_id', $city_id);
        $this->db->update('cities', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }
    public function getallcountries($status=false){

        
        $query = $this->db->get("countries");
        return $query->result_array();
    }
    public function getallstates($status=false){
      
        
        $query = $this->db->get("state");
        return $query->result_array();
    }
    public function getallcities($status=false){
      
        
        $query = $this->db->get("cities");
        return $query->result_array();
    }
    public function adddcountry($data){

    $this->db->insert('countries',$data);
         }
    public function adddstate($data){

    $this->db->insert('state',$data);
         }
    public function adddcity($data){

    $this->db->insert('cities',$data);
         }
  public function getstatedetail($state_id){
$this->db->where("state_id", $state_id);
        $query = $this->db->get("state");
        return $query->result_array();

  }
  public function getcitydetail($city_id){
$this->db->where("city_id", $city_id);
        $query = $this->db->get("cities");
        return $query->result_array();

  }
  public function updatecountry($data,$country_id){
  $this->db->where("country_id", $country_id);
        $query = $this->db->update("countries",$data); 

  }
  public function updatestate($data,$state_id){
  $this->db->where("state_id", $state_id);
        $query = $this->db->update("state",$data); 

  }
  public function updatecity($data,$city_id){
  $this->db->where("city_id", $city_id);
        $query = $this->db->update("cities",$data); 

  }
  public function getcountrydetail($country_id){
$this->db->where("country_id", $country_id);
        $query = $this->db->get("countries");
        return $query->result_array();

  }

}
  
  
?>