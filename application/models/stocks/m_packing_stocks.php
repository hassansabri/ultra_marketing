<?php
class m_packing_stocks extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getallpackings(){
         $this->db->select('*');
         $this->db->where('status','1');
         $this->db->where(' (packing_id != 4) ');
        $query = $this->db->get("packing_options");
      //  echo $this->db->last_query();
        return $query->result_array();
    }
    public function getlogs($data){
        $this->db->select('*');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks_logs");
        return $query->result_array();
    }
    public function getcurrentballance($data){
        $this->db->select_sum('balance');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks");
        return $query->result_array();
    }
    public function deductStock($data, $quantity) {
        // First check if we have enough stock
        
         $current_stock = $this->checkstock($data);
        // if (empty($current_stock) || !isset($current_stock[0]['balance'])) {
        //     return false; // No stock record found
        // }
        
        $available_stock = $current_stock[0]['balance'];
        if ($available_stock < $quantity) {
            return false; // Insufficient stock
        }
        
        // Calculate new balance
        if(($data['packing_fk'] == '4')){
            $big = ceil($quantity/10) ;
            $small = $quantity;
            $new_balance = $available_stock - $big;
            // Update stock with proper WHERE clause
            $data['packing_fk']=2;
        $this->db->where('packing_fk', 2);
         $this->db->update('packingstocks', array('balance' => $new_balance));
        // // Log the deduction
        $log_data = $data;
        $log_data['balance'] = $big; 
        $log_data['stock_type'] = 'stock_deduction';
        $log_data['entry_date'] = date('Y-m-d');
        $this->db->insert('packingstocks_logs', $log_data);

            $new_balance = $available_stock - $small;
            // Update stock with proper WHERE clause
            $data['packing_fk']=3;
        $this->db->where('packing_fk', 3);
         $this->db->update('packingstocks', array('balance' => $new_balance));
        // // Log the deduction
        $log_data = $data;
        $log_data['balance'] = $quantity; 
        $log_data['stock_type'] = 'stock_deduction';
        $log_data['entry_date'] = date('Y-m-d');
        $this->db->insert('packingstocks_logs', $log_data);

        }else{
            $new_balance = $available_stock - $quantity;
        
        // Update stock with proper WHERE clause
        $this->db->where('packing_fk', $data['packing_fk']);
        
        // if (isset($data['brand_fk']) && $data['brand_fk'] > 0) {
        //     $this->db->where('brand_fk', $data['brand_fk']);
        // } else {
        //     $this->db->where('brand_fk', 0);
        // }
        
        // if (isset($data['grade_fk']) && $data['grade_fk'] > 0) {
        //     $this->db->where('grade_fk', $data['grade_fk']);
        // } else {
        //     $this->db->where('grade_fk', 0);
        // }
        
        // if (isset($data['model_fk']) && $data['model_fk'] > 0) {
        //     $this->db->where('model_fk', $data['model_fk']);
        // } else {
        //     $this->db->where('model_fk', 0);
        // }
        
        // if (isset($data['size_fk']) && $data['size_fk'] > 0) {
        //     $this->db->where('size_fk', $data['size_fk']);
        // } else {
        //     $this->db->where('size_fk', 0);
        // }
        

         $this->db->update('packingstocks', array('balance' => $new_balance));
        // echo $this->db->last_query();
        // exit;
         // Log the deduction
        $log_data = $data;
        $log_data['balance'] = $quantity; 
        $log_data['stock_type'] = 'stock_deduction';
        $log_data['entry_date'] = date('Y-m-d');
        $this->db->insert('packingstocks_logs', $log_data);
        }
        
        
        return true;
    }
    public function checkstock2($data){
$this->db->select_sum('balance');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks");
        return $query->result_array();
    }
    public function checkstock($data ){
        $d=array();
        if(($data['packing_fk'] == '4')){
            $this->db->select_sum('balance');
        $this->db->where('packing_fk', 2);
        $query = $this->db->get("packingstocks");
      $d= $flag1 =  $query->result_array();

        $this->db->select_sum('balance');
        $this->db->where('packing_fk', 3);
        $query = $this->db->get("packingstocks");
       $d= $flag2 = $query->result_array();
        if(sizeof($flag1)>0 && sizeof($flag2)>0){
            return $d;

        }else{
            return $d;
        }
        }else{
            $this->db->select_sum('balance');
        $this->db->where('packing_fk', $data['packing_fk']);
        $query = $this->db->get("packingstocks");
        return $query->result_array();
        }
        
    }

    public function addstock($data){
        $this->restorePackingStockForOrder($data,$data['balance']);
    }
    public function restorePackingStock($data, $quantity){
        $current_stock = $this->checkstock($data);
                if (empty($current_stock) || !isset($current_stock[0]['balance'])) {

                }else{
if($data['packing_fk']=='4'){
   
                $available_stock = $quantity;
                 $big = ceil($available_stock/10) ;
            $small = $quantity;
            // restore stock for big polythene
            $new_balance =  getpackingstockvaluebyid(2) + $big;
             // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', 2);
            $this->db->update('packingstocks', array('balance' => $new_balance));
            
            // Log the restoration
            $log_data = $data;
            $log_data['balance'] = $big; // Positive for restoration
            $log_data['packing_fk'] = 2;
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
            // restore stock for small polythene
            $new_balance = getpackingstockvaluebyid(3) + $small;
             // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', 3);
            $this->db->update('packingstocks', array('balance' => $new_balance));
             // Log the restoration
            $log_data = $data;
            $log_data['packing_fk'] = 3;
            $log_data['balance'] = $small; // Positive for restoration
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
                }else{
 $available_stock = $current_stock[0]['balance'];
            $new_balance = $available_stock + $quantity;
            
            // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', $data['packing_fk']);
            $this->db->update('packingstocks', array('balance' => $new_balance));
            
            // Log the restoration
            $log_data = $data;
            $log_data['balance'] = $quantity; // Positive for restoration
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
                }
                return true;

    }
}
        public function restorePackingStockForOrder($data, $quantity) {
        // Get current stock
        $current_stock = $this->checkstock($data);
        if (empty($current_stock) || !isset($current_stock[0]['balance'])) {
                  $log_data = $data;
            // If no stock record exists, create one
            $data['balance'] = $quantity;
            $this->db->insert('packingstocks', $data);
            
            // Log the creation
      
            $log_data['balance'] = $quantity;
            $log_data['stock_type'] = $this->input->post('stock_type');// Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
        } else {
            
            if($data['packing_fk']=='4'){
                $available_stock = $current_stock[0]['balance'];
                 $big = ceil($quantity/10) ;
            $small = $quantity;
            // restore stock for big polythene
            
            $this->db->select_sum('balance');
        $this->db->where('packing_fk', 2);
        $query = $this->db->get("packingstocks");
        $dat = $query->result_array();
        $current_ballance = $dat[0]['balance'];
             // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', 2);
            $this->db->update('packingstocks', array('balance' => $available_stock+$big));
            
            // Log the restoration
            $log_data = $data;
            $log_data['balance'] = $big; // Positive for restoration
            $log_data['packing_fk'] = 2;
            $log_data['stock_type'] = isset($data['stock_type']) ? $data['stock_type'] : 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
            // restore stock for small polythene
            $new_balance = $quantity;
             $this->db->select_sum('balance');
        $this->db->where('packing_fk', 3);
        $query = $this->db->get("packingstocks");
         $dat = $query->result_array();
        $current_ballance = $dat[0]['balance'];
             // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', 3);
            $this->db->update('packingstocks', array('balance' => $current_ballance+$new_balance));
             // Log the restoration
            $log_data = $data;
            $log_data['packing_fk'] = 3;
            $log_data['balance'] = $current_ballance+$new_balance; // Positive for restoration
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);

            }else{
 // Update existing stock
            $available_stock = $current_stock[0]['balance'];
            $new_balance = $available_stock + $quantity;
            
            // Build WHERE clause properly for stock update
            $this->db->where('packing_fk', $data['packing_fk']);
            $this->db->update('packingstocks', array('balance' => $new_balance));
            
            // Log the restoration
            $log_data = $data;
            $log_data['balance'] = $quantity; // Positive for restoration
            $log_data['stock_type'] = 'restore_stock'; // Use valid enum value
            $log_data['entry_date'] = date('Y-m-d');
            $this->db->insert('packingstocks_logs', $log_data);
        }
            }
           
        return true;
    }
}