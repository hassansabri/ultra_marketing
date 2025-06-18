<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_survey
 *
 * @author Hassan
 */
class m_survey extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getAllFormsUnderDepartment($department_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('department_id', $department_id);
        $query = $this->db->get('operation_forms');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getAllFormsUnderCategoryAndFormType($category = false, $form_type = false, $department_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('is_approved', 'yes');
        $this->db->where('form_type', $form_type);
        $this->db->where('category', $category);
        $this->db->where('department_id', $department_id);
        $query = $this->db->get('operation_forms');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getBranches($dep_ent = false, $bracnh_ids = array()) {
        $this->db->where('is_delete', '0');
        $this->db->where('department_entity_id_fk', $dep_ent);
        if (sizeof($bracnh_ids) > 0) {
            $this->db->where_in('branches_id', $bracnh_ids);
        }
        $query = $this->db->get('branches');
//        echo $this->db->last_query();
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getDepEnt($department_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('entity_id', $department_id);
        $query = $this->db->get('department_entity_names');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getDeprtInThisProject($project_id = false) {
        $this->db->select('department_id_fk');
        $this->db->where('is_delete', '0');
        $this->db->where('project_id_fk', $project_id);
        $this->db->group_by('department_id_fk');
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["department_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getCateInThisProject($project_id = false) {
        $this->db->select('category');
        $this->db->where('is_delete', '0');
        $this->db->where('project_id_fk', $project_id);
        $this->db->group_by('category');
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["category"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getBanchesInThisProject($project_id = false) {
        $this->db->select('branch_id_fk');
        $this->db->where('is_delete', '0');
        $this->db->where('project_id_fk', $project_id);
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["branch_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAllDepEntityNew($department_id = false, $dep_ids = array()) {
        $this->db->select('department_entity_names_id');
        $this->db->where('is_delete', '0');
        if (sizeof($dep_ids) > 0) {
            $this->db->where_in('department_entity_names_id', $dep_ids);
        }
        $this->db->where('entity_id', $department_id);
        $this->db->group_by('department_entity_names_id');
        $query = $this->db->get('department_entity_names');
//        echo $this->db->last_query();
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            foreach ($query->result_array() as $value) {
                $data[] = $value["department_entity_names_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAllDepEntity($department_id = false, $dep_ids = array()) {
        $this->db->where('is_delete', '0');
        if (sizeof($dep_ids) > 0) {
            $this->db->where_in('department_entity_names_id', $dep_ids);
        }
        $this->db->where('entity_id', $department_id);
        $query = $this->db->get('department_entity_names');
        $result = $query->result_array();
        if (sizeof($result) > 0) {

            return $result;
        } else {
            return array();
        }
    }

    public function getAllSurveyForms() {
        $this->db->where('is_delete', '0');
//        $this->db->order_by('operation_forms_id', 'DESC');
        $query = $this->db->get('operation_forms');
        return $query->result_array();
    }

    public function updateSurvey($data = false, $survey_form_id = false) {
        $this->db->where("operation_forms_id", $survey_form_id);
        $this->db->update("operation_forms", $data);
    }

    public function getSurveyForms($survey_form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("operation_forms_id", $survey_form_id);
        $query = $this->db->get("operation_forms");
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "operation_forms_id" => $value["operation_forms_id"],
                    "is_approved" => $value["is_approved"],
                    "form_title" => $value["form_title"],
                    "survey_year" => $value["survey_year"],
                    "form_desc" => $value["form_desc"],
                    "form_language" => $value["form_language"],
                    "no_of_group" => $value["no_of_group"],
                    "form_type" => $value["form_type"],
                    "category" => $value["category"],
                    "department_id" => $value["department_id"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"]
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function updateSurveyForm($data = false, $operation_forms_id = false) {
        $this->db->where("operation_forms_id", $operation_forms_id);
        $this->db->update("operation_forms", $data);
    }

    public function getFormData($form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("operation_forms_id", $form_id);
        $query = $this->db->get("operation_forms");
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "operation_forms_id" => $value["operation_forms_id"],
                    "is_approved" => $value["is_approved"],
                    "form_title" => $value["form_title"],
                    "survey_year" => $value["survey_year"],
                    "form_desc" => $value["form_desc"],
                    "form_language" => $value["form_language"],
                    "no_of_group" => $value["no_of_group"],
                    "department_id" => $value["department_id"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "form_questions" => $this->getFormQuestions($value["no_of_group"], $form_id),
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function getFormDataNew($form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("operation_forms_id", $form_id);
        $query = $this->db->get("operation_forms");
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "operation_forms_id" => $value["operation_forms_id"],
                    "is_approved" => $value["is_approved"],
                    "form_title" => $value["form_title"],
                    "survey_year" => $value["survey_year"],
                    "form_desc" => $value["form_desc"],
                    "form_language" => $value["form_language"],
                    "no_of_group" => $value["no_of_group"],
                    "department_id" => $value["department_id"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "form_questions" => $this->getFormQuestionsNew($value["no_of_group"], $form_id),
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function getFormQuestionsNew($no_of_group = false, $form_id = false) {
        if ($no_of_group > 0) {
            $data = array();
            $j = 0;
            $len = $no_of_group;
            for ($i = 1; $i <= $no_of_group; $i++) {
                if ($j == 0) {
                    // first
                    $dat = array(
                        "form_title" => $this->getSectionTitle($i, $form_id),
                        "statements" => $this->getStatements($i, $form_id),
                        "child_section" => $this->getChildsSections($form_id, $i),
                    );
                    $data[] = $dat;
                } else if ($j == $len - 1) {
                    // last
                    $dat = array(
                        "form_title" => $this->getSectionTitle($i, $form_id),
                        "statements" => $this->getStatements($i, $form_id),
                        "child_section" => $this->getChildsSections($form_id, $i),
                    );
                    $data[] = $dat;
                }
                $j++;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getFormQuestions($no_of_group = false, $form_id = false) {
        if ($no_of_group > 0) {
            $data = array();
            for ($i = 1; $i <= $no_of_group; $i++) {
                $dat = array(
                    "form_title" => $this->getSectionTitle($i, $form_id),
                    "statements" => $this->getStatements($i, $form_id),
                    "child_section" => $this->getChildsSections($form_id, $i),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getStatements($section_id = false, $form_id = false, $prent_id = false) {
        $this->db->where('is_delete', '0');
        if ($prent_id) {

            $this->db->where('parent_id', $prent_id);
        } else {
            $this->db->where('parent_id', '0');
        }
        $this->db->where('section', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->order_by('questions_id', 'ASC');
        $query = $this->db->get('questions');
//        echo $this->db->last_query();
//        echo "<br/>";
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "question_statement" => $value["question_statement"],
                    "question_statement_ar" => $value["question_statement_ar"],
                    "is_rating" => $value["is_rating"],
                    "question_type" => $value["question_type"],
                    "is_approved" => $value["is_approved"],
                    "form_id" => $value["form_id"],
                    "section" => $value["section"],
                    "user_id" => $value["user_id"],
                    "is_notes" => $value["is_notes"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "options" => $this->getOptions($value["questions_id"], $value["form_id"], $value["section"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getOptions($questions_id = false, $form_id = false, $section_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('section', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->where('question_id', $questions_id);
        $this->db->order_by('questions_options_id', 'ASC');
        $query = $this->db->get('questions_options');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_options_id" => $value["questions_options_id"],
                    "op_txt" => $value["op_txt"],
                    "op_txt_ar" => $value["op_txt_ar"],
                    "op_val" => $value["op_val"],
                    "question_id" => $value["question_id"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getOptionForAjax($questions_options_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('questions_options_id', $questions_options_id);
        $query = $this->db->get('questions_options');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_options_id" => $value["questions_options_id"],
                    "op_txt" => $value["op_txt"],
                    "op_val" => $value["op_val"],
                    "question_id" => $value["question_id"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getSectionTitle($section_id = false, $form_id = false) {
        $this->db->select('title,title_ar,is_rating,group_titles_id,weight');
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('parent_id', '0');
        $this->db->where('group_id', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->order_by('group_titles_id', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get('group_titles');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return $data = array(
                "title" => "",
                "title_ar" => "",
                "group_titles_id" => "",
                "weight" => "1"
            );
        }
    }

    public function getChildsSections($form_id = false, $section_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('parent_id', $section_id);
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('group_titles');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "group_titles_id" => $value["group_titles_id"],
                    "title" => $value["title"],
                    "title_ar" => $value["title_ar"],
                    "weight" => $value["weight"],
                    "is_rating" => $value["is_rating"],
                    "form_id" => $value["form_id"],
                    "group_id" => $value["group_id"],
                    "parent_id" => $value["parent_id"],
                    "statements" => $this->getStatements($section_id, $form_id, $value["group_titles_id"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getStatementsForAjax($questions_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('parent_id', '0');
        $this->db->where('questions_id', $questions_id);
        $query = $this->db->get('questions');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "question_statement" => $value["question_statement"],
                    "question_statement_ar" => $value["question_statement_ar"],
                    "is_rating" => $value["is_rating"],
                    "question_type" => $value["question_type"],
                    "is_approved" => $value["is_approved"],
                    "form_id" => $value["form_id"],
                    "section" => $value["section"],
                    "user_id" => $value["user_id"],
                    "is_notes" => $value["is_notes"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "options" => $this->getOptions($value["questions_id"], $value["form_id"], $value["section"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getSubStatementsForAjax($questions_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('questions_id', $questions_id);
        $query = $this->db->get('questions');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "question_statement" => $value["question_statement"],
                    "question_statement_ar" => $value["question_statement_ar"],
                    "is_rating" => $value["is_rating"],
                    "question_type" => $value["question_type"],
                    "is_approved" => $value["is_approved"],
                    "form_id" => $value["form_id"],
                    "section" => $value["section"],
                    "user_id" => $value["user_id"],
                    "is_notes" => $value["is_notes"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "options" => $this->getOptions($value["questions_id"], $value["form_id"], $value["section"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function addSurveyForm($data = false) {
        $this->db->insert('operation_forms', $data);
        return $inserted_id = $this->db->insert_id();
    }

    public function getAllAssignForm($users_id = false) {
        $today_date = date("d-m-Y");
        if ($users_id) {
            $this->db->where('user_id', $users_id);
        }
        // $this->db->where('start_date', strtotime($today_date));
        $this->db->where('is_delete', '0');
        $this->db->order_by('form_assign_id', 'DESC');
        $query = $this->db->get('form_assign');
        return $query->result_array();
    }

    public function getAllTheProjects() {
        $this->db->where('is_delete', '0');
        $this->db->order_by('projects_id', 'DESC');
        $query = $this->db->get('projects');
        return $query->result_array();
    }

    public function getProjectDetailById($project_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('projects_id', $project_id);
        $query = $this->db->get('projects');
        return $query->result_array();
    }

    public function getAssignFormData($assign_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('form_assign_id', $assign_id);
        $query = $this->db->get('form_assign');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "form_assign_id" => $value["form_assign_id"],
                    "department_id" => $value["department_id"],
                    "dep_ent" => $value["dep_ent"],
                    "form_id" => $value["form_id"],
                    "user_id" => $value["user_id"],
                    "quantity" => $value["quantity"],
                    "location" => $value["location"],
                    "latitude" => $value["latitude"],
                    "longitude" => $value["longitude"],
                    "radius" => $value["radius"],
                    "start_date" => $value["start_date"],
                    "form_type" => $value["form_type"],
                    "category" => $value["category"],
                    "real_location" => $value["real_location"],
                    "formOfDep" => $this->getAllFormsUnderCategoryAndFormType($value["category"], $value["form_type"], $value["department_id"]),
                    "getDepEnt" => $this->getDepEnt($value["department_id"]),
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function delSubStatement($id) {
        $this->db->select('questions_id');
        $this->db->where('is_delete', '0');
        $this->db->where('parent_id', $id);
        $query = $this->db->get('questions');
        $result = $query->result_array();
        $update_array = array(
            "is_delete" => "1",
            "is_active" => "0",
            "modified_date" => time(),
        );
        if (sizeof($result) > 0) {
            $questions_array = array();
            foreach ($query->result_array() as $value) {
                $questions_array[] = $value["questions_id"];
            }

            // delete all the questions
            $this->db->where('parent_id', $id);
            $this->db->update('questions', $update_array);
            // delete the all the option under these questions
            $this->db->where_in('question_id', $questions_array);
            $this->db->update('questions_options', $update_array);
        }
        // delete the statement as well
        $this->db->where('group_titles_id', $id);
        $this->db->update('group_titles', $update_array);
    }

    public function getAllTheServices($prject_id = false) {
        $this->db->select('target_services');
        $this->db->where('project_id', $prject_id);
        $this->db->group_by('target_services');
        $query = $this->db->get('form_assign');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {

                $data[] = $value["target_services"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAllMasterPlanForSpecificProject($prject_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('project_id_fk', $prject_id);
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "project_master_plan_id" => $value["project_master_plan_id"],
                    "project_id_fk" => $value["project_id_fk"],
                    "created_by" => $value["created_by"],
                    "entity_id_fk" => $value["entity_id_fk"],
                    "department_id_fk" => $value["department_id_fk"],
                    "branch_id_fk" => $value["branch_id_fk"],
                    "form_type" => $value["form_type"],
                    "category" => $value["category"],
//                    "form_id" => $value["form_id"],
                    "quantity" => $value["quantity"],
                    "created_date" => $value["created_date"],
                    "assign_form" => $this->getAssignForm($value["project_master_plan_id"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAssignForm($project_master_plan_id) {
        $this->db->select('form_id_fk,master_plan_form_id');
        $this->db->where('is_delete', '0');
        $this->db->where('project_master_plan_id_fk', $project_master_plan_id);
        $query = $this->db->get('master_plan_form');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "form_id_fk" => $value["form_id_fk"],
                    "master_plan_form_id" => $value["master_plan_form_id"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getApprovedProjects() {
        $this->db->where('is_delete', '0');
        $this->db->where('is_approved', 'yes');
        $this->db->where('is_completed', 'no');
        $this->db->where('is_completed', 'no');
        $this->db->order_by('projects_id', 'DESC');
        $query = $this->db->get('projects');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "projects_id" => $value["projects_id"],
                    "project_title" => $value["project_title"],
                    "project_description" => $value["project_description"],
                    "quantity" => $value["quantity"],
                    "end_date" => $value["end_date"],
                    "form_type" => $value["form_type"],
                    "created_by" => $value["created_by"],
                    "is_approved" => $value["is_approved"],
                    "is_completed" => $value["is_completed"],
                    "created_date" => $value["created_date"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getEntitiesUnderThisProject($projects_id = false) {
        $this->db->select('entity_id_fk');
        $this->db->where('project_id_fk', $projects_id);
        $this->db->where('is_delete', '0');
        $this->db->group_by('entity_id_fk');
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["entity_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getFormTypesUnderThisProject($projects_id = false) {
        $this->db->select('form_type');
        $this->db->where('project_id_fk', $projects_id);
        $this->db->where('is_delete', '0');
        $this->db->group_by('entity_id_fk');
        $query = $this->db->get('project_master_plan');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "form_type" => $value["form_type"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAllDepartments($ids = false) {
        if (sizeof($ids) > 0) {
            $this->db->where("is_delete", "0");
            $this->db->where_in("department_id", $ids);
            $this->db->order_by('code', 'ASC');
            $query = $this->db->get("department");
            if (sizeof($query->result_array()) > 0) {
                $data = array();
                foreach ($query->result_array() as $value) {
                    $dat = array(
                        "department_id" => $value["department_id"],
                        "department_name" => $value["department_name"],
                        "code" => $value["code"],
                        "created_date" => $value["created_date"],
                        "is_active" => $value["is_active"]
                    );
                    $data[] = $dat;
                }
                return $data;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function getAllAttachmentsUnderSection($form_id = false, $section_id = false, $user_id = false, $assign_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("form_id", $form_id);
        $this->db->where("section_id", $section_id);
//        if($user_id){
//            
//        $this->db->where("user_id", $user_id);
//        }
        $this->db->where("assign_id", $assign_id);
        $this->db->order_by("evidence_id", 'DESC');
        $query = $this->db->get('evidence');
        return $query->result_array();
    }

    public function getUserNameByQuestionAndOpt($question_id = false, $optval = false, $answerid = false) {
        $this->db->select("answer_id_fk");
        $this->db->where("is_delete", "0");
        $this->db->where("question_id", $question_id);
        $this->db->where("selected_answer", $optval);
        if ($answerid) {
            $this->db->where_in("answer_id_fk", $answerid);
        }
        $this->db->group_by("answer_id_fk");
        $query = $this->db->get('answer_data');
        //   echo $this->db->last_query();
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["answer_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getUserIdByAnswerId($anwsers_id = false) {
        $this->db->select("user_id");
        $this->db->where("is_delete", "0");
        $this->db->where_in("answers_id", $anwsers_id);
        $this->db->group_by("user_id");
        $query = $this->db->get('answers');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["user_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getUserNameByUserId($users_id = false) {
        $this->db->select("name");
        $this->db->where("is_delete", "0");
        $this->db->where_in("users_id", $users_id);
        $query = $this->db->get('users');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["name"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAnswersId($department = false, $dep_ent = false, $branches = false, $form_type = false, $category = false, $survey_form = false, $prj = false) {
        $this->db->select("answers_id");
        $this->db->where("is_delete", "0");
        if ($department) {
            $this->db->where("department_id", $department);
        }
        if ($dep_ent) {
            $this->db->where("dep_entity_id", $dep_ent);
        }
        if ($branches) {
            $this->db->where("branch_id", $branches);
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
        if ($prj) {
            $this->db->where("project_id", $prj);
        }
        $this->db->group_by("answers_id");
        $this->db->order_by("dep_entity_id", 'DESC');
        $query = $this->db->get('answers');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["answers_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAnswersIdNew($department = false, $dep_ent = false, $branches = false, $form_type = false, $category = false, $survey_form = false) {
        $this->db->select("answers_id");
        $this->db->where("is_delete", "0");
        if ($department) {
            $this->db->where("department_id", $department);
        }
        if (sizeof($dep_ent) > 0) {
            $this->db->where_in("dep_entity_id", $dep_ent);
        }
        if ($branches) {
            $this->db->where("branch_id", $branches);
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
        $this->db->group_by("answers_id");
        $this->db->order_by("answers_id", 'DESC');
        $query = $this->db->get('answers');
//        echo $this->db->last_query();
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["answers_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getAllProjectUnderEntityForm($entity_id = false, $form_type = false, $dep_ent = array(), $category = false) {

        $this->db->select('projects.projects_id, project_master_plan.project_id_fk');
        $this->db->from('projects');
        $this->db->join('project_master_plan', 'projects.projects_id = project_master_plan.project_id_fk');
        $this->db->where('projects.is_delete', '0');
        $this->db->where('project_master_plan.entity_id_fk', $entity_id);
        $this->db->where('project_master_plan.form_type', $form_type);
        if ($category) {
            $this->db->where('project_master_plan.category', $category);
        }
        if (sizeof($dep_ent) > 0) {
            $this->db->where_in('project_master_plan.department_id_fk', $dep_ent);
        }
        $this->db->group_by('projects.projects_id');
        $query = $this->db->get();
//        echo $this->db->last_query();
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["project_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getFormIdFromProjectIdNew($project_ids = array(), $cat = false) {
        if (sizeof($project_ids) > 0) {
            $this->db->select('form_id');
            $this->db->where('is_delete', '0');
            $this->db->where('category', $cat);
            $this->db->where('project_id', $project_ids);
            $this->db->group_by('form_id');
            $query = $this->db->get('answers');
            if (sizeof($query->result_array()) > 0) {
                $data = array();
                foreach ($query->result_array() as $value) {
                    $data[] = $value["form_id"];
                }
                return $data;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function getFormIdFromProjectId($project_ids = array(), $cat = false) {
        if (sizeof($project_ids) > 0) {
            $this->db->select('form_id');
            $this->db->where('is_delete', '0');
            $this->db->where('category', $cat);
            $this->db->where_in('project_id', $project_ids);
            $this->db->group_by('form_id');
            $query = $this->db->get('answers');
            if (sizeof($query->result_array()) > 0) {
                $data = array();
                foreach ($query->result_array() as $value) {
                    $data[] = $value["form_id"];
                }
                return $data;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function getQuestionsUnderTheFrom($form_id = false) {
        $this->db->select('questions_id,section');
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('is_rating', 'yes');
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('questions');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            $section = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "section" => $value["section"],
                    "options" => $this->getOptions($value["questions_id"], $form_id, $value["section"]),
                );
                // $section[] = $value["section"];
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getRatingFormTitle($form_id = false) {
        $this->db->select('title,title_ar,weight,group_titles_id,group_id');
        $this->db->where('is_delete', '0');
        $this->db->where('parent_id', '0');
        $this->db->where('is_active', '1');
        $this->db->where('is_rating', 'yes');
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('group_titles');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "title" => $value["title"],
                    "title_ar" => $value["title_ar"],
                    "weight" => $value["weight"],
                    "group_titles_id" => $value["group_titles_id"],
                    "options" => $this->getChildsSectionsNew($form_id, $value["group_id"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getChildsSectionsNew($form_id = false, $section_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('is_rating', 'yes');
        $this->db->where('parent_id', $section_id);
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('group_titles');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "group_titles_id" => $value["group_titles_id"],
                    "title" => $value["title"],
                    "title_ar" => $value["title_ar"],
                    "weight" => $value["weight"],
                    "statements" => $this->getStatementsNew($section_id, $form_id, $value["group_titles_id"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getStatementsNew($section_id = false, $form_id = false, $prent_id = false) {
        $this->db->where('is_delete', '0');
        if ($prent_id) {

            $this->db->where('parent_id', $prent_id);
        } else {
            $this->db->where('parent_id', '0');
        }
        $this->db->where('section', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->order_by('questions_id', 'ASC');
        $query = $this->db->get('questions');
//        echo $this->db->last_query();
//        echo "<br/>";
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "question_statement" => $value["question_statement"],
                    "question_statement_ar" => $value["question_statement_ar"],
                    "is_rating" => $value["is_rating"],
                    "question_type" => $value["question_type"],
                    "section" => $value["section"],
                    "is_notes" => $value["is_notes"],
                    "options" => $this->getOptions($value["questions_id"], $value["form_id"], $value["section"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getFormDataForRating($form_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("operation_forms_id", $form_id);
        $query = $this->db->get("operation_forms");
//        echo $this->db->last_query();
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "operation_forms_id" => $value["operation_forms_id"],
                    "is_approved" => $value["is_approved"],
                    "form_title" => $value["form_title"],
                    "form_language" => $value["form_language"],
                    "no_of_group" => $value["no_of_group"],
                    "department_id" => $value["department_id"],
                    "form_questions" => $this->getFormQuestionsForRating($value["no_of_group"], $form_id),
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function getFormQuestionsForRating($no_of_group = false, $form_id = false) {
        if ($no_of_group > 0) {
            $data = array();
            for ($i = 1; $i <= $no_of_group; $i++) {
                $dat = array(
                    "form_title" => $this->getSectionTitleForRating($i, $form_id),
                    "statements" => $this->getStatementsForRating($i, $form_id),
                    "child_section" => $this->getChildsSectionsForRating($form_id, $i),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getStatementsForRating($section_id = false, $form_id = false, $prent_id = false) {
        $this->db->where('is_rating', 'yes');
        $this->db->where('is_delete', '0');
        if ($prent_id) {

            $this->db->where('parent_id', $prent_id);
        } else {
            $this->db->where('parent_id', '0');
        }
        $this->db->where('section', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->order_by('questions_id', 'ASC');
        $query = $this->db->get('questions');
//        echo $this->db->last_query();
//        echo "<br/>";
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "questions_id" => $value["questions_id"],
                    "question_statement" => $value["question_statement"],
                    "question_statement_ar" => $value["question_statement_ar"],
                    "is_rating" => $value["is_rating"],
                    "question_type" => $value["question_type"],
                    "is_approved" => $value["is_approved"],
                    "form_id" => $value["form_id"],
                    "section" => $value["section"],
                    "user_id" => $value["user_id"],
                    "is_notes" => $value["is_notes"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"],
                    "options" => $this->getOptions($value["questions_id"], $value["form_id"], $value["section"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getSectionTitleForRating($section_id = false, $form_id = false) {
        $this->db->select('title,title_ar,is_rating,group_titles_id,weight');
        $this->db->where('is_rating', 'yes');
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('parent_id', '0');
        $this->db->where('group_id', $section_id);
        $this->db->where('form_id', $form_id);
        $this->db->order_by('group_titles_id', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get('group_titles');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return $data = array(
                "title" => "",
                "title_ar" => "",
                "group_titles_id" => "",
                "weight" => "1"
            );
        }
    }

    public function getChildsSectionsForRating($form_id = false, $section_id = false) {
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('is_rating', 'yes');
        $this->db->where('parent_id', $section_id);
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('group_titles');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "group_titles_id" => $value["group_titles_id"],
                    "title" => $value["title"],
                    "title_ar" => $value["title_ar"],
                    "weight" => $value["weight"],
                    "is_rating" => $value["is_rating"],
                    "form_id" => $value["form_id"],
                    "group_id" => $value["group_id"],
                    "parent_id" => $value["parent_id"],
                    "statements" => $this->getStatementsForRating($section_id, $form_id, $value["group_titles_id"]),
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function getOverAll($entity = false, $form_type = false, $cat = false, $dep_ent = false) {
        $this->db->select('SUM(avg) as avg,SUM(pure) as pure, COUNT(*) as total');
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        if ($cat) {
            $this->db->where('category', $cat);
        }
        $this->db->where('entity_id', $entity);
        $this->db->where('form_type', $form_type);
        if (sizeof($dep_ent) > 0) {
            $this->db->where_in('dep_id', $dep_ent);
        }
        $query = $this->db->get('over_all_avg');
//        echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }

    public function getOverAllByDep($entity = false, $form_type = false, $category = false, $survey_form = false, $project_id = false, $dep_id = false) {
        $this->db->select('SUM(avg) as avg,SUM(pure) as pure, COUNT(*) as total');
        $this->db->where('is_delete', '0');
        $this->db->where('is_active', '1');
        $this->db->where('category', $category);
        $this->db->where('entity_id', $entity);
        $this->db->where('form_type', $form_type);
        $this->db->where('form_id', $survey_form);
        $this->db->where('project_id', $project_id);
        $this->db->where('dep_id', $dep_id);
        $query = $this->db->get('over_all_avg');
//        echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }

    public function getAllDoneUnderThisProject($projct_id = false, $assign_id = false) {

        $this->db->select('assign_id_fk');
        $this->db->where('is_delete', '0');
        if ($assign_id) {
            $this->db->where('assign_id_fk', $assign_id);
        }
        $this->db->where('project_id', $projct_id);
        $query = $this->db->get('answers');
        $result = $query->result_array();
        return $result;
    }

    public function getAllAssignIdsUnderProject($projct_id = false) {

        $this->db->select('assign_id_fk');
        $this->db->where('is_delete', '0');
        $this->db->where('project_id', $projct_id);
        $query = $this->db->get('answers');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["assign_id_fk"];
            }
            return $data;
        } else {
            return array();
        }
    }

}
