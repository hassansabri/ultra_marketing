# Permission System Documentation

## Overview

This document provides comprehensive documentation for the permission system implemented in the Ultra Marketing application. The system provides role-based access control (RBAC) with granular permissions for each module and action.

## System Architecture

### Database Structure

The permission system consists of 5 core tables:

1. **`roles`** - Defines user roles (Super Admin, Admin, Manager, User, Viewer)
2. **`modules`** - Defines system modules (Dashboard, Users, Orders, etc.)
3. **`permissions`** - Defines specific permissions for each module
4. **`role_permissions`** - Many-to-many relationship between roles and permissions
5. **`user_roles`** - Many-to-many relationship between users and roles

### Key Features

- **Role-Based Access Control**: Users are assigned roles with specific permissions
- **Module-Level Permissions**: Each module has specific permissions (view, create, edit, delete, etc.)
- **Granular Control**: Fine-grained permission control for each action
- **Flexible Assignment**: Users can have multiple roles
- **Easy Integration**: Helper functions for permission checking throughout the application

## Database Tables

### 1. Roles Table
```sql
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `role_description` text,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
);
```

**Default Roles:**
- Super Admin: Full system access
- Admin: Administrative access with most permissions
- Manager: Management level access
- User: Standard user access
- Viewer: Read-only access

### 2. Modules Table
```sql
CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) NOT NULL,
  `module_display_name` varchar(100) NOT NULL,
  `module_description` text,
  `module_icon` varchar(50) DEFAULT 'fa-cube',
  `module_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
);
```

**Default Modules:**
- Dashboard (fa-tachometer-alt)
- User Management (fa-users)
- Order Management (fa-shopping-cart)
- Item Management (fa-box)
- Category Management (fa-tags)
- Brand Management (fa-trademark)
- Shop Management (fa-store)
- Stock Management (fa-warehouse)
- Reports & Analytics (fa-chart-bar)
- Ledger Management (fa-book)
- System Settings (fa-cog)
- Profile Management (fa-user)

### 3. Permissions Table
```sql
CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `permission_display_name` varchar(100) NOT NULL,
  `permission_description` text,
  `permission_type` enum('view','create','edit','delete','export','import','approve','reject','print') DEFAULT 'view',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `module_permission` (`module_id`, `permission_name`),
  FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE
);
```

**Permission Types:**
- **view**: View data/listings
- **create**: Create new records
- **edit**: Edit existing records
- **delete**: Delete records
- **export**: Export data to files
- **import**: Import data from files
- **approve**: Approve pending items
- **reject**: Reject items
- **print**: Print reports/invoices

### 4. Role Permissions Table
```sql
CREATE TABLE `role_permissions` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `granted_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `granted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_permission_id`),
  UNIQUE KEY `role_permission_unique` (`role_id`, `permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE
);
```

### 5. User Roles Table
```sql
CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `assigned_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_role_id`),
  UNIQUE KEY `user_role_unique` (`user_id`, `role_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE
);
```

## Implementation

### 1. Model (m_permissions.php)

The permission model provides all database operations for the permission system:

**Key Methods:**
- `getAllRoles()` - Get all roles
- `getAllModules()` - Get all modules
- `getAllPermissions()` - Get all permissions
- `getRolePermissions($role_id)` - Get permissions for a role
- `getUserRoles($user_id)` - Get roles for a user
- `hasPermission($user_id, $permission_name)` - Check if user has permission
- `hasModulePermission($user_id, $module_name)` - Check if user has module permission
- `assignRoleToUser($user_id, $role_id)` - Assign role to user
- `updateRolePermissions($role_id, $permission_ids)` - Update role permissions

### 2. Controller (permissions.php)

The permission controller manages the permission system interface:

**Key Methods:**
- `index()` - Permission dashboard
- `roles()` - Role management
- `modules()` - Module management
- `permissions()` - Permission management
- `role_permissions($role_id)` - Assign permissions to roles
- `user_roles()` - User role management
- `assign_user_roles($user_id)` - Assign roles to users

### 3. Helper (permission_helper.php)

The permission helper provides easy-to-use functions throughout the application:

**Key Functions:**
- `has_permission($permission_name)` - Check specific permission
- `has_module_permission($module_name)` - Check module permission
- `has_permission_type($module_name, $permission_type)` - Check permission type
- `has_role($role_names)` - Check user roles
- `is_super_admin()` - Check if super admin
- `is_admin()` - Check if admin
- `is_manager()` - Check if manager
- `require_permission($permission_name)` - Require permission or redirect
- `render_action_buttons($actions)` - Render permission-based buttons

## Usage Examples

### 1. Basic Permission Checking

```php
// In controllers
if (!has_permission('users_create')) {
    $this->session->set_flashdata('error', 'Access denied.');
    redirect('dashboard');
}

// Or use require function
require_permission('orders_edit', 'orders');
```

### 2. Module Permission Checking

```php
// Check if user has any permission for a module
if (has_module_permission('orders')) {
    // Show order management menu
}

// Check specific permission type
if (has_permission_type('orders', 'create')) {
    // Show create order button
}
```

### 3. Role-Based Checking

```php
// Check specific roles
if (has_role(['Admin', 'Manager'])) {
    // Show admin features
}

// Check admin status
if (is_admin()) {
    // Show admin panel
}
```

### 4. Menu Filtering

```php
// Define menu items with permissions
$menu_items = [
    [
        'title' => 'Dashboard',
        'url' => 'dashboard',
        'icon' => 'fa-tachometer-alt'
    ],
    [
        'title' => 'User Management',
        'url' => 'users',
        'icon' => 'fa-users',
        'module' => 'users'
    ],
    [
        'title' => 'Orders',
        'url' => 'orders',
        'icon' => 'fa-shopping-cart',
        'module' => 'orders'
    ]
];

// Filter menu by permissions
$filtered_menu = filter_menu_by_permissions($menu_items);
```

### 5. Action Button Rendering

```php
// Define action buttons with permissions
$actions = [
    [
        'text' => 'View',
        'url' => "orders/view/{$order_id}",
        'class' => 'btn btn-info btn-xs',
        'icon' => 'fa-eye',
        'module' => 'orders',
        'type' => 'view'
    ],
    [
        'text' => 'Edit',
        'url' => "orders/edit/{$order_id}",
        'class' => 'btn btn-warning btn-xs',
        'icon' => 'fa-edit',
        'module' => 'orders',
        'type' => 'edit'
    ],
    [
        'text' => 'Delete',
        'url' => "orders/delete/{$order_id}",
        'class' => 'btn btn-danger btn-xs',
        'icon' => 'fa-trash',
        'module' => 'orders',
        'type' => 'delete',
        'confirm' => 'Are you sure you want to delete this order?'
    ]
];

// Render permission-based buttons
echo render_action_buttons($actions);
```

### 6. Record-Level Permissions

```php
// Check if user can view specific record
if (can_view_record('orders', $order_id)) {
    // Show order details
}

// Check if user can edit specific record
if (can_edit_record('orders', $order_id)) {
    // Show edit button
}
```

## Default Permission Assignments

### Super Admin
- All permissions for all modules

### Admin
- All permissions except user deletion and system settings editing

### Manager
- View, create, edit, export, and print permissions for most modules
- Cannot delete users or edit system settings

### User
- View, create, export, and print permissions for:
  - Dashboard
  - Orders
  - Items
  - Profile
  - Ledger

### Viewer
- View permissions only for all modules

## Integration with Existing Controllers

### 1. Add Permission Checks to Controllers

```php
class Orders extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('permission');
        
        // Check if user has module permission
        require_module_permission('orders', 'dashboard');
    }
    
    public function index() {
        // Check view permission
        require_permission('orders_view', 'dashboard');
        
        // Load data and view
    }
    
    public function create() {
        // Check create permission
        require_permission('orders_create', 'orders');
        
        // Handle order creation
    }
    
    public function edit($id) {
        // Check edit permission
        require_permission('orders_edit', 'orders');
        
        // Handle order editing
    }
    
    public function delete($id) {
        // Check delete permission
        require_permission('orders_delete', 'orders');
        
        // Handle order deletion
    }
}
```

### 2. Update Views with Permission-Based Elements

```php
<!-- In views -->
<?php if (has_permission_type('orders', 'create')): ?>
    <a href="<?php echo site_url('orders/create'); ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Create Order
    </a>
<?php endif; ?>

<?php if (has_permission_type('orders', 'export')): ?>
    <a href="<?php echo site_url('orders/export'); ?>" class="btn btn-primary">
        <i class="fa fa-download"></i> Export
    </a>
<?php endif; ?>

<!-- Action buttons -->
<?php
$actions = [
    [
        'text' => 'View',
        'url' => site_url("orders/view/{$order['id']}"),
        'class' => 'btn btn-info btn-xs',
        'icon' => 'fa-eye',
        'module' => 'orders',
        'type' => 'view'
    ],
    [
        'text' => 'Edit',
        'url' => site_url("orders/edit/{$order['id']}"),
        'class' => 'btn btn-warning btn-xs',
        'icon' => 'fa-edit',
        'module' => 'orders',
        'type' => 'edit'
    ]
];
echo render_action_buttons($actions);
?>
```

## Security Considerations

### 1. Server-Side Validation
- Always check permissions on the server side
- Never rely solely on client-side permission hiding
- Use helper functions for consistent permission checking

### 2. Database Security
- Use prepared statements to prevent SQL injection
- Implement proper foreign key constraints
- Regular backup of permission data

### 3. Session Security
- Validate user sessions
- Implement session timeout
- Secure session storage

### 4. Audit Trail
- Log permission changes
- Track user access attempts
- Monitor permission usage

## Performance Optimization

### 1. Caching
- Cache user permissions in session
- Use Redis/Memcached for permission data
- Implement permission result caching

### 2. Database Optimization
- Proper indexing on permission tables
- Optimized queries for permission checking
- Use database views for complex permission queries

### 3. Query Optimization
- Minimize database calls
- Use efficient JOIN operations
- Implement lazy loading where appropriate

## Troubleshooting

### Common Issues

1. **Permission Not Working**
   - Check if user has assigned roles
   - Verify role has required permissions
   - Check if permission is active

2. **Menu Items Not Showing**
   - Verify module permissions
   - Check menu filtering logic
   - Ensure helper is loaded

3. **Action Buttons Not Rendering**
   - Check permission definitions
   - Verify action array structure
   - Test individual permission checks

### Debug Functions

```php
// Debug user permissions
$permissions = get_user_permissions();
print_r($permissions);

// Debug user roles
$roles = get_user_roles();
print_r($roles);

// Check specific permission
var_dump(has_permission('users_create'));
```

## Future Enhancements

### 1. Advanced Features
- Permission inheritance
- Time-based permissions
- Location-based permissions
- IP-based restrictions

### 2. Analytics
- Permission usage analytics
- Access pattern analysis
- Security audit reports

### 3. Integration
- LDAP/Active Directory integration
- Single Sign-On (SSO)
- API permission management

### 4. User Experience
- Permission request workflow
- Self-service role management
- Permission explanation tooltips

## Conclusion

The permission system provides a robust, flexible, and secure way to manage user access throughout the application. By following the implementation guidelines and using the provided helper functions, developers can easily integrate permission checking into any part of the application while maintaining security and performance. 