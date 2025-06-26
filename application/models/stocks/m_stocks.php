<?php
class m_stocks extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getlogs($data){
        $this->db->select('*');
        $this->db->where('brand_fk',$data['brand_fk']);
        $this->db->where('grade_fk',$data['grade_fk']);
        $this->db->where('model_fk',$data['model_fk']);
        $this->db->where('size_fk',$data['size_fk']);
        $this->db->where('type_fk',$data['type_fk']);
        $this->db->where('colour_fk',$data['colour_fk']);
        $this->db->where('item_fk',$data['item_fk']);
        $this->db->where('unit_fk',$data['unit_fk']);
        $query = $this->db->get("stocks_logs");
        return $query->result_array();
        
    }
    public function checkstock($data ){
        $this->db->select_sum('balance');
        $this->db->where('brand_fk',$data['brand_fk']);
        $this->db->where('grade_fk',$data['grade_fk']);
        $this->db->where('model_fk',$data['model_fk']);
        $this->db->where('size_fk',$data['size_fk']);
        $this->db->where('type_fk',$data['type_fk']);
        $this->db->where('colour_fk',$data['colour_fk']);
        $this->db->where('item_fk',$data['item_fk']);
        $this->db->where('unit_fk',$data['unit_fk']);
        $query = $this->db->get("stocks");
        return $query->result_array();
    }

    public function addstock($data){
        $this->db->insert('stocks',$data);
        $this->db->insert('stocks_logs',$data);
    }
       public function getunits($status=false){
        if($status){
            $this->db->where('status',$status);
        }
        $query = $this->db->get("units");
            return $query->result_array();
    }
    
    public function getitemunits($item_id){
        $this->db->where('status',1);
        $this->db->where('item_fk',$item_id);
         $this->db->where('item_type','unit');
        $query = $this->db->get("items_attributes");
      
            return $query->result_array();
    }
    public function getallitems(){
        $this->db->where('item_status',1);
        $query = $this->db->get("items");
        return $query->result_array();
    }
    public function getallattributes(){

    }
    public function getbrands($status=false){
        if($status){
            $this->db->where('status',1);
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
}
?>