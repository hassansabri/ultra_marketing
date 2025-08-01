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
                    "packing_id" => $value["packing_id"],
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
                    "item_detail" => '',
                    "packing_id" => ''
                );
        }
    }
    public function getorderdetail($order_number,$item_fk){
        $this->db->where('order_number_fk',$order_number);
        $this->db->where('item_fk',$item_fk);
        $query = $this->db->get("order_detail");
       //  echo $this->db->last_query();
            return $query->result_array();
    }
    public function insertdraftorder($order_number,$item_id,$order_quantity,$order_price, $shop_id,$packing_id){
        $data=array(
            'order_number'=>$order_number,
            'item_fk'=>$item_id,
            'order_quantity'=>$order_quantity,
            'order_price'=>$order_price,
            'shop_id'=>$shop_id,
            'packing_id'=>$packing_id,
            'created_by'=>$this->session->userdata('uid')
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
public function updateOrderQuantityAndPrice($shopid,$order_number, $item_id, $quantity,$price,$packing_id) {
    echo $item_id;
    $exist = $this->ifitemalredyexist($order_number, $item_id);
    if(!$exist){
        // insert order with default values
        $this->insertdraftorder($order_number, $item_id, $quantity, $price,$shopid,$packing_id);
    }
    $item_ids = array();
    // $this->insertdraftorder($order_number,$item_id);
    $now = date('Y-m-d H:i:s');
    $this->db->where('order_number', $order_number);
    $this->db->where('item_fk', $item_id);
    $this->db->update('orders', array('order_quantity' => $quantity,'order_price' => $price,'modified_date'=>$now,'packing_id' => $packing_id));
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
    $this->db->update('orders', array('order_status' => 'confirm','confirm_by'=>$this->session->userdata('uid')));
}

    // Insert a ledger entry for an order (now with type)
    public function insertOrderLedger($shop_id,$order_number, $date, $amount, $payment_method = null, $remarks = null, $type = 'credit') {
        $data = array(
            'order_number' => $order_number,
            'date' => $date,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'remarks' => $remarks,
            'type' => $type,
            'shop_id' => $shop_id
        );
        $this->db->insert('order_ledger', $data);
        return $this->db->insert_id();
    }

    // Fetch all ledger entries for an order
    public function getOrderLedger($order_number) {
        $this->db->where('order_number', $order_number);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('order_ledger');
        return $query->result_array();
    }

    // Update a ledger entry (now with type)
    public function updateOrderLedger($ledger_id, $data) {
        $this->db->where('ledger_id', $ledger_id);
        return $this->db->update('order_ledger', $data);
    }

    // Delete a ledger entry
    public function deleteOrderLedger($ledger_id) {
        $this->db->where('ledger_id', $ledger_id);
        return $this->db->delete('order_ledger');
    }

    // Get all ledger entries (include type)
    public function getAllOrderLedger() {
        $this->db->select('order_ledger.*, orders.shop_id, shops.shop_name');
        $this->db->from('order_ledger');
        $this->db->join('orders', 'orders.order_number = order_ledger.order_number', 'left');
        $this->db->join('shops', 'shops.shop_id = orders.shop_id', 'left');
        $this->db->order_by('order_ledger.date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get a single ledger entry by ID
    public function getOrderLedgerById($ledger_id) {
        $this->db->select('order_ledger.*, orders.shop_id, shops.shop_name');
        $this->db->from('order_ledger');
        $this->db->join('orders', 'orders.order_number = order_ledger.order_number', 'left');
        $this->db->join('shops', 'shops.shop_id = orders.shop_id', 'left');
        $this->db->where('order_ledger.ledger_id', $ledger_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Get all ledger entries for a shop
    public function getShopLedger($shop_id) {
        $this->db->select('order_ledger.*, orders.shop_id');
        $this->db->from('order_ledger');
        $this->db->join('orders', 'orders.order_number = order_ledger.order_number');
        $this->db->where('orders.shop_id', $shop_id);
        $this->db->order_by('order_ledger.date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Check stock availability for an item with attributes
    public function checkStockAvailability($item_id, $order_quantity, $attributes = array()) {
        $this->load->model('stocks/m_stocks', 'model_stock');
        
        // Prepare stock check data
        $stock_data = array(
            'item_fk' => $item_id,
            'brand_fk' => isset($attributes['brand_fk']) ? $attributes['brand_fk'] : 0,
            'grade_fk' => isset($attributes['grade_fk']) ? $attributes['grade_fk'] : 0,
            'model_fk' => isset($attributes['model_fk']) ? $attributes['model_fk'] : 0,
            'size_fk' => isset($attributes['size_fk']) ? $attributes['size_fk'] : 0,
            'type_fk' => isset($attributes['type_fk']) ? $attributes['type_fk'] : 0,
            'colour_fk' => isset($attributes['colour_fk']) ? $attributes['colour_fk'] : 0,
            'unit_fk' => isset($attributes['unit_fk']) ? $attributes['unit_fk'] : 0
        );
        
        $stock_result = $this->model_stock->checkstock($stock_data);
        
        if (!empty($stock_result) && isset($stock_result[0]['balance'])) {
            $available_stock = $stock_result[0]['balance'];
            return array(
                'available' => $available_stock,
                'requested' => $order_quantity,
                'sufficient' => ($available_stock >= $order_quantity),
                'shortage' => max(0, $order_quantity - $available_stock)
            );
        }
        
        // If no stock record found, return 0 available
        return array(
            'available' => 0,
            'requested' => $order_quantity,
            'sufficient' => false,
            'shortage' => $order_quantity
        );
    }

    /**
     * Deduct stock for an order
     * @param string $order_number Order number
     * @return bool Success status
     */
    public function deductStockForOrder($order_number) {
        $this->load->model('stocks/m_stocks', 'model_stock');
        
        // Get order details
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        $success = true;
        
        foreach ($order_info as $order_item) {
            $item_id = $order_item['item_id'];
            $quantity = $order_item['order_quantity'];
            
            // Get order details for attributes
            $order_details = $this->getorderdetail($order_number, $item_id);
            
            if (empty($order_details)) {
                // No attributes, deduct from general stock
                $stock_data = array(
                    'item_fk' => $item_id,
                    'brand_fk' => 0,
                    'grade_fk' => 0,
                    'model_fk' => 0,
                    'size_fk' => 0,
                    'type_fk' => 0,
                    'colour_fk' => 0,
                    'unit_fk' => 0
                );
                
                if (!$this->model_stock->deductStock($stock_data, $quantity)) {
                    $success = false;
                }
            } else {
                // Deduct stock for each attribute combination
                foreach ($order_details as $detail) {
                    $attribute_quantity = $detail['attribute_quantity'];
                    if ($attribute_quantity > 0) {
                        $stock_data = array(
                            'item_fk' => $item_id,
                            'brand_fk' => 0,
                            'grade_fk' => ($detail['attribute_type'] == 'grade') ? $detail['attribute_fk'] : 0,
                            'model_fk' => ($detail['attribute_type'] == 'model') ? $detail['attribute_fk'] : 0,
                            'size_fk' => ($detail['attribute_type'] == 'size') ? $detail['attribute_fk'] : 0,
                            'type_fk' => ($detail['attribute_type'] == 'type') ? $detail['attribute_fk'] : 0,
                            'colour_fk' => ($detail['attribute_type'] == 'colour') ? $detail['attribute_fk'] : 0,
                            'unit_fk' => ($detail['attribute_type'] == 'unit') ? $detail['attribute_fk'] : 0
                        );
                        
                        if (!$this->model_stock->deductStock($stock_data, $attribute_quantity)) {
                            $success = false;
                        }
                    }
                }
            }
        }
        
        return $success;
    }
    
    /**
     * Restore stock for an order (for cancellation or modification)
     * @param string $order_number Order number
     * @return bool Success status
     */
    public function restoreStockForOrder($order_number) {
        $this->load->model('stocks/m_stocks', 'model_stock');
        
        // Get order details
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        $success = true;
        
        foreach ($order_info as $order_item) {
            $item_id = $order_item['item_fk'];
            $quantity = $order_item['order_quantity'];
            
            // Get order details for attributes
            $order_details = $this->getorderdetail($order_number, $item_id);
            
            if (empty($order_details)) {
                // No attributes, restore to general stock
                $stock_data = array(
                    'item_fk' => $item_id,
                    'brand_fk' => 0,
                    'grade_fk' => 0,
                    'model_fk' => 0,
                    'size_fk' => 0,
                    'type_fk' => 0,
                    'colour_fk' => 0,
                    'unit_fk' => 0
                );
                
                if (!$this->model_stock->restoreStock($stock_data, $quantity)) {
                    $success = false;
                }
            } else {
                // Restore stock for each attribute combination
                foreach ($order_details as $detail) {
                    $attribute_quantity = $detail['attribute_quantity'];
                    if ($attribute_quantity > 0) {
                        $stock_data = array(
                            'item_fk' => $item_id,
                            'brand_fk' => 0,
                            'grade_fk' => ($detail['attribute_type'] == 'grade') ? $detail['attribute_fk'] : 0,
                            'model_fk' => ($detail['attribute_type'] == 'model') ? $detail['attribute_fk'] : 0,
                            'size_fk' => ($detail['attribute_type'] == 'size') ? $detail['attribute_fk'] : 0,
                            'type_fk' => ($detail['attribute_type'] == 'type') ? $detail['attribute_fk'] : 0,
                            'colour_fk' => ($detail['attribute_type'] == 'colour') ? $detail['attribute_fk'] : 0,
                            'unit_fk' => ($detail['attribute_type'] == 'unit') ? $detail['attribute_fk'] : 0
                        );
                        
                        if (!$this->model_stock->restoreStock($stock_data, $attribute_quantity)) {
                            $success = false;
                        }
                    }
                }
            }
        }
        
        return $success;
    }
    
    /**
     * Update order shop_id
     * @param string $order_number Order number
     * @param int $shop_id Shop ID
     * @return bool Success status
     */
    public function updateOrderShop($order_number, $shop_id) {
        $this->db->where('order_number', $order_number);
        return $this->db->update('orders', array('shop_id' => $shop_id));
    }
    
    /**
     * Get all active payment options from the payment_options table
     * @return array
     */
    public function getAllPaymentOptions() {
        $this->db->where('status', 1);
        $query = $this->db->get('payment_options');
        return $query->result_array();
    }
    public function getallpackingoptions(){
        $this->db->where('status', 1);
        $query = $this->db->get('packing_options');
        return $query->result_array();
    }
    public function getItemPackingInfo($order_number){
        $this->db->select('packing_id');
       $query = $this->db->get("orders");
        $dat=array();
      if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $data = array(
                     "title" => $this->getpackingtitle($value["packing_id"])
                );
             $dat[]=$data;
            }
//              echo '<pre>';
//             print_r($dat);
//           echo '</pre>';
// exit;
            return $dat;
        } else {
            return  '';
                    
        }
    }
    public function getpackingtitle(){

    }
}
  
  
?>