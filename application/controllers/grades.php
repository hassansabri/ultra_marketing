<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 * @property m_users $model_grade
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

 class  grades extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("attributes/m_grades", "model_grade");

    }    
    public function index() {
 
        $this->data["all_grades"] = $this->model_grade->getallgrades();
        $this->load->view("grades/all_grades", $this->data);
        
    }                       public function addgrade(){
    $this->data["update"] = "no";   
    $this->load->view('grades/add_grade', $this->data);
}
         public function submitgrade(){
           $sdat['grade_title'] = $this->input->post('grade_name');
           $this->model_grade->adddgrade($sdat);
           redirect(site_url() . 'grades/index');
         }
         
         public function editgrade($grade_id=false){
            $this->data["update"]  = "no";
             $this->data["grade_detail"] =      $this->model_grade->getgradedetail($grade_id);
            //  print_r($this->data["grade_detail"]);
            //  exit;
               $this->load->view('grades/editgrade', $this->data);
         }
         public function updategrade($grade_id=false){
             $sdat['grade_title'] = $this->input->post('grade_name');
            $this->model_grade->updategrade($sdat,$grade_id);
                redirect(site_url() . '/grades/editgrade/'.$grade_id);
         }
          public function changestatus() {
        $grade_id = $this->input->post("grade_id");
        $status = $this->input->post("status");
        if ($grade_id != "") {
            $data = array(
                "status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_grade->changestatus($grade_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>