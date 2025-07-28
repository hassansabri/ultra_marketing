<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Permission Management</li>
            <li>Permissions</li>
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
                            <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                            <h2>Permission Management</h2>
                            <div class="widget-toolbar">
                                <a href="<?php echo site_url('permissions/add_permission'); ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i> Add New Permission
                                </a>
                            </div>
                        </header>
                        <div>
                            <div class="widget-body">
                                <?php if (!empty($permissions)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="permissions-table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="15%">Permission Name</th>
                                                    <th width="20%">Display Name</th>
                                                    <th width="20%">Module</th>
                                                    <th width="15%">Type</th>
                                                    <th width="15%">Status</th>
                                                    <th width="10%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($permissions as $index => $permission): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><strong><?php echo htmlspecialchars($permission['permission_name']); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($permission['permission_display_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($permission['module_display_name'] ?? ''); ?></td>
                                                    <td><?php echo htmlspecialchars(ucfirst($permission['permission_type'])); ?></td>
                                                    <td>
                                                        <?php if ($permission['is_active']): ?>
                                                            <span class="badge badge-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Inactive</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="<?php echo site_url('permissions/view_permission/'.$permission['permission_id']); ?>" 
                                                               class="btn btn-xs btn-info" title="View Details">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/edit_permission/'.$permission['permission_id']); ?>" 
                                                               class="btn btn-xs btn-warning" title="Edit Permission">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="<?php echo site_url('permissions/delete_permission/'.$permission['permission_id']); ?>" 
                                                               class="btn btn-xs btn-danger" 
                                                               onclick="return confirm('Are you sure you want to delete this permission?')"
                                                               title="Delete Permission">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-info">No permissions found.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view("common/footer"); ?> 