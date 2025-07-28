<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('permissions/roles'); ?>">Roles</a></li>
            <li>View Role</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                            <h2>Role Details</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <h3><?php echo htmlspecialchars($role['role_name']); ?>
                                    <?php if ($role['is_active']): ?>
                                        <span class="label label-success">Active</span>
                                    <?php else: ?>
                                        <span class="label label-default">Inactive</span>
                                    <?php endif; ?>
                                </h3>
                                <p><strong>Role Name:</strong> <?php echo htmlspecialchars($role['role_name']); ?></p>
                                <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($role['role_description'])); ?></p>
                                <hr>
                                <h4>Permissions by Module</h4>
                                <?php  if (!empty($permission_summary)): ?>
                                    <?php foreach ($permission_summary as $module):
                                        $i=0;
                                        // print_r($module[$i]);
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <strong><?php if(isset($module[$i]['module_name']))echo htmlspecialchars(); ?></strong>
                                                <span class="badge">Permissions: <?php if(isset($module[$i]['permission_count']))echo $module[$i]['permission_count']; ?></span>
                                            </div>
                                            <div class="panel-body" style="padding:0;">
                                                <table class="table table-bordered table-striped table-condensed" style="margin-bottom:0;">
                                                    <thead>
                                                        <tr>
                                                            <th>Permission Name</th>
                                                            <th>Display Name</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(isset($module['permissions'])){

                                                            foreach ($module['permissions'] as $perm): ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($perm['permission_name']); ?></td>
                                                                <td><?php echo htmlspecialchars($perm['permission_display_name']); ?></td>
                                                                <td><?php echo htmlspecialchars($perm['permission_description']); ?></td>
                                                            </tr>
                                                            <?php endforeach;
                                                        } 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="alert alert-warning">No permissions assigned to this role.</div>
                                <?php endif; ?>
                                <a href="<?php echo site_url('permissions/roles'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Roles</a>
                                <a href="<?php echo site_url('permissions/edit_role/' . $role['role_id']); ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Role</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="jarviswidget jarviswidget-color-green">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-info-circle"></i> </span>
                            <h2>Role Info</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <ul class="list-unstyled">
                                    <li><strong>Created:</strong> <?php echo !empty($role['created_at']) ? date('Y-m-d H:i', strtotime($role['created_at'])) : 'N/A'; ?></li>
                                    <li><strong>Last Updated:</strong> <?php echo !empty($role['updated_at']) ? date('Y-m-d H:i', strtotime($role['updated_at'])) : 'N/A'; ?></li>
                                </ul>
                                <div class="alert alert-info">
                                    <i class="fa fa-lightbulb-o"></i> You can assign or remove permissions for this role from the <a href="<?php echo site_url('permissions/role_permissions/' . $role['role_id']); ?>">Role Permissions</a> page.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 