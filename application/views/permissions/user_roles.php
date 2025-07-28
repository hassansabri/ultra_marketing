<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
            <li>User Roles</li>
        </ol>
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                            <h2>User Role Management</h2>
                            <div class="widget-toolbar">
                                <a href="<?php echo site_url('users/allusers'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-users"></i> Manage Users
                                </a>
                            </div>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($users)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="user-roles-table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="20%">User</th>
                                                    <th width="15%">Username</th>
                                                    <th width="15%">Email</th>
                                                    <th width="15%">Roles</th>
                                                    <th width="10%">Status</th>
                                                    <th width="20%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $index => $user): ?>
                                                <tr class="<?php echo ($user['role_count'] == 0) ? 'table-warning' : ''; ?>">
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td>
                                                        <strong><?php echo $user['user_name']; ?></strong>
                                                        <?php if ($user['role_count'] == 0): ?>
                                                            <br>
                                                            <span class="badge badge-warning">No roles assigned</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo $user['user_name']; ?></td>
                                                    <td><?php echo $user['email']; ?></td>
                                                    <td>
                                                        <?php if ($user['role_count'] > 0): ?>
                                                            <span class="badge badge-success">
                                                                <?php echo $user['role_count']; ?> role(s)
                                                            </span>
                                                            <br>
                                                            <small class="text-muted">Click "View Roles" to see details</small>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">No roles</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">Active</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/assign_user_roles/'.$user['users_id']); ?>" 
                                                               class="btn btn-xs btn-primary" title="Assign Roles">
                                                                <i class="fa fa-user-circle"></i> Assign Roles
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/user_permissions/'.$user['users_id']); ?>" 
                                                               class="btn btn-xs btn-info" title="View Permissions">
                                                                <i class="fa fa-key"></i> View Permissions
                                                            </a>
                                                            <button type="button" class="btn btn-xs btn-success dropdown-toggle" 
                                                                    data-toggle="dropdown" title="Quick Actions">
                                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="<?php echo site_url('permissions/assign_user_roles/'.$user['users_id']); ?>">
                                                                        <i class="fa fa-user-circle"></i> Manage Roles
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo site_url('permissions/user_permissions/'.$user['users_id']); ?>">
                                                                        <i class="fa fa-key"></i> View Permissions
                                                                    </a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a href="<?php echo site_url('users/edituser/'.$user['users_id']); ?>">
                                                                        <i class="fa fa-edit"></i> Edit User
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted" style="padding: 40px;">
                                        <i class="fa fa-users fa-4x"></i>
                                        <h3>No Users Found</h3>
                                        <p>No users are available for role management.</p>
                                        <a href="<?php echo site_url('users/adduser'); ?>" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus"></i> Add New User
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-green">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                            <h2>Total Users</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-success"><?php echo $permission_summary['total_users']; ?></h1>
                                <p class="text-muted">Registered Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-blue">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-check"></i> </span>
                            <h2>Users with Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-primary"><?php echo $permission_summary['user_with_roles']; ?></h1>
                                <p class="text-muted">Have Roles Assigned</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-orange">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-times"></i> </span>
                            <h2>Users without Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-warning"><?php echo $permission_summary['total_users'] - $permission_summary['user_with_roles']; ?></h1>
                                <p class="text-muted">Need Role Assignment</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-purple">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-circle"></i> </span>
                            <h2>Available Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-info"><?php echo count($roles); ?></h1>
                                <p class="text-muted">System Roles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Role Distribution -->
            <div class="row">
                <div class="col-md-6">
                    <div class="jarviswidget jarviswidget-color-green">
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
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $total_users = $permission_summary['total_users'];
                                                foreach ($roles as $role): 
                                                    $user_count = $role['user_count'] ?? 0;
                                                    $percentage = $total_users > 0 ? round(($user_count / $total_users) * 100, 1) : 0;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-<?php echo get_role_badge_class($role['role_name']); ?>">
                                                            <?php echo $role['role_name']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo $user_count; ?> users</span>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px; margin-bottom: 0;">
                                                            <div class="progress-bar progress-bar-<?php echo get_role_badge_class($role['role_name']); ?>" 
                                                                 style="width: <?php echo $percentage; ?>%">
                                                                <?php echo $percentage; ?>%
                                                            </div>
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
                                        <p>No roles available</p>
                                        <a href="<?php echo site_url('permissions/add_role'); ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Create First Role
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="jarviswidget jarviswidget-color-blue">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                            <h2>Quick Actions</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="list-group">
                                    <a href="<?php echo site_url('users/allusers'); ?>" class="list-group-item">
                                        <i class="fa fa-users text-primary"></i> View All Users
                                    </a>
                                    <a href="<?php echo site_url('users/adduser'); ?>" class="list-group-item">
                                        <i class="fa fa-user-plus text-success"></i> Add New User
                                    </a>
                                    <a href="<?php echo site_url('permissions/roles'); ?>" class="list-group-item">
                                        <i class="fa fa-user-circle text-info"></i> Manage Roles
                                    </a>
                                    <a href="<?php echo site_url('permissions/add_role'); ?>" class="list-group-item">
                                        <i class="fa fa-plus-circle text-warning"></i> Create New Role
                                    </a>
                                    <a href="<?php echo site_url('permissions/reports'); ?>" class="list-group-item">
                                        <i class="fa fa-chart-bar text-purple"></i> View Reports
                                    </a>
                                </div>
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

#user-roles-table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

#user-roles-table td {
    vertical-align: middle;
}

.table-warning {
    background-color: #fff3cd !important;
}

.progress {
    background-color: #e9ecef;
    border-radius: 4px;
}

.progress-bar {
    line-height: 20px;
    font-size: 11px;
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
</style>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#user-roles-table').DataTable({
        "pageLength": 25,
        "order": [[1, "asc"]],
        "responsive": true,
        "language": {
            "search": "Search users:",
            "lengthMenu": "Show _MENU_ users per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ users",
            "infoEmpty": "Showing 0 to 0 of 0 users",
            "infoFiltered": "(filtered from _MAX_ total users)"
        }
    });
    
    // Highlight users without roles
    $('tr.table-warning').hover(
        function() {
            $(this).addClass('table-warning-hover');
        },
        function() {
            $(this).removeClass('table-warning-hover');
        }
    );
});
</script>

<?php $this->load->view("common/footer"); ?> 