<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_reports
 *
 * @author Hassan
 */
class m_reports extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getFormDetail($fomr_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("operation_forms_id", $fomr_id);
        $query = $this->db->get("operation_forms");
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "operation_forms_id" => $value["operation_forms_id"],
                    "form_title" => $value["form_title"],
                    "survey_year" => $value["survey_year"],
//                    "form_desc" => $value["form_desc"],
//                    "form_language" => $value["form_language"],
//                    "no_of_group" => $value["no_of_group"],
//                    "department_id" => $value["department_id"],
//                    "created_date" => $value["created_date"],
//                    "is_active" => $value["is_active"],
                    "form_questions" => $this->getFormQuestions($value["no_of_group"], $fomr_id),
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function getFormQuestions($no_of_group = false, $form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("form_id", $form_id);
        $query = $this->db->get("questions");
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "question_statement" => $value["question_statement"],
                    "questions_id" => $value["questions_id"],
//                    "form_id" => $value["form_id"],
//                    "user_id" => $value["user_id"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getFormAnswer($form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("form_id", $form_id);
        $query = $this->db->get("answers");
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "answers_id" => $value["answers_id"],
                    "first_name" => $value["first_name"],
                    "last_name" => $value["last_name"],
                    "email" => $value["email"],
                    "phone" => $value["phone"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAnswerInDetail($form_id, $answers_id, $questions_id) {
        $this->db->select("selected_answer,notes");
        $this->db->where("is_delete", "0");
//        $this->db->where("form_id", $form_id);
        $this->db->where("answer_id_fk", $answers_id);
        $this->db->where("question_id", $questions_id);
        $query = $this->db->get("answer_data");
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0]["selected_answer"] . "-------" . $result[0]["notes"];
        } else {
            return "N/A";
        }
    }

    public function getAnswerInDetailNew($answer_id, $questions_id) {
        $this->db->select("selected_answer,notes");
        $this->db->where("is_delete", "0");
//        $this->db->where("form_id", $form_id);
        $this->db->where("answer_id_fk", $answer_id);
        $this->db->where("question_id", $questions_id);
        $query = $this->db->get("answer_data");
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            if ($result[0]["notes"] != "0" && $result[0]["notes"] != "") {

                return $result[0]["selected_answer"] . "-------" . $result[0]["notes"];
            } else {
                return $result[0]["selected_answer"];
            }
        } else {
            return "N/A";
        }
    }

    public function getAllAssignIds($department = false, $dep_ent = false, $branches = false, $form_type = false, $category = false, $survey_form = false) {
        $this->db->select("form_assign_id");
        $this->db->where("is_delete", "0");
        if ($department) {
//            $this->db->where("department_id", $department);
        }
        if ($dep_ent) {
            $this->db->where("dep_ent", $dep_ent);
        }

        if ($form_type) {
            $this->db->where("form_type", $form_type);
        }
        if ($category) {
            $this->db->where("category", $category);
        }
        if ($survey_form) {
            $this->db->where("form_id", $survey_form);
        }
        $this->db->group_by("form_assign_id");
        $query = $this->db->get('form_assign');
//echo $this->db->last_query();
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["form_assign_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

}
