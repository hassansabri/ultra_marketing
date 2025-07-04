<?php
/**
 *  @property m_login $model_login
* @property CI_Session $session
 * @property CI_Input $input
 *  @property m_items $model_items
 *  * @property m_categries $model_category
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

 class  items extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("items/m_items", "model_item");
              $this->load->model("categories/m_categories", "model_category");

    }    
    public function index() {
 
        $this->data["all_items"] = $this->model_item->getallitems();
        $this->load->view("items/all_items", $this->data);
        
    }
public function additem(){
    $this->data["update"] = "no";   
         $this->data["all_categories"] = $this->model_category->getallcategories();    
    $this->load->view('items/add_new_item', $this->data);
}
public function addnewitem(){
    
           $sdat['item_name'] = $this->input->post('item_name');
           $sdat['item_price'] = $this->input->post('item_price');
           $sdat['item_code'] = $this->input->post('item_code');
           $sdat['item_weight'] = $this->input->post('item_weight');
           $sdat['item_cat_fk'] = $this->input->post('category_id');
           $sdat['item_description'] = $this->input->post('item_description');
           $sdat['item_brand_fk'] = $this->input->post('brand_id');
           $sdat['item_expire_date'] =  date('Y-m-d',strtotime($this->input->post('item_expire_date')));
        
            $this->model_item->addnewitems($sdat);
           redirect(site_url() . 'items/index');

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
         public function submititem(){
            $sdat['item_cat_fk'] =  $this->input->post('category_id');
           redirect(site_url() . 'items/index');
         }
         
         public function edititem($item_id=false){
            $this->data["update"]  = "no";
            
            $this->data["all_categories"] = $this->model_category->getallcategories();
             $this->data["all_brands"] = $this->model_item->getallbrands();
             $this->data["item_detail"] =      $this->model_item->getitemdetail($item_id);
               $this->load->view('items/edititem', $this->data);
         }
         public function updateitem($item_id=false){
             $sdat['item_name'] = $this->input->post('item_name');
             $sdat['item_code'] = $this->input->post('item_code');
             $sdat['item_weight'] = $this->input->post('item_weight');
             $sdat['item_description'] = $this->input->post('item_description');
             $sdat['item_brand_fk'] = $this->input->post('brand_id');
           $sdat['item_cat_fk'] =  $this->input->post('parent_id');
            $sdat['item_expire_date'] =  date('Y-m-d',strtotime($this->input->post('item_expire_date')));
            $this->model_item->updateitem($sdat,$item_id);
                redirect(site_url() . '/items/edititem/'.$item_id);
         }
          public function changestatus() {
        $item_id = $this->input->post("item_id");
        $status = $this->input->post("status");
        if ($item_id != "") {
            $data = array(
                "item_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_item->changestatus($item_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
 }
?>