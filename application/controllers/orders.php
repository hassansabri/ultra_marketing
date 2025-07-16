<?php
/**
 *  @property m_login $model_login
 * @property orders/m_order $model_order
* @property CI_Session $session
 * @property CI_Input $input
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author Hassan
 */

 class orders extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("orders/m_orders", "model_order");

    }    
    public function index(){
        $this->data['all_items']=$this->model_order->getAllItems();
        $this->data["all_brands"] = $this->model_order->getallbrands();
        $this->data["all_shops"] = $this->model_order->getallshops();
        $this->load->view('orders/new_order',$this->data);
    }
    public function show_invoice($order_number = null) {
        // If no order number provided, redirect to draft orders
        if (!$order_number) {
            redirect(site_url() . 'orders/draftorders');
        }
        
        // Get order information
        $this->data['order_info'] = $this->model_order->getOrder($order_number);
        $this->data['order_number'] = $order_number;
        
        // Get profile details for company information
        $this->data['profile'] = $this->model_order->getprofiledetail();
        
        // Fetch shop info for the order (get shop_id from first order_info row)
        $shop_info = null;
        if (isset($this->data['order_info'][0]['shop_id']) && $this->data['order_info'][0]['shop_id']) {
            $this->load->model('shops/m_shop', 'model_shop');
            $shop = $this->model_shop->getshopdetail($this->data['order_info'][0]['shop_id']);
            if ($shop && isset($shop[0])) {
                $shop_info = $shop[0];
            }
        }
        $this->data['shop_info'] = $shop_info;
        
        // Get order details for each item
        $this->data['order_details'] = array();
        foreach($this->data['order_info'] as $oi){
            $item_id = $oi['item_id'];
            $order_details = $this->model_order->getorderdetail($order_number, $item_id);
            
            // Get item details
            $item_detail = $this->model_order->getitemdetail($item_id);
            
            // Organize order details by attribute type
            $organized_details = array();
            foreach($order_details as $detail){
                $attribute_type = $detail['attribute_type'];
                $attribute_fk = $detail['attribute_fk'];
                $quantity = $detail['attribute_quantity'];
                
                // Get attribute details based on type
                switch($attribute_type){
                    case 'grade':
                        $attribute_detail = $this->model_order->getgradedetail($attribute_fk);
                        break;
                    case 'model':
                        $attribute_detail = $this->model_order->getmodeldetail($attribute_fk);
                        break;
                    case 'size':
                        $attribute_detail = $this->model_order->getsizedetail($attribute_fk);
                        break;
                    case 'type':
                        $attribute_detail = $this->model_order->gettypedetail($attribute_fk);
                        break;
                    case 'colour':
                        $attribute_detail = $this->model_order->getcolourdetail($attribute_fk);
                        break;
                    case 'unit':
                        $attribute_detail = $this->model_order->getunitdetail($attribute_fk);
                        break;
                    default:
                        $attribute_detail = array();
                }
                
                if(!isset($organized_details[$attribute_type])){
                    $organized_details[$attribute_type] = array();
                }
                $organized_details[$attribute_type][] = array(
                    'detail' => $attribute_detail,
                    'quantity' => $quantity
                );
            }
            
            $this->data['order_details'][$item_id] = array(
                'item_detail' => $item_detail[0],
                'attributes' => $organized_details
            );
        }
        
        // Fetch ledger entries for the order
        $this->data['order_ledger'] = $this->model_order->getOrderLedger($order_number);
        
        $this->load->view("orders/invoice", $this->data);
    }
        public function initorder(){
          $item_id= $this->input->post('item_id');
          $this->data['flag']= $this->input->post('flag');
          $this->data['order_number']= $this->input->post('order_number');
          $attribute_fk=$this->model_order->getitemattributes($item_id);
          
          
           // print_r($attribute_fk);
           if($attribute_fk){
                      foreach($attribute_fk[0] as $value2){
                          $this->data['brands'][]=$this->model_order->getbranddetail($value2,'1');
                      }
          }
// print_r($attribute_fk[1]);
if($attribute_fk[0]){
  foreach($attribute_fk[0] as $value){
                        $this->data['grades'][]=$this->model_order->getgradedetail($value,'1');
             }
          }
          
          if($attribute_fk[1]){
              foreach($attribute_fk[1] as $value){
                $this->data['models'][]=$this->model_order->getmodeldetail($value,'1');
                }
              }
              if($attribute_fk[2]){
                foreach($attribute_fk[2] as $value){
                  $this->data['sizes'][]=$this->model_order->getsizedetail($value,'1');
                }
              }
              if($attribute_fk[3]){
                foreach($attribute_fk[3] as $value){
                  $this->data['types'][]=$this->model_order->gettypedetail($value,'1');
                }
              }
              if($attribute_fk[4]){
                foreach($attribute_fk[4] as $value){
                  $this->data['colours'][]=$this->model_order->getcolourdetail($value,'1');
                }
              }
              if($attribute_fk[5]){
                foreach($attribute_fk[5] as $value){
                  $this->data['units'][]=$this->model_order->getunitdetail($value,'1');
                }
              }
              $this->data["item_id"] =  $item_id;
              $this->data["item_detail"] =  $this->model_order->getitemdetail($item_id);
            $html=$this->load->view('orders/gen_order',$this->data,true);
           echo json_encode($html); 
        }
        public function allattributes($item_id=false){
           $attribute_fk=$this->model_order->getitemattributes($item_id);
           print_r($attribute_fk);
           $this->data = array();
if($attribute_fk[0]){
  foreach($attribute_fk[0] as $value){
                        $this->data['grades'][]=$this->model_order->getgradedetail($value,'1');
             }
          }
          
          if($attribute_fk[1]){
              foreach($attribute_fk[1] as $value){
                $this->data['models'][]=$this->model_order->getmodeldetail($value,'1');
                }
              }
              if($attribute_fk[2]){
                foreach($attribute_fk[2] as $value){
                  $this->data['sizes'][]=$this->model_order->getsizedetail($value,'1');
                }
              }
              if($attribute_fk[3]){
                foreach($attribute_fk[3] as $value){
                  $this->data['types'][]=$this->model_order->gettypedetail($value,'1');
                }
              }
              if($attribute_fk[4]){
                foreach($attribute_fk[4] as $value){
                  $this->data['colours'][]=$this->model_order->getcolourdetail($value,'1');
                }
              }
              
              $this->data["item_detail"] =  $this->model_order->getitemdetail($item_id);
              return $this->data;
        }
        public function draft_order(){
         $order_number =  $this->input->post('order_number');
         $item_ids =  $this->input->post('item_ids');
         $qty =  $this->input->post('item_qty');
         $item_price =  $this->input->post('item_price');
         $shop_id = $this->input->post('shopid'); // get selected shop
         
         $stock_errors = array();
         $has_stock_issues = false;
         
         // Check stock for all items first
         for($i=0;$i<sizeof($item_ids);$i++){
           $item_id=$item_ids[$i];
           
           // Check stock availability
           $stock_check = $this->model_order->checkStockAvailability($item_id, $qty[$i]);
           if (!$stock_check['sufficient']) {
               $item_detail = $this->model_order->getitemdetail($item_id);
               $item_name = isset($item_detail[0]['item_name']) ? $item_detail[0]['item_name'] : 'Item';
               $stock_errors[] = "Insufficient stock for {$item_name}. Available: {$stock_check['available']}, Requested: {$stock_check['requested']}";
               $has_stock_issues = true;
           }
         }
         
         // If there are stock issues, don't create the order
         if ($has_stock_issues) {
             $this->session->set_flashdata('stock_errors', $stock_errors);
             redirect(site_url() . 'orders');
             return;
         }
         
         // If stock is sufficient, create the order
         for($i=0;$i<sizeof($item_ids);$i++){
           $item_id=$item_ids[$i];
           $data=$this->allattributes($item_id);
           
           $this->model_order->insertdraftorder($order_number,$item_id,$qty[$i],$item_price[$i], $shop_id); // pass shop_id
           if($data['grades']){
            $grade_quantity=0;
             foreach($data['grades'] as $value){
           $value['grade_id'];
              $grade_quantity=$this->input->post("grade-". $value['grade_id'] ."-". $item_id);
               $this->model_order->insertdraftorderdetail($order_number,$value['grade_id'],$grade_quantity,$item_id,'grade');
             }
           }
        //   print_r($grade_quantity);
           if($data['models']){
             foreach($data['models'] as $value){
               $model_quantity=$this->input->post("model-". $value['model_id'] ."-". $item_id);
               if($model_quantity && $model_quantity > 0){
                   $this->model_order->insertdraftorderdetail($order_number,$value['model_id'],$model_quantity,$item_id,'model');
               }
             }
           }
          /// print_r($model_quantity);
           if($data['sizes']){
             foreach($data['sizes'] as $value){
               $size_quantity=$this->input->post("size-". $value['size_id'] ."-". $item_id);
               if($size_quantity && $size_quantity > 0){
                   $this->model_order->insertdraftorderdetail($order_number,$value['size_id'],$size_quantity,$item_id,'size');
               }
             }
           }
         // print_r($size_quantity);
           if($data['types']){
             foreach($data['types'] as $value){
               $type_quantity=$this->input->post("type-". $value['type_id'] ."-". $item_id);
               if($type_quantity && $type_quantity > 0){
                   $this->model_order->insertdraftorderdetail($order_number,$value['type_id'],$type_quantity,$item_id,'type');
               }
             }
           }
          /// print_r($type_quantity);
           if($data['colours']){
             foreach($data['colours'] as $value){
               $colour_quantity=$this->input->post("colour-". $value['colour_id'] ."-". $item_id);
               if($colour_quantity && $colour_quantity > 0){
                   $this->model_order->insertdraftorderdetail($order_number,$value['colour_id'],$colour_quantity,$item_id,'colour');
               }
             }
           }
           
         }
         
         if (!empty($stock_errors)) {
             $this->session->set_flashdata('stock_errors', $stock_errors);
         }
         
         redirect(site_url() . 'orders/draftorders');
         }
        public function draftorders(){
          $this->data['all_draft_orders']=$this->model_order->getAllDraftOrders();
          //  $this->data['products'] = $this->model_order->getdraftproducts();
           $this->load->view('orders/all_draft_orders',$this->data);
        }
        public function completeorders(){
          $this->data['all_complete_orders']=$this->model_order->getAllCompleteOrders();
           $this->load->view('orders/all_complete_orders',$this->data);
        }
        public function editorder($order_number){
          $this->data['order_info'] = $this->model_order->getOrder($order_number);
           $itemids = $this->model_order->getitemidsfromordernumber($order_number);
           foreach($this->data['order_info'] as $oi){
            $item_id=$oi['item_id'];
          
                $attribute_fk=$this->model_order->getitemattributes($item_id);
                  $this->data['item_id']=$item_id;
 //print_r($attribute_fk[0]);
if($attribute_fk[0]){
  foreach($attribute_fk[0] as $value){
                        $this->data['grades'][$item_id][]=$this->model_order->getgradedetail($value,'1');
             }
          }
        //  print_r($this->data['grades'][$item_id]);
          if($attribute_fk[1]){
              foreach($attribute_fk[1] as $value){
                $this->data['models'][$item_id][]=$this->model_order->getmodeldetail($value,'1');
                }
              }
              if($attribute_fk[2]){
                foreach($attribute_fk[2] as $value){
                  $this->data['sizes'][$item_id][]=$this->model_order->getsizedetail($value,'1');
                }
              }
              if($attribute_fk[3]){
                foreach($attribute_fk[3] as $value){
                  $this->data['types'][$item_id][]=$this->model_order->gettypedetail($value,'1');
                }
              }
              if($attribute_fk[4]){
                foreach($attribute_fk[4] as $value){
                  $this->data['colours'][$item_id][]=$this->model_order->getcolourdetail($value,'1');
                }
              }
              if($attribute_fk[5]){
                foreach($attribute_fk[5] as $value){
                  $this->data['units'][$item_id][]=$this->model_order->getunitdetail($value,'1');
                }
              }
              
          }
          
          // Get existing attribute values from order_detail table
          $this->data['existing_values'] = array();
          foreach($this->data['order_info'] as $oi){
            $item_id = $oi['item_id'];
            $order_details = $this->model_order->getorderdetail($order_number, $item_id);
            
            $this->data['existing_values'][$item_id] = array();
            foreach($order_details as $detail){
                $attribute_type = $detail['attribute_type'];
                $attribute_fk = $detail['attribute_fk'];
                $quantity = $detail['attribute_quantity'];
                
                if(!isset($this->data['existing_values'][$item_id][$attribute_type])){
                    $this->data['existing_values'][$item_id][$attribute_type] = array();
                }
                $this->data['existing_values'][$item_id][$attribute_type][$attribute_fk] = $quantity;
            }
          }
          $this->data['order_number'] = $order_number;
$this->data['all_items']=$this->model_order->getAllItems();
        $this->data["all_brands"] = $this->model_order->getallbrands();
          $this->load->view('orders/editorder',$this->data);

        }
        public function deleteorderdetail(){
          $item_id = $this->input->post('item_id');
            $order_number = $this->input->post('order_number');
          $this->model_order->deleteorder2($order_number, $item_id);
          $this->model_order->deleteOrderDetails($order_number, $item_id);
        }
        public function draft_order_updater($order_number){
          $item_ids = array();
            $item_ids = $this->input->post('item_ids');
            $item_qty = $this->input->post('item_qty');
            $item_price = $this->input->post('item_price');
            if(isset($item_ids)&&sizeof($item_ids)>0){
              foreach($item_ids as $key => $value){
                $item_id = $value;
                $quantity = isset($item_qty[$key]) ? $item_qty[$key] : 1;
                $price = isset($item_price[$key]) ? $item_price[$key] : 0;
                
                // Check stock availability before updating
                $stock_check = $this->model_order->checkStockAvailability($item_id, $quantity);
                if (!$stock_check['sufficient']) {
                    $item_detail = $this->model_order->getitemdetail($item_id);
                    $item_name = isset($item_detail[0]['item_name']) ? $item_detail[0]['item_name'] : 'Item';
                    $this->session->set_flashdata('stock_errors', ["Insufficient stock for {$item_name}. Available: {$stock_check['available']}, Requested: {$stock_check['requested']}"]);
                    redirect(site_url() . 'orders/draftorders');
                    return;
                }

                // Update order quantity
                $this->model_order->updateOrderQuantityAndPrice($order_number, $item_id, $quantity,$price);
                
                // Delete existing order details for this item
                $this->model_order->deleteOrderDetails($order_number, $item_id);
                
                // Get attributes for this item
                $data = $this->allattributes($item_id);
                
                // Insert grades
                if($data['grades']){
                    foreach($data['grades'] as $grade){
                        $grade_quantity = $this->input->post("grade-". $grade['grade_id'] ."-". $item_id);
                        if($grade_quantity && $grade_quantity > 0){
                            $this->model_order->insertdraftorderdetail($order_number, $grade['grade_id'], $grade_quantity, $item_id, 'grade');
                        }
                    }
                }
                
                // Insert models
                if($data['models']){
                    foreach($data['models'] as $model){
                       $model_quantity = $this->input->post("model-". $model['model_id'] ."-". $item_id);
                       
                       if($model_quantity && $model_quantity > 0){
                            $this->model_order->insertdraftorderdetail($order_number, $model['model_id'], $model_quantity, $item_id, 'model');
                        }
                    }
                }
                
                // Insert sizes
                if($data['sizes']){
                    foreach($data['sizes'] as $size){
                        $size_quantity = $this->input->post("size-". $size['size_id'] ."-". $item_id);
                        if($size_quantity && $size_quantity > 0){
                            $this->model_order->insertdraftorderdetail($order_number, $size['size_id'], $size_quantity, $item_id, 'size');
                        }
                    }
                }
                
                // Insert types
                if($data['types']){
                    foreach($data['types'] as $type){
                        $type_quantity = $this->input->post("type-". $type['type_id'] ."-". $item_id);
                        if($type_quantity && $type_quantity > 0){
                            $this->model_order->insertdraftorderdetail($order_number, $type['type_id'], $type_quantity, $item_id, 'type');
                        }
                    }
                }
                
                // Insert colours
                if($data['colours']){
                    foreach($data['colours'] as $colour){
                        $colour_quantity = $this->input->post("colour-". $colour['colour_id'] ."-". $item_id);
                        if($colour_quantity && $colour_quantity > 0){
                            $this->model_order->insertdraftorderdetail($order_number, $colour['colour_id'], $colour_quantity, $item_id, 'colour');
                        }
                    }
                }
            }
            }else{
              $this->model_order->deleteorder($order_number);
            }
            
            
            redirect(site_url() . 'orders/draftorders');
        }
        public function review($order_number){
            // Get order information
            $this->data['order_info'] = $this->model_order->getOrder($order_number);
            $this->data['order_number'] = $order_number;
            
            // Get profile details for company information
            $this->data['profile'] = $this->model_order->getprofiledetail();
            
            // Get order details for each item
            $this->data['order_details'] = array();
            foreach($this->data['order_info'] as $oi){
                $item_id = $oi['item_id'];
                $order_details = $this->model_order->getorderdetail($order_number, $item_id);
                
                // Get item details
                $item_detail = $this->model_order->getitemdetail($item_id);
                
                // Organize order details by attribute type
                $organized_details = array();
                foreach($order_details as $detail){
                    $attribute_type = $detail['attribute_type'];
                    $attribute_fk = $detail['attribute_fk'];
                    $quantity = $detail['attribute_quantity'];
                    
                    // Get attribute details based on type
                    switch($attribute_type){
                        case 'grade':
                            $attribute_detail = $this->model_order->getgradedetail($attribute_fk);
                            break;
                        case 'model':
                            $attribute_detail = $this->model_order->getmodeldetail($attribute_fk);
                            break;
                        case 'size':
                            $attribute_detail = $this->model_order->getsizedetail($attribute_fk);
                            break;
                        case 'type':
                            $attribute_detail = $this->model_order->gettypedetail($attribute_fk);
                            break;
                        case 'colour':
                            $attribute_detail = $this->model_order->getcolourdetail($attribute_fk);
                            break;
                        case 'unit':
                            $attribute_detail = $this->model_order->getunitdetail($attribute_fk);
                            break;
                        default:
                            $attribute_detail = array();
                    }
                    
                    if(!isset($organized_details[$attribute_type])){
                        $organized_details[$attribute_type] = array();
                    }
                    $organized_details[$attribute_type][] = array(
                        'detail' => $attribute_detail,
                        'quantity' => $quantity
                    );
                }
                
                $this->data['order_details'][$item_id] = array(
                    'item_detail' => $item_detail[0],
                    'attributes' => $organized_details
                );
            }
            
            $this->load->view('orders/review_order', $this->data);
        }
        public function save($order_number){
           $this->model_order->updateorder($order_number);
           redirect(site_url() . 'orders/review/'.$order_number);
        }

    // List all ledger entries for all orders
    public function ledger() {
        $this->data['ledger_entries'] = $this->model_order->getAllOrderLedger();
        $this->load->view('orders/ledger_crud', $this->data);
    }

    // Add a ledger entry (POST)
    public function add_ledger_entry() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_number = $this->input->post('order_number');
            $date = $this->input->post('date');
            $amount = $this->input->post('amount');
            $payment_method = $this->input->post('payment_method');
            $remarks = $this->input->post('remarks');
            $type = $this->input->post('type');
            $this->model_order->insertOrderLedger($order_number, $date, $amount, $payment_method, $remarks, $type);
            redirect(site_url('orders/ledger'));
        }
        $this->load->view('orders/ledger_crud', $this->data);
    }

    // Edit a ledger entry (GET for form, POST for update)
    public function edit_ledger_entry($ledger_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'order_number' => $this->input->post('order_number'),
                'date' => $this->input->post('date'),
                'amount' => $this->input->post('amount'),
                'payment_method' => $this->input->post('payment_method'),
                'remarks' => $this->input->post('remarks'),
                'type' => $this->input->post('type'),
            );
            $this->model_order->updateOrderLedger($ledger_id, $data);
            redirect(site_url('orders/ledger'));
        }
        $this->data['entry'] = $this->model_order->getOrderLedgerById($ledger_id);
        $this->load->view('orders/ledger_crud', $this->data);
    }

    // Delete a ledger entry
    public function delete_ledger_entry($ledger_id) {
        $this->model_order->deleteOrderLedger($ledger_id);
        redirect(site_url('orders/ledger'));
    }
}
    
?>
