<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li>Home</li>
            <li><a href="<?php echo site_url('packing_options'); ?>">Packing Options</a></li>
            <li><?php echo isset($packing_option) ? 'Edit' : 'Add'; ?> Packing Option</li>
        </ol>
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <h4>Please fix the following errors:</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-box"></i> </span>
                            <h2><?php echo isset($packing_option) ? 'Edit' : 'Add'; ?> Packing Option</h2>
                        </header>
                        
                        <div>
                            <div class="widget-body">
                                <form method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Packing Title <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="packing_title" class="form-control" 
                                                   value="<?php echo set_value('packing_title', isset($packing_option['packing_title']) ? $packing_option['packing_title'] : ''); ?>" 
                                                   placeholder="Enter packing title" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Description</label>
                                        <div class="col-md-8">
                                            <textarea name="packing_description" class="form-control" rows="4" 
                                                      placeholder="Enter packing description"><?php echo set_value('packing_description', isset($packing_option['packing_description']) ? $packing_option['packing_description'] : ''); ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Cost</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">PKR</span>
                                                <input type="number" name="packing_cost" class="form-control" 
                                                       value="<?php echo set_value('packing_cost', isset($packing_option['packing_cost']) ? $packing_option['packing_cost'] : '0.00'); ?>" 
                                                       placeholder="0.00" step="0.01" min="0">
                                            </div>
                                            <small class="text-muted">Leave as 0.00 for free packing</small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> 
                                                <?php echo isset($packing_option) ? 'Update' : 'Save'; ?> Packing Option
                                            </button>
                                            <a href="<?php echo site_url('packing_options'); ?>" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Back to List
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $this->load->view("common/footer"); ?> 