<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/roles'); ?>">Roles</a></li>
            <li>Add New Role</li>
        </ol>
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-plus-circle"></i> </span>
                            <h2>Add New Role</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php echo form_open('permissions/add_role', ['class' => 'form-horizontal', 'id' => 'add-role-form']); ?>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select Existing Role</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="existing_role_select">
                                            <option value="">-- Select Role --</option>
                                            <?php foreach ($all_roles as $role): ?>
                                                <option value="<?php echo htmlspecialchars($role['role_name']); ?>"><?php echo htmlspecialchars($role['role_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-muted">You can select an existing role for reference.</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Role Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="role_name" value="<?php echo set_value('role_name'); ?>" 
                                               placeholder="Enter role name (e.g., admin, manager, user)" required>
                                        <?php echo form_error('role_name', '<span class="text-danger">', '</span>'); ?>
                                        <small class="text-muted">Use lowercase letters, numbers, and underscores only</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Display Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="role_display_name" value="<?php echo set_value('role_display_name'); ?>" 
                                               placeholder="Enter display name (e.g., Administrator, Manager, User)" required>
                                        <?php echo form_error('role_display_name', '<span class="text-danger">', '</span>'); ?>
                                        <small class="text-muted">This is the name that will be displayed to users</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="role_description" rows="4" 
                                                  placeholder="Describe the purpose and responsibilities of this role" required><?php echo set_value('role_description'); ?></textarea>
                                        <?php echo form_error('role_description', '<span class="text-danger">', '</span>'); ?>
                                        <small class="text-muted">Provide a clear description of what this role can do</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Role Color</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="role_color">
                                            <option value="primary" <?php echo set_select('role_color', 'primary'); ?>>Primary (Blue)</option>
                                            <option value="success" <?php echo set_select('role_color', 'success'); ?>>Success (Green)</option>
                                            <option value="warning" <?php echo set_select('role_color', 'warning'); ?>>Warning (Orange)</option>
                                            <option value="danger" <?php echo set_select('role_color', 'danger'); ?>>Danger (Red)</option>
                                            <option value="info" <?php echo set_select('role_color', 'info'); ?>>Info (Cyan)</option>
                                            <option value="secondary" <?php echo set_select('role_color', 'secondary'); ?>>Secondary (Gray)</option>
                                            <option value="dark" <?php echo set_select('role_color', 'dark'); ?>>Dark (Black)</option>
                                        </select>
                                        <small class="text-muted">Choose a color for this role's badge</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', true); ?>>
                                                Active (Role will be available for assignment)
                                            </label>
                                        </div>
                                        <small class="text-muted">Inactive roles cannot be assigned to users</small>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Default Permissions</label>
                                    <div class="col-md-9">
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i>
                                            <strong>Note:</strong> You can assign permissions to this role after creation. 
                                            Click "Create Role" to continue, then manage permissions.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Create Role
                                        </button>
                                        <a href="<?php echo site_url('permissions/roles'); ?>" class="btn btn-default">
                                            <i class="fa fa-times"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Role Guidelines -->
                    <div class="jarviswidget jarviswidget-color-green">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-lightbulb"></i> </span>
                            <h2>Role Guidelines</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="alert alert-info">
                                    <h5><i class="fa fa-info-circle"></i> Best Practices</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check text-success"></i> Use descriptive names</li>
                                        <li><i class="fa fa-check text-success"></i> Follow naming conventions</li>
                                        <li><i class="fa fa-check text-success"></i> Provide clear descriptions</li>
                                        <li><i class="fa fa-check text-success"></i> Start with basic permissions</li>
                                    </ul>
                                </div>
                                
                                <h5>Common Role Types:</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Admin:</strong> Full system access</li>
                                    <li><strong>Manager:</strong> Department-level access</li>
                                    <li><strong>User:</strong> Basic user access</li>
                                    <li><strong>Guest:</strong> Read-only access</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="jarviswidget jarviswidget-color-blue">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-bolt"></i> </span>
                            <h2>Quick Actions</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <div class="list-group">
                                    <a href="<?php echo site_url('permissions/roles'); ?>" class="list-group-item">
                                        <i class="fa fa-list"></i> View All Roles
                                    </a>
                                    <a href="<?php echo site_url('permissions/add_module'); ?>" class="list-group-item">
                                        <i class="fa fa-plus"></i> Create Module
                                    </a>
                                    <a href="<?php echo site_url('permissions/add_permission'); ?>" class="list-group-item">
                                        <i class="fa fa-plus"></i> Create Permission
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

.form-group {
    margin-bottom: 20px;
}

.control-label {
    font-weight: 600;
}

.text-danger {
    color: #dc3545 !important;
}

.alert {
    border-radius: 4px;
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
    // Form validation
    $('#add-role-form').validate({
        rules: {
            role_name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                pattern: /^[a-z0-9_]+$/
            },
            role_display_name: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            role_description: {
                required: true,
                minlength: 10,
                maxlength: 500
            }
        },
        messages: {
            role_name: {
                required: "Please enter a role name",
                minlength: "Role name must be at least 2 characters long",
                maxlength: "Role name cannot exceed 50 characters",
                pattern: "Role name can only contain lowercase letters, numbers, and underscores"
            },
            role_display_name: {
                required: "Please enter a display name",
                minlength: "Display name must be at least 2 characters long",
                maxlength: "Display name cannot exceed 100 characters"
            },
            role_description: {
                required: "Please enter a description",
                minlength: "Description must be at least 10 characters long",
                maxlength: "Description cannot exceed 500 characters"
            }
        },
        errorClass: 'text-danger',
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    // Auto-generate display name from role name
    $('input[name="role_name"]').on('input', function() {
        var roleName = $(this).val();
        var displayName = roleName.replace(/_/g, ' ').replace(/\b\w/g, function(l) {
            return l.toUpperCase();
        });
        $('input[name="role_display_name"]').val(displayName);
    });
});
</script>

<?php $this->load->view("common/footer"); ?> 