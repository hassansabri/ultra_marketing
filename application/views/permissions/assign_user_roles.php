<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="ribbon">
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line('home'); ?></li>
            <li>Permission Management</li>
            <li><a href="<?php echo site_url('users/allusers'); ?>">Users</a></li>
            <li>Assign Roles</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-md-8">
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-user-circle"></i> </span>
                            <h2>Assign Roles to User</h2>
                        </header>
                        <div>
                            <div class="widget-body">
                                <h4>User: <strong><?php echo htmlspecialchars($user['name']); ?></strong> (<?php echo htmlspecialchars($user['user_name']); ?>)</h4>
                                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                                <form method="post" action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Roles</label>
                                        <div class="col-md-9">
                                            <?php if (!empty($all_roles)): ?>
                                                <?php $assigned = array_column($user_roles, 'role_id'); ?>
                                                <?php foreach ($all_roles as $role): ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="roles[]" value="<?php echo $role['role_id']; ?>" <?php echo in_array($role['role_id'], $assigned) ? 'checked' : ''; ?>>
                                                            <?php echo htmlspecialchars($role['role_name']); ?>
                                                            <small class="text-muted">(<?php echo htmlspecialchars($role['role_description']); ?>)</small>
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="alert alert-info">No roles available.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Update Roles
                                            </button>
                                            <a href="<?php echo site_url('users/allusers'); ?>" class="btn btn-default">
                                                <i class="fa fa-times"></i> Cancel
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
<?php $this->load->view('common/footer'); ?> 