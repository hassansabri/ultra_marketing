<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
            <li>Roles</li>
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
                            <span class="widget-icon"> <i class="fa fa-user-circle"></i> </span>
                            <h2>Role Management</h2>
                            <div class="widget-toolbar">
                                <a href="<?php echo site_url('permissions/add_role'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New Role
                                </a>
                            </div>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($roles)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="roles-table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="20%">Role Name</th>
                                                    <th width="30%">Description</th>
                                                    <th width="10%">Users</th>
                                                    <th width="10%">Permissions</th>
                                                    <th width="10%">Status</th>
                                                    <th width="15%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($roles as $index => $role): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td>
                                                        <strong><?php echo $role['role_name']; ?></strong>
                                                        <?php if ($role['created_at']): ?>
                                                            <br>
                                                            <small class="text-muted">
                                                                Created: <?php echo date('M j, Y', strtotime($role['created_at'])); ?>
                                                            </small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $role['role_description']; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            <?php echo $role['user_count'] ?? 0; ?> users
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <!-- <span class="badge badge-success">
                                                            <?php echo $role['permission_count']; ?> permissions
                                                        </span> -->
                                                    </td>
                                                    <td>
                                                        <?php if ($role['is_active']): ?>
                                                            <span class="badge badge-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/view_role/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-info" title="View Details">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/edit_role/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-warning" title="Edit Role">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/role_permissions/'.$role['role_id']); ?>" 
                                                               class="btn btn-xs btn-primary" title="Manage Permissions">
                                                                <i class="fa fa-key"></i>
                                                            </a>
                                                            <?php if (($role['user_count'] ?? 0) == 0): ?>
                                                                <a href="<?php echo site_url('permissions/delete_role/'.$role['role_id']); ?>" 
                                                                   class="btn btn-xs btn-danger" 
                                                                   onclick="return confirm('Are you sure you want to delete this role?')"
                                                                   title="Delete Role">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted" style="padding: 40px;">
                                        <i class="fa fa-user-circle fa-4x"></i>
                                        <h3>No Roles Found</h3>
                                        <p>Get started by creating your first role.</p>
                                        <a href="<?php echo site_url('permissions/add_role'); ?>" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus"></i> Create First Role
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
                            <h2>Total Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-success"><?php echo $permission_summary['total_roles']; ?></h1>
                                <p class="text-muted">System Roles</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-blue">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-check-circle"></i> </span>
                            <h2>Active Roles</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-primary"><?php echo $permission_summary['active_roles']; ?></h1>
                                <p class="text-muted">Currently Active</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-orange">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-plus"></i> </span>
                            <h2>Users with Roles</h2>
                        </header>
                        <div>
                            <!-- <div class="widget-body text-center">
                                <h1 class="text-warning"><?php echo $permission_summary['users_with_roles']; ?></h1>
                                <p class="text-muted">Assigned Users</p>
                            </div> -->
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="jarviswidget jarviswidget-color-purple">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                            <h2>Total Permissions</h2>
                        </header>
                        <div>
                            <div class="widget-body text-center">
                                <h1 class="text-info"><?php echo $permission_summary['total_permissions']; ?></h1>
                                <p class="text-muted">System Permissions</p>
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

#roles-table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

#roles-table td {
    vertical-align: middle;
}
</style>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#roles-table').DataTable({
        "pageLength": 25,
        "order": [[1, "asc"]],
        "responsive": true,
        "language": {
            "search": "Search roles:",
            "lengthMenu": "Show _MENU_ roles per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ roles",
            "infoEmpty": "Showing 0 to 0 of 0 roles",
            "infoFiltered": "(filtered from _MAX_ total roles)"
        }
    });
});
</script>

<?php $this->load->view("common/footer"); ?> 