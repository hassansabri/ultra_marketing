<?php
/**
 *  @property m_login $model_login
 * @property orders/m_order $model_order
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

 class orders extends CI_Controller {

    //put your code here
        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('logged_in'))redirect('login');
            $this->load->model("orders/m_orders", "model_order");

    }    
    public function index(){
        $this->data['all_items']=$this->model_order->getAllItems();
        $this->load->view('orders/new_order',$this->data);
    }
    public function show_invoice() {
        $this->data['profile']=$this->model_order->getprofiledetail();
                $this->load->view("orders/invoice",$this->data);
        
        }
        
}
    
?>
