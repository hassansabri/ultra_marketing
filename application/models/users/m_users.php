<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_users
 *
 * @author Hassan
 */
class m_users extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getUserDetail($user_id = false) {
//        $this->db->where("is_active", "1");
        $this->db->where("is_delete", "0");
        $this->db->where("users_id", $user_id);
        $query = $this->db->get("users");
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "users_id" => $value["users_id"],
                    "user_name" => $value["user_name"],
                    "name" => $value["name"],
                    "user_type" => $value["user_type"],
                    "email" => $value["email"],
                    "gender" => $value["gender"],
                    "phone" => $value["phone"],
                    "designation" => $value["designation"],
                    "emergency_number" => $value["emergency_number"],
                    "passport_no" => $value["passport_no"],
                    "blood_group" => $value["blood_group"],
                    "user_image" => $value["user_image"],
                    "random_id" => $value["random_id"],
                 //   "latitude" => $value["latitude"],
                 //   "longitude" => $value["longitude"],
                //    "geo_address" => $value["geo_address"],
                 //   "radius" => $value["radius"],
                    // "entity_id" => $value["entity_id"],
               //     "nationality" => $value["nationality"]
                );
                return $dat;
            }
        } else {
            return array();
        }
    }

    public function updateUser($data = false, $user_id = false) {
        $this->db->where("users_id", $user_id);
        $this->db->update("users", $data);
    }

    public function updatePassword($data = false, $user_id = false, $oldpassword = false) {
        $oldpassword = md5($oldpassword);
        $this->db->where("users_id", $user_id);
        $this->db->where("password", $oldpassword);
        $this->db->update("users", $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }

    public function getAllUsers($users_id = false, $user_type = false) {
        $this->db->where("is_delete", "0");
//        $this->db->where("users_id !=", $users_id);
//        if ($user_type != "super_admin") {
//            $this->db->where("user_type !=", "super_admin");
//        }
        $query = $this->db->get("users");
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $dat = array(
                    "users_id" => $value["users_id"],
                    "user_name" => $value["user_name"],
                    "name" => $value["name"],
                    "user_type" => $value["user_type"],
                    "email" => $value["email"],
                    "gender" => $value["gender"],
                    "phone" => $value["phone"],
                    "designation" => $value["designation"],
                    "emergency_number" => $value["emergency_number"],
                    "passport_no" => $value["passport_no"],
                    "blood_group" => $value["blood_group"],
                    "user_image" => $value["user_image"],
                    "random_id" => $value["random_id"],
              //      "latitude" => $value["latitude"],
             //       "longitude" => $value["longitude"],
                //    "geo_address" => $value["geo_address"],
                //    "radius" => $value["radius"],
                    "is_active" => $value["is_active"],
                //   "nationality" => $value["nationality"],
                );
                $data[] = $dat;
            }
            return $data;
        } else {
            return array();
        }
    }

    public function changestatus($user_id = false, $data = false) {
        $this->db->where('users_id', $user_id);
        $this->db->update('users', $data);
        $afftectedRows = $this->db->affected_rows();
        return $afftectedRows;
    }

    public function getUserTypes() {
        $query = $this->db->get('users_types');
        return $query->result_array();
    }

    public function getCurretnUserTypes($user_id = false) {
        $this->db->select('users_type_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('users_data');
        if (sizeof($query->result_array()) > 0) {
            $data = array();
            foreach ($query->result_array() as $value) {
                $data[] = $value["users_type_id"];
            }
            return $data;
        } else {
            return array();
        }
    }

    public function addUserType($data = false) {
        $this->db->insert('users_data', $data);
    }

    public function deleteUserType($user_id = false, $type_id = false) {
        $this->db->where('user_id', $user_id);
        $this->db->where('users_type_id', $type_id);
        $this->db->delete('users_data');
    }

    public function checkusername($username = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("user_name", $username);
        $query = $this->db->get("users");
        $result = $query->result_array();
        return $result;
    }

    public function checkemail($email = false) {
        $this->db->where("is_delete", "0");
        $this->db->where("email", $email);
        $query = $this->db->get("users");
        $result = $query->result_array();
        return $result;
    }

}
