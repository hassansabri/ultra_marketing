<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('users/allusers'); ?>">Users</a></li>
            <li>User Permissions</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                            <h2>User Permissions</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <h4>User: <strong><?php echo htmlspecialchars($user['name']); ?></strong> (<?php echo htmlspecialchars($user['user_name']); ?>)</h4>
                                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                                <?php if (!empty($user_permissions)): ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Permission Name</th>
                                                <th>Display Name</th>
                                                <th>Module</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($user_permissions as $index => $permission): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($permission['permission_name']); ?></td>
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
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info">This user has no permissions assigned.</div>
                                <?php endif; ?>
                                <a href="<?php echo site_url('users/allusers'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Back to Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 