<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/permissions'); ?>">Permissions</a></li>
            <li>View Permission</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                            <h2>Permission Details</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($permission)): ?>
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Module</th>
                                            <td><?php echo htmlspecialchars($permission['module_display_name'] ?? ''); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Permission Name</th>
                                            <td><?php echo htmlspecialchars($permission['permission_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Display Name</th>
                                            <td><?php echo htmlspecialchars($permission['permission_display_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><?php echo htmlspecialchars($permission['permission_description']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td><?php echo htmlspecialchars(ucfirst($permission['permission_type'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <?php if ($permission['is_active']): ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td><?php echo htmlspecialchars($permission['created_at']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created By</th>
                                            <td><?php echo htmlspecialchars($permission['created_by']); ?></td>
                                        </tr>
                                    </table>
                                    <a href="<?php echo site_url('permissions/permissions'); ?>" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> Back to Permissions
                                    </a>
                                <?php else: ?>
                                    <div class="alert alert-warning">Permission not found.</div>
                                    <a href="<?php echo site_url('permissions/permissions'); ?>" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> Back to Permissions
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 