<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/modules'); ?>">Modules</a></li>
            <li>Add Module</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-cube"></i> </span>
                            <h2>Add New Module</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php echo form_open('permissions/add_module', ['class' => 'form-horizontal', 'id' => 'add-module-form']); ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Module Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="module_name" value="<?php echo set_value('module_name'); ?>" placeholder="Enter module name (e.g., orders)" required>
                                        <?php echo form_error('module_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Display Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="module_display_name" value="<?php echo set_value('module_display_name'); ?>" placeholder="Enter display name (e.g., Orders)" required>
                                        <?php echo form_error('module_display_name', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="module_description" rows="3" placeholder="Describe the module"><?php echo set_value('module_description'); ?></textarea>
                                        <?php echo form_error('module_description', '<span class="text-danger">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', true); ?>>
                                                Active (Module will be available for assignment)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Create Module
                                        </button>
                                        <a href="<?php echo site_url('permissions/modules'); ?>" class="btn btn-default">
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