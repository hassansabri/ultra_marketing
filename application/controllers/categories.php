<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
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

 class  categories extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("categories/m_categories", "model_category");

    }    
    public function index() {
 if (!has_permission_type('Categories','view',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
        $this->data["all_categories"] = $this->model_category->getallcategories();
        $this->load->view("categories/all_categories", $this->data);
        
    }
public function addcategory(){
    if (!has_permission_type('Categories','create',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
    $this->data["update"] = "no";   
    $this->data["all_categories"] = $this->model_category->getallcategories('1');
    
    $this->load->view('categories/add_new_category', $this->data);
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
         public function submitcategory(){
            if (!has_permission_type('Categories','create',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
           $sdat['category_name'] = $this->input->post('category_name');
           $sdat['parent_id'] =  $this->input->post('parent_id');
           $this->model_category->adddcategory($sdat);
           redirect(site_url() . 'categories/index');
         }
         
         public function editcategory($category_id=false){
            if (!has_permission_type('Categories','edit',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
            $this->data["update"]  = "no";
            $this->data["all_categories"] = $this->model_category->getallcategories();
             $this->data["category_detail"] =      $this->model_category->getcategorydetail($category_id);
               $this->load->view('categories/editcategory', $this->data);
         }
         public function updatecategory($category_id=false){
            if (!has_permission_type('Categories','edit',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
             $sdat['category_name'] = $this->input->post('category_name');
           $sdat['parent_id'] =  $this->input->post('parent_id');
            $this->model_category->updatecategory($sdat,$category_id);
                redirect(site_url() . '/categories/editcategory/'.$category_id);
         }
          public function changestatus() {
             if (!has_permission_type('Categories','delete',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
        $category_id = $this->input->post("category_id");
        $status = $this->input->post("status");
        if ($category_id != "") {
            $data = array(
                "category_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_category->changestatus($category_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>