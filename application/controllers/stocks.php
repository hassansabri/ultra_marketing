<?php
/**
 *  @property m_login $model_login
 * @property m_users $model_stock
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

 class  stocks extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("stocks/m_stocks", "model_stock");

    }    
    public function index(){
        $this->data['all_items']=$this->model_stock->getallitems();
        $this->load->view('stocks/getstock',$this->data);
    }
    public function getlogs(){
        $this->data['item_fk']=$this->input->post('item_id');
        $this->data['brand_fk']=$this->input->post('brand');
        $this->data['grade_fk']=$this->input->post('grade');
        $this->data['model_fk']=$this->input->post('model');
        $this->data['size_fk']=$this->input->post('size');
        $this->data['type_fk']=$this->input->post('type');
        $this->data['colour_fk']=$this->input->post('colour');
        $this->data['unit_fk']=$this->input->post('unit');
        $this->data['all_logs']=$this->model_stock->getlogs($this->data);
         $this->load->view('stocks/logs',$this->data,true);
    }
    public function addstock(){
         $this->data['item_fk']=$this->input->post('item_id');
        $this->data['brand_fk']=$this->input->post('brand');
        $this->data['grade_fk']=$this->input->post('grade');
        $this->data['model_fk']=$this->input->post('model');
        $this->data['size_fk']=$this->input->post('size');
        $this->data['type_fk']=$this->input->post('type');
        $this->data['colour_fk']=$this->input->post('colour');
        $this->data['unit_fk']=$this->input->post('unit');
        $this->data['balance']=$this->input->post('balance');
        $this->data['stock_type'] = $this->input->post('stock_type');
           $this->data['entry_date'] =  date('Y-m-d',strtotime($this->input->post('entry_date')));
        $this->model_stock->addstock($this->data);
        $this->ldata['all_logs']=$this->model_stock->getlogs($this->data);
        
        // update logs
       $this->ldata['current_ballance']=$this->model_stock->getcurrentballance($this->data);
     $log_view = $this->load->view('stocks/logs_values',$this->ldata,true);
     $rdata=array(
        'logs'=>$log_view
     );
     echo json_encode($rdata);
    }
    public function checkstock(){
        $this->data['item_fk']=$this->input->post('item_id');
        $this->data['brand_fk']=$this->input->post('brand');
        $this->data['grade_fk']=$this->input->post('grade');
        $this->data['model_fk']=$this->input->post('model');
        $this->data['size_fk']=$this->input->post('size');
        $this->data['type_fk']=$this->input->post('type');
        $this->data['colour_fk']=$this->input->post('colour');
        $this->data['unit_fk']=$this->input->post('unit');
     $stock_arr = $this->model_stock->checkstock($this->data);
     $this->ldata['all_logs']=$this->model_stock->getlogs($this->data);
     $this->ldata['current_ballance']=$this->model_stock->getcurrentballance($this->data);
     $log_view = $this->load->view('stocks/logs_values',$this->ldata,true);
     if(!isset($stock_arr[0]['balance'])){
$stock=0;
     }else{
        $stock=$stock_arr[0]['balance'];
     }
     $rdata=array(
        'balance'=>$stock,
        'logs'=>$log_view
     );
     echo json_encode($rdata);
    }
    public function getallstock(){
    $item_id=    $this->input->post('item_id');
            $this->data['itemid']=$item_id;
        $itemid=$item_id;
      $this->data["all_brands"] = $this->model_stock->getbrands('1');
       $this->data['get_item_brands']=$this->model_stock->getitembrands($itemid);

       $this->data["all_grades"] = $this->model_stock->getgrades('1');
       $this->data['get_item_grades']=$this->model_stock->getitemgrades($itemid);

       $this->data["all_models"] = $this->model_stock->getmodels('1');
       $this->data['get_item_models']=$this->model_stock->getitemmodels($itemid);

       $this->data["all_sizes"] = $this->model_stock->getsizes('1');
       $this->data['get_item_sizes'] = $this->model_stock->getitemsizes($itemid);

       $this->data["all_types"] = $this->model_stock->gettypes('1');
       $this->data['get_item_types'] = $this->model_stock->getitemtypes($itemid);

       $this->data["all_colours"] = $this->model_stock->getcolours('1');
       $this->data['get_item_colours'] = $this->model_stock->getitemcolours($itemid);

       $this->data["all_units"] = $this->model_stock->getunits('1');
       $this->data['get_item_units'] = $this->model_stock->getitemunits($itemid);
        $this->data['item_fk']=$this->input->post('item_id');
        $this->data['brand_fk']=$this->input->post('brand');
        $this->data['grade_fk']=$this->input->post('grade');
        $this->data['model_fk']=$this->input->post('model');
        $this->data['size_fk']=$this->input->post('size');
        $this->data['type_fk']=$this->input->post('type');
        $this->data['colour_fk']=$this->input->post('colour');
        $this->data['unit_fk']=$this->input->post('unit');
       $this->data['all_logs'] = $this->model_stock->getlogs($this->data);
    echo   $this->load->view('stocks/update_stock',$this->data,true);

    }
    public function getstock() {
        $this->data['itemid']=0;
  $this->data["all_brands"] = $this->model_stock->getbrands('1');
       

       $this->data["all_grades"] = $this->model_stock->getgrades('1');


       $this->data["all_models"] = $this->model_stock->getmodels('1');
       

       $this->data["all_sizes"] = $this->model_stock->getsizes('1');
       

       $this->data["all_types"] = $this->model_stock->gettypes('1');
       

       $this->data["all_colours"] = $this->model_stock->getcolours('1');
       $this->data["all_units"] = $this->model_stock->getunits('1');
       

        $this->data["all_stock"] = $this->model_stock->getallitemsstock();
       // $this->load->view("grades/all_grades", $this->data);
        
    }
 }
?>