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
        $this->load->model("users/m_users", "model_users");
      
    }

    public function index() {
      
        $users_id = $this->session->userdata('uid');
        $user_type = $this->session->userdata('user_type');
        $this->data["all_users"] = $this->model_users->getAllUsers($users_id, $user_type);
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
                    "entity_id" => $this->input->post("entity_id"),
                    "nationality" => $this->input->post("nationality"),
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
            $this->data["user_detail"] = $this->model_users->getUserDetail($user_id);
            $this->load->view("users/editprofileuser", $this->data);
        } else {
            redirect(site_url() . '/users');
        }
    }

    public function allusers() {
    
        $users_id = $this->session->userdata('uid');
        $user_type = $this->session->userdata('user_type');
        $this->data["all_users"] = $this->model_users->getAllUsers($users_id, $user_type);
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

    public function allassignform() {
        $this->session->unset_userdata('lati');
        $this->session->unset_userdata('longi');
        $users_id = $this->session->userdata('uid');
        $this->data["allassign"] = $this->model_survey->getAllAssignForm($users_id);
        $this->load->view("users/allassignform", $this->data);
    }

    public function startsurvey($assign_id = false) {
        $lati = $this->session->userdata('lati');
        $longi = $this->session->userdata('longi');
        if ($lati == "" || $longi == "") {
            redirect(site_url() . '/users/allassignform');
        }
        $form_id = "";
        // check user assign to this form or not
        $users_id = $this->session->userdata('uid');
        $assign_detail = $this->utils->getDetailIdByAssignId($assign_id, $users_id);
        if ($assign_detail != "") {
            $form_id = $assign_detail["form_id"];
        }
        if ($assign_detail["form_type"] == "mystry_shopper") {
            $quntity = '1';
        } else {
            $quntity = $assign_detail["quantity"];
        }
        $return = $this->utils->checkHowManyTimeAssignFormCompleted($assign_detail["form_assign_id"], $quntity);
        if ($return["success"] == "yes") {
            redirect(site_url() . '/users/allassignform');
        }
        if ($form_id) {
            // check if there is any post request
            $sbmt = $this->input->post("sbmt");
            if (isset($sbmt) && $sbmt == "sbmt") {
                $fname = $this->input->post("fname");
                $lname = $this->input->post("lname");
                $email = $this->input->post("email");
                $phone = $this->input->post("phone");
                $form_id = $this->input->post("form_id");
                $start_time = $this->input->post("start_time");
                $form_type = $this->input->post("form_type");
                $category = $this->input->post("category");
                $department_id = $this->input->post("department_id");
                $users_id = $this->session->userdata('uid');
                $project_id = $this->input->post("project_id");
                $branch_id = $this->input->post("branch_id");
                $master_plan_id = $this->input->post("master_plan_id");
                $dep_entity_id = $this->input->post("dep_entity_id");
                $order_id = $this->input->post("order_id");
                $assign_id_fk = $this->input->post("assign_id_fk");
                if (isset($form_id) && $form_id != "") {
                    $form_array = array(
                        "assign_id_fk" => $assign_id_fk,
                        "project_id" => $project_id,
                        "branch_id" => $branch_id,
                        "master_plan_id" => $master_plan_id,
                        "dep_entity_id" => $dep_entity_id,
                        "order_id" => $order_id,
                        "first_name" => $fname,
                        "last_name" => $lname,
                        "email" => $email,
                        "phone" => $phone,
                        "lati" => $lati,
                        "longi" => $longi,
                        "user_id" => $users_id,
                        "form_type" => $form_type,
                        "category" => $category,
                        "department_id" => $department_id,
                        "form_id" => $form_id,
                        "start_time" => $start_time,
                        "end_time" => time(),
                        "created_date" => time(),
                        "modified_date" => time(),
                    );
                    $this->db->insert('answers', $form_array);
                    $inserted_id = $this->db->insert_id();
                    // now insert all the ansers
                    $questions = $this->input->post('questions');
                    if (sizeof($questions) > 0) {
                        foreach ($questions as $value) {
                            $anwser_array = array(
                                "answer_id_fk" => $inserted_id,
                                "question_id" => $value,
                                "selected_answer" => $this->input->post($value),
                                "notes" => $this->input->post($value . "_notes"),
                                "created_date" => time(),
                                "modified_date" => time(),
                            );
                            $this->db->insert('answer_data', $anwser_array);
                        }
                    }
                    $this->data["update"] = "yes";
                    $this->data["error"] = "no";
                    $this->data["msg"] = "Thank you for your answers.";
                    redirect(site_url() . '/users/allassignform');
                }
            }
            // get user data
            $users_id = $this->session->userdata('uid');
            $this->data["user_detail"] = $this->model_users->getUserDetail($users_id);
            // get form data
            $this->data['department'] = $this->model_survey->getFormData($form_id);
            $form_type = $this->utils->getFormType($form_id);
            $this->data["form_id"] = $form_id;
            $this->data["form_type"] = $form_type;
            $this->data["assign_detail"] = $assign_detail;
            $this->load->view('users/preview_form', $this->data);
        } else {
            redirect(site_url() . '/users/allassignform');
        }
    }

    public function checkUserDistance() {
        $assign_id = $this->input->post('form_id');
        $form_id = "";
        // check user assign to this form or not
        $users_id = $this->session->userdata('uid');
        $assign_detail = $this->utils->getDetailIdByAssignId($assign_id, $users_id);
        $today_date = date("d-m-Y");
        if ($assign_detail != "") {
            $form_id = $assign_detail["form_id"];
        }
        $form_type = $this->utils->getFormType($form_id);
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        if (isset($form_id) && $form_id != "" && isset($latitude) && $latitude != "" && isset($longitude) && $longitude != "") {
            $users_id = $this->session->userdata('uid');
            // get user lat long assign to this survey form
            $this->db->select('latitude,longitude,radius');
            $this->db->where('form_assign_id', $assign_id);
            $this->db->where('user_id', $users_id);
            $this->db->where('is_active', '1');
            $this->db->where('is_delete', '0');
            $query = $this->db->get('form_assign');
            $result = $query->result_array();
            if (sizeof($result) > 0) {
                $falg = false;
                $distance_in_meter = 0;
                // check form type
                if (1 == 1) {
                    $falg = true;
                } else {
                    $total_distance = $this->get_distance_between_points_New($result[0]['latitude'], $result[0]['longitude'], $latitude, $longitude);
                    $distance_in_meter = round($total_distance);
                    if ($distance_in_meter <= $result[0]['radius']) {
                        $falg = true;
                    } else {
                        $falg = false;
                    }
                }
//              $distance_in_meter = $total_distance / 1000;
                if ($falg) {
                    // set session of lat long
                    $this->session->set_userdata('lati', $latitude);
                    $this->session->set_userdata('longi', $longitude);
                    $data = array(
                        "success" => "yes",
                        "msg" => "In the zone",
                        "distance" => $distance_in_meter,
                    );
                } else {
                    $data = array(
                        "success" => "no",
                        "msg" => "You are not in the zone" . " " . $latitude . " " . $longitude . " " . $distance_in_meter,
                        "distance" => $distance_in_meter,
                    );
                }
            } else {
                $data = array(
                    "success" => "no",
                    "msg" => "No Form is assign to you",
                );
            }
        } else {
            $data = array(
                "success" => "no",
                "msg" => "Something went wrong",
            );
        }
        echo json_encode($data);
    }

    public function distancess($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    public function get_distance_between_points($latitude1, $longitude1, $latitude2, $longitude2) {
        $theta = $longitude1 - $longitude2;
        $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
    }

    public function get_distance_between_points_New($lat1, $lon1, $lat2, $lon2) {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        $meters = $km * 1000;
        return $meters;
    }

    public function gettimestamp() {
        $data = array(
            "success" => "yes",
            "html" => time(),
        );
        echo json_encode($data);
    }

    public function preview($assign_id = false) {
        if (isset($assign_id) && $assign_id != "" && $assign_id > 0) {
            // check already assign or not
            $users_id = $this->session->userdata('uid');
            $assign_detail = $this->utils->getDetailIdByAssignId($assign_id, $users_id);
            $qnty = 1;
            $return = $this->utils->checkHowManyTimeAssignFormCompleted($assign_id, $qnty);
            //    print_r($return);
            if ($return["success"] == "no") {
                redirect(site_url() . '/users/allassignform');
            } else {
                // get user data
                $users_id = $this->session->userdata('uid');
                $this->data["user_detail"] = $this->model_users->getUserDetail($users_id);
                // get form data
                $form_id = $assign_detail["form_id"];
                $this->data['department'] = $this->model_survey->getFormData($form_id);
                $form_type = $this->utils->getFormType($form_id);
                $this->data["form_id"] = $form_id;
                $this->data["form_type"] = $form_type;
                $this->data["assign_id"] = $assign_id;
                $this->data["assign_detail"] = $assign_detail;
                $this->load->view('users/previewcompletform', $this->data);
            }
        } else {
            redirect(site_url() . 'users/allassignform');
        }
    }

    public function updatetextarea() {
        $answer_data_id = $this->input->post('answer_data_id');
        $dat = $this->input->post('dat');
        if ($answer_data_id != "" && $dat != "") {
            $dt = array(
                "selected_answer" => $dat,
                "modified_date" => time(),
            );
            $this->db->where('answer_data_id', $answer_data_id);
            $this->db->update('answer_data', $dt);
            $data = array(
                "success" => "yes",
                "msg" => "updated successfully",
            );
        } else {
            $data = array(
                "success" => "no",
                "msg" => "Something went wrong",
            );
        }
        echo json_encode($data);
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
