<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_type
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

 class  types extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            $this->load->model("attributes/m_types", "model_type");

    }    
    public function index() {
 
        $this->data["all_types"] = $this->model_type->getalltypes();
        $this->load->view("types/all_types", $this->data);
        
    }                       public function addtype(){
    $this->data["update"] = "no";   
    $this->load->view('types/add_type', $this->data);
}
         public function submittype(){
           $sdat['type_title'] = $this->input->post('type_name');
           $this->model_type->adddtype($sdat);
           redirect(site_url() . 'types/index');
         }
         
         public function edittype($type_id=false){
            $this->data["update"]  = "no";
             $this->data["type_detail"] =      $this->model_type->gettypedetail($type_id);
            //  print_r($this->data["type_detail"]);
            //  exit;
               $this->load->view('types/edittype', $this->data);
         }
         public function updatetype($type_id=false){
             $sdat['type_title'] = $this->input->post('type_name');
            $this->model_type->updatetype($sdat,$type_id);
                redirect(site_url() . '/types/edittype/'.$type_id);
         }
          public function changestatus() {
        $type_id = $this->input->post("type_id");
        $status = $this->input->post("status");
        if ($type_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_type->changestatus($type_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>