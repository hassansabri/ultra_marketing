<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 *  @property m_users $model_orders
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

 class shops extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("shops/m_shop", "model_shops");
            $this->load->model("orders/m_orders", "model_orders");

    }    
    public function index() {
 
        $this->data["all_shops"] = $this->model_shops->getallshops();
        $this->load->view("shops/all_shops", $this->data);
        
    }
public function addnewsupplier(){
    $this->data["update"] = "no";   
    $this->load->view('shops/add_new_supplier', $this->data);
}
public function addnewcrediter(){
    $this->data["update"] = "no";   
    $this->load->view('shops/add_new_crediter', $this->data);
}
public function getstates(){
   $country_id=0;
    $country_id = $this->input->post('country_id');
 //     $html='<select id="statesid" name="state_name">';
       $html='<option>Please Select</option>';

       $states = getStates($country_id); 
       if($states){
            foreach($states as $value){
                $html .='<option value="'.$value["state_id"].'">'.$value["state_name"].'</option>';
                                    }
       }
   // $html .='</select>';
        echo json_encode($html);
   
                        }
 
     public function getcities(){
   $country_id=0;
    $country_id = $this->input->post('country_id');
    $state_id = $this->input->post('state_id');
    //     $html='<select id="statesid" name="state_name">';
       $html='<option>Please Select</option>';

       $states = getcities($country_id,$state_id); 
       if($states){
            foreach($states as $value){
                $html .='<option value="'.$value["city_id"].'">'.$value["city_name"].'</option>';
            
                                    }
       }
   // $html .='</select>';
        echo json_encode($html);
   
                        }
         public function addshop(){
           $sdat['shop_name'] = $this->input->post('shop_name');
           $sdat['shop_owner'] =  $this->input->post('shop_owner');
            $sdat['shop_email'] = $this->input->post('shop_email');
            $sdat['shop_number'] = $this->input->post('shop_number');
            $sdat['shop_country'] = $this->input->post('country_id');
            $sdat['shop_state'] = $this->input->post('state');
            $sdat['shop_city'] = $this->input->post('city');
            $sdat['shop_latitude'] = $this->input->post('shop_latitude');
            $sdat['shop_longitude'] = $this->input->post('shop_longitude');
            $sdat['shop_address'] = $this->input->post('shop_address');
            $sdat['shop_type'] = $this->input->post('shop_type');
           $this->model_shops->addnewshop($sdat);
           redirect(site_url() . 'shops/index/addnew'.$sdat['shop_type']);
         }
         public function suppliers(){
            $this->data["all_shops"] = $this->model_shops->getallsuppliers();
        $this->load->view("shops/all_shops", $this->data);
         }
         public function crediters(){
            $this->data["all_shops"] = $this->model_shops->getallcrediters();
        $this->load->view("shops/all_shops", $this->data);
         }
         
         public function editshop($shop_id=false){
            $this->data["update"]  = "no";
             $this->data["shop_detail"] =      $this->model_shops->getshopdetail($shop_id);
               $this->load->view('shops/editshop', $this->data);
         }
         public function updateshop($shop_id=false){
             $sdat['shop_name'] = $this->input->post('shop_name');
           $sdat['shop_owner'] =  $this->input->post('shop_owner');
            $sdat['shop_email'] = $this->input->post('shop_email');
            $sdat['shop_number'] = $this->input->post('shop_number');
            $sdat['shop_country'] = $this->input->post('country_id');
            $sdat['shop_state'] = $this->input->post('state');
            $sdat['shop_city'] = $this->input->post('city');
            $sdat['shop_latitude'] = $this->input->post('shop_latitude');
            $sdat['shop_longitude'] = $this->input->post('shop_longitude');
            $sdat['shop_address'] = $this->input->post('shop_address');
            $this->model_shops->updateshop($sdat,$shop_id);
                redirect(site_url() . '/shops/editshop/'.$shop_id);
         }
  public function changestatus() {
        $shop_id = $this->input->post("shop_id");
        $status = $this->input->post("status");
        if ($shop_id != "") {
            $data = array(
                "shop_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_shops->changestatus($shop_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
    public function ledger($shop_id) {
        
        $this->data['shop_ledger'] = $this->model_orders->getShopLedger($shop_id);
        $this->data['shop_detail'] = $this->model_shops->getshopdetail($shop_id);
        $this->load->view('shops/shop_ledger', $this->data);
    }
    public function getinvoices(){
    $shop_id = $this->input->post('shop_id');
   $invoices =  $this->model_shops->getinvoices($shop_id);
      $html='<option>Please Select</option>';
       if($invoices){
            foreach($invoices as $value){
                $html .='<option value="'.$value["order_number"].'">'.$value["order_number"].'</option>';
                                    }
       }
        echo json_encode($html);
    }
        }
    
?>
