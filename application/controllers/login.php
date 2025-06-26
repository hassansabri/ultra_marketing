<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_users
* @property CI_Session $session
 * @property CI_Input $input
 */
class login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model("users/m_login", "model_login");
    }
    public function logout() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('website');
        redirect(site_url());
    }
    public function sd()
{
    $this->session->sess_destroy();
}
    public function index(){
        if ($this->session->userdata('logged_in'))redirect('users');
        $this->load->view('login/loginscreen');
    }
    public function verify() {
        $userlogin = $this->session->userdata('logged_in');
        $website = $this->session->userdata('website');
        // if ($userlogin && $website == 'survey') {
        //     redirect(site_url() . '/users');
        // } else {
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            
            if ($email != "" && $password != "") {
                $newpassword = md5($password);
                $reutn = $this->model_login->checkLogin($email, $newpassword);
                if (sizeof($reutn) > 0) {
                    $access = $this->model_login->userAccess($reutn["users_id"]);
                    $access_rights[] = 'test';
                    $access_rights[] = 'test';
                    // if (sizeof($access) > 0) {
                    //     foreach ($access as $row) {
                    //         $access_rights[] = $row->users_types_id;
                    //     }
                    // }

                    $newdata = array(
                        'name' => $reutn["name"],
                        'email' => $reutn["email"],
                        'uid' => $reutn["users_id"],
                        'user_type' => $reutn["user_type"],
                        'logged_in' => TRUE,
                        'website' => 'ultra_marketing'
                    );
            
                    $this->session->set_userdata($newdata);
                    // print_r($this->session->userdata('access'));
                    // if ($this->session->userdata('access') != '') {
                    //     echo 'h';
                    // }
                    // exit;

                //    if (in_array($this->session->userdata('access'))) {
                //        redirect(site_url() . '/users/');
                //     } else if (in_array($this->session->userdata('access'))) {
                //         redirect(site_url() . '/reports/reportbydepartment');
                //     } else {
                        
                        redirect(site_url() . '/users/allusers');
                //   }
                } else {
                    $message[]="yes";
                    $this->load->view("login/loginscreen", $message);
                }
            } else {
                $message[] = array(
                    "error" => "yes",
                    "msg" => $this->lang->line("invalidusername"),
                );
                $this->load->view("login/loginscreen", $message);
            }
     //   }
    }



}