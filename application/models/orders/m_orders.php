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
class m_orders extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getallbrands(){
        $query = $this->db->get("brands");
        $this->db->where('status',1);
            return $query->result_array();
    }
    public function getAllItems(){
        $this->db->where('item_status',1);
         $query = $this->db->get("items");
        return $query->result_array();
    }
    public function getitemattributesgeneral($item_id,$item_type){
  $this->db->select('attribute_fk');
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type',$item_type);
        $this->db->where('status',1);
        $query = $this->db->get("items_attributes");
        // echo $this->db->last_query();
        $data = array();
        $da = array();
              if (sizeof($query->result_array()) > 0) {
                $i=0;
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "attribute_fk" => $value["attribute_fk"]
                );
                $data[$i] = $dat['attribute_fk'];
                $i++;
            }
            
        }
        return $data;
    }
    public function getitemattributes($item_id){
        $brand=array();
    $data= $this->getitemattributesgeneral($item_id,'brand');
    $brand=$data;
     $da[]=$brand;
    $data= $this->getitemattributesgeneral($item_id,'grade');
    // $da['grade']=array('grade');    
    $da[] = $data;
        $data= $this->getitemattributesgeneral($item_id,'model');
        $da[]= $data;
        $data= $this->getitemattributesgeneral($item_id,'size');
        $da[] = $data;
        $data= $this->getitemattributesgeneral($item_id,'type');
        $da[] = $data;
        $data= $this->getitemattributesgeneral($item_id,'colour');
        $da[] = $data;
        $data= $this->getitemattributesgeneral($item_id,'unit');
        $da[] = $data;
       return $da;
    }
    public function getprofiledetail(){
        $this->db->where('profile_id','1');
        $query = $this->db->get("profile");
        return $query->result_array();
    }
    public function getitemdetail($items_id){
$this->db->where("item_id", $items_id);
        $query = $this->db->get("items");
        return $query->result_array();

  }
  public function gettypedetail($type_id,$status=false){
        if($status){$this->db->where('status',1);}
        
        $this->db->where('type_id',$type_id);
        $query = $this->db->get("types");
           $data = $query->result_array();
      if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }
    }
    public function getsizedetail($size_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('size_id',$size_id);
        $query = $this->db->get("sizes");
         $data = $query->result_array();
      if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }

    }
    public function getmodeldetail($model_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('model_id',$model_id);
        $query = $this->db->get("models");
        $data = $query->result_array();
      if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }
    }
    public function getgradedetail($grade_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('grade_id',$grade_id);
        $query = $this->db->get("grades");
        $data = $query->result_array();
             if (sizeof($query->result_array()) > 0) {
            return $data[0];
        } else {
            return array();
        }
    }
    public function getbranddetail($brand_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('brand_id',$brand_id);
        $query = $this->db->get("brands");
            $data = $query->result_array();
             if (sizeof($query->result_array()) > 0) {
            return $data[0];
        } else {
            return array();
        }
            
    }
    public function getcolourdetail($colour_id,$status=false){
        if($status){$this->db->where('status',1);}
        
        $this->db->where('colour_id',$colour_id);
        $query = $this->db->get("colours");
         $data = $query->result_array();
        //  echo $this->db->last_query();
      if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }
    }
    public function getunitdetail($unit_id,$status=false){
        if($status){$this->db->where('status',1);}
        $this->db->where('unit_id',$unit_id);
        $query = $this->db->get("units");
         $data = $query->result_array();
      if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }
    }
    public function getitembrands($item_id){
        $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','brand');
        $query = $this->db->get("items_attributes");
      
            return $query->result_array();
    }
    public function getitemgrades($item_id){
       
 $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','grade');
         $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
     public function getitemmodels($item_id){
       
 $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','model');
         $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
    public function getitemsizes($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
       $this->db->where('item_type','size');
        $query = $this->db->get("items_attributes");
       
        return $query->result_array();
    }
    public function getitemcolours($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','colour');
        $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
    public function getitemtypes($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','type');
        $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
    public function getitemunits($item_id){
        $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','unit');
        $query = $this->db->get("items_attributes");
      
            return $query->result_array();
    }


}
  
  
?>