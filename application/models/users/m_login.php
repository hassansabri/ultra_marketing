<?php
/**
 *  @property CI_DB $db  
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Hassan
 */
class m_login extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function checkLogin($email = false, $password = false) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('is_active', '1');
        $this->db->where('is_delete', '0');
        $query = $this->db->get('users');
        $result = $query->result_array();
        if (sizeof($result) > 0) {
            return $result[0];
        } else {
            return array();
        }
    }

    public function userAccess($user_id = false) {
        $this->db->select('users_types.type_title,users_types.type_title,users_types.users_types_id')->from('users_data');
        $this->db->join('users_types', 'users_types.users_types_id=users_data.users_type_id');
        $this->db->where('users_data.user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

}
