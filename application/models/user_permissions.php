<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_permissions extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Get all permissions for a user
    public function getUserPermissions($user_id) {
        $this->db->select('p.*');
        $this->db->from('permissions p');
        $this->db->join('user_roles ur', 'ur.user_id = ' . (int)$user_id, 'inner');
        $this->db->join('role_permissions rp', 'rp.role_id = ur.role_id', 'inner');
        $this->db->where('rp.permission_id = p.permission_id');
        $this->db->group_by('p.permission_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Assign a permission to a user (direct assignment, if needed)
    public function assignPermissionToUser($user_id, $permission_id) {
        $data = [
            'user_id' => $user_id,
            'permission_id' => $permission_id
        ];
        return $this->db->insert('user_permissions', $data);
    }

    // Remove a permission from a user (direct assignment, if needed)
    public function removePermissionFromUser($user_id, $permission_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('permission_id', $permission_id);
        return $this->db->delete('user_permissions');
    }
} 