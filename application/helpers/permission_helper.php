<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Permission Helper Functions
 * 
 * This helper contains utility functions for permission management
 */

/**
 * Check if user has specific permission
 * 
 * @param string $permission_name The permission name to check
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user has permission, false otherwise
 */
function has_permission($permission_name, $user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return false;
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    return $CI->m_permissions->hasPermission($user_id, $permission_name);
}

/**
 * Check if user has module permission
 * 
 * @param string $module_name The module name to check
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user has any permission for the module, false otherwise
 */
function has_module_permission($module_name, $user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return false;
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
        
    }
    
    // echo $module_name;
    // echo 'haha';
    // exit;
    return $CI->m_permissions->hasModulePermission($user_id, $module_name);
}

/**
 * Check if user has permission type for module
 * 
 * @param string $module_name The module name
 * @param string $permission_type The permission type (view, create, edit, delete, etc.)
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user has the permission type, false otherwise
 */
function has_permission_type($module_name, $permission_type, $user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return false;
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    return $CI->m_permissions->hasPermissionType($user_id, $module_name, $permission_type);
}

/**
 * Check if user is admin
 * 
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user is admin, false otherwise
 */
function is_admin($user_id = null) {
    return has_permission('admin_access', $user_id) || has_role('admin', $user_id);
}

/**
 * Check if user has specific role
 * 
 * @param string $role_name The role name to check
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user has the role, false otherwise
 */
function has_role($role_name, $user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return false;
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    $user_roles = $CI->m_permissions->getUserRoles($user_id);
    
    foreach ($user_roles as $role) {
        if (strtolower($role['role_name']) === strtolower($role_name)) {
            return true;
        }
    }
    
    return false;
}

/**
 * Get user roles
 * 
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return array Array of user roles
 */
function get_user_roles($user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return [];
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    return $CI->m_permissions->getUserRoles($user_id);
}

/**
 * Get user permissions
 * 
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return array Array of user permissions
 */
function get_user_permissions($user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return [];
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    return $CI->m_permissions->getUserPermissions($user_id);
}

/**
 * Get role badge class based on role name
 * 
 * @param string $role_name The role name
 * @return string CSS class for badge
 */
function get_role_badge_class($role_name) {
    $role_name = strtolower($role_name);
    
    switch ($role_name) {
        case 'admin':
        case 'administrator':
            return 'danger';
        case 'manager':
        case 'management':
            return 'warning';
        case 'user':
        case 'member':
            return 'primary';
        case 'guest':
        case 'visitor':
            return 'secondary';
        case 'moderator':
            return 'info';
        case 'supervisor':
            return 'success';
        default:
            return 'primary';
    }
}

/**
 * Get role badge HTML
 * 
 * @param string $role_name The role name
 * @param string $custom_class Custom CSS class (optional)
 * @return string HTML badge
 */
function get_role_badge($role_name, $custom_class = '') {
    $class = $custom_class ?: get_role_badge_class($role_name);
    return '<span class="badge badge-' . $class . '">' . htmlspecialchars($role_name) . '</span>';
}

/**
 * Get permission badge class based on permission type
 * 
 * @param string $permission_type The permission type
 * @return string CSS class for badge
 */
function get_permission_badge_class($permission_type) {
    $permission_type = strtolower($permission_type);
    
    switch ($permission_type) {
        case 'view':
        case 'read':
            return 'info';
        case 'create':
        case 'add':
            return 'success';
        case 'edit':
        case 'update':
            return 'warning';
        case 'delete':
        case 'remove':
            return 'danger';
        case 'export':
            return 'primary';
        case 'import':
            return 'secondary';
        case 'approve':
            return 'success';
        case 'reject':
            return 'danger';
        case 'print':
            return 'info';
        case 'manage':
            return 'dark';
        case 'assign':
            return 'purple';
        default:
            return 'primary';
    }
}

/**
 * Get permission badge HTML
 * 
 * @param string $permission_name The permission name
 * @param string $permission_type The permission type
 * @return string HTML badge
 */
function get_permission_badge($permission_name, $permission_type = '') {
    $class = get_permission_badge_class($permission_type);
    return '<span class="badge badge-' . $class . '">' . htmlspecialchars($permission_name) . '</span>';
}

/**
 * Check if user can access current page
 * 
 * @param string $required_permission Required permission (optional)
 * @param string $required_role Required role (optional)
 * @return bool True if user can access, false otherwise
 */
function can_access($required_permission = '', $required_role = '') {
    $CI =& get_instance();
    
    // Check if user is logged in
    if (!$CI->session->userdata('user_id')) {
        return false;
    }
    
    // Check required permission
    if ($required_permission && !has_permission($required_permission)) {
        return false;
    }
    
    // Check required role
    if ($required_role && !has_role($required_role)) {
        return false;
    }
    
    return true;
}

/**
 * Require permission for current page
 * 
 * @param string $required_permission Required permission
 * @param string $redirect_url Redirect URL if access denied
 */
function require_permission($required_permission, $redirect_url = 'dashboard') {
    if (!has_permission($required_permission)) {
        $CI =& get_instance();
        $CI->session->set_flashdata('error', 'You do not have permission to access this page.');
        redirect($redirect_url);
    }
}

/**
 * Require role for current page
 * 
 * @param string $required_role Required role
 * @param string $redirect_url Redirect URL if access denied
 */
function require_role($required_role, $redirect_url = 'dashboard') {
    if (!has_role($required_role)) {
        $CI =& get_instance();
        $CI->session->set_flashdata('error', 'You do not have the required role to access this page.');
        redirect($redirect_url);
    }
}

/**
 * Get permission icon based on permission type
 * 
 * @param string $permission_type The permission type
 * @return string Font Awesome icon class
 */
function get_permission_icon($permission_type) {
    $permission_type = strtolower($permission_type);
    
    switch ($permission_type) {
        case 'view':
        case 'read':
            return 'fa-eye';
        case 'create':
        case 'add':
            return 'fa-plus';
        case 'edit':
        case 'update':
            return 'fa-edit';
        case 'delete':
        case 'remove':
            return 'fa-trash';
        case 'export':
            return 'fa-download';
        case 'import':
            return 'fa-upload';
        case 'approve':
            return 'fa-check';
        case 'reject':
            return 'fa-times';
        case 'print':
            return 'fa-print';
        case 'manage':
            return 'fa-cog';
        case 'assign':
            return 'fa-user-plus';
        default:
            return 'fa-key';
    }
}

/**
 * Get module icon based on module name
 * 
 * @param string $module_name The module name
 * @return string Font Awesome icon class
 */
function get_module_icon($module_name) {
    $module_name = strtolower($module_name);
    
    switch ($module_name) {
        case 'users':
        case 'user':
            return 'fa-users';
        case 'roles':
        case 'role':
            return 'fa-user-circle';
        case 'permissions':
        case 'permission':
            return 'fa-key';
        case 'modules':
        case 'module':
            return 'fa-cubes';
        case 'dashboard':
            return 'fa-tachometer-alt';
        case 'reports':
        case 'report':
            return 'fa-chart-bar';
        case 'settings':
        case 'setting':
            return 'fa-cog';
        case 'profile':
            return 'fa-user';
        case 'orders':
        case 'order':
            return 'fa-shopping-cart';
        case 'products':
        case 'product':
            return 'fa-box';
        case 'categories':
        case 'category':
            return 'fa-tags';
        case 'brands':
        case 'brand':
            return 'fa-trademark';
        case 'shops':
        case 'shop':
            return 'fa-store';
        case 'stocks':
        case 'stock':
            return 'fa-warehouse';
        case 'faq':
            return 'fa-question-circle';
        default:
            return 'fa-cube';
    }
}

/**
 * Format permission name for display
 * 
 * @param string $permission_name The permission name
 * @return string Formatted permission name
 */
function format_permission_name($permission_name) {
    // Convert snake_case to Title Case
    $formatted = str_replace('_', ' ', $permission_name);
    $formatted = ucwords($formatted);
    
    return $formatted;
}

/**
 * Format module name for display
 * 
 * @param string $module_name The module name
 * @return string Formatted module name
 */
function format_module_name($module_name) {
    // Convert snake_case to Title Case
    $formatted = str_replace('_', ' ', $module_name);
    $formatted = ucwords($formatted);
    
    return $formatted;
}

/**
 * Get user's permission summary
 * 
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return array Permission summary
 */
function get_user_permission_summary($user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return [
            'total_roles' => 0,
            'total_permissions' => 0,
            'modules_with_access' => 0
        ];
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    $user_roles = $CI->m_permissions->getUserRoles($user_id);
    $user_permissions = $CI->m_permissions->getUserPermissions($user_id);
    
    // Count unique modules
    $modules = [];
    foreach ($user_permissions as $permission) {
        if (isset($permission['module_name'])) {
            $modules[$permission['module_name']] = true;
        }
    }
    
    return [
        'total_roles' => count($user_roles),
        'total_permissions' => count($user_permissions),
        'modules_with_access' => count($modules)
    ];
}

/**
 * Check if user has any permission for a specific action
 * 
 * @param string $action The action to check (view, create, edit, delete, etc.)
 * @param int $user_id User ID (optional, uses current session if not provided)
 * @return bool True if user has any permission for the action, false otherwise
 */
function has_action_permission($action, $user_id = null) {
    $CI =& get_instance();
    
    if (!$user_id) {
        $user_id = $CI->session->userdata('user_id');
    }
    
    if (!$user_id) {
        return false;
    }
    
    // Load permissions model if not loaded
    if (!isset($CI->m_permissions)) {
        $CI->load->model('m_permissions');
    }
    
    $user_permissions = $CI->m_permissions->getUserPermissions($user_id);
    
    foreach ($user_permissions as $permission) {
        if (strpos(strtolower($permission['permission_name']), strtolower($action)) !== false) {
            return true;
        }
    }
    
    return false;
}

/**
 * Get permission status text
 * 
 * @param bool $has_permission Whether user has permission
 * @return string Status text
 */
function get_permission_status_text($has_permission) {
    return $has_permission ? 'Allowed' : 'Denied';
}

/**
 * Get permission status class
 * 
 * @param bool $has_permission Whether user has permission
 * @return string CSS class
 */
function get_permission_status_class($has_permission) {
    return $has_permission ? 'text-success' : 'text-danger';
}

/**
 * Get permission status icon
 * 
 * @param bool $has_permission Whether user has permission
 * @return string Font Awesome icon class
 */
function get_permission_status_icon($has_permission) {
    return $has_permission ? 'fa-check-circle' : 'fa-times-circle';
} 