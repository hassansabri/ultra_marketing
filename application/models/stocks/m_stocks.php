<?php
class m_stocks extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getCrediters(){
        $this->db->select('*');
        $this->db->where('shop_type','crediter');
        $this->db->where('shop_status','1');
        $query = $this->db->get("shops");
        return $query->result_array();
        
    }
    public function getlogs($data){
        $this->db->select('*');
        $this->db->where('item_fk', $data['item_fk']);
        
        // Only add WHERE conditions for non-zero values to avoid issues
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
        $query = $this->db->get("stocks_logs");
        return $query->result_array();
    }
    public function getcurrentballance($data){
        $this->db->select_sum('balance');
        $this->db->where('item_fk', $data['item_fk']);
        
        // Only add WHERE conditions for non-zero values to avoid issues
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
        $query = $this->db->get("stocks");
        return $query->result_array();
    }
    public function checkstock($data ){
        $this->db->select_sum('balance');
        $this->db->where('item_fk', $data['item_fk']);
        
        // Only add WHERE conditions for non-zero values to avoid issues
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
        $query = $this->db->get("stocks");
        return $query->result_array();
    }
    public function checkpackingstock($data ){
        $this->db->select_sum('balance');
        $this->db->where('packing_fk', $data['packing_fk']);
        
        // Only add WHERE conditions for non-zero values to avoid issues
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
        $query = $this->db->get("packingstocks");
        return $query->result_array();
    }

    public function addstock($data){
        $this->restoreStock($data,$data['balance']);
    //    $this->db->insert('stocks_logs',$data);
    }
    
    /**
     * Deduct stock for an order
     * @param array $data Stock data with quantities to deduct
     * @param int $quantity Quantity to deduct
     * @return bool Success status
     */
    public function deductStock($data, $quantity) {
        // First check if we have enough stock
        
        $current_stock = $this->checkstock($data);
        if (empty($current_stock) || !isset($current_stock[0]['balance'])) {
            return false; // No stock record found
        }
        
        $available_stock = $current_stock[0]['balance'];
        if ($available_stock < $quantity) {
            return false; // Insufficient stock
        }
        
        // Calculate new balance
        $new_balance = $available_stock - $quantity;
        
        // Update stock with proper WHERE clause
        $this->db->where('item_fk', $data['item_fk']);
        
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
         $this->db->update('stocks', array('balance' => $new_balance));
        // // Log the deduction
        $log_data = $data;
        $log_data['balance'] = $quantity; 
        $log_data['stock_type'] = 'stock_deduction';
        $log_data['entry_date'] = date('Y-m-d');
        $this->db->insert('stocks_logs', $log_data);
        
        return true;
    }
    public function deductpackingStock($data, $quantity) {
        // First check if we have enough stock
        
        $current_stock = $this->checkpackingstock($data);
        if (empty($current_stock) || !isset($current_stock[0]['balance'])) {
            return false; // No stock record found
        }
        
        $available_stock = $current_stock[0]['balance'];
        if ($available_stock < $quantity) {
            return false; // Insufficient stock
        }
        
        // Calculate new balance
        $new_balance = $available_stock - $quantity;
        
        // Update stock with proper WHERE clause
        $this->db->where('item_fk', $data['item_fk']);
        
        if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
            $this->db->where('brand_fk', $data['brand_fk']);
        } else {
            $this->db->where('brand_fk', 0);
        }
        
        if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
            $this->db->where('grade_fk', $data['grade_fk']);
        } else {
            $this->db->where('grade_fk', 0);
        }
        
        if (isset($data['model_fk']) && $data['model_fk'] > 0) {
            $this->db->where('model_fk', $data['model_fk']);
        } else {
            $this->db->where('model_fk', 0);
        }
        
        if (isset($data['size_fk']) && $data['size_fk'] > 0) {
            $this->db->where('size_fk', $data['size_fk']);
        } else {
            $this->db->where('size_fk', 0);
        }
        
        if (isset($data['type_fk']) && $data['type_fk'] > 0) {
            $this->db->where('type_fk', $data['type_fk']);
        } else {
            $this->db->where('type_fk', 0);
        }
        
        if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
            $this->db->where('colour_fk', $data['colour_fk']);
        } else {
            $this->db->where('colour_fk', 0);
        }
        
        if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
            $this->db->where('unit_fk', $data['unit_fk']);
        } else {
            $this->db->where('unit_fk', 0);
        }
        
         $this->db->update('packingstocks', array('balance' => $new_balance));
        // // Log the deduction
        $log_data = $data;
        $log_data['balance'] = $quantity; 
        $log_data['stock_type'] = 'stock_deduction';
        $log_data['entry_date'] = date('Y-m-d');
        $this->db->insert('packingstocks_logs', $log_data);
        
        return true;
    }
    
    /**
     * Restore stock (for order cancellation or modification)
     * @param array $data Stock data
     * @param int $quantity Quantity to restore
     * @return bool Success status
     */
    public function restoreStock($data, $quantity) {
        // Get current stock
        $current_stock = $this->checkstock($data);
        if (empty($current_stock) || !isset($current_stock[0]['balance'])) {
                  $log_data = $data;
            // If no stock record exists, create one
            $data['balance'] = $quantity;
            $data['stock_type'] = '';
            $this->db->insert('stocks', $data);
            
            // Log the creation
      
            $log_data['balance'] = $quantity;
            $log_data['stock_type'] = $this->input->post('stock_type');// Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('stocks_logs', $log_data);
        } else {
            // Update existing stock
            $available_stock = $current_stock[0]['balance'];
            $new_balance = $available_stock + $quantity;
            
            // Build WHERE clause properly for stock update
            $this->db->where('item_fk', $data['item_fk']);
            
            if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
                $this->db->where('brand_fk', $data['brand_fk']);
            } else {
                $this->db->where('brand_fk', 0);
            }
            
            if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
                $this->db->where('grade_fk', $data['grade_fk']);
            } else {
                $this->db->where('grade_fk', 0);
            }
            
            if (isset($data['model_fk']) && $data['model_fk'] > 0) {
                $this->db->where('model_fk', $data['model_fk']);
            } else {
                $this->db->where('model_fk', 0);
            }
            
            if (isset($data['size_fk']) && $data['size_fk'] > 0) {
                $this->db->where('size_fk', $data['size_fk']);
            } else {
                $this->db->where('size_fk', 0);
            }
            
            if (isset($data['type_fk']) && $data['type_fk'] > 0) {
                $this->db->where('type_fk', $data['type_fk']);
            } else {
                $this->db->where('type_fk', 0);
            }
            
            if (isset($data['colour_fk']) && $data['colour_fk'] > 0) {
                $this->db->where('colour_fk', $data['colour_fk']);
            } else {
                $this->db->where('colour_fk', 0);
            }
            
            if (isset($data['unit_fk']) && $data['unit_fk'] > 0) {
                $this->db->where('unit_fk', $data['unit_fk']);
            } else {
                $this->db->where('unit_fk', 0);
            }
            
            $this->db->update('stocks', array('balance' => $new_balance));
            
            // Log the restoration
            $log_data = $data;
            $log_data['balance'] = $quantity; // Positive for restoration
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('stocks_logs', $log_data);
        }
        
        // Log the restoration
        // $log_data = $data;
        // $log_data['balance'] = $quantity; // Positive for restoration
        // $log_data['stock_type'] = 'restoration';
        // $log_data['entry_date'] = date('Y-m-d');
        // $this->db->insert('stocks_logs', $log_data);
        
        return true;
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
    
    /**
     * Get all items with their stock information
     * @return array Array of items with stock details
     */
    public function getallitemsstock() {
        $this->db->select('i.item_id, i.item_name, i.item_status, COALESCE(SUM(s.balance), 0) as total_stock');
        $this->db->from('items i');
        $this->db->join('stocks s', 'i.item_id = s.item_fk', 'left');
        $this->db->where('i.item_status', 1);
        $this->db->group_by('i.item_id');
        $this->db->order_by('i.item_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
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

    /**
     * Get all items with zero or negative stock balance
     */
    public function get_items_with_zero_stock() {
        $this->db->select('stocks.item_fk, items.item_name');
        $this->db->from('stocks');
        $this->db->join('items', 'items.item_id = stocks.item_fk');
        $this->db->where('stocks.balance <=', 0);
        $this->db->group_by('stocks.item_fk');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_items_not_exists_in_stock(){
        $notexists = array();
       $items= $this->getallitems();
       if(isset($items)){
        foreach($items as $value){
            $this->db->select('stocks.item_fk');
        $this->db->from('stocks');
        $this->db->where('stocks.item_fk', $value['item_id']);
        $query = $this->db->get();
        $data= $query->result_array();
        if(!$data){
            $notexists[]=$value['item_id'];
        }
        }
    }
    return $notexists;
    }
}
?>