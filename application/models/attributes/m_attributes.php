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
class m_attributes extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getbrands($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("brands");
            return $query->result_array();
    }
    
    public function getitembrands($item_id){
        $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','brand');
        $query = $this->db->get("items_attributes");
      
            return $query->result_array();
    }

     public function getgrades($status=false){
       if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("grades");
            return $query->result_array();
    }
 public function getitemgrades($item_id){
       
 $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','grade');
         $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
     public function getmodels($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("models");
            return $query->result_array();
    }
      public function getitemmodels($item_id){
       
 $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','model');
         $query = $this->db->get("items_attributes");
            return $query->result_array();
    }
     public function getsizes($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("sizes");
       
        return $query->result_array();
    }
    public function getitemsizes($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
       $this->db->where('item_type','size');
        $query = $this->db->get("items_attributes");
       
        return $query->result_array();
    }
    public function getcolours($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("colours");
            return $query->result_array();
    }

     public function getitemcolours($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','colour');
        $query = $this->db->get("items_attributes");
            return $query->result_array();
    } 
     public function gettypes($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("types");
            return $query->result_array();
    }

     public function getitemtypes($item_id){
         $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
        $this->db->where('item_type','type');
        $query = $this->db->get("items_attributes");
            return $query->result_array();
    } 
       public function submitattributes($array_name,$item_id,$item_type){
        $data=array();
    print_r($array_name);
   // exit;
        if($array_name){
            $i=0;
            $data=array();
            foreach($array_name as $value){
if($value){
            //   print_r($value2);
                        $data2=array(
                    'status'=>2,
                );
                        
                $this->db->where('attribute_fk',$value);
                $this->db->where('item_fk',$item_id);
                 $this->db->where('item_type',$item_type);
                 $this->db->where('status',1);
                $this->db->update('items_attributes',$data2);
    $data=array(
                    'attribute_fk'=>$value,
                    'item_fk' =>$item_id,
                    'item_type'=>$item_type
                );
$this->db->insert('items_attributes',$data);    
                    

                 
                 
                               

}

             

            }
        }
           
    }
}
  
  
?>