<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_colour
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

 class  colours extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            $this->load->model("attributes/m_colours", "model_colour");

    }    
    public function index() {
 
        $this->data["all_colours"] = $this->model_colour->getallcolours();
        $this->load->view("colours/all_colours", $this->data);
        
    }                       public function addcolour(){
    $this->data["update"] = "no";   
    $this->load->view('colours/add_colour', $this->data);
}
         public function submitcolour(){
           $sdat['colour_title'] = $this->input->post('colour_name');
           $this->model_colour->adddcolour($sdat);
           redirect(site_url() . 'colours/index');
         }
         
         public function editcolour($colour_id=false){
            $this->data["update"]  = "no";
             $this->data["colour_detail"] =      $this->model_colour->getcolourdetail($colour_id);
            //  print_r($this->data["colour_detail"]);
            //  exit;
               $this->load->view('colours/editcolour', $this->data);
         }
         public function updatecolour($colour_id=false){
             $sdat['colour_title'] = $this->input->post('colour_name');
            $this->model_colour->updatecolour($sdat,$colour_id);
                redirect(site_url() . '/colours/editcolour/'.$colour_id);
         }
          public function changestatus() {
        $colour_id = $this->input->post("colour_id");
        $status = $this->input->post("status");
        if ($colour_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_colour->changestatus($colour_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>