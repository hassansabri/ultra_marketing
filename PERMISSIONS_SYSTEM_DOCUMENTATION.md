# Permissions System Documentation

## Overview

The Permissions System is a comprehensive Role-Based Access Control (RBAC) solution built for the Ultra Marketing application. It provides granular control over user access to different modules and features within the system.

## System Architecture

### Core Components

1. **Controller**: `application/controllers/Permissions.php`
2. **Model**: `application/models/M_permissions.php`
3. **Helper**: `application/helpers/permission_helper.php`
4. **Views**: `application/views/permissions/`

### Database Tables

- `roles` - System roles
- `modules` - System modules
- `permissions` - Individual permissions
- `role_permissions` - Role-permission assignments
- `user_roles` - User-role assignments
- `user_permissions_view` - View for user permissions (calculated)

## Features

### 1. Role Management
- Create, edit, and delete roles
- Assign permissions to roles
- Role status management (active/inactive)
- Role color coding and badges

### 2. Module Management
- Create and manage system modules
- Module ordering and icons
- Module status management

### 3. Permission Management
- Create granular permissions
- Permission types (view, create, edit, delete, etc.)
- Permission assignment to roles

### 4. User Role Assignment
- Individual user role assignment
- Bulk role assignment
- Role assignment history tracking

### 5. Permission Checking
- Real-time permission validation
- Module-level permission checking
- Action-level permission checking

## Installation & Setup

### 1. Database Setup

Run the following SQL to create the required tables:

```sql
-- Roles table
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `role_display_name` varchar(100) NOT NULL,
  `role_description` text,
  `role_color` varchar(20) DEFAULT 'primary',
  `is_active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
);

-- Modules table
CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_display_name` varchar(100) NOT NULL,
  `module_description` text,
  `module_icon` varchar(50) DEFAULT 'fa-cube',
  `module_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
);

-- Permissions table
CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `permission_display_name` varchar(100) NOT NULL,
  `permission_description` text,
  `permission_type` varchar(20) DEFAULT 'view',
  `is_active` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `permission_name` (`permission_name`),
  KEY `module_id` (`module_id`),
  FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE
);

-- Role permissions table
CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `granted_by` int(11) DEFAULT NULL,
  `granted_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`, `permission_id`),
  KEY `permission_id` (`permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE
);

-- User roles table
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_id`, `role_id`),
  KEY `role_id` (`role_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE
);

-- User permissions view
CREATE VIEW `user_permissions_view` AS
SELECT DISTINCT
  ur.user_id,
  p.permission_id,
  p.permission_name,
  p.permission_display_name,
  p.permission_type,
  m.module_id,
  m.module_name,
  m.module_display_name,
  r.role_id,
  r.role_name
FROM user_roles ur
JOIN role_permissions rp ON ur.role_id = rp.role_id
JOIN permissions p ON rp.permission_id = p.permission_id
JOIN modules m ON p.module_id = m.module_id
JOIN roles r ON ur.role_id = r.role_id
WHERE ur.is_active = 1 
  AND r.is_active = 1 
  AND p.is_active = 1 
  AND m.is_active = 1;
```

### 2. File Setup

1. Copy the controller file to `application/controllers/Permissions.php`
2. Copy the model file to `application/models/M_permissions.php`
3. Copy the helper file to `application/helpers/permission_helper.php`
4. Copy all view files to `application/views/permissions/`

### 3. Autoload Configuration

Add the helper to `application/config/autoload.php`:

```php
$autoload['helper'] = array('permission_helper');
```

### 4. Initial Data Setup

Insert basic roles and modules:

```sql
-- Insert basic modules
INSERT INTO modules (module_name, module_display_name, module_description, module_icon, module_order) VALUES
('dashboard', 'Dashboard', 'Main dashboard module', 'fa-tachometer-alt', 1),
('users', 'Users', 'User management module', 'fa-users', 2),
('roles', 'Roles', 'Role management module', 'fa-user-circle', 3),
('permissions', 'Permissions', 'Permission management module', 'fa-key', 4),
('reports', 'Reports', 'Reports and analytics module', 'fa-chart-bar', 5),
('settings', 'Settings', 'System settings module', 'fa-cog', 6);

-- Insert basic roles
INSERT INTO roles (role_name, role_display_name, role_description, role_color) VALUES
('admin', 'Administrator', 'Full system access with all permissions', 'danger'),
('manager', 'Manager', 'Department-level access with management permissions', 'warning'),
('user', 'User', 'Basic user access with limited permissions', 'primary'),
('guest', 'Guest', 'Read-only access to public information', 'secondary');

-- Insert basic permissions
INSERT INTO permissions (module_id, permission_name, permission_display_name, permission_description, permission_type) VALUES
(1, 'dashboard_view', 'View Dashboard', 'Can view the main dashboard', 'view'),
(2, 'users_view', 'View Users', 'Can view user list', 'view'),
(2, 'users_create', 'Create Users', 'Can create new users', 'create'),
(2, 'users_edit', 'Edit Users', 'Can edit existing users', 'edit'),
(2, 'users_delete', 'Delete Users', 'Can delete users', 'delete'),
(3, 'roles_view', 'View Roles', 'Can view role list', 'view'),
(3, 'roles_create', 'Create Roles', 'Can create new roles', 'create'),
(3, 'roles_edit', 'Edit Roles', 'Can edit existing roles', 'edit'),
(3, 'roles_delete', 'Delete Roles', 'Can delete roles', 'delete'),
(4, 'permissions_view', 'View Permissions', 'Can view permission list', 'view'),
(4, 'permissions_manage', 'Manage Permissions', 'Can manage all permissions', 'manage');

-- Assign permissions to admin role
INSERT INTO role_permissions (role_id, permission_id) 
SELECT 1, permission_id FROM permissions;

-- Assign basic permissions to manager role
INSERT INTO role_permissions (role_id, permission_id) 
SELECT 2, permission_id FROM permissions 
WHERE permission_type IN ('view', 'edit') AND module_id IN (1, 2);

-- Assign view permissions to user role
INSERT INTO role_permissions (role_id, permission_id) 
SELECT 3, permission_id FROM permissions 
WHERE permission_type = 'view' AND module_id IN (1, 2);

-- Assign view permissions to guest role
INSERT INTO role_permissions (role_id, permission_id) 
SELECT 4, permission_id FROM permissions 
WHERE permission_type = 'view' AND module_id = 1;
```

## Usage Guide

### 1. Permission Checking in Controllers

```php
// Check if user has specific permission
if (!has_permission('users_create')) {
    $this->session->set_flashdata('error', 'Access denied');
    redirect('dashboard');
}

// Check if user has module permission
if (!has_module_permission('users')) {
    $this->session->set_flashdata('error', 'Access denied');
    redirect('dashboard');
}

// Check if user has permission type
if (!has_permission_type('users', 'edit')) {
    $this->session->set_flashdata('error', 'Access denied');
    redirect('dashboard');
}

// Check if user has specific role
if (!has_role('admin')) {
    $this->session->set_flashdata('error', 'Access denied');
    redirect('dashboard');
}
```

### 2. Permission Checking in Views

```php
<?php if (has_permission('users_create')): ?>
    <a href="<?php echo site_url('users/add'); ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i> Add User
    </a>
<?php endif; ?>

<?php if (has_permission_type('users', 'edit')): ?>
    <a href="<?php echo site_url('users/edit/'.$user_id); ?>" class="btn btn-warning">
        <i class="fa fa-edit"></i> Edit
    </a>
<?php endif; ?>

<?php if (has_role('admin')): ?>
    <a href="<?php echo site_url('users/delete/'.$user_id); ?>" class="btn btn-danger">
        <i class="fa fa-trash"></i> Delete
    </a>
<?php endif; ?>
```

### 3. Role Assignment

```php
// Assign role to user
$this->m_permissions->assignRoleToUser($user_id, $role_id, $assigned_by);

// Remove role from user
$this->m_permissions->removeRoleFromUser($user_id, $role_id);

// Update user roles (bulk)
$this->m_permissions->updateUserRoles($user_id, $role_ids, $assigned_by);

// Bulk assign roles
$this->m_permissions->bulkAssignRoles($user_ids, $role_ids, 'add', $assigned_by);
```

### 4. Permission Assignment

```php
// Assign permission to role
$this->m_permissions->assignPermissionToRole($role_id, $permission_id, $granted_by);

// Remove permission from role
$this->m_permissions->removePermissionFromRole($role_id, $permission_id);

// Update role permissions (bulk)
$this->m_permissions->updateRolePermissions($role_id, $permission_ids, $granted_by);
```

## API Endpoints

### Dashboard
- `GET /permissions` - Permission management dashboard

### Role Management
- `GET /permissions/roles` - List all roles
- `GET /permissions/add_role` - Add new role form
- `POST /permissions/add_role` - Create new role
- `GET /permissions/edit_role/{id}` - Edit role form
- `POST /permissions/edit_role/{id}` - Update role
- `GET /permissions/view_role/{id}` - View role details
- `GET /permissions/delete_role/{id}` - Delete role
- `GET /permissions/role_permissions/{id}` - Manage role permissions
- `POST /permissions/role_permissions/{id}` - Update role permissions

### Module Management
- `GET /permissions/modules` - List all modules
- `GET /permissions/add_module` - Add new module form
- `POST /permissions/add_module` - Create new module
- `GET /permissions/edit_module/{id}` - Edit module form
- `POST /permissions/edit_module/{id}` - Update module
- `GET /permissions/view_module/{id}` - View module details
- `GET /permissions/delete_module/{id}` - Delete module

### Permission Management
- `GET /permissions/permissions` - List all permissions
- `GET /permissions/add_permission` - Add new permission form
- `POST /permissions/add_permission` - Create new permission
- `GET /permissions/edit_permission/{id}` - Edit permission form
- `POST /permissions/edit_permission/{id}` - Update permission
- `GET /permissions/view_permission/{id}` - View permission details
- `GET /permissions/delete_permission/{id}` - Delete permission

### User Role Management
- `GET /permissions/user_roles` - List users with roles
- `GET /permissions/assign_user_roles/{id}` - Assign roles to user
- `POST /permissions/assign_user_roles/{id}` - Update user roles
- `GET /permissions/user_permissions/{id}` - View user permissions
- `POST /permissions/bulk_assign_roles` - Bulk assign roles

### Reports & Analytics
- `GET /permissions/reports` - Permission reports
- `GET /permissions/export_permissions` - Export permissions data

### Settings
- `GET /permissions/settings` - Permission settings
- `POST /permissions/settings` - Update settings

### AJAX Endpoints
- `POST /permissions/get_permissions_by_module` - Get permissions by module
- `POST /permissions/check_permission` - Check specific permission
- `POST /permissions/get_user_permissions` - Get user permissions
- `GET /permissions/get_role_permissions/{id}` - Get role permissions
- `GET /permissions/get_user_roles/{id}` - Get user roles

## Helper Functions

### Permission Checking
- `has_permission($permission_name, $user_id = null)` - Check specific permission
- `has_module_permission($module_name, $user_id = null)` - Check module permission
- `has_permission_type($module_name, $permission_type, $user_id = null)` - Check permission type
- `has_role($role_name, $user_id = null)` - Check specific role
- `is_admin($user_id = null)` - Check if user is admin

### Data Retrieval
- `get_user_roles($user_id = null)` - Get user roles
- `get_user_permissions($user_id = null)` - Get user permissions
- `get_user_permission_summary($user_id = null)` - Get permission summary

### UI Helpers
- `get_role_badge_class($role_name)` - Get role badge CSS class
- `get_role_badge($role_name, $custom_class = '')` - Get role badge HTML
- `get_permission_badge_class($permission_type)` - Get permission badge CSS class
- `get_permission_badge($permission_name, $permission_type = '')` - Get permission badge HTML
- `get_permission_icon($permission_type)` - Get permission icon
- `get_module_icon($module_name)` - Get module icon

### Formatting
- `format_permission_name($permission_name)` - Format permission name
- `format_module_name($module_name)` - Format module name
- `get_permission_status_text($has_permission)` - Get status text
- `get_permission_status_class($has_permission)` - Get status CSS class
- `get_permission_status_icon($has_permission)` - Get status icon

### Access Control
- `can_access($required_permission = '', $required_role = '')` - Check access
- `require_permission($required_permission, $redirect_url = 'dashboard')` - Require permission
- `require_role($required_role, $redirect_url = 'dashboard')` - Require role

## Security Features

### 1. Permission Validation
- All controller methods check for appropriate permissions
- Session-based user authentication
- Role-based access control

### 2. Data Protection
- SQL injection prevention through CodeIgniter's query builder
- XSS protection through output escaping
- CSRF protection through form validation

### 3. Audit Trail
- Role assignment tracking
- Permission assignment tracking
- User activity logging

## Best Practices

### 1. Role Design
- Create roles based on job functions, not individuals
- Use descriptive role names and descriptions
- Start with basic roles and add specialized ones as needed

### 2. Permission Granularity
- Create specific permissions rather than broad ones
- Use consistent naming conventions
- Group related permissions by module

### 3. User Management
- Assign roles to users, not individual permissions
- Regularly review and update role assignments
- Use bulk operations for efficiency

### 4. Security
- Regularly audit permission assignments
- Remove unused roles and permissions
- Monitor for unusual access patterns

## Troubleshooting

### Common Issues

1. **Permission not working**
   - Check if user has the correct role
   - Verify permission is assigned to the role
   - Ensure all related records are active

2. **Role assignment not saving**
   - Check database constraints
   - Verify user and role exist
   - Check for duplicate assignments

3. **Helper functions not available**
   - Ensure helper is autoloaded
   - Check file permissions
   - Verify helper file exists

### Debug Tools

1. **Permission Checker**
   ```php
   // Debug user permissions
   $user_permissions = get_user_permissions($user_id);
   print_r($user_permissions);
   
   // Debug user roles
   $user_roles = get_user_roles($user_id);
   print_r($user_roles);
   ```

2. **Database Queries**
   ```sql
   -- Check user roles
   SELECT * FROM user_roles WHERE user_id = ?;
   
   -- Check role permissions
   SELECT * FROM role_permissions WHERE role_id = ?;
   
   -- Check user permissions view
   SELECT * FROM user_permissions_view WHERE user_id = ?;
   ```

## Performance Considerations

### 1. Database Optimization
- Use indexes on frequently queried columns
- Optimize the user_permissions_view
- Cache permission data when appropriate

### 2. Query Optimization
- Use eager loading for related data
- Minimize database queries in loops
- Use bulk operations for multiple records

### 3. Caching
- Cache user permissions for session duration
- Cache role-permission mappings
- Use Redis or Memcached for high-traffic applications

## Future Enhancements

### 1. Advanced Features
- Permission inheritance
- Time-based permissions
- Location-based permissions
- Conditional permissions

### 2. Integration
- LDAP/Active Directory integration
- Single Sign-On (SSO) support
- API authentication
- Mobile app permissions

### 3. Analytics
- Permission usage analytics
- Access pattern analysis
- Security audit reports
- Compliance reporting

## Support

For technical support or questions about the permissions system:

1. Check the troubleshooting section
2. Review the code comments
3. Test with debug tools
4. Contact the development team

## Version History

- **v1.0.0** - Initial release with basic RBAC functionality
- **v1.1.0** - Added bulk operations and enhanced UI
- **v1.2.0** - Added reports and analytics features
- **v1.3.0** - Enhanced security and performance optimizations 