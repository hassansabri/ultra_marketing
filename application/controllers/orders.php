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
        $this->data["all_brands"] = $this->model_order->getallbrands();
        $this->load->view('orders/new_order',$this->data);
    }
    public function show_invoice() {
        $this->data['profile']=$this->model_order->getprofiledetail();
                $this->load->view("orders/invoice",$this->data);
        
        }
        public function initorder(){
           $item_id= $this->input->post('item_id');
           $attribute_fk=$this->model_order->getitemattributes($item_id);
           $this->data = array();
           // print_r($attribute_fk);
           if($attribute_fk){
                      foreach($attribute_fk[0] as $value2){
                          $this->data['brands'][]=$this->model_order->getbranddetail($value2,'1');
          
                      }
          }
// print_r($attribute_fk[1]);
if($attribute_fk[1]){
  foreach($attribute_fk[1] as $value){
                        $this->data['grades'][]=$this->model_order->getgradedetail($value,'1');
             }
          }
          
          if($attribute_fk[2]){
              foreach($attribute_fk[2] as $value){
                $this->data['models'][]=$this->model_order->getmodeldetail($value,'1');
                }
              }
              if($attribute_fk[3]){
                foreach($attribute_fk[3] as $value){
                  $this->data['sizes'][]=$this->model_order->getsizedetail($value,'1');
                }
              }
              if($attribute_fk[4]){
                foreach($attribute_fk[4] as $value){
                  $this->data['types'][]=$this->model_order->gettypedetail($value,'1');
                }
              }
              if($attribute_fk[5]){
                foreach($attribute_fk[5] as $value){
                  $this->data['colours'][]=$this->model_order->getcolourdetail($value,'1');
                }
              }
              if($attribute_fk[6]){
                foreach($attribute_fk[6] as $value){
                  $this->data['units'][]=$this->model_order->getunitdetail($value,'1');
                }
              }
              $this->data["item_id"] =  $item_id;
              $this->data["item_detail"] =  $this->model_order->getitemdetail($item_id);
            $html=$this->load->view('orders/gen_order',$this->data,true);
           echo json_encode($html); 
        }
        public function allattributes($item_id=false){
           $attribute_fk=$this->model_order->getitemattributes($item_id);
           $this->data = array();
if($attribute_fk[1]){
  foreach($attribute_fk[1] as $value){
                        $this->data['grades'][]=$this->model_order->getgradedetail($value,'1');
             }
          }
          
          if($attribute_fk[2]){
              foreach($attribute_fk[2] as $value){
                $this->data['models'][]=$this->model_order->getmodeldetail($value,'1');
                }
              }
              if($attribute_fk[3]){
                foreach($attribute_fk[3] as $value){
                  $this->data['sizes'][]=$this->model_order->getsizedetail($value,'1');
                }
              }
              if($attribute_fk[4]){
                foreach($attribute_fk[4] as $value){
                  $this->data['types'][]=$this->model_order->gettypedetail($value,'1');
                }
              }
              if($attribute_fk[5]){
                foreach($attribute_fk[5] as $value){
                  $this->data['colours'][]=$this->model_order->getcolourdetail($value,'1');
                }
              }
              if($attribute_fk[6]){
                foreach($attribute_fk[6] as $value){
                  $this->data['units'][]=$this->model_order->getunitdetail($value,'1');
                }
              }
              
              $this->data["item_detail"] =  $this->model_order->getitemdetail($item_id);
              return $this->data;
        }
        public function draft_order(){
         $order_number =  $this->input->post('order_number');
         $item_ids =  $this->input->post('item_ids');
         foreach($item_ids as $value){
        echo  $item_id=$value;
           $data=$this->allattributes($item_id);
           if($data['grades']){
            $grade_quantity=array();
             foreach($data['grades'] as $value){
               $grade_quantity[]=$this->input->post("grade-". $value['grade_id'] ."-". $item_id);
             }
           }
           print_r($grade_quantity);
           if($data['models']){
            $model_quantity=array();
             foreach($data['models'] as $value){
               $model_quantity[]=$this->input->post("model-". $value['model_id'] ."-". $item_id);
             }
           }
           print_r($model_quantity);
           if($data['sizes']){
            $size_quantity=array();
             foreach($data['sizes'] as $value){
               $size_quantity[]=$this->input->post("size-". $value['size_id'] ."-". $item_id);
             }
           }
           print_r($size_quantity);
           if($data['types']){
             $type_quantity=array();
             foreach($data['types'] as $value){
               $type_quantity[]=$this->input->post("type-". $value['type_id'] ."-". $item_id);
             }
           }
           print_r($type_quantity);
           if($data['colours']){
             $colour_quantity=array();
             foreach($data['colours'] as $value){
               $colour_quantity[]=$this->input->post("colour-". $value['colour_id'] ."-". $item_id);
             }
           }
           print_r($colour_quantity);
           // if($grades){}
           echo "<br>";
         }
         }
        
}
    
?>
