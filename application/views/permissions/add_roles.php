<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li><a href="<?php echo site_url('permissions'); ?>">Permission Management</a></li>
            <li>Assign User Roles</li>
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
                            <h2>Assign Roles to User: <?php echo $user['name']; ?></h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>User Information</h4>
                                        <table class="table table-striped">
                                            <tr>
                                                <td><strong>Name:</strong></td>
                                                <td><?php echo $user['name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Username:</strong></td>
                                                <td><?php echo $user['user_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td><?php echo $user['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Current Roles:</strong></td>
                                                <td>
                                                    <?php if (!empty($user_roles)): ?>
                                                        <?php foreach ($user_roles as $role): ?>
                                                            <?php echo get_role_badge($role['role_name']); ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">No roles assigned</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h4>Assign Roles</h4>
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label>Select Roles:</label>
                                                <?php foreach ($all_roles as $role): ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="roles[]" value="<?php echo $role['role_id']; ?>" 
                                                                   <?php echo in_array($role['role_id'], array_column($user_roles, 'role_id')) ? 'checked' : ''; ?>>
                                                            <?php echo get_role_badge($role['role_name']); ?>
                                                            <small class="text-muted"><?php echo $role['role_description']; ?></small>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-save"></i> Update User Roles
                                                </button>
                                                <a href="<?php echo site_url('users/allusers'); ?>" class="btn btn-default">
                                                    <i class="fa fa-arrow-left"></i> Back to Users
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>User Permissions Summary</h4>
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i>
                                            <strong>Note:</strong> This user will have all permissions from the selected roles. 
                                            You can manage individual role permissions from the <a href="<?php echo site_url('permissions/roles'); ?>">Roles Management</a> page.
                                        </div>
                                        
                                        <?php if (!empty($user_roles)): ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Role</th>
                                                            <th>Permissions</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($user_roles as $role): ?>
                                                            <tr>
                                                                <td><?php echo get_role_badge($role['role_name']); ?></td>
                                                                <td>
                                                                    <span class="badge badge-info">
                                                                        <?php 
                                                                        // Get permission count for this role
                                                                        $CI =& get_instance();
                                                                        $CI->load->model('m_permissions');
                                                                        $permissions = $CI->m_permissions->getRolePermissions($role['role_id']);
                                                                        echo count($permissions);
                                                                        ?> permissions
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="<?php echo site_url('permissions/role_permissions/'.$role['role_id']); ?>" class="btn btn-xs btn-info">
                                                                        <i class="fa fa-eye"></i> View Permissions
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-warning">
                                                <i class="fa fa-exclamation-triangle"></i>
                                                This user has no roles assigned and will not have access to any system features.
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
.checkbox label {
    display: block;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f9f9f9;
}

.checkbox label:hover {
    background-color: #f0f0f0;
}

.checkbox input[type="checkbox"] {
    margin-right: 10px;
}

.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.badge-danger {
    background-color: #e74c3c;
}

.badge-warning {
    background-color: #f39c12;
}

.badge-info {
    background-color: #3498db;
}

.badge-success {
    background-color: #27ae60;
}

.badge-secondary {
    background-color: #95a5a6;
}
</style>

<?php $this->load->view("common/footer"); ?> 