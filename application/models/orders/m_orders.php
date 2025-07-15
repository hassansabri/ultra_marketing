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
 public function getallshops(){
     $this->db->where('shop_status',1);
        $query = $this->db->get("shops");
        return $query->result_array();
    }
    public function getallbrands(){
        $this->db->where('status',1);
        $query = $this->db->get("brands");
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
$this->db->select("*");
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
    //    echo $this->db->last_query();
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
    public function getitemidsfromordernumber($order_number){
        $this->db->select('item_fk');
         $this->db->where('order_status','draft');
         $this->db->group_by('item_fk');
        $query = $this->db->get("orders");
        return $query->result_array();
    }
    public function getAllDraftOrders(){
        $this->db->where('order_status','draft');
         $this->db->group_by('order_number');
        $query = $this->db->get("orders");
      if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $data = array(
                    "order_id" => $value["order_id"],
                    "order_number" => $value["order_number"],
                    "item_fk" => $value["item_fk"],
                    "order_quantity" => $value["order_quantity"],
                    "order_price" => $value["order_price"],
                    "created_date" => $value["created_date"],
                    "order_detail" => $this->getorderdetail($value["order_number"],$value["item_fk"])
                );
                $dat[]=$data;
            }
            return $dat;
        } else {
            return array();
        }
    }
    public function getAllCompleteOrders(){
        $this->db->where('order_status','confirm');
         $this->db->group_by('order_number');
        $query = $this->db->get("orders");
      if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $data = array(
                    "order_id" => $value["order_id"],
                    "order_number" => $value["order_number"],
                    "item_fk" => $value["item_fk"],
                    "order_quantity" => $value["order_quantity"],
                    "order_price" => $value["order_price"],
                    "created_date" => $value["created_date"],
                    "order_detail" => $this->getorderdetail($value["order_number"],$value["item_fk"])
                );
                $dat[]=$data;
            }
            return $dat;
        } else {
            return array();
        }
    }
    public function getOrder($order_number){
        $this->db->where('order_number',$order_number);
        $query = $this->db->get("orders");
        $dat=array();
      if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $data = array(
                    "order_id" => $value["order_id"],
                    "order_number" => $value["order_number"],
                    "item_id" => $value["item_fk"],
                    "order_quantity" => $value["order_quantity"],
                    "order_status" => $value["order_status"],
                    "order_price" => $value["order_price"],
                    "created_date" => $value["created_date"],
                    "shop_id" => isset($value["shop_id"]) ? $value["shop_id"] : null,
                    "order_detail" => $this->getorderdetail($value["order_number"],$value["item_fk"]),
                    "item_detail" => $this->getitemdetail($value["item_fk"])
                );
             $dat[]=$data;
            }
//              echo '<pre>';
//             print_r($dat);
//           echo '</pre>';
// exit;
            return $dat;
        } else {
            return  $data = array(
                    "order_id" => '',
                    "order_number" => '',
                    "item_id" =>'',
                    "order_quantity" => '',
                    "order_statue" => '',
                    "order_price" => '',
                    "created_date" => '',
                    "shop_id" => '',
                    "order_detail" => '',
                    "item_detail" => ''
                );;
        }
    }
    public function getorderdetail($order_number,$item_fk){
        $this->db->where('order_number_fk',$order_number);
        $this->db->where('item_fk',$item_fk);
        $query = $this->db->get("order_detail");
       //  echo $this->db->last_query();
            return $query->result_array();
    }
    public function insertdraftorder($order_number,$item_id,$order_quantity,$order_price, $shop_id = null){
        $data=array(
            'order_number'=>$order_number,
            'item_fk'=>$item_id,
            'order_quantity'=>$order_quantity,
            'order_price'=>$order_price,
            'shop_id'=>$shop_id
        );
         $this->db->insert('orders',$data);
        
    }
public function insertdraftorderdetail($order_number,$attribute_fk,$quantity,$item_id,$type){
    if($quantity > 0){

        $data=array(
                    'order_number_fk'=>$order_number,
                    'attribute_fk'=>$attribute_fk,
                    'attribute_quantity'=>$quantity,
                    'item_fk'=>$item_id,
                    'attribute_type'=>$type,
                );
                 $this->db->insert('order_detail',$data);
    }
}

public function deleteOrderDetails($order_number, $item_id) {
    $this->db->where('order_number_fk', $order_number);
    $this->db->where('item_fk', $item_id);
    $this->db->delete('order_detail');
}
public function deleteorder2($order_number,$item_id){
      $this->db->where('order_number', $order_number);
      $this->db->where('item_fk',$item_id);
         $this->db->delete('orders');
}
public function deleteorder($order_number){
      $this->db->where('order_number', $order_number);
         $this->db->delete('orders');
}
public function get_itemids_from_ordernumber($order_number){
$this->db->select('item_fk');
    $this->db->where('order_number', $order_number);
    $query = $this->db->get("orders");
        $dat=array();
      if (sizeof($query->result_array()) > 0) {
        return true;
      }else{
        return false;
      }
}
public function ifitemalredyexist($order_number, $item_id){
    $this->db->select('order_id');
    $this->db->where('order_number', $order_number);
    $this->db->where('item_fk', $item_id);
        $query = $this->db->get("orders");
        $dat=array();
      if (sizeof($query->result_array()) > 0) {
        return true;
      }else{
        return false;
      }
}
public function updateOrderQuantityAndPrice($order_number, $item_id, $quantity,$price) {
    $exist = $this->ifitemalredyexist($order_number, $item_id);
    if(!$exist){
        // insrt order
        $this->insertdraftorder($order_number,$item_id);
    }
    $item_ids = array();
    // $this->insertdraftorder($order_number,$item_id);
    $now = date('Y-m-d H:i:s');
    $this->db->where('order_number', $order_number);
    $this->db->where('item_fk', $item_id);
    $this->db->update('orders', array('order_quantity' => $quantity,'order_price' => $price,'modified_date'=>$now));
    $afftectedRows = $this->db->affected_rows();
    if ($afftectedRows) {   
            $item_ids[]=$item_id;
         }
         
}

public function updateOrderDetail($order_number, $attribute_fk, $quantity, $item_id, $type) {
    $this->db->where('order_number_fk', $order_number);
    $this->db->where('attribute_fk', $attribute_fk);
    $this->db->where('item_fk', $item_id);
    $this->db->where('attribute_type', $type);
    $this->db->update('order_detail', array('attribute_quantity' => $quantity));
}
public function updateorder($order_number){
    $this->db->where('order_number', $order_number);
    $this->db->where('order_status', 'draft');
    $this->db->update('orders', array('order_status' => 'confirm'));
}

}
  
  
?>