<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_department
 *
 * @author Qaisar
 */
class m_departments extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getDepartments() {
        $this->db->where('is_active', '1');
        $this->db->where('is_delete', '0');
        $this->db->order_by('code', 'ASC');
        $query = $this->db->get('department');
        return $query->result_array();
    }

    public function getProcessUnderDepartments($dept_id = false) {
        $this->db->where('is_active', '1');
        $this->db->where('is_delete', '0');
        $this->db->where('department_id_fk', $dept_id);
        $this->db->order_by('process_code', 'ASC');
        $query = $this->db->get('process');
        return $query->result_array();
    }
    
    public function getDepartment($department_id = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("department_id", $department_id);
        $query = $this->db->get("department");
        if (sizeof($query->result_array()) > 0) {
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "department_id" => $value["department_id"],
                    "department_name" => $value["department_name"],
                    "code" => $value["code"],
                    "created_date" => $value["created_date"],
                    "is_active" => $value["is_active"]
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function updateDepartment($data = false, $department_id = false) {
        $this->db->where("department_id", $department_id);
        $this->db->update("department", $data);
    }

    public function getAllDepartments() {
        $this->db->where("is_delete", "0");
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
    }
}
