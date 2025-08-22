<?php
 class  packing_stocks extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("stocks/m_packing_stocks", "model_packingstock");

    }  
     public function index(){
        $this->data['all_packings']=$this->model_packingstock->getallpackings();
        $this->load->view('stocks/getpackingstock',$this->data);
    }
    public function getallstock(){
    $packing_id=    $this->input->post('packing_id');
            $this->data['packing_fk']=$packing_id;
        $itemid=$packing_id;
      

       
       $this->data['all_logs'] = $this->model_packingstock->getlogs($this->data);
       $this->data['current_ballance']=$this->model_packingstock->getcurrentballance($this->data);
    echo   $this->load->view('stocks/update_packingstock',$this->data,true);

    }
      public function addstock(){
         $this->data['packing_fk']=$this->input->post('packing_id');
        $this->data['balance']=$this->input->post('balance');
        $this->data['stock_type'] = $this->input->post('stock_type');
           $this->data['entry_date'] =  date('Y-m-d',strtotime($this->input->post('entry_date')));
        $this->model_packingstock->addstock($this->data);
        $this->ldata['all_logs']=$this->model_packingstock->getlogs($this->data);
        
        // update logs
       $this->ldata['current_ballance']=$this->model_packingstock->getcurrentballance($this->data);
     $log_view = $this->load->view('stocks/packing_logs_values',$this->ldata,true);
     $rdata=array(
        'logs'=>$log_view
     );
     echo json_encode($rdata);
    }
    public function checkstock(){
        $this->data['packing_fk']=$this->input->post('packing_id');
     $stock_arr = $this->model_packingstock->checkstock2($this->data);
     $this->ldata['all_logs']=$this->model_packingstock->getlogs($this->data);
     $this->ldata['current_ballance']=$this->model_packingstock->getcurrentballance($this->data);
     $log_view = $this->load->view('stocks/packing_logs_values',$this->ldata,true);
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
}