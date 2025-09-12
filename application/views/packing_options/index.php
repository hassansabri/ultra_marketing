<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li>Home</li><li>Packing Options</li>
        </ol>
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-box"></i> </span>
                            <h2>Packing Options Management</h2>
                            <div class="widget-toolbar">
                                <a href="<?php echo site_url('packing_options/add'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New Packing Option
                                </a>
                            </div>
                        </header>
                        
                        <div>
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Cost</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($packing_options) && count($packing_options) > 0): ?>
                                                <?php foreach ($packing_options as $option): ?>
                                                    <tr>
                                                        <td><?php echo $option['packing_id']; ?></td>
                                                        <td><?php echo $option['packing_title']; ?></td>
                                                        <td>
                                                            <?php if ($option['packing_description']): ?>
                                                                <?php echo substr($option['packing_description'], 0, 50); ?>
                                                                <?php if (strlen($option['packing_description']) > 50): ?>...<?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="text-muted">No description</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($option['packing_cost'] > 0): ?>
                                                                PKR <?php echo number_format($option['packing_cost'], 2); ?>
                                                            <?php else: ?>
                                                                <span class="text-success">Free</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($option['status']): ?>
                                                                <span class="label label-success">Active</span>
                                                            <?php else: ?>
                                                                <span class="label label-danger">Inactive</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo date('M j, Y', strtotime($option['created_date'])); ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?php echo site_url('packing_options/edit/' . $option['packing_id']); ?>" class="btn btn-xs btn-primary">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <!-- <a href="<?php echo site_url('packing_options/toggle_status/' . $option['packing_id']); ?>" class="btn btn-xs btn-warning" onclick="return confirm('Are you sure you want to change the status?')">
                                                                    <?php if ($option['status']): ?>
                                                                        <i class="fa fa-ban"></i> Disable
                                                                    <?php else: ?>
                                                                        <i class="fa fa-check"></i> Enable
                                                                    <?php endif; ?>
                                                                </a>
                                                                <a href="<?php echo site_url('packing_options/delete/' . $option['packing_id']); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this packing option?')">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a> -->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">No packing options found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $this->load->view("common/footer"); ?> 