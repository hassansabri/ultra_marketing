<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_size
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

 class  sizes extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("attributes/m_sizes", "model_size");

    }    
    public function index() {
 
        $this->data["all_sizes"] = $this->model_size->getallsizes();
        $this->load->view("sizes/all_sizes", $this->data);
        
    }                       public function addsize(){
    $this->data["update"] = "no";   
    $this->load->view('sizes/add_size', $this->data);
}
         public function submitsize(){
           $sdat['size_title'] = $this->input->post('size_name');
           $this->model_size->adddsize($sdat);
           redirect(site_url() . 'sizes/index');
         }
         
         public function editsize($size_id=false){
            $this->data["update"]  = "no";
             $this->data["size_detail"] =      $this->model_size->getsizedetail($size_id);
            //  print_r($this->data["size_detail"]);
            //  exit;
               $this->load->view('sizes/editsize', $this->data);
         }
         public function updatesize($size_id=false){
             $sdat['size_title'] = $this->input->post('size_name');
            $this->model_size->updatesize($sdat,$size_id);
                redirect(site_url() . '/sizes/editsize/'.$size_id);
         }
          public function changestatus() {
        $size_id = $this->input->post("size_id");
        $status = $this->input->post("status");
        if ($size_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_size->changestatus($size_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>