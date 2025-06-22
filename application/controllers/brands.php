<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_brand
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

 class  brands extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("attributes/m_brands", "model_brand");

    }    
    public function index() {
 
        $this->data["all_brands"] = $this->model_brand->getallbrands();
        $this->load->view("brands/all_brands", $this->data);
        
    }                       public function addbrand(){
    $this->data["update"] = "no";   
    $this->load->view('brands/add_brand', $this->data);
}
         public function submitbrand(){
           $sdat['brand_title'] = $this->input->post('brand_name');
           $this->model_brand->adddbrand($sdat);
           redirect(site_url() . 'brands/index');
         }
         
         public function editbrand($brand_id=false){
            $this->data["update"]  = "no";
             $this->data["brand_detail"] =      $this->model_brand->getbranddetail($brand_id);
            //  print_r($this->data["brand_detail"]);
            //  exit;
               $this->load->view('brands/editbrand', $this->data);
         }
         public function updatebrand($brand_id=false){
             $sdat['brand_title'] = $this->input->post('brand_name');
            $this->model_brand->updatebrand($sdat,$brand_id);
                redirect(site_url() . '/brands/editbrand/'.$brand_id);
         }
          public function changestatus() {
        $brand_id = $this->input->post("brand_id");
        $status = $this->input->post("status");
        if ($brand_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_brand->changestatus($brand_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>