<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_permissions');
        $this->load->library('session');
        $this->load->helper('permission_helper');
        
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        // Check if user has permission to access this module
        // if (!has_module_permission('permissions') && !is_admin()) {
        //     $this->session->set_flashdata('error', 'You do not have permission to access this module.');
        //     redirect('dashboard');
        // }
    }
    
    // =====================================================
    // DASHBOARD
    // =====================================================
    public function dashboard(){
        $data['title'] = 'Permission Management Dashboard';
        
        $data['summary'] = $this->m_permissions->getPermissionSummary();
        $data['roles'] = $this->m_permissions->getRolesWithPermissionCount();
        $data['modules'] = $this->m_permissions->getModulesWithPermissionCount();
        $data['users'] = $this->m_permissions->getUsersWithRoleCount();
        // $data['recent_assignments'] = $this->m_permissions->getRecentRoleAssignments();
        $this->load->view('permissions/dashboard', $data);
    }

    public function index() {
        $data['summary'] = $this->m_permissions->getPermissionSummary();
        $data['roles'] = $this->m_permissions->getRolesWithPermissionCount();
        $data['modules'] = $this->m_permissions->getModulesWithPermissionCount();
        $data['users'] = $this->m_permissions->getUsersWithRoleCount();
        // $data['recent_assignments'] = $this->m_permissions->getRecentRoleAssignments();
        $this->load->view('permissions/dashboard', $data);
    }
    
    // =====================================================
    // ROLE MANAGEMENT
    // =====================================================
    
    public function roles() {
        $data['title'] = 'Role Management';
        $data['roles'] = $this->m_permissions->getAllRoles();
        $data['permission_summary'] = $this->m_permissions->getPermissionSummary();
        // $this->load->view('common/header', $data);
        $this->load->view('permissions/roles', $data);
        // $this->load->view('common/footer');
    }
    
    public function add_role() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('role_name', 'Role Name', 'required|is_unique[roles.role_name]');
            $this->form_validation->set_rules('role_description', 'Role Description', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'role_name' => $this->input->post('role_name'),
                    'role_description' => $this->input->post('role_description'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $role_id = $this->m_permissions->createRole($data);
                
                if ($role_id) {
                    $this->session->set_flashdata('success', 'Role created successfully.');
                    redirect('permissions/roles');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create role.');
                }
            }
        }
        
        $data['title'] = 'Add New Role';
        $data['modules'] = $this->m_permissions->getAllModules();
        
        $this->load->view('permissions/add_role', $data);
  
    }
    
    public function edit_role($role_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('role_name', 'Role Name', 'required');
            $this->form_validation->set_rules('role_description', 'Role Description', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'role_name' => $this->input->post('role_name'),
                    'role_description' => $this->input->post('role_description'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    // 'updated_by' => $this->session->userdata('user_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($this->m_permissions->updateRole($role_id, $data)) {
                    $this->session->set_flashdata('success', 'Role updated successfully.');
                    redirect('permissions/roles');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update role.');
                }
            }
        }
        
        $data['title'] = 'Edit Role';
        $data['role'] = $this->m_permissions->getRoleById($role_id);
        $data['modules'] = $this->m_permissions->getAllModules();
        
        if (!$data['role']) {
            $this->session->set_flashdata('error', 'Role not found.');
            redirect('permissions/roles');
        }
        
        $this->load->view('permissions/edit_role', $data);
    
    }
    
    public function delete_role($role_id) {
        // Check if role is assigned to any users
        $users_with_role = $this->m_permissions->getUsersWithRole($role_id);
        
        if (!empty($users_with_role)) {
            $this->session->set_flashdata('error', 'Cannot delete role. It is assigned to ' . count($users_with_role) . ' user(s).');
            redirect('permissions/roles');
        }
        
        if ($this->m_permissions->deleteRole($role_id)) {
            $this->session->set_flashdata('success', 'Role deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete role.');
        }
        redirect('permissions/roles');
    }
    
    public function view_role($role_id) {
        $data['title'] = 'View Role Details';
        $data['role'] = $this->m_permissions->getRoleById($role_id);
        $data['role_permissions'] = $this->m_permissions->getRolePermissions($role_id);
        $data['users_with_role'] = $this->m_permissions->getUsersWithRoleCount($role_id);
        $data['permission_summary'] = $this->m_permissions->getRolePermissionSummary($role_id);
        
        if (!$data['role']) {
            $this->session->set_flashdata('error', 'Role not found.');
            redirect('permissions/roles');
        }
        
        
        $this->load->view('permissions/view_role', $data);
        
    }
    
    // =====================================================
    // MODULE MANAGEMENT
    // =====================================================
    
    public function modules() {
        $data['title'] = 'Module Management';
        $data['modules'] = $this->m_permissions->getAllModules();
        $data['permission_summary'] = $this->m_permissions->getPermissionSummary();
        $this->load->view('permissions/modules', $data);
        
    }
    
    public function add_module() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('module_name', 'Module Name', 'required|is_unique[modules.module_name]');
            $this->form_validation->set_rules('module_display_name', 'Display Name', 'required');
            $this->form_validation->set_rules('module_description', 'Description', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'module_name' => $this->input->post('module_name'),
                    'module_display_name' => $this->input->post('module_display_name'),
                    'module_description' => $this->input->post('module_description'),
                    'module_icon' => $this->input->post('module_icon'),
                    'module_order' => $this->input->post('module_order'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                   // 'created_by' => $this->session->userdata('users_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $module_id = $this->m_permissions->createModule($data);
                
                if ($module_id) {
                    $this->session->set_flashdata('success', 'Module created successfully.');
                    redirect('permissions/modules');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create module.');
                }
            }
        }
        
        $data['title'] = 'Add New Module';
        $this->load->view('permissions/add_module', $data);
        
    }
    
    public function edit_module($module_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('module_name', 'Module Name', 'required');
            $this->form_validation->set_rules('module_display_name', 'Display Name', 'required');
            $this->form_validation->set_rules('module_description', 'Description', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'module_name' => $this->input->post('module_name'),
                    'module_display_name' => $this->input->post('module_display_name'),
                    'module_description' => $this->input->post('module_description'),
                    'module_icon' => $this->input->post('module_icon'),
                    'module_order' => $this->input->post('module_order'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    // 'updated_by' => $this->session->userdata('user_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($this->m_permissions->updateModule($module_id, $data)) {
                    $this->session->set_flashdata('success', 'Module updated successfully.');
                    redirect('permissions/modules');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update module.');
                }
            }
        }
        
        $data['title'] = 'Edit Module';
        $data['module'] = $this->m_permissions->getModuleById($module_id);
        
        if (!$data['module']) {
            $this->session->set_flashdata('error', 'Module not found.');
            redirect('permissions/modules');
        }
        $this->load->view('permissions/edit_module', $data);
    }
    
    public function delete_module($module_id) {
        // Check if module has permissions
        $permissions = $this->m_permissions->getPermissionsByModule($module_id);
        
        if (!empty($permissions)) {
            $this->session->set_flashdata('error', 'Cannot delete module. It has ' . count($permissions) . ' permission(s).');
            redirect('permissions/modules');
        }
        
        if ($this->m_permissions->deleteModule($module_id)) {
            $this->session->set_flashdata('success', 'Module deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete module.');
        }
        redirect('permissions/modules');
    }
    
    public function view_module($module_id) {
        $data['title'] = 'View Module Details';
        $data['module'] = $this->m_permissions->getModuleById($module_id);
        $data['permissions'] = $this->m_permissions->getPermissionsByModule($module_id);
        $data['roles_with_permissions'] = $this->m_permissions->getRolesWithModulePermissions($module_id);
        
        if (!$data['module']) {
            $this->session->set_flashdata('error', 'Module not found.');
            redirect('permissions/modules');
        }
    
        $this->load->view('permissions/view_module', $data);
        
    }
    
    // =====================================================
    // PERMISSION MANAGEMENT
    // =====================================================
    
    public function permissions() {
        $data['title'] = 'Permission Management';
        $data['permissions'] = $this->m_permissions->getAllPermissions();
        $data['modules'] = $this->m_permissions->getAllModules();
        $data['permission_types'] = $this->m_permissions->getPermissionTypes();
        $data['permission_summary'] = $this->m_permissions->getPermissionSummary();

        $this->load->view('permissions/permissions', $data);
    
    }
    
    public function add_permission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('module_id', 'Module', 'required');
            $this->form_validation->set_rules('permission_name', 'Permission Name', 'required|is_unique[permissions.permission_name]');
            $this->form_validation->set_rules('permission_display_name', 'Display Name', 'required');
            $this->form_validation->set_rules('permission_description', 'Description', 'required');
            $this->form_validation->set_rules('permission_type', 'Permission Type', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'module_id' => $this->input->post('module_id'),
                    'permission_name' => $this->input->post('permission_name'),
                    'permission_display_name' => $this->input->post('permission_display_name'),
                    'permission_description' => $this->input->post('permission_description'),
                    'permission_type' => $this->input->post('permission_type'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $permission_id = $this->m_permissions->createPermission($data);
                
                if ($permission_id) {
                    $this->session->set_flashdata('success', 'Permission created successfully.');
                    redirect('permissions/permissions');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create permission.');
                }
            }
        }
        
        $data['title'] = 'Add New Permission';
        $data['modules'] = $this->m_permissions->getAllModules();
        $data['permission_types'] = $this->m_permissions->getPermissionTypes();
        
        
        $this->load->view('permissions/add_permission', $data);
        
    }
    
    public function edit_permission($permission_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('module_id', 'Module', 'required');
            $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');
            $this->form_validation->set_rules('permission_display_name', 'Display Name', 'required');
            $this->form_validation->set_rules('permission_description', 'Description', 'required');
            $this->form_validation->set_rules('permission_type', 'Permission Type', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'module_id' => $this->input->post('module_id'),
                    'permission_name' => $this->input->post('permission_name'),
                    'permission_display_name' => $this->input->post('permission_display_name'),
                    'permission_description' => $this->input->post('permission_description'),
                    'permission_type' => $this->input->post('permission_type'),
                    'is_active' => $this->input->post('is_active') ? 1 : 0,
                    // 'updated_by' => $this->session->userdata('user_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($this->m_permissions->updatePermission($permission_id, $data)) {
                    $this->session->set_flashdata('success', 'Permission updated successfully.');
                    redirect('permissions/permissions');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update permission.');
                }
            }
        }
        
        $data['title'] = 'Edit Permission';
        $data['permission'] = $this->m_permissions->getPermissionById($permission_id);
        $data['modules'] = $this->m_permissions->getAllModules();
        $data['permission_types'] = $this->m_permissions->getPermissionTypes();
        
        if (!$data['permission']) {
            $this->session->set_flashdata('error', 'Permission not found.');
            redirect('permissions/permissions');

        }
        $this->load->view('permissions/edit_permission', $data);
}
    public function delete_permission($permission_id) {
        // Check if permission is assigned to any roles
        $roles_with_permission = $this->m_permissions->getRolesWithPermission($permission_id);
        
        if (!empty($roles_with_permission)) {
            $this->session->set_flashdata('error', 'Cannot delete permission. It is assigned to ' . count($roles_with_permission) . ' role(s).');
            redirect('permissions/permissions');
        }
        
        if ($this->m_permissions->deletePermission($permission_id)) {
            $this->session->set_flashdata('success', 'Permission deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete permission.');
        }
        redirect('permissions/permissions');
    }
    
    public function view_permission($permission_id) {
        $data['title'] = 'View Permission Details';
        $data['permission'] = $this->m_permissions->getPermissionById($permission_id);
        $data['roles_with_permission'] = $this->m_permissions->getRolesWithPermission($permission_id);
        $data['users_with_permission'] = $this->m_permissions->getUsersWithPermission($permission_id);
        
        if (!$data['permission']) {
            $this->session->set_flashdata('error', 'Permission not found.');
            redirect('permissions/permissions');
        }
        
        
        $this->load->view('permissions/view_permission', $data);
        
    }
    
    // =====================================================
    // ROLE PERMISSION ASSIGNMENT
    // =====================================================
    
    public function role_permissions($role_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $permission_ids = $this->input->post('permissions_id');
            
            if ($this->m_permissions->updateRolePermissions($role_id, $permission_ids, $this->session->userdata('user_id'))) {
                $this->session->set_flashdata('success', 'Role permissions updated successfully.');
                redirect('permissions/roles');
            } else {
                $this->session->set_flashdata('error', 'Failed to update role permissions.');
            }
        }
        
        $data['title'] = 'Role Permissions';
        $data['role'] = $this->m_permissions->getRoleById($role_id);
        $data['role_permissions'] = $this->m_permissions->getRolePermissions($role_id);
        $data['all_permissions'] = $this->m_permissions->getAllPermissions();
        $data['modules'] = $this->m_permissions->getAllModules();
        $data['permission_summary'] = $this->m_permissions->getRolePermissionSummary($role_id);
        $data['permission_id'] = $this->m_permissions->getRolePermissionid($role_id);
        $data['role_id'] = $role_id;
        
        if (!$data['role']) {
            $this->session->set_flashdata('error', 'Role not found.');
            redirect('permissions/roles');
        }
        
        
        $this->load->view('permissions/role_permissions', $data);

    }
    
    // =====================================================
    // USER ROLE ASSIGNMENT
    // =====================================================
    
    public function user_roles() {
        $data['title'] = 'User Role Management';
        $data['users'] = $this->m_permissions->getUsersWithRoleCount();
        $data['roles'] = $this->m_permissions->getAllRoles();
        $data['permission_summary'] = $this->m_permissions->getPermissionSummary();
        
        
        $this->load->view('permissions/user_roles', $data);
        
    }
    
    public function assign_user_roles($user_id = false) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_ids = $this->input->post('roles');
            
            if ($this->m_permissions->updateUserRoles($user_id, $role_ids, $this->session->userdata('user_id'))) {
                $this->session->set_flashdata('success', 'User roles updated successfully.');
                redirect('permissions/user_roles');
            } else {
                $this->session->set_flashdata('error', 'Failed to update user roles.');
            }
        }
        
        $data['title'] = 'Assign User Roles';
        $data['user'] = $this->db->get_where('users', ['users_id' => $user_id])->row_array();
        $data['user_roles'] = $this->m_permissions->getUserRoles($user_id);
        $data['all_roles'] = $this->m_permissions->getAllRoles();
        $data['user_permissions'] = $this->m_permissions->getUserPermissions($user_id);
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('permissions/user_roles');
        }
        
        
        $this->load->view('permissions/assign_user_roles', $data);
        
    }
    
    public function bulk_assign_roles() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        if (!has_module_permission('users') && !is_admin()) {
            show_error('Access Denied', 403);
        }
        
        if ($this->input->post()) {
            $users = $this->input->post('users');
            $roles = $this->input->post('roles');
            $action = $this->input->post('action', 'add');
            
            if (empty($users) || empty($roles)) {
                $this->session->set_flashdata('error', 'Please select at least one user and one role.');
                redirect('users/allusers');
            }
            
            $success_count = 0;
            $error_count = 0;
            
            foreach ($users as $user_id) {
                try {
                    if ($action === 'replace') {
                        // Remove all existing roles and assign new ones
                        $this->m_permissions->removeAllUserRoles($user_id);
                    } elseif ($action === 'remove') {
                        // Remove only selected roles
                        foreach ($roles as $role_id) {
                            $this->m_permissions->removeRoleFromUser($user_id, $role_id);
                        }
                        $success_count++;
                        continue;
                    }
                    
                    // Add roles (for both 'add' and 'replace' actions)
                    if ($action !== 'remove') {
                        foreach ($roles as $role_id) {
                            // Check if role is already assigned (for 'add' action)
                            if ($action === 'add') {
                                $existing_roles = $this->m_permissions->getUserRoles($user_id);
                                $role_exists = false;
                                foreach ($existing_roles as $existing_role) {
                                    if ($existing_role['role_id'] == $role_id) {
                                        $role_exists = true;
                                        break;
                                    }
                                }
                                if (!$role_exists) {
                                    $this->m_permissions->assignRoleToUser($user_id, $role_id);
                                }
                            } else {
                                $this->m_permissions->assignRoleToUser($user_id, $role_id);
                            }
                        }
                    }
                    
                    $success_count++;
                } catch (Exception $e) {
                    $error_count++;
                }
            }
            
            if ($error_count > 0) {
                $this->session->set_flashdata('warning', "Role assignment completed with {$success_count} successful and {$error_count} failed assignments.");
            } else {
                $this->session->set_flashdata('success', "Successfully assigned roles to {$success_count} users.");
            }
            
            redirect('users/allusers');
        }
        
        redirect('users/allusers');
    }
    
    public function user_permissions($user_id) {
        $data['title'] = 'User Permissions';
        $data['user'] = $this->db->get_where('users', ['users_id' => $user_id])->row_array();
        $data['user_permissions'] = $this->m_permissions->getUserPermissions($user_id);
        $data['user_roles'] = $this->m_permissions->getUserRoles($user_id);
        $data['permissions_by_module'] = $this->m_permissions->getUserPermissionsByModule($user_id);
        
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('permissions/user_roles');
        }
        
        
        $this->load->view('permissions/user_view_permission', $data);
        
    }
    
    public function user_view_permission($user_id) {
        $this->load->model('m_permissions');
        $data['title'] = 'User Permissions';
        $data['user'] = $this->db->get_where('users', ['users_id' => $user_id])->row_array();
        $data['permissions'] = $this->m_permissions->getUserPermissions($user_id);
        if (!$data['user']) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('users/allusers');
        }
        $this->load->view('permissions/user_view_permission', $data);
    }
    
    // =====================================================
    // AJAX METHODS
    // =====================================================
    
    public function get_permissions_by_module() {
        $module_id = $this->input->post('module_id');
        $permissions = $this->m_permissions->getPermissionsByModule($module_id);
        echo json_encode($permissions);
    }
    public function assign_permissions_by_role() {
        $permission_ids = $this->input->post('permission_id');
        $role_id = $this->input->post('role_id');
        $val = $this->input->post('val');
       $flag =  $this->m_permissions->updateRolePermissions2($role_id, $permission_ids, $this->session->userdata('user_id'),$val);
        echo json_encode($flag);
    }
    
    public function check_permission() {
        $user_id = $this->session->userdata('user_id');
        $permission_name = $this->input->post('permission_name');
        $has_permission = $this->m_permissions->hasPermission($user_id, $permission_name);
        echo json_encode(['has_permission' => $has_permission]);
    }
    
    public function get_user_permissions() {
        $user_id = $this->session->userdata('user_id');
        $permissions = $this->m_permissions->getUserPermissionsByModule($user_id);
        echo json_encode($permissions);
    }
    
    public function get_role_permissions($role_id) {
        $permissions = $this->m_permissions->getRolePermissions($role_id);
        echo json_encode($permissions);
    }
    
    public function get_user_roles($user_id) {
        $roles = $this->m_permissions->getUserRoles($user_id);
        echo json_encode($roles);
    }
    
    // =====================================================
    // REPORTS AND ANALYTICS
    // =====================================================
    
    public function reports() {
        $data['title'] = 'Permission Reports';
        $data['role_distribution'] = $this->m_permissions->getRoleDistribution();
        $data['permission_usage'] = $this->m_permissions->getPermissionUsage();
        $data['user_permission_summary'] = $this->m_permissions->getUserPermissionSummary();
        $data['recent_activities'] = $this->m_permissions->getRecentActivities();
        
        
        $this->load->view('permissions/reports', $data);
        
    }
    
    public function export_permissions() {
        $data['permissions'] = $this->m_permissions->getAllPermissions();
        $data['roles'] = $this->m_permissions->getAllRoles();
        $data['users'] = $this->m_permissions->getUsersWithRoleCount();
        
        // Generate CSV or Excel file
        $this->load->library('excel');
        // ... export logic
    }
    
    // =====================================================
    // SETTINGS AND CONFIGURATION
    // =====================================================
    
    public function settings() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle settings update
            $settings = [
                'default_role' => $this->input->post('default_role'),
                'auto_assign_roles' => $this->input->post('auto_assign_roles') ? 1 : 0,
                'permission_audit' => $this->input->post('permission_audit') ? 1 : 0,
                'role_expiry' => $this->input->post('role_expiry') ? 1 : 0
            ];
            
            if ($this->m_permissions->updateSettings($settings)) {
                $this->session->set_flashdata('success', 'Settings updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update settings.');
            }
        }
        
        $data['title'] = 'Permission Settings';
        $data['settings'] = $this->m_permissions->getSettings();
        $data['roles'] = $this->m_permissions->getAllRoles();
        
        
        $this->load->view('permissions/settings', $data);

    }
} 