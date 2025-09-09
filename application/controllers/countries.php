<?php
/**
 *  @property m_faq $model_country
 *  @property CI_Session $session
 *  @property CI_Input $input
 */
class  countries extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) redirect('login');
        $this->load->model("countries/m_country", "model_country");
    }
     public function index() {
 
        $this->data["all_countries"] = $this->model_country->getallcountries();
        $this->load->view("countries/all_countries", $this->data);
        
    }
public function addcountry(){
            if (!has_permission_type('Country','add country',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }                                
    $this->data["update"] = "no";   
    $this->load->view('countries/add_new_country', $this->data);
}
  public function submitcountry(){
           $sdat['country_name'] = $this->input->post('country_name');
           $sdat['country_code'] = $this->input->post('country_code');
           $this->model_country->adddcountry($sdat);
           redirect(site_url() . 'countries/index');
         }
         
         public function editcountry($country_id=false){
             if (!has_permission_type('Country','edit country',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
            $this->data["update"]  = "no";
            $this->data["all_countries"] = $this->model_country->getallcountries();
             $this->data["country_detail"] =      $this->model_country->getcountrydetail($country_id);
               $this->load->view('countries/editcountry', $this->data);
         }
         public function updatecountry($country_id=false){
             $sdat['country_name'] = $this->input->post('country_name');
             $sdat['country_code'] = $this->input->post('country_code');
            $this->model_country->updatecountry($sdat,$country_id);
                redirect(site_url() . '/countries/editcountry/'.$country_id);
         }
          public function changestatus() {
            if (!has_permission_type('Country','app country',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
        $country_id = $this->input->post("country_id");
        $status = $this->input->post("status");
        if ($country_id != "") {
            $data = array(
                "country_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_country->changestatus($country_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
    // State section start
    public function all_states(){
    
        if (!has_permission_type('States','view',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        } 
        $this->data["all_countries"] = $this->model_country->getallcountries();
        $this->data["all_states"] = $this->model_country->getallstates();
        $this->load->view("countries/all_states", $this->data);
    }
    public function addstate(){
        if (!has_permission_type('States','create',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        } 
        $this->data["all_countries"] = $this->model_country->getallcountries();
    $this->data["update"] = "no";   
    $this->load->view('countries/add_new_state', $this->data);
}
  public function submitstate(){
    if (!has_permission_type('States','create',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        } 
           $sdat['state_name'] = $this->input->post('state_name');
           $sdat['country_fk'] = $this->input->post('country_id');
           $this->model_country->adddstate($sdat);
           redirect(site_url() . 'countries/all_states');
         }
         
         public function editstate($state_id=false){
            if (!has_permission_type('States','Edit',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        } 
            $this->data["update"]  = "no";
            $this->data["state_id"]  = $state_id;
            $this->data["all_countries"] = $this->model_country->getallcountries();
             $this->data["state_detail"] =      $this->model_country->getstatedetail($state_id);
               $this->load->view('countries/editstate', $this->data);
         }
         public function updatestate($state_id=false){
             $sdat['state_name'] = $this->input->post('state_name');
            $this->model_country->updatestate($sdat,$state_id);
                redirect(site_url() . '/countries/editstate/'.$state_id);
         }
          public function changestatetstatus() {
            if (!has_permission_type('States','app_state',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        } 
        $state_id = $this->input->post("state_id");
        $status = $this->input->post("status");
        if ($state_id != "") {
            $data = array(
                "state_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_country->changestatestatus($state_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
    // City section start
    public function all_cities(){
        if (!has_permission_type('cities','view',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
        $this->data["all_cities"] = $this->model_country->getallcities();
        $this->data["all_states"] = $this->model_country->getallstates();
        $this->load->view("countries/all_cities", $this->data);
    }
    public function addcity(){
        if (!has_permission_type('cities','create',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
         $this->data["all_countries"] = $this->model_country->getallcountries();
        $this->data["all_states"] = $this->model_country->getallstates();
    $this->data["update"] = "no";   
    $this->load->view('countries/add_new_city', $this->data);
}
  public function submitcity(){
           $sdat['city_name'] = $this->input->post('city_name');
           $sdat['state_fk'] = $this->input->post('state_id');
           $sdat['country_fk'] = $this->input->post('country_id');
           $this->model_country->adddcity($sdat);
           redirect(site_url() . 'countries/all_cities');
         }
         
         public function editcity($city_id=false){
            if (!has_permission_type('cities','edit',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
            $this->data["update"]  = "no";
            $this->data["city_id"]  = $city_id;
            $this->data["all_countries"] = $this->model_country->getallcountries();
        $this->data["all_states"] = $this->model_country->getallstates();
             $this->data["city_detail"] =      $this->model_country->getcitydetail($city_id);
               $this->load->view('countries/editcity', $this->data);
         }
         public function updatecity($city_id=false){
             $sdat['city_name'] = $this->input->post('city_name');
             $sdat['state_fk'] = $this->input->post('state_id');
           $sdat['country_fk'] = $this->input->post('country_id');
            $this->model_country->updatecity($sdat,$city_id);
                redirect(site_url() . '/countries/editcity/'.$city_id);
         }
          public function changecitystatus() {
            if (!has_permission_type('cities','approve',$this->session->userdata('uid'))) {
            echo 'you dont have permissions';
            exit;
        }
        $city_id = $this->input->post("city_id");
        $status = $this->input->post("status");
        if ($city_id != "") {
            $data = array(
                "city_status" => $status,
                "modified_date" =>  date("Y-m-d H:i:s")
            );
            $this->model_country->changecitystatus($city_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }
    




}