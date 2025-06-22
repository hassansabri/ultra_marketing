<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_model
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

 class  models extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("attributes/m_models", "model_model");

    }    
    public function index() {
 
        $this->data["all_models"] = $this->model_model->getallmodels();
        $this->load->view("model/all_models", $this->data);
        
    }                       public function addmodel(){
    $this->data["update"] = "no";   
    $this->load->view('model/add_model', $this->data);
}
         public function submitmodel(){
           $sdat['model_title'] = $this->input->post('model_name');
           $this->model_model->adddmodel($sdat);
           redirect(site_url() . 'models/index');
         }
         
         public function editmodel($model_id=false){
            $this->data["update"]  = "no";
             $this->data["model_detail"] =      $this->model_model->getmodeldetail($model_id);
               $this->load->view('model/editmodel', $this->data);
         }
         public function updatemodel($model_id=false){
             $sdat['model_title'] = $this->input->post('model_name');
            $this->model_model->updatemodel($sdat,$model_id);
                redirect(site_url() . '/models/editmodel/'.$model_id);
         }
          public function changestatus() {
        $model_id = $this->input->post("model_id");
        $status = $this->input->post("status");
        if ($model_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_model->changestatus($model_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>