<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/roles'); ?>">Roles</a></li>
            <li>Edit Role</li>
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
                            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                            <h2>Edit Role</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php echo form_open('permissions/edit_role/' . $role['role_id'], ['class' => 'form-horizontal', 'id' => 'edit-role-form']); ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select Existing Role</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="existing_role_select">
                                            <option value="">-- Select Role --</option>
                                            <?php foreach ($all_roles as $role): ?>
                                                <option value="<?php echo htmlspecialchars($role['role_name']); ?>" <?php echo ($role['role_name'] == $role['role_name']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($role['role_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-muted">You can select an existing role for reference.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Role Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="role_name" value="<?php echo set_value('role_name', $role['role_name']); ?>" placeholder="Enter role name" required>
                                        <?php echo form_error('role_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Display Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="role_display_name" value="<?php echo set_value('role_name', $role['role_name']); ?>" placeholder="Enter display name" required>
                                        <?php echo form_error('role_display_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="role_description" rows="4" placeholder="Describe the role" required><?php echo set_value('role_description', $role['role_description']); ?></textarea>
                                        <?php echo form_error('role_description', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Role Color</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="role_color">
                                            <option value="primary" <?php echo set_select('role_color', 'primary', $role['role_color'] == 'primary'); ?>>Primary (Blue)</option>
                                            <option value="success" <?php echo set_select('role_color', 'success', $role['role_color'] == 'success'); ?>>Success (Green)</option>
                                            <option value="warning" <?php echo set_select('role_color', 'warning', $role['role_color'] == 'warning'); ?>>Warning (Orange)</option>
                                            <option value="danger" <?php echo set_select('role_color', 'danger', $role['role_color'] == 'danger'); ?>>Danger (Red)</option>
                                            <option value="info" <?php echo set_select('role_color', 'info', $role['role_color'] == 'info'); ?>>Info (Cyan)</option>
                                            <option value="secondary" <?php echo set_select('role_color', 'secondary', $role['role_color'] == 'secondary'); ?>>Secondary (Gray)</option>
                                            <option value="dark" <?php echo set_select('role_color', 'dark', $role['role_color'] == 'dark'); ?>>Dark (Black)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', $role['is_active']); ?>>
                                                Active (Role will be available for assignment)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Role
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
                </div>
            </div>
        </section>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<?php $this->load->view("common/footer"); ?> 