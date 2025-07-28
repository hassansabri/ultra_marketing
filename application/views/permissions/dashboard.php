<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
        </ol>
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <!-- Summary Cards -->
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                            <h2>Total Users</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-primary"><?php echo $summary['total_users']; ?></h1>
                                <p class="text-muted">Registered Users</p>
                                <small class="text-info">
                                    <?php
                                    // print_r($summary); echo $summary['users_with_roles']; ?> with roles assigned
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-green">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-circle"></i> </span>
                            <h2>Active Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-success"><?php echo $summary['active_roles']; ?></h1>
                                <p class="text-muted">System Roles</p>
                                <small class="text-info">
                                    <?php echo $summary['total_roles']; ?> total roles
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-orange">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-cubes"></i> </span>
                            <h2>Active Modules</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-warning"><?php echo $summary['active_modules']; ?></h1>
                                <p class="text-muted">System Modules</p>
                                <small class="text-info">
                                    <?php echo $summary['total_modules']; ?> total modules
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-purple">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                            <h2>Active Permissions</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-info"><?php echo $summary['active_permissions']; ?></h1>
                                <p class="text-muted">System Permissions</p>
                                <small class="text-info">
                                    <?php echo $summary['total_permissions']; ?> total permissions
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Quick Actions -->
                <div class="col-md-4">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                            <h2>Quick Actions</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="list-group">
                                    <a href="<?php echo site_url('permissions/add_role'); ?>" class="list-group-item">
                                        <i class="fa fa-plus-circle text-success"></i> Create New Role
                                    </a>
                                    <a href="<?php echo site_url('permissions/add_module'); ?>" class="list-group-item">
                                        <i class="fa fa-plus-circle text-info"></i> Create New Module
                                    </a>
                                    <a href="<?php echo site_url('permissions/add_permission'); ?>" class="list-group-item">
                                        <i class="fa fa-plus-circle text-warning"></i> Create New Permission
                                    </a>
                                    <a href="<?php echo site_url('permissions/user_roles'); ?>" class="list-group-item">
                                        <i class="fa fa-users text-primary"></i> Manage User Roles
                                    </a>
                                    <a href="<?php echo site_url('permissions/reports'); ?>" class="list-group-item">
                                        <i class="fa fa-chart-bar text-purple"></i> View Reports
                                    </a>
                                    <a href="<?php echo site_url('permissions/settings'); ?>" class="list-group-item">
                                        <i class="fa fa-cog text-secondary"></i> System Settings
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activities -->
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-green">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-clock"></i> </span>
                            <h2>Recent Role Assignments</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($recent_assignments)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Role</th>
                                                    <th>Assigned At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_assignments as $assignment): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo $assignment['user_name']; ?></strong>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo get_role_badge_class($assignment['role_name']); ?>">
                                                            <?php echo $assignment['role_name']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <?php echo date('M j, Y g:i A', strtotime($assignment['assigned_at'])); ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo site_url('permissions/assign_user_roles/'.$assignment['users_id']); ?>" 
                                                           class="btn btn-xs btn-primary">
                                                            <i class="fa fa-edit"></i> Manage
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <i class="fa fa-info-circle fa-2x"></i>
                                        <p>No recent role assignments</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Role Distribution -->
                <div class="col-md-6">
                    <div class="jarviswidget jarviswidget-color-orange">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-chart-pie"></i> </span>
                            <h2>Role Distribution</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($roles)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Users</th>
                                                    <th>Permissions</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($roles as $role): ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-<?php echo get_role_badge_class($role['role_name']); ?>">
                                                            <?php echo $role['role_name']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            <?php echo $role['user_count'] ?? 0; ?> users
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            <?php echo $role['permission_count']; ?> permissions
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/view_role/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/edit_role/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/role_permissions/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-primary">
                                                                <i class="fa fa-key"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <i class="fa fa-exclamation-triangle fa-2x"></i>
                                        <p>No roles found</p>
                                        <a href="<?php echo site_url('permissions/add_role'); ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Create First Role
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Module Overview -->
                <div class="col-md-6">
                    <div class="jarviswidget jarviswidget-color-purple">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-cubes"></i> </span>
                            <h2>Module Overview</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($modules)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th>Permissions</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modules as $module): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo $module['module_display_name']; ?></strong>
                                                        <br>
                                                        <small class="text-muted"><?php echo $module['module_name']; ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            <?php echo $module['permission_count']; ?> permissions
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php if ($module['is_active']): ?>
                                                            <span class="badge badge-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/view_module/'.$module['module_id']); ?>" 
                                                               class="btn btn-xs btn-info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/edit_module/'.$module['module_id']); ?>" 
                                                               class="btn btn-xs btn-warning">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <i class="fa fa-exclamation-triangle fa-2x"></i>
                                        <p>No modules found</p>
                                        <a href="<?php echo site_url('permissions/add_module'); ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Create First Module
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- User Overview -->
                <div class="col-md-12">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                            <h2>User Overview</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($users)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Roles</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (array_slice($users, 0, 10) as $user): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?php echo $user['user_name']; ?></strong>
                                                        <br>
                                                        <small class="text-muted"><?php echo $user['user_name']; ?></small>
                                                    </td>
                                                    <td>
                                                        <?php if ($user['role_count'] > 0): ?>
                                                            <span class="badge badge-success">
                                                                <?php echo $user['role_count']; ?> role(s)
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge badge-warning">No roles</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/assign_user_roles/'.$user['users_id']); ?>" 
                                                               class="btn btn-xs btn-primary">
                                                                <i class="fa fa-user-circle"></i> Assign Roles
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/user_permissions/'.$user['users_id']); ?>" 
                                                               class="btn btn-xs btn-info">
                                                                <i class="fa fa-key"></i> View Permissions
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (count($users) > 10): ?>
                                        <div class="text-center">
                                            <a href="<?php echo site_url('permissions/user_roles'); ?>" class="btn btn-primary">
                                                <i class="fa fa-users"></i> View All Users
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <i class="fa fa-users fa-2x"></i>
                                        <p>No users found</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<style>
.jarviswidget {
    margin-bottom: 20px;
}

.jarviswidget .widget-body {
    padding: 15px;
}

.list-group-item {
    border-left: none;
    border-right: none;
    border-radius: 0;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}

.list-group-item i {
    margin-right: 8px;
    width: 16px;
}

.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.text-primary { color: #007bff !important; }
.text-success { color: #28a745 !important; }
.text-warning { color: #ffc107 !important; }
.text-info { color: #17a2b8 !important; }
.text-purple { color: #6f42c1 !important; }
.text-secondary { color: #6c757d !important; }
</style>

<?php $this->load->view("common/footer"); ?> 