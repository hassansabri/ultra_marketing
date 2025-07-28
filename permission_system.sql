-- Permission System Database Tables
-- This file contains all tables needed for a comprehensive permission system

-- =====================================================
-- CORE PERMISSION TABLES
-- =====================================================

-- 1. Roles Table
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `role_description` text,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Modules Table
CREATE TABLE IF NOT EXISTS `modules` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Permissions Table
CREATE TABLE IF NOT EXISTS `permissions` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Role Permissions Table (Many-to-Many)
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `granted_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `granted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_permission_id`),
  UNIQUE KEY `role_permission_unique` (`role_id`, `permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. User Roles Table (Many-to-Many)
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `assigned_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`user_role_id`),
  UNIQUE KEY `user_role_unique` (`user_id`, `role_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- SAMPLE DATA INSERTION
-- =====================================================


-- Insert Modules
INSERT INTO `modules` (`module_name`, `module_display_name`, `module_description`, `module_icon`, `module_order`) VALUES
('dashboard', 'Dashboard', 'Main dashboard and overview', 'fa-tachometer-alt', 1),
('users', 'User Management', 'Manage system users and accounts', 'fa-users', 2),
('orders', 'Order Management', 'Manage orders and invoices', 'fa-shopping-cart', 3),
('items', 'Item Management', 'Manage products and items', 'fa-box', 4),
('categories', 'Category Management', 'Manage product categories', 'fa-tags', 5),
('brands', 'Brand Management', 'Manage product brands', 'fa-trademark', 6),
('shops', 'Shop Management', 'Manage shops and locations', 'fa-store', 7),
('stocks', 'Stock Management', 'Manage inventory and stock levels', 'fa-warehouse', 8),
('reports', 'Reports & Analytics', 'View reports and analytics', 'fa-chart-bar', 9),
('ledger', 'Ledger Management', 'Manage financial ledgers', 'fa-book', 10),
('settings', 'System Settings', 'System configuration and settings', 'fa-cog', 11),
('profile', 'Profile Management', 'User profile and preferences', 'fa-user', 12);

-- Insert Permissions for each module
-- Dashboard Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(1, 'dashboard_view', 'View Dashboard', 'Access to view dashboard and overview', 'view'),
(1, 'dashboard_export', 'Export Dashboard Data', 'Export dashboard reports and data', 'export');

-- User Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(2, 'users_view', 'View Users', 'View list of all users', 'view'),
(2, 'users_create', 'Create Users', 'Create new user accounts', 'create'),
(2, 'users_edit', 'Edit Users', 'Edit existing user accounts', 'edit'),
(2, 'users_delete', 'Delete Users', 'Delete user accounts', 'delete'),
(2, 'users_export', 'Export Users', 'Export user data to file', 'export'),
(2, 'users_import', 'Import Users', 'Import users from file', 'import');

-- Order Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(3, 'orders_view', 'View Orders', 'View all orders', 'view'),
(3, 'orders_create', 'Create Orders', 'Create new orders', 'create'),
(3, 'orders_edit', 'Edit Orders', 'Edit existing orders', 'edit'),
(3, 'orders_delete', 'Delete Orders', 'Delete orders', 'delete'),
(3, 'orders_approve', 'Approve Orders', 'Approve pending orders', 'approve'),
(3, 'orders_reject', 'Reject Orders', 'Reject orders', 'reject'),
(3, 'orders_export', 'Export Orders', 'Export order data', 'export'),
(3, 'orders_print', 'Print Orders', 'Print order invoices', 'print');

-- Item Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(4, 'items_view', 'View Items', 'View all items/products', 'view'),
(4, 'items_create', 'Create Items', 'Create new items/products', 'create'),
(4, 'items_edit', 'Edit Items', 'Edit existing items/products', 'edit'),
(4, 'items_delete', 'Delete Items', 'Delete items/products', 'delete'),
(4, 'items_export', 'Export Items', 'Export item data', 'export'),
(4, 'items_import', 'Import Items', 'Import items from file', 'import');

-- Category Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(5, 'categories_view', 'View Categories', 'View all categories', 'view'),
(5, 'categories_create', 'Create Categories', 'Create new categories', 'create'),
(5, 'categories_edit', 'Edit Categories', 'Edit existing categories', 'edit'),
(5, 'categories_delete', 'Delete Categories', 'Delete categories', 'delete'),
(5, 'categories_export', 'Export Categories', 'Export category data', 'export');

-- Brand Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(6, 'brands_view', 'View Brands', 'View all brands', 'view'),
(6, 'brands_create', 'Create Brands', 'Create new brands', 'create'),
(6, 'brands_edit', 'Edit Brands', 'Edit existing brands', 'edit'),
(6, 'brands_delete', 'Delete Brands', 'Delete brands', 'delete'),
(6, 'brands_export', 'Export Brands', 'Export brand data', 'export');

-- Shop Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(7, 'shops_view', 'View Shops', 'View all shops', 'view'),
(7, 'shops_create', 'Create Shops', 'Create new shops', 'create'),
(7, 'shops_edit', 'Edit Shops', 'Edit existing shops', 'edit'),
(7, 'shops_delete', 'Delete Shops', 'Delete shops', 'delete'),
(7, 'shops_export', 'Export Shops', 'Export shop data', 'export');

-- Stock Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(8, 'stocks_view', 'View Stocks', 'View stock levels', 'view'),
(8, 'stocks_create', 'Create Stock Entries', 'Create new stock entries', 'create'),
(8, 'stocks_edit', 'Edit Stocks', 'Edit stock levels', 'edit'),
(8, 'stocks_delete', 'Delete Stock Entries', 'Delete stock entries', 'delete'),
(8, 'stocks_export', 'Export Stocks', 'Export stock data', 'export'),
(8, 'stocks_import', 'Import Stocks', 'Import stock data', 'import');

-- Reports Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(9, 'reports_view', 'View Reports', 'Access to view reports', 'view'),
(9, 'reports_export', 'Export Reports', 'Export report data', 'export'),
(9, 'reports_print', 'Print Reports', 'Print reports', 'print');

-- Ledger Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(10, 'ledger_view', 'View Ledger', 'View ledger entries', 'view'),
(10, 'ledger_create', 'Create Ledger Entries', 'Create new ledger entries', 'create'),
(10, 'ledger_edit', 'Edit Ledger', 'Edit ledger entries', 'edit'),
(10, 'ledger_delete', 'Delete Ledger Entries', 'Delete ledger entries', 'delete'),
(10, 'ledger_export', 'Export Ledger', 'Export ledger data', 'export'),
(10, 'ledger_print', 'Print Ledger', 'Print ledger reports', 'print');

-- Settings Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(11, 'settings_view', 'View Settings', 'View system settings', 'view'),
(11, 'settings_edit', 'Edit Settings', 'Edit system settings', 'edit'),
(11, 'settings_export', 'Export Settings', 'Export system configuration', 'export');

-- Profile Management Permissions
INSERT INTO `permissions` (`module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`) VALUES
(12, 'profile_view', 'View Profile', 'View own profile', 'view'),
(12, 'profile_edit', 'Edit Profile', 'Edit own profile', 'edit');

-- =====================================================
-- DEFAULT ROLE PERMISSIONS
-- =====================================================

-- Super Admin gets all permissions
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 1, `permission_id` FROM `permissions`;

-- Admin gets most permissions (except user deletion and some sensitive operations)
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 2, `permission_id` FROM `permissions` 
WHERE `permission_name` NOT IN ('users_delete', 'settings_edit');

-- Manager gets view, create, edit permissions for most modules
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 3, `permission_id` FROM `permissions` 
WHERE `permission_type` IN ('view', 'create', 'edit', 'export', 'print')
AND `permission_name` NOT IN ('users_delete', 'settings_edit', 'users_create');

-- User gets basic view and create permissions
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 4, `permission_id` FROM `permissions` 
WHERE `permission_type` IN ('view', 'create', 'export', 'print')
AND `module_name` IN ('dashboard', 'orders', 'items', 'profile', 'ledger');

-- Viewer gets only view permissions
INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT 5, `permission_id` FROM `permissions` 
WHERE `permission_type` = 'view';

-- =====================================================
-- INDEXES FOR PERFORMANCE
-- =====================================================

-- Add indexes for better performance
CREATE INDEX idx_role_permissions_role ON role_permissions(role_id);
CREATE INDEX idx_role_permissions_permission ON role_permissions(permission_id);
CREATE INDEX idx_user_roles_user ON user_roles(user_id);
CREATE INDEX idx_user_roles_role ON user_roles(role_id);
CREATE INDEX idx_permissions_module ON permissions(module_id);
CREATE INDEX idx_permissions_type ON permissions(permission_type);
CREATE INDEX idx_modules_active ON modules(is_active);
CREATE INDEX idx_roles_active ON roles(is_active);
CREATE INDEX idx_permissions_active ON permissions(is_active);

-- =====================================================
-- VIEWS FOR EASY QUERYING
-- =====================================================

-- View for user permissions
CREATE VIEW `user_permissions_view` AS
SELECT DISTINCT 
    u.user_id,
    u.username,
    r.role_name,
    m.module_name,
    m.module_display_name,
    p.permission_name,
    p.permission_display_name,
    p.permission_type
FROM users u
JOIN user_roles ur ON u.user_id = ur.user_id
JOIN roles r ON ur.role_id = r.role_id
JOIN role_permissions rp ON r.role_id = rp.role_id
JOIN permissions p ON rp.permission_id = p.permission_id
JOIN modules m ON p.module_id = m.module_id
WHERE ur.is_active = 1 
AND r.is_active = 1 
AND p.is_active = 1 
AND m.is_active = 1;

-- View for role permissions summary
CREATE VIEW `role_permissions_summary` AS
SELECT 
    r.role_name,
    m.module_display_name,
    COUNT(p.permission_id) as permission_count,
    GROUP_CONCAT(p.permission_type) as permission_types
FROM roles r
JOIN role_permissions rp ON r.role_id = rp.role_id
JOIN permissions p ON rp.permission_id = p.permission_id
JOIN modules m ON p.module_id = m.module_id
WHERE r.is_active = 1 AND p.is_active = 1 AND m.is_active = 1
GROUP BY r.role_id, m.module_id
ORDER BY r.role_name, m.module_order; 