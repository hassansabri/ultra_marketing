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
           $item_id=$value;
           $data=$this->allattributes($item_id);
           if($data['grades']){
             $this->model_order->insertdraftorder($order_number,$item_id);
            $grade_quantity=0;
             foreach($data['grades'] as $value){
           $value['grade_id'];
              $grade_quantity=$this->input->post("grade-". $value['grade_id'] ."-". $item_id);
               $this->model_order->insertdraftorderdetail($order_number,$value['grade_id'],$grade_quantity,$item_id,'grade');
             }
           }
        //   print_r($grade_quantity);
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
           
         }
         redirect(site_url() . 'orders/draftorders');
         }
        public function draftorders(){
          $this->data['all_draft_orders']=$this->model_order->getAllDraftOrders();
          //  $this->data['products'] = $this->model_order->getdraftproducts();
           $this->load->view('orders/all_draft_orders',$this->data);
        }
        public function editorder($order_number){
          $this->data['order_info'] = $this->model_order->getOrder($order_number);
           $itemids = $this->model_order->getitemidsfromordernumber($order_number);
              foreach($itemids as $value){
            $item_id=$value['item_fk'];
                $attribute_fk=$this->model_order->getitemattributes($item_id);
                print_r($attribute_fk);
                  $this->data['item_id']=$item_id;
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
              
          }
          
      //   $att=array(
          
      //     'gradesr/getgradedetail',
      //      'modelsr/getmodeldetail',
      //      'sizesr/getsizedetail',
      //      'typesr/gettypedetail',
      //     'coloursr/getcolourdetail',
      //     'unitsr/getunitdetail',
      //   );
      // $index=0;  
      //     foreach($this->data['order_info'] as $value){
      //       $item_fk=$value['item_id'];
      //       foreach($value['order_detail'] as $value2){  
      //          $attribute_fk=$this->model_order->getitemattributes($item_fk);
      //         $str1=$att[$index];
      //         $arr = explode('/',$str1);
      //          $variabel=$arr[0];
      //         $function = $arr[1];
      //           $this->data[$variabel][$item_fk][]=$this->model_order->$function($value2['attribute_fk'],'1');
      //         }
      //         $index++;
              // continue;
         
     //   print_r($this->data);
          // }
          $this->data['order_number'] = $order_number;

          $this->load->view('orders/editorder',$this->data);

        }
}
    
?>
