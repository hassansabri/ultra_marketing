<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permissions extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // =====================================================
    // ROLE MANAGEMENT
    // =====================================================
    
    /**
     * Get all roles
     */
    public function getAllRoles($active_only = true) {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        $this->db->order_by('role_name', 'ASC');
        return $this->db->get('roles')->result_array();
    }
    
    /**
     * Get role by ID
     */
    public function getRoleById($role_id) {
        return $this->db->get_where('roles', ['role_id' => $role_id])->row_array();
    }
    
    /**
     * Create new role
     */
    public function createRole($data) {
        $this->db->insert('roles', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update role
     */
    public function updateRole($role_id, $data) {
        $this->db->where('role_id', $role_id);
        return $this->db->update('roles', $data);
    }
    
    /**
     * Delete role
     */
    public function deleteRole($role_id) {
        $this->db->where('role_id', $role_id);
        return $this->db->delete('roles');
    }
    
    // =====================================================
    // MODULE MANAGEMENT
    // =====================================================
    
    /**
     * Get all modules
     */
    public function getAllModules($active_only = true) {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        $this->db->order_by('module_order', 'ASC');
        return $this->db->get('modules')->result_array();
    }
    
    /**
     * Get module by ID
     */
    public function getModuleById($module_id) {
        return $this->db->get_where('modules', ['module_id' => $module_id])->row_array();
    }
    
    /**
     * Get module by name
     */
    public function getModuleByName($module_name) {
        return $this->db->get_where('modules', ['module_name' => $module_name])->row_array();
    }
    
    /**
     * Create new module
     */
    public function createModule($data) {
        $this->db->insert('modules', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Update module
     */
    public function updateModule($module_id, $data) {
        $this->db->where('module_id', $module_id);
        return $this->db->update('modules', $data);
    }
    
    /**
     * Delete module
     */
    public function deleteModule($module_id) {
        $this->db->where('module_id', $module_id);
        return $this->db->delete('modules');
    }
    
    // =====================================================
    // PERMISSION MANAGEMENT
    // =====================================================
    
    /**
     * Get all permissions
     */
    public function getAllPermissions($active_only = true) {
        if ($active_only) {
            $this->db->where('p.is_active', 1);
        }
        $this->db->select('p.*, m.module_name, m.module_display_name');
        $this->db->from('permissions p');
        $this->db->join('modules m', 'm.module_id = p.module_id');
        $this->db->order_by('m.module_order', 'ASC');
        $this->db->order_by('p.permission_name', 'ASC');
        return $this->db->get()->result_array();
    }
    
    /**
     * Get permissions by module
     */
    public function getPermissionsByModule($module_id, $active_only = true) {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        $this->db->where('module_id', $module_id);
        $this->db->order_by('permission_name', 'ASC');
        return $this->db->get('permissions')->result_array();
    }
    
    /**
     * Get permission by ID
     */
    public function getPermissionById($permission_id) {
        $this->db->select('p.*, m.module_display_name');
        $this->db->from('permissions p');
        $this->db->join('modules m', 'm.module_id = p.module_id', 'left');
        $this->db->where('p.permission_id', $permission_id);
        return $this->db->get()->row_array();
    }
    
    /**
     * Get permission by name
     */
    public function getPermissionByName($permission_name) {
        return $this->db->get_where('permissions', ['permission_name' => $permission_name])->row_array();
    }
    
    /**
     * Create a new permission
     */
    public function createPermission($data) {
        $this->db->insert('permissions', $data);
        return $this->db->insert_id();
    }

    /**
     * Update a permission
     */
    public function updatePermission($permission_id, $data) {
        $this->db->where('permission_id', $permission_id);
        return $this->db->update('permissions', $data);
    }

    /**
     * Get all roles with this permission
     */
    public function getRolesWithPermission($permission_id) {
        $this->db->select('r.role_id, r.role_name, r.role_display_name');
        $this->db->from('role_permissions rp');
        $this->db->join('roles r', 'r.role_id = rp.role_id');
        $this->db->where('rp.permission_id', $permission_id);
        return $this->db->get()->result_array();
    }

    /**
     * Get all users with this permission (via their roles)
     */
    public function getUsersWithPermission($permission_id) {
        $this->db->select('u.users_id, u.name, u.email');
        $this->db->from('user_roles ur');
        $this->db->join('users u', 'u.users_id = ur.users_id');
        $this->db->join('role_permissions rp', 'rp.role_id = ur.role_id');
        $this->db->where('rp.permission_id', $permission_id);
        $this->db->where('u.is_active', 1);
        $this->db->group_by('u.users_id');
        return $this->db->get()->result_array();
    }
    
    /**
     * Delete permission
     */
    public function deletePermission($permission_id) {
        $this->db->where('permission_id', $permission_id);
        return $this->db->delete('permissions');
    }
    
    // =====================================================
    // ROLE PERMISSION MANAGEMENT
    // =====================================================
    
    /**
     * Get permissions for a role
     */
    public function getRolePermissions($role_id) {
        $this->db->select('p.*, m.module_name, m.module_display_name');
        $this->db->from('role_permissions rp');
        $this->db->join('permissions p', 'p.permission_id = rp.permission_id');
        $this->db->join('modules m', 'm.module_id = p.module_id');
        $this->db->where('rp.role_id', $role_id);
        $this->db->where('p.is_active', 1);
        $this->db->order_by('m.module_order', 'ASC');
        $this->db->order_by('p.permission_name', 'ASC');
        return $this->db->get()->result_array();
    }
    public function getRolePermissionid($role_id) { 
        $this->db->select('p.permission_id');
        $this->db->from('role_permissions rp');
        $this->db->join('permissions p', 'p.permission_id = rp.permission_id');
        $this->db->join('modules m', 'm.module_id = p.module_id');
        $this->db->where('rp.role_id', $role_id);
        $this->db->where('p.is_active', 1);
        $this->db->order_by('m.module_order', 'ASC');
        $this->db->order_by('p.permission_name', 'ASC');
        
  $query = $this->db->get();
        if (sizeof($query->result_array()) > 0) {
            $dat = array();
            foreach ($query->result_array() as $value) {
                $dat[] = $value["permission_id"];
            }
            return $dat;
        } else {
            return array();
        }
    }
    
    /**
     * Assign permission to role
     */
    public function assignPermissionToRole($role_id, $permission_id, $granted_by = null) {
        $data = [
            'role_id' => $role_id,
            'permission_id' => $permission_id,
            'granted_by' => $granted_by
        ];
        
        // Check if already assigned
        $existing = $this->db->get_where('role_permissions', [
            'role_id' => $role_id,
            'permission_id' => $permission_id
        ])->row_array();
        
        if (!$existing) {
            return $this->db->insert('role_permissions', $data);
        }
        return true;
    }
    
    /**
     * Remove permission from role
     */
    public function removePermissionFromRole($role_id, $permission_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('permission_id', $permission_id);
        return $this->db->delete('role_permissions');
    }
    
    /**
     * Update role permissions (bulk)
     */
    public function updateRolePermissions($role_id, $permission_ids, $granted_by = null) {
        // Remove all existing permissions
        $this->db->where('role_id', $role_id);
        $this->db->where('role_id', 'DESC');
        $this->db->delete('role_permissions');
        
        // Add new permissions
        if (!empty($permission_ids)) {
            $data = [];
            foreach ($permission_ids as $permission_id) {
                $data[] = [
                    'role_id' => $role_id,
                    'permission_id' => $permission_id,
                    'granted_by' => $granted_by
                ];
            }
            return $this->db->insert_batch('role_permissions', $data);
        }
        return true;
    }
    public function updateRolePermissions2($role_id, $permission_id, $granted_by,$val) {
        // Remove all existing permissions
        
        if($val=='yes'){

            // Add new permissions
                $data = [];
                    $data = [
                        'role_id' => $role_id,
                        'permission_id' => $permission_id,
                        'granted_by' => $granted_by
                    ];
                
                 $this->db->insert('role_permissions', $data);
            
        }else{
            $this->db->where('role_id', $role_id);
            $this->db->where('permission_id', $permission_id);
        $this->db->delete('role_permissions');
        }
        return true;
    }
    // =====================================================
    // USER ROLE MANAGEMENT
    // =====================================================
    
    /**
     * Get roles for a user
     */
    public function getUserRoles($users_id) {
        $this->db->select('r.*');
        $this->db->from('user_roles ur');
        $this->db->join('roles r', 'r.role_id = ur.role_id');
        $this->db->where('ur.users_id', $users_id);
        $this->db->where('ur.is_active', 1);
        $this->db->where('r.is_active', 1);
        $this->db->order_by('r.role_name', 'ASC');
        return $this->db->get()->result_array();
    }
    
    /**
     * Assign role to user
     */
    public function assignRoleToUser($users_id, $role_id, $assigned_by = null) {
        $data = [
            'users_id' => $users_id,
            'role_id' => $role_id,
            'assigned_by' => $assigned_by
        ];
        
        // Check if already assigned
        $existing = $this->db->get_where('user_roles', [
            'user_role_id' => $users_id,
            'role_id' => $role_id
        ])->row_array();
        
        if (!$existing) {
            return $this->db->insert('user_roles', $data);
        } else {
            // Update if exists but inactive
            $this->db->where('user_role_id', $users_id);
            $this->db->where('role_id', $role_id);
            return $this->db->update('user_roles', ['is_active' => 1]);
        }
    }
    
    /**
     * Remove role from user
     */
    public function removeRoleFromUser($users_id, $role_id) {
        $this->db->where('user_role_id', $users_id);
        $this->db->where('role_id', $role_id);
        return $this->db->update('user_roles', ['is_active' => 0]);
    }
    
    /**
     * Update user roles (bulk)
     */
    public function updateUserRoles($users_id, $role_ids, $assigned_by = null) {
        // Deactivate all existing roles
        $this->db->where('user_role_id', $users_id);
        $this->db->update('user_roles', ['is_active' => 0]);
        
        // Add new roles
        if (!empty($role_ids)) {
            foreach ($role_ids as $role_id) {
                $this->assignRoleToUser($users_id, $role_id, $assigned_by);
            }
        }
        return true;
    }
    
    /**
     * Remove all roles from user
     */
    public function removeAllUserRoles($users_id) {
        $this->db->where('user_role_id', $users_id);
        return $this->db->update('user_roles', ['is_active' => 0]);
    }
    
    /**
     * Bulk assign roles to multiple users
     */
    public function bulk_assign_roles($users_ids, $role_ids, $action = 'add', $assigned_by = null) {
        $results = [
            'success_count' => 0,
            'error_count' => 0,
            'errors' => []
        ];
        
        foreach ($users_ids as $users_id) {
            try {
                if ($action === 'replace') {
                    // Remove all existing roles and assign new ones
                    $this->removeAllUserRoles($users_id);
                    foreach ($role_ids as $role_id) {
                        $this->assignRoleToUser($users_id, $role_id, $assigned_by);
                    }
                } elseif ($action === 'remove') {
                    // Remove only selected roles
                    foreach ($role_ids as $role_id) {
                        $this->removeRoleFromUser($users_id, $role_id);
                    }
                } else {
                    // Add roles (keep existing)
                    foreach ($role_ids as $role_id) {
                        // Check if role is already assigned
                        $existing_roles = $this->getUserRoles($users_id);
                        $role_exists = false;
                        foreach ($existing_roles as $existing_role) {
                            if ($existing_role['role_id'] == $role_id) {
                                $role_exists = true;
                                break;
                            }
                        }
                        if (!$role_exists) {
                            $this->assignRoleToUser($users_id, $role_id, $assigned_by);
                        }
                    }
                }
                
                $results['success_count']++;
            } catch (Exception $e) {
                $results['error_count']++;
                $results['errors'][] = "User ID {$users_id}: " . $e->getMessage();
            }
        }
        
        return $results;
    }
    
    // =====================================================
    // PERMISSION CHECKING
    // =====================================================
    
    /**
     * Check if user has specific permission
     */
    public function hasPermission($users_id, $permission_name) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('user_permissions_view');
        $this->db->where('users_id', $users_id);
        $this->db->where('permission_name', $permission_name);
        $result = $this->db->get()->row_array();
        return $result['count'] > 0;
    }
    
    /**
     * Check if user has any permission for a module
     */
    public function hasModulePermission($users_id, $module_name) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('user_permissions_view');
        $this->db->where('users_id', $users_id);
        $this->db->where('module_name', $module_name);
        $result = $this->db->get()->row_array();
        // echo $this->db->last_query();
        // exit;
        return $result['count'] > 0;
    }
    
    /**
     * Get all permissions for a user
     */
    public function getUserPermissions($users_id) {
        return $this->db->get_where('user_permissions_view', ['users_id' => $users_id])->result_array();
    }
    
    /**
     * Get user permissions by module
     */
    public function getUserPermissionsByModule($users_id) {
        $permissions = $this->getUserPermissions($users_id);
        $grouped = [];
        
        foreach ($permissions as $permission) {
            $module = $permission['module_name'];
            if (!isset($grouped[$module])) {
                $grouped[$module] = [
                    'module_name' => $permission['module_name'],
                    'module_display_name' => $permission['module_display_name'],
                    'permissions' => []
                ];
            }
            $grouped[$module]['permissions'][] = $permission;
        }
        
        return $grouped;
    }
    
    /**
     * Check if user has permission type for module
     */
    public function hasPermissionType($users_id, $module_name, $permission_type) {
        $this->db->select('COUNT(*) as count');
        $this->db->from('user_permissions_view');
        $this->db->where('users_id', $users_id);
        $this->db->where('module_name', $module_name);
        $this->db->where('permission_type', $permission_type);
        $result = $this->db->get()->row_array();
        //echo $this->db->last_query();
        $c = $result['count'];
        if($c > 0 ){ return true; }else{ return false; }
        // return $result['count'];
    }
    
    // =====================================================
    // UTILITY METHODS
    // =====================================================
    
    /**
     * Get permission types
     */
    public function getPermissionTypes() {
        return [
            'view' => 'View',
            'create' => 'Create',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'export' => 'Export',
            'import' => 'Import',
            'approve' => 'Approve',
            'reject' => 'Reject',
            'print' => 'Print'
        ];
    }
    
    /**
     * Get modules with permissions count
     */
    public function getModulesWithPermissionCount() {
        $this->db->select('m.*, COUNT(p.permission_id) as permission_count');
        $this->db->from('modules m');
        $this->db->join('permissions p', 'p.module_id = m.module_id', 'left');
        $this->db->where('m.is_active', 1);
        $this->db->group_by('m.module_id');
        $this->db->order_by('m.module_order', 'ASC');
        return $this->db->get()->result_array();
    }
    
    /**
     * Get roles with permissions count
     */
    public function getRolesWithPermissionCount() {
        $this->db->select('r.*, COUNT(rp.permission_id) as permission_count');
        $this->db->from('roles r');
        $this->db->join('role_permissions rp', 'rp.role_id = r.role_id', 'left');
        $this->db->where('r.is_active', 1);
        $this->db->group_by('r.role_id');
        $this->db->order_by('r.role_name', 'ASC');
        return $this->db->get()->result_array();
    }
    
    /**
     * Get users with roles count
     */
    
    public function getUsersWithRoleCount() {
        $this->db->select('u.users_id, u.user_name, u.email, COUNT(ur.role_id) as role_count');
        $this->db->from('users u');
        $this->db->join('user_roles ur', 'ur.users_id != u.users_id', 'left');
        $this->db->where('ur.is_active', 1);
        $this->db->group_by('u.users_id');
        $this->db->order_by('u.user_name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Get permission summary for dashboard
     */
    public function getPermissionSummary() {
        $summary = [
            'user_with_roles'=>count($this->getUsersWithRoleCount()),
            'total_roles' => $this->db->count_all('roles'),
            'total_modules' => $this->db->count_all('modules'),
            'total_permissions' => $this->db->count_all('permissions'),
            'total_users' => $this->db->count_all('users'),
            'active_roles' => $this->db->where('is_active', 1)->count_all_results('roles'),
            'active_modules' => $this->db->where('is_active', 1)->count_all_results('modules'),
            'active_permissions' => $this->db->where('is_active', 1)->count_all_results('permissions')
        ];
        
        return $summary;
    }

    /**
     * Get a summary of permissions for a given role, grouped by module, and include users with this role
     */
    public function getRolePermissionSummary($role_id) {
        $this->db->select('m.module_id, m.module_name, m.module_display_name, COUNT(p.permission_id) as permission_count');
        $this->db->from('role_permissions rp');
        $this->db->join('permissions p', 'p.permission_id = rp.permission_id');
        $this->db->join('modules m', 'm.module_id = p.module_id');
        $this->db->where('rp.role_id', $role_id);
        $this->db->where('p.is_active', 1);
        $this->db->group_by(['m.module_id', 'm.module_name', 'm.module_display_name']);
        $this->db->order_by('m.module_order', 'ASC');
        $summary = $this->db->get()->result_array();
// print_r($summary);
// exit;
if(isset($summary) ){
        // Add permissions for each module
        foreach ($summary as &$module) {
            $this->db->select('p.permission_id, p.permission_name, p.permission_display_name, p.permission_description');
            $this->db->from('role_permissions rp');
            $this->db->join('permissions p', 'p.permission_id = rp.permission_id');
            $this->db->where('rp.role_id', $role_id);
            $this->db->where('p.module_id', $module['module_id']);
            $this->db->where('p.is_active', 1);
            $module['permissions'] = $this->db->get()->result_array();

            $this->db->select('u.users_id, u.name, u.email');
            $this->db->from('user_roles ur');
            $this->db->join('users u', 'u.users_id = ur.users_id');
            $this->db->where('ur.role_id', $role_id);
            $this->db->where('u.is_active', 1);
            $users_with_role = $this->db->get()->result_array();
        }
    
}
        // Add users with this role

        return [
            'modules' => $summary,
           // 'user_with_role' => $users_with_role
        ];
    }
} 