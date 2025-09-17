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
public function getPackingOptionDetail($packing_id){

}
    public function getallshops(){
     $this->db->where('shop_status',1);
     $this->db->where('shop_type','supplier');
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
    public function getpackingdetail($packing_id){
$this->db->select("*");
$this->db->where("packing_id", $packing_id);
        $query = $this->db->get("packing_options");
        $data =  $query->result_array();
        if (sizeof($query->result_array()) > 0) {
          return $data[0];
    } else {
            
        return array();
        }
    

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

    /**
     * Get all cancelled orders (working version)
     * @return array Array of cancelled orders
     */
    public function getAllCancelledOrders(){
        // Get orders that were modified after creation (effectively cancelled)
        // This includes orders that were changed from 'confirm' to 'draft' status
        $this->db->select('o.*, od.attribute_type, od.attribute_fk, od.attribute_quantity');
        $this->db->from('orders o');
        $this->db->join('order_detail od', 'o.order_number = od.order_number_fk', 'left');
        $this->db->where('o.modified_date >', 'o.created_date');
        $this->db->where('o.order_status', 'cancelled');
        $this->db->group_by('o.order_number');
        $this->db->order_by('o.modified_date', 'DESC');
        $query = $this->db->get();
        
        if (sizeof($query->result_array()) > 0) {
            $dat = array();
            foreach ($query->result_array() as $value) {
                $data = array(
                    "order_id" => $value["order_id"],
                    "order_number" => $value["order_number"],
                    "item_fk" => $value["item_fk"],
                    "order_quantity" => $value["order_quantity"],
                    "order_price" => $value["order_price"],
                    "created_date" => $value["created_date"],
                    "modified_date" => $value["modified_date"],
                    "cancelled_date" => $value["modified_date"], // Use modified_date as cancelled date
                    "original_status" => $value["order_status"], // Assume it was confirmed before cancellation
                    "stock_restored" => 1, // Assume stock was restored
                    "order_detail" => $this->getorderdetail($value["order_number"],$value["item_fk"])
                );
                $dat[]=$data;
            }
            return $dat;
        } else {
            return array();
        }
    }

    /**
     * Get cancellation statistics and counts (working version)
     * @return array Array with cancellation statistics
     */
    public function getCancellationStats() {
        // Count orders that were modified after creation (effectively cancelled)
        // These are orders that were changed from 'confirm' to 'draft' status
        
        // Total cancelled orders
        $this->db->select('COUNT(DISTINCT order_number) as total');
        $this->db->from('orders');
        $this->db->where('modified_date >', 'created_date');
        $this->db->where('order_status', 'cancelled');
        $query = $this->db->get();
        $total_cancelled = $query->row()->total;
        
        // Cancelled orders this month
        $this->db->select('COUNT(DISTINCT order_number) as total');
        $this->db->from('orders');
        $this->db->where('CAST(modified_date AS DATE) >', 'CAST(created_date AS DATE)');
        $this->db->where('order_status', 'cancelled');
        $this->db->where('MONTH(modified_date)', date('m'));
        $this->db->where('YEAR(modified_date)', date('Y'));
        $query = $this->db->get();
        $cancelled_this_month = $query->row()->total;
        
        // Cancelled orders this year
        $this->db->select('COUNT(DISTINCT order_number) as total');
        $this->db->from('orders');
        $this->db->where('modified_date >', 'created_date');
        $this->db->where('order_status', 'cancelled');
        $this->db->where('YEAR(modified_date)', date('Y'));
        $query = $this->db->get();
        $cancelled_this_year = $query->row()->total;
        
        // Orders cancelled today
        $this->db->select('COUNT(DISTINCT order_number) as total');
        $this->db->from('orders');
        $this->db->where('order_status', 'cancelled');
        $this->db->where('DATE(modified_date)', date('Y-m-d'));
        $query = $this->db->get();
        $cancelled_today = $query->row()->total;
        
        // Recent cancellations (last 7 days)
        $this->db->select('COUNT(DISTINCT order_number) as total');
        $this->db->from('orders');
        $this->db->where('modified_date >', 'created_date');
        $this->db->where('order_status', 'cancelled');
        $this->db->where('modified_date >=', date('Y-m-d H:i:s', strtotime('-7 days')));
        $query = $this->db->get();
        $recent_cancellations = $query->row()->total;
        
        return array(
            'total_cancelled' => $total_cancelled,
            'cancelled_this_month' => $cancelled_this_month,
            'cancelled_this_year' => $cancelled_this_year,
            'cancelled_today' => $cancelled_today,
            'recent_cancellations' => $recent_cancellations,
            
        );
    }

    /**
     * Get cancellation reasons summary (basic version)
     * @return array Array with cancellation reasons and counts
     */
    public function getCancellationReasonsSummary() {
        // For now, return empty array until the cancelled_orders table is created
        return array();
    }

    /**
     * Update stock restoration status for cancelled order (basic version)
     * @param string $order_number Order number
     * @return bool Success status
     */
    public function updateStockRestorationStatus($order_number) {
        // For now, return true until the cancelled_orders table is created
        return true;
    }
    public function getOrder($order_number,$item_id=null){
        $this->db->where('order_number',$order_number);
        if($item_id){
            $this->db->where('item_fk',$item_id);

        }
        $query = $this->db->get("orders");
        //echo $this->db->last_query();
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
                    "packing_quantity" => $value["packing_quantity"],
                    "packing_limit" => $value["packing_limit"],
                    "packing_price" => $value["packing_price"],
                    "shop_id" => isset($value["shop_id"]) ? $value["shop_id"] : null,
                    "order_detail" => $this->getorderdetail($value["order_number"],$value["item_fk"]),
                    "item_detail" => $this->getitemdetail($value["item_fk"]),
                    "packing_title" => getpackingtitle($value["packing_id"])
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
    public function insertdraftorder($order_number,$item_id,$order_quantity,$order_price, $shop_id,$packing_id,$packing_quantity,$bigpolythenelimit){
        $packing_price=0;
        if($packing_id == '4'){
            $packing_detail = $this->model_order->getpackingdetail(2);
            $data=$packing_detail['packing_cost'];
             $packing_detail = $this->model_order->getpackingdetail(3);
            $data1 = $packing_detail['packing_cost'];
            $packing_price=$data+$data1;
        }else{
            if($packing_id>0){

                $packing_detail = $this->model_order->getpackingdetail($packing_id);
                $data = $packing_detail['packing_cost'];
                $packing_price=$data;                                                                                                                       
            }
        }
        $data=array(
            'order_number'=>$order_number,
            'item_fk'=>$item_id,
            'order_quantity'=>$order_quantity,
            'order_price'=>$order_price,
            'shop_id'=>$shop_id,
            'packing_id'=>$packing_id,
            'packing_quantity'=>$packing_quantity,
            'packing_limit'=>$bigpolythenelimit,
            'packing_price'=>$packing_price,
            'created_by'=>$this->session->userdata('uid')
        );
         $this->db->insert('orders',$data);
        
    }
    public function insertPackingCostLogs($packing_id,$packing_price,$order_number,$original_cost){
        if($packing_id == '4'){
$packing_detail = $this->model_order->getpackingdetail(2);
            $data=array(
                'packing_fk'=>2,
                'packing_price'=>$packing_detail['packing_cost'],
                'packing_original_price'=>$packing_detail['original_cost'],
                'order_number'=>$order_number,
            );
             $this->db->insert('packingstock_cost_logs',$data);
             $packing_detail = $this->model_order->getpackingdetail(3);
            $data=array(
                'packing_fk'=>3,
                'packing_price'=>$packing_detail['packing_cost'],
                'packing_original_price'=>$packing_detail['original_cost'],
                'order_number'=>$order_number,
            );
             $this->db->insert('packingstock_cost_logs',$data);
        }else{

            $data=array(
                'packing_fk'=>$packing_id,
                'packing_price'=>$packing_price,
                'order_number'=>$order_number,
                'packing_original_price'=>$original_cost,
            );
             $this->db->insert('packingstock_cost_logs',$data);
        }
        
    }
    public function insertCostLogs($item_id,$item_price,$order_number,$original_cost){
        $data=array(
            'item_fk'=>$item_id,
            'item_price'=>$item_price,
            'order_number'=>$order_number,
            'item_original_price'=>$original_cost,
        );
         $this->db->insert('stock_cost_logs',$data);
        
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
public function showlastprice($shop_id,$item_id,$order_number){
    $this->db->select('order_price');
    $this->db->where('order_number !=', $order_number);
    $this->db->where('item_fk', $item_id);
    $this->db->where('shop_id', $shop_id);
    $this->db->where('order_status', 'confirm');
    // $this->db->order_by('order_id', 'asc');
    $this->db->limit(1);
        $query = $this->db->get("orders");
        $dat=$query->result_array();
      if (sizeof($query->result_array()) > 0) {
        return $dat[0]['order_price'];
      }else{
        return 0;
      }
}
public function updateOrderQuantityAndPrice($shopid,$order_number, $item_id, $quantity,$price,$packing_id,$packing_quantity,$packing_limit) {
    // echo $packing_quantity;
    $exist = $this->ifitemalredyexist($order_number, $item_id);
    if(!$exist){
        // insert order with default values
        $this->insertdraftorder($order_number, $item_id, $quantity, $price,$shopid,$packing_id,$packing_quantity,$packing_limit);
    }
    $item_ids = array();
    // $this->insertdraftorder($order_number,$item_id);
    $now = date('Y-m-d H:i:s');
    $this->db->where('order_number', $order_number);
    $this->db->where('item_fk', $item_id);
    $this->db->update('orders', array('order_quantity' => $quantity,'order_price' => $price,'modified_date'=>$now,'packing_id' => $packing_id,'packing_quantity' => $packing_quantity,'packing_limit' => $packing_limit));
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
    public function insertOrderLedger($packing_price,$shop_id,$order_number, $date, $amount, $payment_method = null, $remarks = null, $type = 'credit') {
        if($packing_price){
            $packing_price = $packing_price;
        }else{
            $packing_price = 0;
        }
        $data = array(
            'order_number' => $order_number,
            'date' => $date,
            'amount' => $amount+$packing_price,
            'payment_method' => $payment_method,
            'remarks' => $remarks,
            'type' => $type,
            'shop_id' => $shop_id
        );
        $this->db->insert('order_ledger', $data);
        return $this->db->insert_id();
    }
    public function insertOrderLedgerDetail($ledger_fk,$shop_id,$order_number, $date,$amount,$check_number,$bank_name) {
        $data = array(
            'ledger_fk' => $ledger_fk,
            'order_number' => $order_number,
            'check_date' => $date,
            'shop_id' => $shop_id,
            'amount' => $amount,
            'check_number' => $check_number,
            'bank_name' => $bank_name
        );
        $this->db->insert('order_ledger_detail', $data);
        return $this->db->insert_id();
    }
    public function deleteOrderLedgerDetail($ledger_fk) {
        $this->db->where('ledger_fk', $ledger_fk);
        $this->db->delete('order_ledger_detail');
        return $this->db->insert_id();
    }

    // Fetch all ledger entries for an order
    public function getOrderLedger($order_number) {
        $this->db->where('order_number', $order_number);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('order_ledger');
        return $query->result_array();
    }
    public function getOrderLedgerByItem($order_number,$item_id=null) {
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
    public function updateOrderLedgerNew($order_number) {
        $this->db->where('order_number', $order_number);
        return $this->db->update('order_ledger', array('status' => 2));
    }
    public function updateCostLogForItem($order_number) {
        $this->db->where('order_number', $order_number);
        return $this->db->update('stock_cost_logs', array('status' => 2));
    }
    public function updateCostLogForPacking($order_number) {
        $this->db->where('order_number', $order_number);
        return $this->db->update('packingstock_cost_logs', array('status' => 2));
    }

    // Get all ledger entries (include type)
    public function getAllOrderLedger() {
        $this->db->select('order_ledger.*, orders.shop_id, shops.shop_name');
        $this->db->from('order_ledger');
        $this->db->join('orders', 'orders.order_number = order_ledger.order_number', 'left');
        $this->db->join('shops', 'shops.shop_id = orders.shop_id', 'left');
        $this->db->where('order_ledger.status != ', 2);
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
        $this->db->where('order_ledger.status', 1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getOrderLedgerDetailById($ledger_id) {
        $this->db->select('order_ledger_detail.*, orders.shop_id, shops.shop_name');
        $this->db->from('order_ledger_detail');
        $this->db->join('orders', 'orders.order_number = order_ledger_detail.order_number', 'left');
        $this->db->join('shops', 'shops.shop_id = orders.shop_id', 'left');
        $this->db->where('order_ledger_detail.ledger_fk', $ledger_id);
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
    public function checkPackingStockAvailability($packing_id, $order_quantity, $attributes = array()) {
        $this->load->model('stocks/m_packing_stocks', 'model_packingstock');
        
        // Prepare stock check data
        $stock_data = array(
            'packing_fk' => $packing_id,
            // 'brand_fk' => isset($attributes['brand_fk']) ? $attributes['brand_fk'] : 0,
            // 'grade_fk' => isset($attributes['grade_fk']) ? $attributes['grade_fk'] : 0,
            // 'model_fk' => isset($attributes['model_fk']) ? $attributes['model_fk'] : 0,
            // 'size_fk' => isset($attributes['size_fk']) ? $attributes['size_fk'] : 0,
            // 'type_fk' => isset($attributes['type_fk']) ? $attributes['type_fk'] : 0,
            // 'colour_fk' => isset($attributes['colour_fk']) ? $attributes['colour_fk'] : 0,
            // 'unit_fk' => isset($attributes['unit_fk']) ? $attributes['unit_fk'] : 0
        );
        
        $stock_result = $this->model_packingstock->checkstock($stock_data);
       // print_r($stock_result);
        if (!empty($stock_result)) {
            if(($packing_id == '4')){
                foreach($stock_result as $sr){
        if(isset($sr[0]['balance'])){
            $available_stock[]=$sr[0]['balance'];

        }else{
            
            $available_stock = 0;
        }           
    }
}else{
                $available_stock = 0;
            }
   // print_r($available_stock);
            return array(
                'available' => $available_stock,
                'requested' => $order_quantity,
                'sufficient' => true //($available_stock >= $order_quantity),
                //'shortage' => max(0, $order_quantity - $available_stock)
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
    public function deductStockForOrder($order_number,$item_id) {
        $this->load->model('stocks/m_stocks', 'model_stock');
        
        // Get order details
        $order_info = $this->getOrder($order_number,$item_id);
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
                    'shop_fk' => $order_item['shop_id'],
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
                            'shop_fk' => $order_item['shop_id'],
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
    public function deductStockForPacking($order_number,$packing_id,$packing_quantity,$packing_limit) {
        $this->load->model('stocks/m_packing_stocks', 'model_packingstock');
        
        // Get order details
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        $success = true;
//         print_r($order_info);
// exit;
        foreach ($order_info as $order_item) {
            $quantity = $order_item['order_quantity'];
            
         // No attributes, deduct from general stock
                $stock_data = array(
                    'packing_fk' => $packing_id,
                    'brand_fk' => 0,
                    'grade_fk' => 0,
                    'model_fk' => 0,
                    'size_fk' => 0,
                    'type_fk' => 0,
                    'colour_fk' => 0,
                    'shop_fk' => 0,
                    'unit_fk' => 0
                );
                if (!$this->model_packingstock->deductStock($stock_data, $quantity,$packing_quantity,$packing_limit)) {
                    $success = false;
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
        $this->load->model('stocks/m_packing_stocks', 'model_packingstock');
        // Get order details
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        // Debug: Log the restoration attempt
        log_message('debug', 'Attempting to restore stock for order: ' . $order_number . ' with ' . count($order_info) . ' items');
        
        $success = true;
        
        foreach ($order_info as $order_item) {
            $item_id = $order_item['item_id'];
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
    public function restorePackingStockForOrder($order_number) {
        $this->load->model('stocks/m_packing_stocks', 'model_packingstock');
        
        // Get order details
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        // Debug: Log the restoration attempt
        log_message('debug', 'Attempting to restore stock for order: ' . $order_number . ' with ' . count($order_info) . ' items');
        
        $success = true;
        
        foreach ($order_info as $order_item) {
            $packing_id = $order_item['packing_id'];
            $quantity = $order_item['packing_quantity'];
            $packing_limit = $order_item['packing_limit'];
            
            // Get order details for attributes
            $order_details = $this->getorderdetail($order_number, $packing_id);
            
            if (empty($order_details)) {
                // No attributes, restore to general stock
                $stock_data = array(
                    'packing_fk' => $packing_id,
                    // 'brand_fk' => 0,
                    // 'grade_fk' => 0,
                    // 'model_fk' => 0,
                    // 'size_fk' => 0,
                    // 'type_fk' => 0,
                    // 'colour_fk' => 0,
                    // 'unit_fk' => 0
                );
                
                if (!$this->model_packingstock->restorePackingStock($stock_data, $quantity,$packing_limit)) {
                    $success = false;
                }
            } else {
                // Restore stock for each attribute combination
                foreach ($order_details as $detail) {
                    $attribute_quantity = $detail['order_quantity'];
                    if ($attribute_quantity > 0) {
                        $stock_data = array(
                            'packing_fk' => $packing_id,
                        //     'brand_fk' => 0,
                        //     'grade_fk' => ($detail['attribute_type'] == 'grade') ? $detail['attribute_fk'] : 0,
                        //     'model_fk' => ($detail['attribute_type'] == 'model') ? $detail['attribute_fk'] : 0,
                        //     'size_fk' => ($detail['attribute_type'] == 'size') ? $detail['attribute_fk'] : 0,
                        //     'type_fk' => ($detail['attribute_type'] == 'type') ? $detail['attribute_fk'] : 0,
                        //     'colour_fk' => ($detail['attribute_type'] == 'colour') ? $detail['attribute_fk'] : 0,
                        //     'unit_fk' => ($detail['attribute_type'] == 'unit') ? $detail['attribute_fk'] : 0
                         );
                        
                        if (!$this->model_packingstock->restorePackingStock($stock_data, $attribute_quantity)) {
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
        $this->db->order_by('packing_title', 'ASC');
        $query = $this->db->get('packing_options');
        return $query->result_array();
    }
    public function getallpackingoptions2(){
        $this->db->where('status', 1);
        $this->db->where('packing_id !=', 4);
        $this->db->order_by('packing_title', 'ASC');
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
                     "packing_title" => getpackingtitle($value["packing_id"])
                );
             $dat=$data;
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

    /**
     * Cancel an order by updating its status to cancelled (basic version)
     * @param string $order_number Order number to cancel
     * @param string $cancellation_reason Optional reason for cancellation
     * @return bool Success status
     */
    public function cancelOrder($order_number, $cancellation_reason = null) {
        // Get order info before cancellation
        $order_info = $this->getOrder($order_number);
        if (empty($order_info)) {
            return false;
        }
        
        // For now, just change status to draft (effectively cancelling it)
        // This will be updated to 'cancelled' once the database is updated
        $this->db->where('order_number', $order_number);
     //   $this->db->where_in('order_status','cancel');
        
        $update_data = array(
            'order_status' => 'cancelled', // Will be 'cancelled' after DB update
            'modified_date' => date('Y-m-d H:i:s')
        );
        
        $result = $this->db->update('orders', $update_data);
        
        // Note: Advanced tracking will be added once cancelled_orders table exists
        
        return $result;
    }
}
  
  
?>