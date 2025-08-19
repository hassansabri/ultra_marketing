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
}