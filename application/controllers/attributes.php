<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_shops
 * @property m_users $model_category
 *  @property m_attributes $model_attributs
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

 class   attributes extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            $this->load->model("categories/m_categories", "model_category");
               $this->load->model("attributes/m_attributes", "model_attributes");

    }    
    public function index() {
 
      
        $this->load->view("attributes/all_attributes");
        
    }
    public function submitattribute(){
      $item_id =   $this->input->post('itemid');
        $data["all_brands"]=   $this->input->post('brand_id');
  $this->model_attributes->submitattributes($data['all_brands'],$item_id,'brand');
     $data["all_models"]=   $this->input->post('model_id');
        $this->model_attributes->submitattributes($data['all_models'],$item_id,'model');
     $data["all_grades"]=   $this->input->post('grade_id');
$this->model_attributes->submitattributes($data['all_grades'],$item_id,'grade');
     $data["all_sizes"]=   $this->input->post('size_id');
         $this->model_attributes->submitattributes($data['all_sizes'],$item_id,'size');
      $data["all_types"]=   $this->input->post('type_id');
           $this->model_attributes->submitattributes($data['all_types'],$item_id,'type');

//  $data['proc'] = $this->input->post('proc');
$I=0;
for($i=0; $i<sizeof($data); $i++){
   
 
}
    
    }
    public function add_new_attribute(){
        $this->data['itemid'] = $itemid= $this->input->post('item_id');
       $this->data["all_brands"] = $this->model_attributes->getbrands('1');
       $this->data['get_item_brands']=$this->model_attributes->getitembrands($itemid);

       $this->data["all_grades"] = $this->model_attributes->getgrades('1');
       $this->data['get_item_grades']=$this->model_attributes->getitemgrades($itemid);

       $this->data["all_models"] = $this->model_attributes->getmodels('1');
       $this->data['get_item_models']=$this->model_attributes->getitemmodels($itemid);

       $this->data["all_sizes"] = $this->model_attributes->getsizes('1');
       $this->data['get_item_sizes'] = $this->model_attributes->getitemsizes($itemid);

       $this->data["all_types"] = $this->model_attributes->gettypes('1');
       $this->data['get_item_types'] = $this->model_attributes->getitemtypes($itemid);

      
        $html =  $this->load->view('attributes/add_new_attribute',$this->data,true);
         
        echo json_encode($html);
    }
    public function addcategory(){
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
           $sdat['category_name'] = $this->input->post('category_name');
           $sdat['parent_id'] =  $this->input->post('parent_id');
           $this->model_category->adddcategory($sdat);
           redirect(site_url() . 'categories/index');
         }
         
         public function editcategory($category_id=false){
            $this->data["update"]  = "no";
            $this->data["all_categories"] = $this->model_category->getallcategories();
             $this->data["category_detail"] =      $this->model_category->getcategorydetail($category_id);
               $this->load->view('categories/editcategory', $this->data);
         }
         public function updatecategory($category_id=false){
             $sdat['category_name'] = $this->input->post('category_name');
           $sdat['parent_id'] =  $this->input->post('parent_id');
            $this->model_category->updatecategory($sdat,$category_id);
                redirect(site_url() . '/categories/editcategory/'.$category_id);
         }
          public function changestatus() {
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