<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/permissions'); ?>">Permissions</a></li>
            <li>Edit Permission</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                            <h2>Edit Permission</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php echo form_open('permissions/edit_permission/' . $permission['permission_id'], ['class' => 'form-horizontal', 'id' => 'edit-permission-form']); ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Module <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="module_id" required>
                                            <option value="">-- Select Module --</option>
                                            <?php foreach ($modules as $module): ?>
                                                <option value="<?php echo $module['module_id']; ?>" <?php echo set_select('module_id', $module['module_id'], $permission['module_id'] == $module['module_id']); ?>><?php echo htmlspecialchars($module['module_display_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('module_id', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Permission Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="permission_name" value="<?php echo set_value('permission_name', $permission['permission_name']); ?>" placeholder="Enter permission name (e.g., view_orders)" required>
                                        <?php echo form_error('permission_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Display Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="permission_display_name" value="<?php echo set_value('permission_display_name', $permission['permission_display_name']); ?>" placeholder="Enter display name (e.g., View Orders)" required>
                                        <?php echo form_error('permission_display_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="permission_description" rows="3" placeholder="Describe the permission" required><?php echo set_value('permission_description', $permission['permission_description']); ?></textarea>
                                        <?php echo form_error('permission_description', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="permission_type" required>
                                            <option value="">-- Select Type --</option>
                                            <?php foreach ($permission_types as $type): ?>
                                                <option value="<?php echo $type; ?>" <?php echo set_select('permission_type', $type, $permission['permission_type'] == $type); ?>><?php echo htmlspecialchars(ucfirst($type)); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('permission_type', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', $permission['is_active']); ?>>
                                                Active (Permission will be available for assignment)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Permission
                                        </button>
                                        <a href="<?php echo site_url('permissions/permissions'); ?>" class="btn btn-default">
                                            <i class="fa fa-times"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 