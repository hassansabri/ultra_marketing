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
        if (!$this->session->userdata('logged_in'))
            redirect('login');
        $this->load->model("orders/m_orders", "model_order");
    }

    public function index() {
        $this->data['order_number'] = rand(0000,9999);
        $this->data['all_items'] = $this->model_order->getAllItems();
        $this->data["all_brands"] = $this->model_order->getallbrands();
        $this->data["all_shops"] = $this->model_order->getallshops();
        $this->data['all_packing_options'] = $this->model_order->getAllPackingOptions();
        $this->model_order->insertdraftorder($this->data['order_number'], 0,0, 0, 0,0, null, null);
        $this->load->view('orders/new_order', $this->data);
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
        
        // Get packing information for the order
        //  $this->data['item_packing'] = $this->model_order->getItemPackingInfo($this->data['order_info'][0]['itemidS']);
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
        if($this->data['shop_info']){
            
            foreach ($this->data['order_info'] as $oi) {
                $item_id = $oi['item_id'];
                $order_details = $this->model_order->getorderdetail($order_number, $item_id);
    
                // Get item details
                $item_detail = $this->model_order->getitemdetail($item_id);
                
                // Organize order details by attribute type
                $organized_details = array();
                foreach ($order_details as $detail) {
                    $attribute_type = $detail['attribute_type'];
                    $attribute_fk = $detail['attribute_fk'];
                    $quantity = $detail['attribute_quantity'];
                    
                    // Get attribute details based on type
                    switch ($attribute_type) {
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
                                                case 'packing':
                                                    $attribute_detail = $this->model_order->getPackingOptionDetail($attribute_fk);
                                                    break;
                                                    default:
                                                    $attribute_detail = array();
                                                }
                                                
                                                if (!isset($organized_details[$attribute_type])) {
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
                                    }
                                    
                                    // Fetch ledger entries for the order
                                    $this->data['order_ledger'] = $this->model_order->getOrderLedger($order_number);
                                    
                                    // Fetch shop ledger entries if shop info is available
                                    $this->data['shop_ledger'] = array();
                                    if (isset($this->data['order_info'][0]['shop_id']) && $this->data['order_info'][0]['shop_id']) {
                                        $this->data['shop_ledger'] = $this->model_order->getShopLedger($this->data['order_info'][0]['shop_id']);
                                    }
                                    
                                    $this->load->view("orders/invoice", $this->data);
                                }
                                
                                public function initorder() {
                                    $item_id = $this->input->post('item_id');
                                    $this->data['flag'] = $this->input->post('flag');
                                    $this->data['order_number'] = $this->input->post('order_number');
                                    $attribute_fk = $this->model_order->getitemattributes($item_id);
                                    
                                    
                                    // print_r($attribute_fk);
                                    if ($attribute_fk) {
                                        foreach ($attribute_fk[0] as $value2) {
                                            $this->data['brands'][] = $this->model_order->getbranddetail($value2, '1');
                                        }
                                    }
                                    // print_r($attribute_fk[1]);
                                    if ($attribute_fk[0]) {
                                        foreach ($attribute_fk[0] as $value) {
                                            $this->data['grades'][] = $this->model_order->getgradedetail($value, '1');
                                        }
                                    }
                                    
                                    if ($attribute_fk[1]) {
                                        foreach ($attribute_fk[1] as $value) {
                                            $this->data['models'][] = $this->model_order->getmodeldetail($value, '1');
                                        }
                                    }
                                    if ($attribute_fk[2]) {
                                        foreach ($attribute_fk[2] as $value) {
                                            $this->data['sizes'][] = $this->model_order->getsizedetail($value, '1');
                                        }
                                    }
                                    if ($attribute_fk[3]) {
                                        foreach ($attribute_fk[3] as $value) {
                                            $this->data['types'][] = $this->model_order->gettypedetail($value, '1');
                                        }
                                    }
                                    if ($attribute_fk[4]) {
                                        foreach ($attribute_fk[4] as $value) {
                                            $this->data['colours'][] = $this->model_order->getcolourdetail($value, '1');
                                        }
                                    }
                                    if ($attribute_fk[5]) {
                                        foreach ($attribute_fk[5] as $value) {
                                            $this->data['units'][] = $this->model_order->getunitdetail($value, '1');
            }
        }
        $this->data["item_id"] = $item_id;
        $this->data["item_detail"] = $this->model_order->getitemdetail($item_id);
        $this->data['all_packing_options'] = $this->model_order->getallpackingoptions();
        $html = $this->load->view('orders/gen_order', $this->data, true);
        echo json_encode($html);
    }
    
    public function allattributes($item_id = false) {
        $attribute_fk = $this->model_order->getitemattributes($item_id);
        // print_r($attribute_fk);
        $this->data = array();
        $this->data = array(
            'grades' => array(),
            'models' => '',
            'sizes' => '',
            'types' => '',
            'colours' => '',
        );
        if ($attribute_fk[0]) {
            foreach ($attribute_fk[0] as $value) {
                $this->data['grades'][] = $this->model_order->getgradedetail($value, '1');
            }
        }
        
        if ($attribute_fk[1]) {
            foreach ($attribute_fk[1] as $value) {
                $this->data['models'][] = $this->model_order->getmodeldetail($value, '1');
            }
        }
        if ($attribute_fk[2]) {
            foreach ($attribute_fk[2] as $value) {
                $this->data['sizes'][] = $this->model_order->getsizedetail($value, '1');
            }
        }
        if ($attribute_fk[3]) {
            foreach ($attribute_fk[3] as $value) {
                $this->data['types'][] = $this->model_order->gettypedetail($value, '1');
            }
        }
        if ($attribute_fk[4]) {
            foreach ($attribute_fk[4] as $value) {
                $this->data['colours'][] = $this->model_order->getcolourdetail($value, '1');
            }
        }
        
        $this->data["item_detail"] = $this->model_order->getitemdetail($item_id);
        return $this->data;
    }
    public function neworderreview(){
        $order_number = $this->input->post('order_number');
       // echo $order_number;
        // Get order information
        $this->data['order_info'] = $this->model_order->getOrder($order_number);
        $this->data['order_number'] = $order_number;
        
        // Get profile details for company information
        $this->data['profile'] = $this->model_order->getprofiledetail();
        
        // Get packing information for the order
        //  $this->data['item_packing'] = $this->model_order->getItemPackingInfo($this->data['order_info'][0]['itemidS']);
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
        if($this->data['shop_info']){
            
            foreach ($this->data['order_info'] as $oi) {
                $item_id = $oi['item_id'];
                $order_details = $this->model_order->getorderdetail($order_number, $item_id);
    
                // Get item details
                $item_detail = $this->model_order->getitemdetail($item_id);
                
                // Organize order details by attribute type
                $organized_details = array();
                foreach ($order_details as $detail) {
                    $attribute_type = $detail['attribute_type'];
                    $attribute_fk = $detail['attribute_fk'];
                    $quantity = $detail['attribute_quantity'];
                    
                    // Get attribute details based on type
                    switch ($attribute_type) {
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
                                                case 'packing':
                                                    $attribute_detail = $this->model_order->getPackingOptionDetail($attribute_fk);
                                                    break;
                                                    default:
                                                    $attribute_detail = array();
                                                }
                                                
                                                if (!isset($organized_details[$attribute_type])) {
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
                                    }
                                    
                                    // Fetch ledger entries for the order
                                    $this->data['order_ledger'] = $this->model_order->getOrderLedger($order_number);
                                    
                                    // Fetch shop ledger entries if shop info is available
                                    $this->data['shop_ledger'] = array();
                                    if (isset($this->data['order_info'][0]['shop_id']) && $this->data['order_info'][0]['shop_id']) {
                                        $this->data['shop_ledger'] = $this->model_order->getShopLedger($this->data['order_info'][0]['shop_id']);
                                    }
                                    
                                  $html =  $this->load->view("orders/invoice_ajax", $this->data,true);
                                  echo json_encode($html);
    }
    public function neworderupdate(){
        $order_number = $this->input->post('order_number');
        $this->model_order->deleteorder($order_number);
           
        $item_ids = $this->input->post('item_ids');
        $order_number = $this->input->post('order_number');
        $qty = $this->input->post('item_qty');
        $item_price = $this->input->post('item_price');
        $shop_id = $this->input->post('shopid'); // get selected shop
        // Server-side validation for required fields
        $validation_errors = array();

        // Validate shop selection
        if (empty($shop_id) || $shop_id === '') {
            $validation_errors[] = 'Please select a shop';
        }

        // Validate that items are added
        if (empty($item_ids) || !is_array($item_ids) || count($item_ids) === 0) {
            $validation_errors[] = 'Please add at least one item to the order';
        }

        // Validate quantities
        if (!empty($qty) && is_array($qty)) {
            foreach ($qty as $index => $quantity) {
                if (empty($quantity) || $quantity <= 0) {
                    $validation_errors[] = 'Please enter valid quantities for all items';
                    break;
                }
            }
        } else {
            $validation_errors[] = 'Please enter valid quantities for all items';
        }

        // If validation fails, redirect back with errors
        if (!empty($validation_errors)) {
            $this->session->set_flashdata('validation_errors', $validation_errors);
            redirect(site_url() . 'orders');
            return;
        }

        $stock_errors = array();
        $has_stock_issues = false;

        // Check stock for all items first
        for ($i = 0; $i < sizeof($item_ids); $i++) {
            $item_id = $item_ids[$i];

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
        for ($i = 0; $i < sizeof($item_ids); $i++) {
            $item_id = $item_ids[$i];
            $data = $this->allattributes($item_id);
            $packing_id = $this->input->post('packing_option_' . $item_id);
$packing_quantity = $this->input->post('packing_quantity');
            $bigpolythenelimit = $this->input->post('bigpolythenelimit');
            $this->model_order->insertdraftorder($order_number, $item_id, $qty[$i], $item_price[$i], $shop_id, $packing_id,$packing_quantity[$i],$bigpolythenelimit[$i]); // pass shop_id
            if ($data['grades']) {
                $grade_quantity = 0;
                foreach ($data['grades'] as $value) {
                    $value['grade_id'];
                    $grade_quantity = $this->input->post("grade-" . $value['grade_id'] . "-" . $item_id);
                    $this->model_order->insertdraftorderdetail($order_number, $value['grade_id'], $grade_quantity, $item_id, 'grade');
                }
            }
            //   print_r($grade_quantity);
            if ($data['models']) {
                foreach ($data['models'] as $value) {
                    $model_quantity = $this->input->post("model-" . $value['model_id'] . "-" . $item_id);
                    if ($model_quantity && $model_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['model_id'], $model_quantity, $item_id, 'model');
                    }
                }
            }
            /// print_r($model_quantity);
            if ($data['sizes']) {
                foreach ($data['sizes'] as $value) {
                    $size_quantity = $this->input->post("size-" . $value['size_id'] . "-" . $item_id);
                    if ($size_quantity && $size_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['size_id'], $size_quantity, $item_id, 'size');
                    }
                }
            }
            // print_r($size_quantity);
            if ($data['types']) {
                foreach ($data['types'] as $value) {
                    $type_quantity = $this->input->post("type-" . $value['type_id'] . "-" . $item_id);
                    if ($type_quantity && $type_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['type_id'], $type_quantity, $item_id, 'type');
                    }
                }
            }
            /// print_r($type_quantity);
            if ($data['colours']) {
                foreach ($data['colours'] as $value) {
                    $colour_quantity = $this->input->post("colour-" . $value['colour_id'] . "-" . $item_id);
                    if ($colour_quantity && $colour_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['colour_id'], $colour_quantity, $item_id, 'colour');
                    }
                }
            }
        }

        // Order created successfully (stock will be deducted when order is completed)
        $this->session->set_flashdata('success', 'Draft order created successfully. Stock will be deducted when order is completed.');

        if (!empty($stock_errors)) {
            $this->session->set_flashdata('stock_errors', $stock_errors);
        }
echo json_encode('Success');
    }
    public function draft_order() {
        
        $item_ids = $this->input->post('item_ids');
        $order_number = $this->input->post('order_number');
        $qty = $this->input->post('item_qty');
        $item_price = $this->input->post('item_price');
        $shop_id = $this->input->post('shopid'); // get selected shop
        // Server-side validation for required fields
        $validation_errors = array();

        // Validate shop selection
        if (empty($shop_id) || $shop_id === '') {
            $validation_errors[] = 'Please select a shop';
        }

        // Validate that items are added
        if (empty($item_ids) || !is_array($item_ids) || count($item_ids) === 0) {
            $validation_errors[] = 'Please add at least one item to the order';
        }

        // Validate quantities
        if (!empty($qty) && is_array($qty)) {
            foreach ($qty as $index => $quantity) {
                if (empty($quantity) || $quantity <= 0) {
                    $validation_errors[] = 'Please enter valid quantities for all items';
                    break;
                }
            }
        } else {
            $validation_errors[] = 'Please enter valid quantities for all items';
        }

        // If validation fails, redirect back with errors
        if (!empty($validation_errors)) {
            $this->session->set_flashdata('validation_errors', $validation_errors);
            redirect(site_url() . 'orders');
            return;
        }

        $stock_errors = array();
        $has_stock_issues = false;

        // Check stock for all items first
        for ($i = 0; $i < sizeof($item_ids); $i++) {
            $item_id = $item_ids[$i];

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
        for ($i = 0; $i < sizeof($item_ids); $i++) {
            $item_id = $item_ids[$i];
            $data = $this->allattributes($item_id);
            $packing_quantity = $this->input->post('packing_quantity');
            $bigpolythenelimit = $this->input->post('bigpolythenelimit');
                   $packing_id = $this->input->post('packing_option_' . $item_id);

          //  $this->model_order->insertdraftorder($order_number, $item_id, $qty[$i], $item_price[$i], $shop_id, $packing_id,$packing_quantity[$i],$bigpolythenelimit[$i]); // pass shop_id
            if ($data['grades']) {
                $grade_quantity = 0;
                foreach ($data['grades'] as $value) {
                    $value['grade_id'];
                    $grade_quantity = $this->input->post("grade-" . $value['grade_id'] . "-" . $item_id);
                    $this->model_order->insertdraftorderdetail($order_number, $value['grade_id'], $grade_quantity, $item_id, 'grade');
                }
            }
            //   print_r($grade_quantity);
            if ($data['models']) {
                foreach ($data['models'] as $value) {
                    $model_quantity = $this->input->post("model-" . $value['model_id'] . "-" . $item_id);
                    if ($model_quantity && $model_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['model_id'], $model_quantity, $item_id, 'model');
                    }
                }
            }
            /// print_r($model_quantity);
            if ($data['sizes']) {
                foreach ($data['sizes'] as $value) {
                    $size_quantity = $this->input->post("size-" . $value['size_id'] . "-" . $item_id);
                    if ($size_quantity && $size_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['size_id'], $size_quantity, $item_id, 'size');
                    }
                }
            }
            // print_r($size_quantity);
            if ($data['types']) {
                foreach ($data['types'] as $value) {
                    $type_quantity = $this->input->post("type-" . $value['type_id'] . "-" . $item_id);
                    if ($type_quantity && $type_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['type_id'], $type_quantity, $item_id, 'type');
                    }
                }
            }
            /// print_r($type_quantity);
            if ($data['colours']) {
                foreach ($data['colours'] as $value) {
                    $colour_quantity = $this->input->post("colour-" . $value['colour_id'] . "-" . $item_id);
                    if ($colour_quantity && $colour_quantity > 0) {
                        $this->model_order->insertdraftorderdetail($order_number, $value['colour_id'], $colour_quantity, $item_id, 'colour');
                    }
                }
            }
        }

        // Order created successfully (stock will be deducted when order is completed)
        $this->session->set_flashdata('success', 'Draft order created successfully. Stock will be deducted when order is completed.');

        if (!empty($stock_errors)) {
            $this->session->set_flashdata('stock_errors', $stock_errors);
        }

        redirect(site_url() . 'orders/draftorders');
    }

    public function draftorders() {
        $this->data['all_draft_orders'] = $this->model_order->getAllDraftOrders();
        //  $this->data['products'] = $this->model_order->getdraftproducts();
        $this->load->view('orders/all_draft_orders', $this->data);
    }

    public function completeorders() {
        $this->data['all_complete_orders'] = $this->model_order->getAllCompleteOrders();
        $this->load->view('orders/all_complete_orders', $this->data);
    }

    public function cancelledorders() {
        // Get working cancellation data
        $this->data['all_cancelled_orders'] = $this->model_order->getAllCancelledOrders();
        $this->data['cancellation_stats'] = $this->model_order->getCancellationStats();
        $this->data['cancellation_reasons'] = array(); // Will be implemented later
        $this->load->view('orders/all_cancelled_orders', $this->data);
    }

    public function editorder($order_number) {
        $this->data['order_info'] = $this->model_order->getOrder($order_number);
        $itemids = $this->model_order->getitemidsfromordernumber($order_number);
        foreach ($this->data['order_info'] as $oi) {
            $item_id = $oi['item_id'];

            $attribute_fk = $this->model_order->getitemattributes($item_id);
            $this->data['item_id'] = $item_id;
            //print_r($attribute_fk[0]);
            if ($attribute_fk[0]) {
                foreach ($attribute_fk[0] as $value) {
                    $this->data['grades'][$item_id][] = $this->model_order->getgradedetail($value, '1');
                }
            }
            //  print_r($this->data['grades'][$item_id]);
            if ($attribute_fk[1]) {
                foreach ($attribute_fk[1] as $value) {
                    $this->data['models'][$item_id][] = $this->model_order->getmodeldetail($value, '1');
                }
            }
            if ($attribute_fk[2]) {
                foreach ($attribute_fk[2] as $value) {
                    $this->data['sizes'][$item_id][] = $this->model_order->getsizedetail($value, '1');
                }
            }
            if ($attribute_fk[3]) {
                foreach ($attribute_fk[3] as $value) {
                    $this->data['types'][$item_id][] = $this->model_order->gettypedetail($value, '1');
                }
            }
            if ($attribute_fk[4]) {
                foreach ($attribute_fk[4] as $value) {
                    $this->data['colours'][$item_id][] = $this->model_order->getcolourdetail($value, '1');
                }
            }
            if ($attribute_fk[5]) {
                foreach ($attribute_fk[5] as $value) {
                    $this->data['units'][$item_id][] = $this->model_order->getunitdetail($value, '1');
                }
            }
        }

        // Get existing attribute values from order_detail table
        $this->data['existing_values'] = array();
        foreach ($this->data['order_info'] as $oi) {
            $item_id = $oi['item_id'];
            $order_details = $this->model_order->getorderdetail($order_number, $item_id);

            $this->data['existing_values'][$item_id] = array();
            foreach ($order_details as $detail) {
                $attribute_type = $detail['attribute_type'];
                $attribute_fk = $detail['attribute_fk'];
                $quantity = $detail['attribute_quantity'];

                if (!isset($this->data['existing_values'][$item_id][$attribute_type])) {
                    $this->data['existing_values'][$item_id][$attribute_type] = array();
                }
                $this->data['existing_values'][$item_id][$attribute_type][$attribute_fk] = $quantity;
            }
        }
        $this->data['order_number'] = $order_number;
        $this->data['all_items'] = $this->model_order->getAllItems();
        $this->data["all_brands"] = $this->model_order->getallbrands();
        $this->data['all_shops'] = $this->model_order->getallshops();
        $this->data['all_packing_options'] = $this->model_order->getallpackingoptions();
        // Get current shop ID for the order
        $current_order = $this->model_order->getOrder($order_number);
        if (!empty($current_order)) {
            $this->data['current_shop_id'] = $current_order[0]['shop_id'];
        }

        $this->load->view('orders/editorder', $this->data);
    }

    public function deleteorderdetail() {
        $item_id = $this->input->post('item_id');
        $order_number = $this->input->post('order_number');

        // Check if order is completed (not draft) before restoring stock
        $order_info = $this->model_order->getOrder($order_number);
        if (!empty($order_info) && $order_info[0]['order_status'] === 'confirm') {
            // Restore stock only for completed orders
            $stock_restoration_success = $this->model_order->restoreStockForOrder($order_number);
           
            if (!$stock_restoration_success) {
                $this->session->set_flashdata('stock_errors', ['Failed to restore stock for cancelled order. Please contact administrator.']);
            }
        }

        $this->model_order->deleteorder2($order_number, $item_id);
        $this->model_order->deleteOrderDetails($order_number, $item_id);
    }

    public function draft_order_updater($order_number) {

        $item_ids = array();
        $item_ids = $this->input->post('item_ids');
        $item_qty = $this->input->post('item_qty');
        $item_price = $this->input->post('item_price');
        $packing_quantity = $this->input->post('packing_quantity');
        $bigpolythenelimit = $this->input->post('bigpolythenelimit');


        // Server-side validation for required fields
        $validation_errors = array();

        // Validate shop selection
        $shop_id = $this->input->post('shopid');
        if (empty($shop_id) || $shop_id === '') {
            $validation_errors[] = 'Please select a shop';
        }

        // Validate that items are added
        if (empty($item_ids) || !is_array($item_ids) || count($item_ids) === 0) {
            $validation_errors[] = 'Please add at least one item to the order';
        }

        // Validate quantities
        if (!empty($item_qty) && is_array($item_qty)) {
            foreach ($item_qty as $index => $quantity) {
                if (empty($quantity) || $quantity <= 0) {
                    $validation_errors[] = 'Please enter valid quantities for all items';
                    break;
                }
            }
        } else {
            $validation_errors[] = 'Please enter valid quantities for all items';
        }

        // If validation fails, redirect back with errors
        if (!empty($validation_errors)) {
            $this->session->set_flashdata('validation_errors', $validation_errors);
            redirect(site_url() . 'orders/editorder/' . $order_number);
            return;
        }
      //  print_r($packing_quantity);
      //   print_r($item_ids);
        if (isset($item_ids) && sizeof($item_ids) > 0) {
            $index1=0;   
            foreach ($item_ids as $key => $value) {
                $item_id = $value;
                $quantity = isset($item_qty[$key]) ? $item_qty[$key] : 1;
                $price = isset($item_price[$key]) ? $item_price[$key] : 0;
                $packing_quantity1 = $packing_quantity[$index1];
                $packing_limit = isset($bigpolythenelimit[$key]) ? $bigpolythenelimit[$key] : 0;
             //   echo $packing_quantity1;
             //    echo '----';
              //  echo $index1;
                //echo $packing_quantity[$index];
//echo $packing_quantity.'----';
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
                $packing_id = $this->input->post('packing_option_' . $item_id);
                 
                $this->model_order->updateOrderQuantityAndPrice($shop_id, $order_number, $item_id, $quantity, $price, $packing_id,$packing_quantity1,$packing_limit);
                $index1++;
            }
        } else {
            $this->model_order->deleteorder($order_number);
        }

        // Order updated successfully (stock will be deducted when order is completed)
        $this->session->set_flashdata('success', 'Draft order updated successfully. Stock will be deducted when order is completed.');

       redirect(site_url() . 'orders/draftorders');
    }
    public function showlastprice(){
         $shop_id = $this->input->post('shop_id');
         $item_id = $this->input->post('item_id');
         $order_number = $this->input->post('order_number');
        $lastprice =$this->model_order->showlastprice($shop_id,$item_id,$order_number);
        echo json_encode ($lastprice);
    }

    public function review($order_number) {
        // Get order information
        $this->data['order_info'] = $this->model_order->getOrder($order_number);
        $this->data['order_number'] = $order_number;

        // Get profile details for company information
        $this->data['profile'] = $this->model_order->getprofiledetail();

        // Get packing information for the order
        $this->data['packing_info'] = $this->model_order->getItemPackingInfo($order_number);

        // Get order details for each item
        $this->data['order_details'] = array();
        foreach ($this->data['order_info'] as $oi) {
            $item_id = $oi['item_id'];
            $order_details = $this->model_order->getorderdetail($order_number, $item_id);

            // Get item details
            $item_detail = $this->model_order->getitemdetail($item_id);

            // Organize order details by attribute type
            $organized_details = array();
            foreach ($order_details as $detail) {
                $attribute_type = $detail['attribute_type'];
                $attribute_fk = $detail['attribute_fk'];
                $quantity = $detail['attribute_quantity'];

                // Get attribute details based on type
                switch ($attribute_type) {
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
                    case 'packing':
                        $attribute_detail = $this->model_order->getPackingOptionDetail($attribute_fk);
                        break;
                    default:
                        $attribute_detail = array();
                }

                if (!isset($organized_details[$attribute_type])) {
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

    public function save($order_number) {
        // Check stock availability before completing the order
        $order_info = $this->model_order->getOrder($order_number);
        $stock_errors = array();
        $has_stock_issues = false;
$packing_price=0;
        foreach ($order_info as $oi) {
            $item_id = $oi['item_id'];
            $quantity = $oi['order_quantity'];
            $packing_id = $oi['packing_id'];
            $packing_price = $oi['packing_price'];

            // Check stock availability
            $stock_check = $this->model_order->checkStockAvailability($item_id, $quantity);
            if (!$stock_check['sufficient']) {
                $item_detail = $this->model_order->getitemdetail($item_id);
                $item_name = isset($item_detail[0]['item_name']) ? $item_detail[0]['item_name'] : 'Item';
                $stock_errors[] = "Insufficient stock for {$item_name}. Available: {$stock_check['available']}, Requested: {$stock_check['requested']}";
                $has_stock_issues = true;
            }
            
            $stock_check = $this->model_order->checkPackingStockAvailability($packing_id, $quantity);
            $packing_detail = $this->model_order->getpackingdetail($packing_id);
            if (!$stock_check['sufficient']) {
                $packing_title = isset($packing_detail[0]['packing_title']) ? $packing_detail[0]['packing_title'] : 'Packing';
                $stock_errors[] = "Insufficient1 stock for {$packing_title}. Available: {$stock_check['available']}, Requested: {$stock_check['requested']}";
                $has_stock_issues = true;
            }
            
            // If there are stock issues, don't complete the order
            if ($has_stock_issues) {
                $this->session->set_flashdata('stock_errors', $stock_errors);
                redirect(site_url() . 'orders/review/' . $order_number);
                return;
            }
            
            // Update order status to confirmed
            $this->model_order->updateorder($order_number);
            
            // Deduct stock after successful order completion
            $stock_deduction_success = $this->model_order->deductStockForOrder($order_number);
            $stock_deduction_success = $this->model_order->deductStockForPacking($order_number,$packing_id,$oi['packing_quantity'],$oi['packing_limit']);
            // Insert ledger entry
            $this->model_order->insertOrderLedger($packing_price,$oi['shop_id'], $order_number, $oi['created_date'], $oi['order_price']*$oi['order_quantity'],'', 'xyz', 'debit');
            if (!$stock_deduction_success) {
                
                $this->session->set_flashdata('stock_errors', ['Failed to deduct stock for completed order. Please contact administrator.']);
            } else {
                
                $this->session->set_flashdata('success', 'Order completed successfully and stock deducted.');
            }
            // insert cost logs
$item_detail = $this->model_order->getitemdetail($item_id);
$this->model_order->insertCostLogs($item_id,$oi['order_price'],$order_number,$item_detail[0]['item_price']);
$this->model_order->insertPackingCostLogs($packing_id,$packing_detail['packing_cost'],$order_number,$packing_detail['original_cost']);
            
        }
        redirect(site_url() . 'orders/review/' . $order_number);
    }

    // List all ledger entries for all orders
    public function ledger() {
        $this->data['ledger_entries'] = $this->model_order->getAllOrderLedger();
        $this->data['all_shops'] = $this->model_order->getallshops();
        $this->data['payment_options'] = $this->model_order->getAllPaymentOptions();
        $this->load->view('orders/ledger_crud', $this->data);
    }

    // Add a ledger entry (POST)
    public function add_ledger_entry() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $shop_id = $this->input->post('shop_id');
            $order_number = $this->input->post('order_number');
            $date = $this->input->post('date');
            $type = $this->input->post('type');
            $amount = $this->input->post('amount');
            $payment_method = $this->input->post('payment_method');
            $remarks = $this->input->post('remarks');
            $check_number = $this->input->post('check_number');
            $bank_name = $this->input->post('bank_name');

            // Insert ledger entry
           $ledger_fk =  $this->model_order->insertOrderLedger($shop_id, $order_number, $date, $amount, $payment_method, $remarks, $type);
            if($payment_method == 'Check'){
                 $date =  date('Y-m-d',strtotime($this->input->post('date')));
                 $this->model_order->deleteOrderLedgerDetail($ledger_fk,$shop_id, $order_number, $date,$amount,$check_number,$bank_name);
                 $this->model_order->insertOrderLedgerDetail($ledger_fk,$shop_id, $order_number, $date,$amount,$check_number,$bank_name);
                 // delete and insert order ledger detail
                 
                }
                // Update order with shop_id if not already set
                // if ($shop_id) {
                    //     $this->model_order->updateOrderShop($order_number, $shop_id);
                    // }
                    
                    redirect(site_url('orders/ledger'));
                }
                $this->data['all_shops'] = $this->model_order->getallshops();
                $this->data['payment_options'] = $this->model_order->getAllPaymentOptions();
                $this->load->view('orders/ledger_crud', $this->data);
            }
            
            // Edit a ledger entry (GET for form, POST for update)
            public function edit_ledger_entry($ledger_id) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $shop_id = $this->input->post('shop_id');
                    $order_number = $this->input->post('order_number');
                    
                    $data = array(
                        'order_number' => $order_number,
                        'date' => $this->input->post('date'),
                        'amount' => $this->input->post('amount'),
                        'payment_method' => $this->input->post('payment_method'),
                        'remarks' => $this->input->post('remarks'),
                        'type' => $this->input->post('type'),
                    );
                    $this->model_order->deleteOrderLedgerDetail($ledger_id);
                    $date =  date('Y-m-d',strtotime($this->input->post('check_date')));
                 
                    $this->model_order->insertOrderLedgerDetail($ledger_id,$shop_id, $order_number, $date,$this->input->post('amount'),$this->input->post('check_number'),$this->input->post('bank_name'));
            $this->model_order->updateOrderLedger($ledger_id, $data);

            // Update order with shop_id if provided
            // if ($shop_id) {
            //     $this->model_order->updateOrderShop($order_number, $shop_id);
            // }

            redirect(site_url('orders/edit_ledger_entry/'.$ledger_id));
        }
        $this->data['entry'] = $this->model_order->getOrderLedgerById($ledger_id);
        $this->data['entry_detail'] = $this->model_order->getOrderLedgerDetailById($ledger_id);
        $this->data['all_shops'] = $this->model_order->getallshops();
        $this->data['payment_options'] = $this->model_order->getAllPaymentOptions();
        $this->load->view('orders/ledger_crud', $this->data);
    }

    // Delete a ledger entry
    public function delete_ledger_entry($ledger_id) {
        $this->model_order->deleteOrderLedger($ledger_id);
        redirect(site_url('orders/ledger'));
    }

    // AJAX method to update shop for an order
    public function update_shop_ajax() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_number = $this->input->post('order_number');
            $shop_id = $this->input->post('shop_id');

            if ($order_number && $shop_id) {
                $success = $this->model_order->updateOrderShop($order_number, $shop_id);

                if ($success) {
                    echo json_encode(array('success' => true, 'message' => 'Shop updated successfully'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Failed to update shop'));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Invalid order number or shop ID'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
        }
    }
    /**
     * Cancel an order via AJAX with reason
     */
    public function cancel_order_ajax() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
            return;
        }

        $order_number = $this->input->post('order_number');
        $cancellation_reason = $this->input->post('cancellation_reason');

        if (!$order_number) {
            echo json_encode(array('success' => false, 'message' => 'Order number is required'));
            return;
        }

        // Check if order exists
        $order_info = $this->model_order->getOrder($order_number);
        if (empty($order_info)) {
            echo json_encode(array('success' => false, 'message' => 'Order not found'));
            return;
        }

        // Check if order is already cancelled (basic check)
        if ($order_info[0]['order_status'] === 'draft' && $order_info[0]['modified_date'] > $order_info[0]['created_date']) {
            echo json_encode(array('success' => false, 'message' => 'Order appears to have been cancelled already'));
            return;
        }

        // Attempt to cancel the order
        $cancellation_success = $this->model_order->cancelOrder($order_number, $cancellation_reason);
        
        if ($cancellation_success) {
            // Restore stock for the cancelled order
            $stock_restoration_success = $this->model_order->restoreStockForOrder($order_number);
             $stock_restoration_success = $this->model_order->restorePackingStockForOrder($order_number);
            
            if ($stock_restoration_success) {
                // Update stock restoration status
                $this->model_order->updateStockRestorationStatus($order_number);
                echo json_encode(array('success' => true, 'message' => 'Order cancelled successfully and stock restored'));
            $this->model_order->updateOrderLedgerNew($order_number);
            } else {
                echo json_encode(array('success' => true, 'message' => 'Order cancelled but failed to restore stock. Please contact administrator.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to cancel order'));
        }
    }

}

?>
