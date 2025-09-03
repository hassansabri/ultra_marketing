<?php
/**
 *  @property m_login $model_login
 *  @property m_users $model_users
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
class users extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))redirect('login');
        $this->load->model("users/m_users", "model_users");
      
    }

    public function index() {
      
        $users_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->data["all_users"] = $this->model_users->getAllUsers($users_id, $user_type);
        
        // Load permission model to get user roles
        $this->load->model('m_permissions');
        
            // Get roles for each user
    foreach ($this->data["all_users"] as &$user) {
        $user['roles'] = $this->m_permissions->getUserRoles($user['users_id']);
        // Calculate total permissions for this user
        $user['permission_count'] = 0;
        if (!empty($user['roles'])) {
            foreach ($user['roles'] as $role) {
                $permissions = $this->m_permissions->getRolePermissions($role['role_id']);
                $user['permission_count'] += count($permissions);
            }
        }
    }
        $this->load->view("users/allusers", $this->data);
    }

    public function changepassword() {
        $users_id = $this->session->userdata('uid');
        $sbmt = $this->input->post("sbmt");
        if ($sbmt == "sbmt") {
            $oldpassword = $this->input->post("oldpassword");
            $newpassword = $this->input->post("newpassword");
            $confirmpassword = $this->input->post("confirmpassword");
            if ($oldpassword != "" && $newpassword != "") {
                if ($newpassword == $confirmpassword) {
                    $data = array(
                        "password" => md5($newpassword),
                        "modified_date" => time(),
                    );
                    $return = $this->model_users->updatePassword($data, $users_id, $oldpassword);
                    if ($return) {
                        $this->data["update"] = "yes";
                        $this->data["error"] = "no";
                        $this->data["msg"] = "Password Updated Successfully";
                    } else {
                        $this->data["update"] = "yes";
                        $this->data["error"] = "yes";
                        $this->data["msg"] = "Wrong old password";
                    }
                } else {
                    $this->data["update"] = "yes";
                    $this->data["error"] = "yes";
                    $this->data["msg"] = "New Password and Confirm Password Mismatch";
                }
            } else {
                $this->data["update"] = "yes";
                $this->data["error"] = "yes";
                $this->data["msg"] = "All fields are required.";
            }
        } else {
            $this->data["update"] = "no";
        }
        $this->load->view("users/changepassword", $this->data);
    }

    public function editprofile() {
        $users_id = $this->session->userdata('uid');
        $sbmt = $this->input->post("sbmt");
        if ($sbmt == "sbmt") {
            $data = array(
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "gender" => $this->input->post("gender"),
                "phone" => $this->input->post("phone"),
                "designation" => $this->input->post("designation"),
                "emergency_number" => $this->input->post("emergency_number"),
                "passport_no" => $this->input->post("passport_no"),
                "blood_group" => $this->input->post("blood_group"),
                "modified_date" => time(),
            );
            if (isset($_FILES['user_image']['tmp_name']) && $_FILES['user_image']['tmp_name'] != '') {
                $gallery_path = realpath(APPPATH . '../images/user/');
                $name = $_FILES["user_image"]["name"];
                $ext = end((explode(".", $name)));
                $random_digit = rand(00000000, 99999999);
                $fileName = $random_digit . "." . $ext;
                $config = array(
                    'allowed_types' => 'jpg|jpeg|gif|png',
                    'upload_path' => $gallery_path,
                    'overwrite' => false,
                    'max_size' => 0,
                    'file_name' => $fileName
                );
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("user_image")) {
                    
                } else {
                    $this->session->set_userdata('user_image', $fileName);
                    $data["user_image"] = $fileName;
                }
            }
            $this->model_users->updateUser($data, $users_id);
            $this->data["update"] = "yes";
        } else {
            $this->data["update"] = "no";
        }
        $this->data["users_id"] = $users_id;
        $this->data["user_detail"] = $this->model_users->getUserDetail($users_id);
        $this->load->view("users/editprofile", $this->data);
    }

    public function editprofileuser($user_id = false) {
        if ($user_id) {
            $sbmt = $this->input->post("sbmt");
            if ($sbmt == "sbmt") {
                $data = array(
                    "name" => $this->input->post("name"),
                    "email" => $this->input->post("email"),
                    "gender" => $this->input->post("gender"),
                    "phone" => $this->input->post("phone"),
                    "designation" => $this->input->post("designation"),
                    "emergency_number" => $this->input->post("emergency_number"),
                    "passport_no" => $this->input->post("passport_no"),
                    "blood_group" => $this->input->post("blood_group"),
                
                    "modified_date" => time(),
                );
                $password = $this->input->post("password");
                $password2 = trim($password);
                if ($password2) {
                    $password3 = md5($password2);
                    $data["password"] = $password3;
                }
                if (isset($_FILES['user_image']['tmp_name']) && $_FILES['user_image']['tmp_name'] != '') {
                    $gallery_path = realpath(APPPATH . '../images/user/');
                    $name = $_FILES["user_image"]["name"];
                    $ext = end((explode(".", $name)));
                    $random_digit = rand(00000000, 99999999);
                    $fileName = $random_digit . "." . $ext;
                    $config = array(
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => $gallery_path,
                        'overwrite' => false,
                        'max_size' => 0,
                        'file_name' => $fileName
                    );
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("user_image")) {
                        
                    } else {
                        $data["user_image"] = $fileName;
                    }
                }
                $this->model_users->updateUser($data, $user_id);
                $this->data["update"] = "yes";
                $this->data["msg"] = "User Updated Successfully";
            } else {
                $this->data["update"] = "no";
            }
            $this->data["users_id"] = $user_id;
//             $data['users'] = $this->m_permissions->getUsersWithRoleCount();
            $this->data["user_detail"] = $this->model_users->getUserDetail($user_id);
            $this->load->view("users/editprofileuser", $this->data);
        } else {
            redirect(site_url() . '/users');
        }
    }

    public function allusers() {
    
        $users_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');
        $this->data["all_users"] = $this->model_users->getAllUsers($users_id, $user_type);
        
        // Load permission model to get user roles
        $this->load->model('m_permissions');
        
            // Get roles for each user
    foreach ($this->data["all_users"] as &$user) {
        $user['roles'] = $this->m_permissions->getUserRoles($user['users_id']);
        // Calculate total permissions for this user
        $user['permission_count'] = 0;
        if (!empty($user['roles'])) {
            foreach ($user['roles'] as $role) {
                $permissions = $this->m_permissions->getRolePermissions($role['role_id']);
                $user['permission_count'] += count($permissions);
            }
        }
    }
        
        $this->load->view("users/allusers", $this->data);
    }

    public function changestatus() {
        $user_id = $this->input->post("user_id");
        $status = $this->input->post("status");
        if ($user_id != "") {
            $data = array(
                "is_active" => $status,
                "modified_date" => time(),
            );
            $this->model_users->changestatus($user_id, $data);
            echo "1";
        } else {
            echo "0";
        }
    }

    public function changepermissions($user_id = false) {
        if ($user_id) {
            $this->data["user_detail"] = $this->model_users->getUserDetail($user_id);
            if (sizeof($this->data["user_detail"]) > 0) {
                $this->data["user_types"] = $this->model_users->getUserTypes();
                $this->data["current_user_types"] = $this->model_users->getCurretnUserTypes($user_id);
//                print_r($this->data["current_user_types"]);
//                exit;
                $this->data["update"] = "no";
                $this->load->view("users/changepermissions", $this->data);
            } else {
                $this->load->view('404');
            }
        } else {
            $this->load->view('404');
        }
    }

    public function updatepermissions() {
        $user_id = $this->input->post("user_id");
        $type_id = $this->input->post("type_id");
        $action = $this->input->post("action");
        if ($user_id != "" && $type_id != "" && $action != "") {
            if ($action == "add") {
                $data = array(
                    "users_type_id" => $type_id,
                    "user_id" => $user_id,
                    "created_date" => time(),
                );
                $this->model_users->addUserType($data);
            } else {
                $this->model_users->deleteUserType($user_id, $type_id);
            }
            echo "1";
        } else {
            echo "0";
        }
    }

    public function adduser() {

        $sbmt = $this->input->post("sbmt");
        if (isset($sbmt) && $sbmt == "sbmt") {
            $name = $this->input->post("name");
            $username = $this->input->post("username");
            $email = $this->input->post("email");
            $gender = $this->input->post("gender");
            $phone = $this->input->post("phone");
            $password = $this->input->post("password");
            $entity_id = $this->input->post("entity_id");
            // user name exist or not.
            $username_data = $this->model_users->checkusername($username);
            $email_data = $this->model_users->checkemail($email);
            if (sizeof($username_data) > 0 || sizeof($email_data)) {
                if (sizeof($username_data) > 0) {
                    $this->data["update"] = "yes";
                    $this->data["error"] = "yes";
                    $this->data["msg"] = "Username Already Exist";
                } else {
                    $this->data["update"] = "yes";
                    $this->data["error"] = "yes";
                    $this->data["msg"] = "Email Already Exist";
                }
            } else {
                $data = array(
                    "name" => $name,
                    "user_name" => $username,
                    "email" => $email,
                    "gender" => $gender,
                    "phone" => $phone,
                    "modified_date" => time(),
                    "designation" => $this->input->post("designation"),
                    "emergency_number" => $this->input->post("emergency_number"),
                    "passport_no" => $this->input->post("passport_no"),
                    "blood_group" => $this->input->post("blood_group")
                );
                $password2 = $password;
                $password3 = md5($password2);
                $data["password"] = $password3;
                if (isset($_FILES['user_image']['tmp_name']) && $_FILES['user_image']['tmp_name'] != '') {
                    $gallery_path = realpath(APPPATH . '../images/user/');
                    $name = $_FILES["user_image"]["name"];
                    $ext = end((explode(".", $name)));
                    $random_digit = rand(00000000, 99999999);
                    $fileName = $random_digit . "." . $ext;
                    $config = array(
                        'allowed_types' => 'jpg|jpeg|gif|png',
                        'upload_path' => $gallery_path,
                        'overwrite' => false,
                        'max_size' => 0,
                        'file_name' => $fileName
                    );
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("user_image")) {
                        
                    } else {
                        $data["user_image"] = $fileName;
                    }
                }
                $this->data["update"] = "yes";
                $this->data["error"] = "no";
                $this->data["msg"] = "User Created Successfully";
                $this->db->insert('users', $data);
                redirect(site_url() . '/users');
            }
        } else {
            $this->data["update"] = "no";
        }

        $this->load->view('users/adduser', $this->data);
    }

    public function update_premission() {
        $users_id = $this->session->userdata('uid');
        if (isset($users_id) && $users_id != "" && $users_id > 0) {
            $this->load->model("users/m_login", "model_login");
            $access = $this->model_login->userAccess($users_id);
            $access_rights = array();
            if (sizeof($access) > 0) {
                foreach ($access as $row) {
                    $access_rights[] = $row->users_types_id;
                }
            }
            $this->session->unset_userdata('access');
            $this->session->set_userdata('access', $access_rights);
            if (in_array(2, $this->session->userdata('access'))) {
                redirect(site_url() . '/users/allassignform');
            } else if (in_array(10, $this->session->userdata('access'))) {
                redirect(site_url() . '/reports/reportbydepartment');
            } else {
                redirect(site_url() . '/users');
            }
        } else {
            if (in_array(2, $this->session->userdata('access'))) {
                redirect(site_url() . '/users/allassignform');
            } else if (in_array(10, $this->session->userdata('access'))) {
                redirect(site_url() . '/reports/reportbydepartment');
            } else {
                redirect(site_url() . '/users');
            }
        }
    }

}
