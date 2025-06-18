<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @author Survey
 *
 * Purpose of this class is to provide all the utilities functions which can be used from any controller.
 *
 */

class utils {

    var $languages;
    var $arrStatus;
    var $CI;

    function __construct() {

        $this->CI = & get_instance();
        $this->arrStatus['Error'] = "";
        $this->arrStatus['Info'] = "";
        $this->arrStatus['Success'] = "";
        $lng = $this->getLanguageParamVal();
        if ($lng == "en") {
            $this->CI->config->set_item('language_post_fix', '');
        } else {
            $this->CI->config->set_item('language_post_fix', '_ar');
        }
    }

    function getValue($key) {
        $rec = $this->CI->db->get_where('keyvalues', array('key' => $key));
        $obj = $rec->result();
        $this->CI->load->library("xml");
        $arr = $this->CI->xml->xml2array($obj[0]->value);
        while (list($key, $value) = each($arr['data'])) {
            if (is_array($value)) {
                $arr['data'][$key] = "";
            }
        }
        return $arr;
    }

    public function getLanguageParam() {
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, '/en') !== false) {
            $this->CI->session->set_userdata('language_frontid', "1");
            $this->CI->lang->load("eng", "english");
        } else {
            $this->CI->session->set_userdata('language_frontid', "2");
            $this->CI->lang->load("ar", "arabic");
        }
    }

    public function getLanguageParamVal() {
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, '/en') !== false) {
            return "en";
        } else {
            return "ar";
        }
    }

    public function changelangugeparamurl() {
        echo $url = $_SERVER['REQUEST_URI'];
        // exit;
        if (strpos($url, '/en') !== false) {
            $str = str_replace("/en", "/ar", $url);
            redirect('http://' . $_SERVER['HTTP_HOST'] . $str);
        } else {
            $str = str_replace("/en", "/ar", $url);
            redirect('http://' . $_SERVER['HTTP_HOST'] . $str);
        }
    }

    public function getUserFullName($user_id = false) {
        $q = "SELECT
              name
              FROM users WHERE users_id ='" . $user_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["name"]) && $result[0]["name"] != "") {
            return $result[0]["name"];
        } else {
            return "";
        }
    }

    public function getDepartmentName($dep_id = false) {
        $q = "SELECT
              department_name
              FROM department WHERE department_id ='" . $dep_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["department_name"]) && $result[0]["department_name"] != "") {
            return $result[0]["department_name"];
        } else {
            return "";
        }
    }

    public function getBranchName($branch_id = false) {
        $q = "SELECT
              branch_name" . $this->CI->config->item('language_post_fix') . "
              FROM branches WHERE branches_id ='" . $branch_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["branch_name" . $this->CI->config->item('language_post_fix')]) && $result[0]["branch_name" . $this->CI->config->item('language_post_fix')] != "") {
            return $result[0]["branch_name" . $this->CI->config->item('language_post_fix')];
        } else {
            return "N/A";
        }
    }

    public function getBranchNameAr($branch_id = false) {
        $q = "SELECT
              branch_name" . $this->CI->config->item('language_post_fix') . "
              FROM branches WHERE branches_id ='" . $branch_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["branch_name_ar"]) && $result[0]["branch_name_ar"] != "") {
            return $result[0]["branch_name_ar"];
        } else {
            return "N/A";
        }
    }

    public function getBranchID($assigned_id = false) {
        $q = "SELECT
              branch_id
              FROM form_assign WHERE form_assign_id ='" . $assigned_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["branch_id"]) && $result[0]["branch_id"] != "") {
            return $result[0]["branch_id"];
        } else {
            return "N/A";
        }
    }

    public function getFormName($form_id = false) {
        $q = "SELECT
              form_title
              FROM operation_forms WHERE operation_forms_id ='" . $form_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["form_title"]) && $result[0]["form_title"] != "") {
            return $result[0]["form_title"];
        } else {
            return "N/A";
        }
    }

    public function getDepEntityNameAR($dep_id = false) {
        $q = "SELECT
              department_entity_name_ar
              FROM department_entity_names WHERE department_entity_names_id ='" . $dep_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["department_entity_name_ar"]) && $result[0]["department_entity_name_ar"] != "") {
            return $result[0]["department_entity_name_ar"];
        } else {
            return "";
        }
    }

    public function getDepEntityName($dep_id = false) {

        $q = "SELECT
              department_entity_name" . $this->CI->config->item('language_post_fix') . "
              FROM department_entity_names WHERE department_entity_names_id ='" . $dep_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["department_entity_name" . $this->CI->config->item('language_post_fix')]) && $result[0]["department_entity_name" . $this->CI->config->item('language_post_fix')] != "") {
            return $result[0]["department_entity_name" . $this->CI->config->item('language_post_fix')];
        } else {
            return "";
        }
    }

    public function getDepEntityNameArabic($dep_id = false) {
        $q = "SELECT
              department_entity_name_ar
              FROM department_entity_names WHERE department_entity_names_id ='" . $dep_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["department_entity_name_ar"]) && $result[0]["department_entity_name_ar"] != "") {
            return $result[0]["department_entity_name_ar"];
        } else {
            return "";
        }
    }

    public function getSurveyFormName($form_id = false) {
        $q = "SELECT
              form_title
              FROM operation_forms WHERE operation_forms_id ='" . $form_id . "' ";
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (isset($result[0]["form_title"]) && $result[0]["form_title"] != "") {
            return $result[0]["form_title"];
        } else {
            return "";
        }
    }

    public function sendMail($from, $from_name, $to, $subject, $msg) {
        require_once(APPPATH . 'libraries/class.phpmailer.php');
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        // SMTP information Begin
        $host = "mail.an-project.org";
        $username = "sendmail@an-project.org";
        $password = 'gf3fr!@#$R!#YWGVG#%YTWAW24t6urd';
        // SMTP information End
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = $host; // SMTP server example
        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        //  $mail->SMTPSecure = "tls";
        $mail->Port = 25; // SMTP Port                // set the SMTP port for the GMAIL server
        $mail->Username = $username; // SMTP account username example
        $mail->Password = $password;
        // defaults to using php "mail()"
        $mail->SetFrom($from, $from_name);
        foreach ($to as $email => $name) {
            $mail->AddAddress($email, $name);
        }
        //$mail->AddAddress($address);
        $mail->Subject = $subject;
        $mail->AltBody = " "; // optional, comment out and test
        $mail->MsgHTML($msg);
        if (!$mail->Send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return "Message sent!";
        }
    }

    public function getFormType($form_id = false) {
        //operation_forms
        $this->CI->db->select('form_type');
        $this->CI->db->where('operation_forms_id', $form_id);
        $query = $this->CI->db->get('operation_forms');
        $result = $query->result_array();
        if (isset($result[0]["form_type"]) && $result[0]["form_type"] != "") {
            return $result[0]["form_type"];
        } else {
            return "";
        }
    }

    public function getCompletedSurvey($assign_id_fk = false) {
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('assign_id_fk', $assign_id_fk);
        $query = $this->CI->db->count_all_results('answers');
        return $query;
    }

    public function getDetailIdByAssignId($assign_id = false, $user_id = false) {
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('form_assign_id', $assign_id);
        if ($user_id) {
            $this->CI->db->where('user_id', $user_id);
        }
        $query = $this->CI->db->get('form_assign');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return "";
        }
    }

    public function getDetails($assign_id = false, $user_id = false) {
        $this->CI->db->where('is_delete', '0');
        if ($user_id) {
            $this->CI->db->where('user_id', $user_id);
        }
        $this->CI->db->order_by('department_id', 'asc');
        $query = $this->CI->db->get('form_assign');
        $result = $query->result_array();
        return $result;
    }

    public function get_sum($id) {
        $this->CI->db->select_sum('quantity');
        $this->CI->db->from('project_master_plan');
        $this->CI->db->where('project_id_fk', $id);
        $query = $this->CI->db->get();
        return $query->row()->quantity;
    }

    public function getValueWithSpecificField($form_type = false, $order_id = false, $project_id = false, $master_plan_id = false, $ent_id = false, $dep_id = false, $branch = false, $category = false, $field = false) {
        $this->CI->db->select($field);
        $this->CI->db->where('project_id', $project_id);
        $this->CI->db->where('master_plan_id', $master_plan_id);
        $this->CI->db->where('department_id', $ent_id);
        $this->CI->db->where('dep_ent', $dep_id);
        $this->CI->db->where('branch_id', $branch);
        $this->CI->db->where('category', $category);
        $this->CI->db->where('order_id', $order_id);
        $this->CI->db->where('form_type', $form_type);
        $this->CI->db->where('is_delete', '0');
        $query = $this->CI->db->get('form_assign');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            if ($field == "start_date") {
                $date = date('d-m-Y', $result[0][$field]);
                return $date;
            } else {
                return $result[0][$field];
            }
        } else {
            return "";
        }
    }

    public function checkHowManyTimeAssignFormCompleted($assing_id = false, $qunatity = false) {
        $dat = array();
        $this->CI->db->where('assign_id_fk', $assing_id);
        $this->CI->db->from('answers');
        $count = $this->CI->db->count_all_results();
        if ($count >= $qunatity) {
            $dat = array(
                "success" => "yes",
                "total_complete" => $count,
            );
        } else {
            $dat = array(
                "success" => "no",
                "total_complete" => "0",
            );
        }
        return $dat;
    }

    public function getAttachments($assing_id = false) {
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('assign_id_fk', $assing_id);
        $query = $this->CI->db->get('attachments');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return array();
        }
    }

    public function countCompletedUnderProject($project_id = false) {

        $this->CI->db->from('answers');
        $this->CI->db->where('project_id', $project_id);
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return count($result);
    }

    public function countAssignUnderProject($project_id = false) {

        $this->CI->db->from('form_assign');
        $this->CI->db->where('project_id', $project_id);
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return count($result);
    }

    public function getHowManyTimeAssessed($form_id = false, $assign_id = false) {

        $this->CI->db->select('answers_id,first_name,last_name,email,phone,start_time,end_time,lati,longi,dep_entity_id,branch_id');
        $this->CI->db->from('answers');
        if ($assign_id) {
            $this->CI->db->where('assign_id_fk', $assign_id);
        }
        $this->CI->db->where('form_id', $form_id);
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function countAllQuestionUnderForm($form_id = false) {
        $this->CI->db->select('questions_id');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('form_id', $form_id);
        $query = $this->CI->db->get('questions');
        $result = $query->result_array();
        return count($result);
    }

    public function countAllApproveQuestionUnderForm($form_id = false) {
        $this->CI->db->select('questions_id');
        $this->CI->db->where('is_approved', 'yes');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('form_id', $form_id);
        $query = $this->CI->db->get('questions');
        $result = $query->result_array();
        return count($result);
    }

    public function getAnswerInDetailNew($answer_id, $questions_id) {
        $this->CI->db->select("selected_answer,notes,answer_data_id");
        $this->CI->db->where("is_delete", "0");
        $this->CI->db->where("answer_id_fk", $answer_id);
        $this->CI->db->where("question_id", $questions_id);
        $query = $this->CI->db->get("answer_data");
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return "N/A";
        }
    }

    public function getAnswerCout($form_id = false, $questions_id = false, $op_val = false, $answers_id = false) {
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('question_id', $questions_id);
        $this->CI->db->where('selected_answer', $op_val);
        if ($answers_id) {
            $this->CI->db->where_in('answer_id_fk', $answers_id);
        }
        $query = $this->CI->db->count_all_results('answer_data');
        return $query;
    }

    public function getAlltheTextAreaComments($form_id = false, $questions_id = false, $answers_id = false) {
        $this->CI->db->select('selected_answer,answer_id_fk');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('question_id', $questions_id);
        if ($answers_id) {
            $this->CI->db->where_in('answer_id_fk', $answers_id);
        }
        $query = $this->CI->db->get('answer_data');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "selected_answer" => $value["selected_answer"],
                    "answer_id_fk" => $value["answer_id_fk"],
                    "branch_name" => $this->getBranchNameByAnswerId($value["answer_id_fk"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getBranchNameByAnswerId($answer_id_fk = false) {
        $q = 'SELECT b.branch_name_ar, b.branch_name  from answers as ans INNER JOIN branches as b on ans.branch_id=b.branches_id where answers_id  ="' . $answer_id_fk . '" ';
        $query = $this->CI->db->query($q);
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0]["branch_name_ar"];
        } else {
            return "";
        }
    }

    public function getAllComents($form_id = false, $questions_id = false, $answers_id = false) {
        $this->CI->db->select('notes,answer_id_fk');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('question_id', $questions_id);
        if ($answers_id) {
            $this->CI->db->where_in('answer_id_fk', $answers_id);
        }
        $query = $this->CI->db->get('answer_data');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "notes" => $value["notes"],
                    "answer_id_fk" => $value["answer_id_fk"],
                    "branch_name" => $this->getBranchNameByAnswerId($value["answer_id_fk"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function checkPublish($assign_id = false) {
        $this->CI->db->select('assign_id_fk');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('assign_id_fk', $assign_id);
        $query = $this->CI->db->get('publish_answers');
        $result = $query->result_array();
        return $result;
    }

    public function getAnswerInDetailDynamic($answer_id, $questions_id, $table) {
        $this->CI->db->select("selected_answer,notes,answer_data_id");
        $this->CI->db->where("is_delete", "0");
        $this->CI->db->where("answer_id_fk", $answer_id);
        $this->CI->db->where("question_id", $questions_id);
        $query = $this->CI->db->get($table);
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return "N/A";
        }
    }

    public function countAllRatingSection($form_id = false) {
        $this->CI->db->select('form_id');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('parent_id', '0');
        $this->CI->db->where('is_rating', 'yes');
        $this->CI->db->where('form_id', $form_id);
        $query = $this->CI->db->count_all_results('group_titles');
        return $query;
    }

    public function getPrjectNameByProjectId($project_id = false) {
        $this->CI->db->select("project_title");
        $this->CI->db->where("is_delete", "0");
        $this->CI->db->where("projects_id", $project_id);
        $query = $this->CI->db->get("projects");
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0]["project_title"];
        } else {
            return "N/A";
        }
    }

    public function getApprovedProjectUnderEnityYear($entity_id = false, $year = false) {
        $this->CI->db->select('projects_id');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('is_active', '1');
        $this->CI->db->where('entity_id', $entity_id);
        $this->CI->db->where('year', $year);
        $query = $this->CI->db->get('projects');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["projects_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function countJobDone($department_entity_names_id = false, $category = false, $entity = false, $year = false) {
        $this->CI->db->select('answers.project_id, projects.projects_id');
        $this->CI->db->from('answers');
        $this->CI->db->join('projects', 'answers.project_id = projects.projects_id');
        $this->CI->db->where('answers.dep_entity_id', $department_entity_names_id);
        $this->CI->db->where('answers.category', $category);
        $this->CI->db->where('projects.is_delete', '0');
        $this->CI->db->where('answers.is_delete', '0');
        if ($entity != "" && $year != "") {
            $this->CI->db->where('projects.entity_id', $entity);
            $this->CI->db->where('projects.year', $year);
        }
        $result = $this->CI->db->get();
        return count($result->result_array());
    }

    public function getTotalJobNeedToComplete($department_id = false, $category = false, $entity = false, $year = false) {
        if ($entity != "" && $year != "") {
            $aprroved_prj = $this->getApprovedProjectUnderEnityYear($entity, $year);
        }
        $this->CI->db->select_sum('quantity');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('project_id_fk !=', '1');
        $this->CI->db->where('is_active', '1');
        $this->CI->db->where('department_id_fk', $department_id);
        $this->CI->db->where('category', $category);
        if ($entity != "" && $year != "") {
            if (sizeof($aprroved_prj) > 0) {
                $this->CI->db->where_in('project_id_fk', $aprroved_prj);
            } else {
                return 0;
            }
        }
        $this->CI->db->from('project_master_plan');
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return $result[0]["quantity"];
    }

    public function getSurveyTime($assign_id = false) {
        $this->CI->db->select('created_date');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('assign_id_fk', $assign_id);
        $this->CI->db->from('answers');
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return $result[0]["created_date"];
    }

    public function getSurveyTimeNew($assign_id = false) {
        $return = $this->getAnswerId($assign_id);
        if (sizeof($return) > 0) {
            if ($return["category"] == "Face to Face Visit") {
                $myarray = array('1498', '1499', '1500');
                $this->CI->db->select('selected_answer');
                $this->CI->db->where('is_delete', '0');
                $this->CI->db->where('answer_id_fk', $return["answers_id"]);
                $this->CI->db->where_in('question_id', $myarray);
                $this->CI->db->from('answer_data');
                $query = $this->CI->db->get();
                $result = $query->result_array();
                if (sizeof($result) > 0) {
                    return $result[1]["selected_answer"] . " " . $result[2]["selected_answer"];
                } else {
                    return "";
                }
            } else if ($return["category"] == "Mobile Application") {
                $myarray = array('1727', '1728', '1729');
                $this->CI->db->select('selected_answer');
                $this->CI->db->where('is_delete', '0');
                $this->CI->db->where('answer_id_fk', $return["answers_id"]);
                $this->CI->db->where_in('question_id', $myarray);
                $this->CI->db->from('answer_data');
                $query = $this->CI->db->get();
                $result = $query->result_array();
                if (sizeof($result) > 0) {
                    return $result[1]["selected_answer"] . " " . $result[2]["selected_answer"];
                } else {
                    return "";
                }
            } else if ($return["category"] == "Telephone Transactions") {
                $myarray = array('1720', '1721', '1722');
                $this->CI->db->select('selected_answer');
                $this->CI->db->where('is_delete', '0');
                $this->CI->db->where('answer_id_fk', $return["answers_id"]);
                $this->CI->db->where_in('question_id', $myarray);
                $this->CI->db->from('answer_data');
                $query = $this->CI->db->get();
                $result = $query->result_array();
                if (sizeof($result) > 0) {
                    return $result[1]["selected_answer"] . " " . $result[2]["selected_answer"];
                } else {
                    return "";
                }
            } else if ($return["category"] == "Website") {
                $myarray = array('1618', '1619', '1620');
                $this->CI->db->select('selected_answer');
                $this->CI->db->where('is_delete', '0');
                $this->CI->db->where('answer_id_fk', $return["answers_id"]);
                $this->CI->db->where_in('question_id', $myarray);
                $this->CI->db->from('answer_data');
                $query = $this->CI->db->get();
                $result = $query->result_array();
                if (sizeof($result) > 0) {
                    return $result[1]["selected_answer"] . " " . $result[2]["selected_answer"];
                } else {
                    return "";
                }
            } else {
                return "";
            }
        } else {
            return "-";
        }
    }

    public function getAnswerId($assign_id = false) {
        $this->CI->db->select('answers_id,category,form_id');
        $this->CI->db->where('is_delete', '0');
        $this->CI->db->where('assign_id_fk', $assign_id);
        $this->CI->db->from('answers');
        $query = $this->CI->db->get();
        $result = $query->result_array();
        return $result[0];
    }

}
