<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li><?php echo $this->lang->line("all_users"); ?></li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well no-padding">


                            <fieldset>
                                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                    <!-- widget options:
                                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
    
                                    data-widget-colorbutton="false"
                                    data-widget-editbutton="false"
                                    data-widget-togglebutton="false"
                                    data-widget-deletebutton="false"
                                    data-widget-fullscreenbutton="false"
                                    data-widget-custombutton="false"
                                    data-widget-collapsed="true"
                                    data-widget-sortable="false"
    
                                    -->
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                        <h2><?php echo $this->lang->line("all_users"); ?></h2>
                                        <div class="widget-toolbar">
                                            <?php if (has_module_permission('users') || is_admin()): ?>
                                            <a href="<?php echo site_url(); ?>/permissions" class="btn btn-success btn-sm">
                                                <i class="fa fa-shield"></i> Permission Management
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </header>

                                    <!-- widget div-->
                                    <div>

                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                            <!-- This area used as dropdown edit box -->
                                        </div>
                                        <!-- end widget edit box -->
                                        <!-- widget content -->
                                        <div class="widget-body no-padding">
                                            <!-- Roles and Permissions Summary -->
                                            <div class="row" style="margin: 15px;">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="alert alert-primary text-center">
                                                                <h4><i class="fa fa-users"></i></h4>
                                                                <strong>Total Users</strong><br>
                                                                <span class="h3"><?php echo count($all_users); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="alert alert-success text-center">
                                                                <h4><i class="fa fa-user-circle"></i></h4>
                                                                <strong>Users with Roles</strong><br>
                                                                <?php 
                                                                $users_with_roles = 0;
                                                                foreach ($all_users as $user) {
                                                                    if (!empty($user['roles'])) {
                                                                        $users_with_roles++;
                                                                    }
                                                                }
                                                                ?>
                                                                <span class="h3"><?php echo $users_with_roles; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="alert alert-warning text-center">
                                                                <h4><i class="fa fa-exclamation-triangle"></i></h4>
                                                                <strong>Users without Roles</strong><br>
                                                                <span class="h3"><?php echo count($all_users) - $users_with_roles; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="alert alert-info text-center">
                                                                <h4><i class="fa fa-key"></i></h4>
                                                                <strong>Total Permissions</strong><br>
                                                                <?php 
                                                                $total_permissions = 0;
                                                                foreach ($all_users as $user) {
                                                                    $total_permissions += isset($user['permission_count']) ? $user['permission_count'] : 0;
                                                                }
                                                                ?>
                                                                <span class="h3"><?php echo $total_permissions; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Role Distribution -->
                                                    <div class="row" style="margin-top: 15px;">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">
                                                                        <i class="fa fa-chart-pie"></i> Role Distribution
                                                                    </h5>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <?php 
                                                                    $CI =& get_instance();
                                                                    $CI->load->model('m_permissions');
                                                                    $all_roles = $CI->m_permissions->getAllRoles();
                                                                    $role_counts = [];
                                                                    foreach ($all_roles as $role) {
                                                                        $role_counts[$role['role_name']] = 0;
                                                                    }
                                                                    foreach ($all_users as $user) {
                                                                        if (!empty($user['roles'])) {
                                                                            foreach ($user['roles'] as $user_role) {
                                                                                if (isset($role_counts[$user_role['role_name']])) {
                                                                                    $role_counts[$user_role['role_name']]++;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="row">
                                                                        <?php foreach ($role_counts as $role_name => $count): ?>
                                                                        <div class="col-md-2 col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                                                                            <div class="text-center">
                                                                                <span class="badge badge-<?php echo get_role_badge_class($role_name); ?>" style="font-size: 12px; padding: 8px 12px;">
                                                                                    <i class="fa fa-user-circle"></i> <?php echo $role_name; ?>
                                                                                </span>
                                                                                <br>
                                                                                <small class="text-muted"><?php echo $count; ?> users</small>
                                                                            </div>
                                                                        </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Bulk Role Assignment -->
                                            <?php if (has_module_permission('permissions') || is_admin()): ?>
                                            <div class="row" style="margin: 15px;">
                                                <div class="col-md-12">
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <i class="fa fa-users"></i> Bulk Role Assignment
                                                            </h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <form id="bulkRoleForm" method="post" action="<?php echo site_url('permissions/bulk_assign_roles'); ?>">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label><strong>Select Users:</strong></label>
                                                                            <div class="checkbox-group" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                                                                                <label class="checkbox-inline">
                                                                                    <input type="checkbox" id="selectAllUsers"> <strong>Select All Users</strong>
                                                                                </label>
                                                                                <hr>
                                                                                <?php foreach ($all_users as $user): ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="users[]" value="<?php echo $user['users_id']; ?>" class="user-checkbox">
                                                                                        <?php echo $user['name']; ?> (<?php echo $user['user_name']; ?>)
                                                                                        <?php if (!empty($user['roles'])): ?>
                                                                                            <span class="badge badge-success"><?php echo count($user['roles']); ?> roles</span>
                                                                                        <?php else: ?>
                                                                                            <span class="badge badge-warning">No roles</span>
                                                                                        <?php endif; ?>
                                                                                    </label>
                                                                                </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label><strong>Select Roles:</strong></label>
                                                                            <div class="checkbox-group" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                                                                                <label class="checkbox-inline">
                                                                                    <input type="checkbox" id="selectAllRoles"> <strong>Select All Roles</strong>
                                                                                </label>
                                                                                <hr>
                                                                                <?php 
                                                                                $CI =& get_instance();
                                                                                $CI->load->model('m_permissions');
                                                                                $all_roles = $CI->m_permissions->getAllRoles();
                                                                                foreach ($all_roles as $role): 
                                                                                ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="roles[]" value="<?php echo $role['role_id']; ?>" class="role-checkbox">
                                                                                        <span class="badge badge-<?php echo get_role_badge_class($role['role_name']); ?>">
                                                                                            <?php echo $role['role_name']; ?>
                                                                                        </span>
                                                                                        <br>
                                                                                        <small class="text-muted"><?php echo $role['role_description']; ?></small>
                                                                                    </label>
                                                                                </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label><strong>Assignment Action:</strong></label>
                                                                            <div class="radio">
                                                                                <label>
                                                                                    <input type="radio" name="action" value="add" checked>
                                                                                    <i class="fa fa-plus text-success"></i> Add Roles (Keep existing)
                                                                                </label>
                                                                            </div>
                                                                            <div class="radio">
                                                                                <label>
                                                                                    <input type="radio" name="action" value="replace">
                                                                                    <i class="fa fa-refresh text-warning"></i> Replace All Roles
                                                                                </label>
                                                                            </div>
                                                                            <div class="radio">
                                                                                <label>
                                                                                    <input type="radio" name="action" value="remove">
                                                                                    <i class="fa fa-minus text-danger"></i> Remove Selected Roles
                                                                                </label>
                                                                            </div>
                                                                            
                                                                            <hr>
                                                                            
                                                                            <div class="form-group">
                                                                                <button type="submit" class="btn btn-primary btn-block" id="bulkAssignBtn">
                                                                                    <i class="fa fa-users"></i> Assign Roles to Selected Users
                                                                                </button>
                                                                            </div>
                                                                            
                                                                            <div class="alert alert-info">
                                                                                <small>
                                                                                    <i class="fa fa-info-circle"></i>
                                                                                    <strong>Selected:</strong> <span id="selectedUsersCount">0</span> users, 
                                                                                    <span id="selectedRolesCount">0</span> roles
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="hasinput">
                                                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("filtername"); ?>" />
                                                        </th>
                                                        <th class="hasinput">
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="<?php echo $this->lang->line("filterusername"); ?>" type="text">

                                                </div>
                                                </th>
                                                <th class="hasinput">
                                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("filteremail"); ?>" />
                                                </th>
                                                <th class="hasinput">
                                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("filterphone"); ?>" />
                                                </th>
                                                <th class="hasinput ">
                                                    <input type="text" class="form-control" placeholder="Filter roles" />
                                                </th>
                                                <th class="hasinput ">
                                                    <input type="text" class="form-control" placeholder="Filter permissions" />
                                                </th>
                                                <th class="hasinput ">

                                                </th>

                                                </tr>
                                                <tr>
                                                    <th data-class="expand"><?php echo $this->lang->line("name"); ?></th>
                                                    <th><?php echo $this->lang->line("UserName"); ?></th>
                                                    <th data-hide="phone"><?php echo $this->lang->line("email"); ?></th>
                                                                                                    <th data-hide="phone"><?php echo $this->lang->line("phone"); ?></th>
                                                <th data-hide="phone,tablet"><?php echo $this->lang->line("status"); ?></th>
                                                <th data-hide="phone,tablet">
                                                    Roles
                                                    <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                    <br>
                                                    <small>
                                                        <a href="#bulkRoleForm" class="text-primary" style="text-decoration: none;">
                                                            <i class="fa fa-plus-circle"></i> Bulk Assign
                                                        </a>
                                                    </small>
                                                    <?php endif; ?>
                                                </th>
                                                <th data-hide="phone,tablet">Permissions</th>
                                                <th data-hide=""><?php echo $this->lang->line("option"); ?></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                    <?php if (sizeof($all_users) > 0) { ?>
                                                        <?php foreach ($all_users as $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value["name"]; ?></td>
                                                                <td><?php echo $value["user_name"]; ?></td>
                                                                <td><?php echo $value["email"]; ?></td>
                                                                <td><?php echo $value["phone"]; ?></td>
                                                                <td>
                                                                    <span class="onoffswitch">
                                                                        <input class="onoffswitch-checkbox changestatus" id="<?php echo $value['users_id'] ?>" type="checkbox" <?php if ($value["is_active"] == "1") { ?>checked="checked" value="1"<?php } else { ?>value='0'<?php } ?> >
                                                                        <label class="onoffswitch-label" for="<?php echo $value['users_id'] ?>"> 
                                                                            <span class="onoffswitch-inner" data-swchon-text="<?php echo $this->lang->line("active"); ?>" data-swchoff-text="Disable"></span> 
                                                                            <span class="onoffswitch-switch"></span> 
                                                                        </label> 
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <div class="user-roles-container">
                                                                        <?php if (isset($value['roles']) && !empty($value['roles'])): ?>
                                                                            <div class="roles-list">
                                                                                <?php foreach ($value['roles'] as $role): ?>
                                                                                    <span class="badge badge-<?php echo get_role_badge_class($role['role_name']); ?> role-badge">
                                                                                        <i class="fa fa-user-circle"></i>
                                                                                        <?php echo $role['role_name']; ?>
                                                                                    </span>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                            <div class="role-actions">
                                                                                <small class="text-muted">
                                                                                    <i class="fa fa-shield"></i> <?php echo count($value['roles']); ?> role(s)
                                                                                </small>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="no-roles">
                                                                                <span class="text-muted">
                                                                                    <i class="fa fa-exclamation-triangle"></i> No roles assigned
                                                                                </span>
                                                                                <br>
                                                                                <small class="text-danger">
                                                                                    <i class="fa fa-info-circle"></i> User has no access
                                                                                </small>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        
                                                                        <!-- Assign Role Link -->
                                                                        <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                        <div class="assign-role-link">
                                                                            <a href="<?php echo site_url(); ?>/permissions/assign_user_roles/<?php echo $value['users_id']; ?>" 
                                                                               class="btn btn-primary btn-xs assign-role-btn" 
                                                                               title="Assign Roles to <?php echo $value['name']; ?>">
                                                                                <i class="fa fa-plus-circle"></i> Assign Role
                                                                            </a>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="user-permissions-container">
                                                                        <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                            <?php 
                                                                            $permission_count = isset($value['permission_count']) ? $value['permission_count'] : 0;
                                                                            $btn_class = $permission_count > 0 ? 'btn-success' : 'btn-warning';
                                                                            $icon_class = $permission_count > 0 ? 'fa-shield' : 'fa-exclamation-triangle';
                                                                            ?>
                                                                            <div class="permission-actions">
                                                                                <a href="<?php echo site_url(); ?>/permissions/assign_user_roles/<?php echo $value['users_id']; ?>" 
                                                                                   class="btn <?php echo $btn_class; ?> btn-xs permission-btn" 
                                                                                   title="Manage User Permissions">
                                                                                    <i class="fa <?php echo $icon_class; ?>"></i> 
                                                                                    <?php echo $permission_count > 0 ? 'Manage' : 'Setup'; ?>
                                                                                </a>
                                                                                
                                                                                <?php if ($permission_count > 0): ?>
                                                                                    <a href="<?php echo site_url(); ?>/permissions/user_permissions/<?php echo $value['users_id']; ?>" 
                                                                                       class="btn btn-info btn-xs permission-btn" 
                                                                                       title="View User Permissions">
                                                                                        <i class="fa fa-eye"></i> View
                                                                                    </a>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            
                                                                            <div class="permission-summary">
                                                                                <div class="permission-count">
                                                                                    <i class="fa fa-key"></i> 
                                                                                    <strong><?php echo $permission_count; ?></strong> permissions
                                                                                </div>
                                                                                
                                                                                <?php if (isset($value['roles']) && !empty($value['roles'])): ?>
                                                                                    <div class="role-permissions">
                                                                                        <?php foreach ($value['roles'] as $role): ?>
                                                                                            <small class="text-muted">
                                                                                                <i class="fa fa-circle"></i> 
                                                                                                <?php echo $role['role_name']; ?>
                                                                                            </small>
                                                                                        <?php endforeach; ?>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                                
                                                                                <?php if ($permission_count == 0): ?>
                                                                                    <div class="no-permissions">
                                                                                        <small class="text-danger">
                                                                                            <i class="fa fa-exclamation-circle"></i> No permissions assigned
                                                                                        </small>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="no-access">
                                                                                <span class="text-muted">
                                                                                    <i class="fa fa-lock"></i> No access
                                                                                </span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary">
                                                                            <?php echo $this->lang->line("dropdown"); ?>
                                                                        </button>
                                                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                            <li class="dropdown-header">
                                                                                <i class="fa fa-shield"></i> Permission Status
                                                                                <?php 
                                                                                $permission_count = isset($value['permission_count']) ? $value['permission_count'] : 0;
                                                                                $status_class = $permission_count > 0 ? 'text-success' : 'text-danger';
                                                                                $status_text = $permission_count > 0 ? 'Active' : 'No Permissions';
                                                                                ?>
                                                                                <span class="badge <?php echo $permission_count > 0 ? 'badge-success' : 'badge-danger'; ?> pull-right">
                                                                                    <?php echo $status_text; ?>
                                                                                </span>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <?php endif; ?>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/users/editprofileuser/<?php echo $value['users_id']; ?>"> <?php echo $this->lang->line("edit_profile"); ?></a>
                                                                            </li>
                                                                            <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/permissions/assign_user_roles/<?php echo $value['users_id']; ?>">
                                                                                    <i class="fa fa-plus-circle text-primary"></i> 
                                                                                    <span class="text-primary">Assign Roles</span>
                                                                                    <?php if (empty($value['roles'])): ?>
                                                                                        <span class="badge badge-danger pull-right">Urgent</span>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            </li>
                                                                            <?php endif; ?>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/users/changepermissions/<?php echo $value['users_id']; ?>"><?php echo $this->lang->line("AccessRights"); ?></a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/permissions/assign_user_roles/<?php echo $value['users_id']; ?>">
                                                                                    <?php 
                                                                                    $permission_count = isset($value['permission_count']) ? $value['permission_count'] : 0;
                                                                                    $icon_class = $permission_count > 0 ? 'fa-shield' : 'fa-exclamation-triangle';
                                                                                    $text_class = $permission_count > 0 ? 'text-success' : 'text-warning';
                                                                                    ?>
                                                                                    <i class="fa <?php echo $icon_class; ?> <?php echo $text_class; ?>"></i> 
                                                                                    <span class="<?php echo $text_class; ?>">
                                                                                        <?php echo $permission_count > 0 ? 'Manage Permissions' : 'Setup Permissions'; ?>
                                                                                    </span>
                                                                                    <?php if ($permission_count > 0): ?>
                                                                                        <span class="badge badge-success pull-right"><?php echo $permission_count; ?></span>
                                                                                    <?php else: ?>
                                                                                        <span class="badge badge-warning pull-right">0</span>
                                                                                    <?php endif; ?>
                                                                                </a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <?php endif; ?>
                                                                            <?php if (has_module_permission('permissions') || is_admin()): ?>
                                                                            <li class="divider"></li>
                                                                            <li>
                                                                                <a href="<?php echo site_url(); ?>/permissions/assign_user_roles/<?php echo $value['users_id']; ?>" class="text-center">
                                                                                    <strong>
                                                                                        <i class="fa fa-cog"></i> Quick Permission Setup
                                                                                    </strong>
                                                                                </a>
                                                                            </li>
                                                                            <?php endif; ?>
                                                                            <li>
                                                                                <a href="<?php echo site_url('users/changepermissions/' . $value['users_id']); ?>" 
                                                                                   class="btn btn-warning btn-xs" 
                                                                                   title="Change Permission">
                                                                                    <i class="fa fa-lock"></i> Change Permission
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <?php } ?>
                                                </tbody>

                                            </table>

                                        </div>
                                        <!-- end widget content -->

                                    </div>
                                    <!-- end widget div -->

                                </div>
                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>
<style>
    /* Permission dropdown styling */
    .dropdown-menu .dropdown-header {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #495057;
    }
    
    .dropdown-menu .dropdown-header i {
        margin-right: 5px;
    }
    
    .dropdown-menu .badge {
        font-size: 10px;
        padding: 2px 6px;
    }
    
    .dropdown-menu .text-success {
        color: #28a745 !important;
    }
    
    .dropdown-menu .text-warning {
        color: #ffc107 !important;
    }
    
    .dropdown-menu .text-danger {
        color: #dc3545 !important;
    }
    
    .dropdown-menu .pull-right {
        float: right;
    }
    
    .dropdown-menu .text-center {
        text-align: center;
    }
    
    .dropdown-menu .text-center strong {
        color: #007bff;
    }
    
    /* Permission status indicators */
    .permission-status-active {
        color: #28a745;
        font-weight: bold;
    }
    
    .permission-status-inactive {
        color: #dc3545;
        font-weight: bold;
    }
    
    /* User Roles and Permissions Styling */
    .user-roles-container,
    .user-permissions-container {
        padding: 5px;
        border-radius: 4px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    .roles-list {
        margin-bottom: 5px;
    }
    
    .role-badge {
        display: inline-block;
        margin: 2px;
        padding: 4px 8px;
        font-size: 11px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .role-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .role-badge i {
        margin-right: 3px;
    }
    
    .role-actions {
        text-align: center;
        padding: 3px 0;
        border-top: 1px solid #dee2e6;
    }
    
    .no-roles {
        text-align: center;
        padding: 10px;
        background-color: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 4px;
    }
    
    .assign-role-link {
        text-align: center;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid #dee2e6;
    }
    
    .assign-role-btn {
        width: 100%;
        padding: 6px 12px;
        font-size: 11px;
        border-radius: 4px;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        color: white;
        font-weight: bold;
    }
    
    .assign-role-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,123,255,0.3);
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        color: white;
        text-decoration: none;
    }
    
    .assign-role-btn i {
        margin-right: 4px;
        font-size: 12px;
    }
    
    /* Enhanced styling for users without roles */
    .no-roles .assign-role-link {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 2px solid #ffc107;
    }
    
    .no-roles .assign-role-btn {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: #212529;
        font-weight: bold;
        border: 1px solid #d39e00;
    }
    
    .no-roles .assign-role-btn:hover {
        background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
        box-shadow: 0 4px 8px rgba(255,193,7,0.3);
        color: #212529;
    }
    
    .permission-actions {
        margin-bottom: 8px;
        text-align: center;
    }
    
    .permission-btn {
        margin: 2px;
        padding: 4px 8px;
        font-size: 11px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .permission-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .permission-summary {
        padding: 5px;
        background-color: white;
        border-radius: 3px;
        border: 1px solid #dee2e6;
    }
    
    .permission-count {
        text-align: center;
        font-weight: bold;
        color: #495057;
        margin-bottom: 5px;
    }
    
    .permission-count i {
        color: #007bff;
        margin-right: 3px;
    }
    
    .role-permissions {
        text-align: center;
        margin-top: 5px;
    }
    
    .role-permissions small {
        display: block;
        margin: 2px 0;
        color: #6c757d;
    }
    
    .role-permissions i {
        font-size: 8px;
        margin-right: 3px;
    }
    
    .no-permissions {
        text-align: center;
        padding: 5px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 3px;
        margin-top: 5px;
    }
    
    .no-access {
        text-align: center;
        padding: 10px;
        background-color: #e2e3e5;
        border: 1px solid #d6d8db;
        border-radius: 4px;
    }
    
    /* Hover effects for containers */
    .user-roles-container:hover,
    .user-permissions-container:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }
    
    /* Responsive design for mobile */
    @media (max-width: 768px) {
        .role-badge {
            font-size: 10px;
            padding: 3px 6px;
        }
        
        .permission-btn {
            font-size: 10px;
            padding: 3px 6px;
        }
        
        .user-roles-container,
        .user-permissions-container {
            padding: 3px;
        }
    }
    
    /* Highlight users without roles */
    .highlight-no-roles {
        background-color: #fff3cd !important;
        border-left: 4px solid #ffc107 !important;
    }
    
    .highlight-no-roles:hover {
        background-color: #ffeaa7 !important;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>

<script type="text/javascript">
    user.init();
    
    // Bulk Role Assignment JavaScript
    $(document).ready(function() {
        // Select All Users
        $('#selectAllUsers').change(function() {
            $('.user-checkbox').prop('checked', $(this).is(':checked'));
            updateSelectionCounts();
        });
        
        // Select All Roles
        $('#selectAllRoles').change(function() {
            $('.role-checkbox').prop('checked', $(this).is(':checked'));
            updateSelectionCounts();
        });
        
        // Update selection counts when individual checkboxes change
        $('.user-checkbox, .role-checkbox').change(function() {
            updateSelectionCounts();
        });
        
        // Update selection counts
        function updateSelectionCounts() {
            var selectedUsers = $('.user-checkbox:checked').length;
            var selectedRoles = $('.role-checkbox:checked').length;
            
            $('#selectedUsersCount').text(selectedUsers);
            $('#selectedRolesCount').text(selectedRoles);
            
            // Update button text
            var action = $('input[name="action"]:checked').val();
            var buttonText = '';
            
            switch(action) {
                case 'add':
                    buttonText = 'Add Roles to ' + selectedUsers + ' Users';
                    break;
                case 'replace':
                    buttonText = 'Replace Roles for ' + selectedUsers + ' Users';
                    break;
                case 'remove':
                    buttonText = 'Remove Roles from ' + selectedUsers + ' Users';
                    break;
            }
            
            $('#bulkAssignBtn').html('<i class="fa fa-users"></i> ' + buttonText);
        }
        
        // Update button text when action changes
        $('input[name="action"]').change(function() {
            updateSelectionCounts();
        });
        
        // Form submission with confirmation
        $('#bulkRoleForm').submit(function(e) {
            var selectedUsers = $('.user-checkbox:checked').length;
            var selectedRoles = $('.role-checkbox:checked').length;
            var action = $('input[name="action"]:checked').val();
            
            if (selectedUsers === 0) {
                alert('Please select at least one user.');
                e.preventDefault();
                return false;
            }
            
            if (selectedRoles === 0) {
                alert('Please select at least one role.');
                e.preventDefault();
                return false;
            }
            
            var confirmMessage = '';
            switch(action) {
                case 'add':
                    confirmMessage = 'Are you sure you want to ADD ' + selectedRoles + ' role(s) to ' + selectedUsers + ' user(s)?';
                    break;
                case 'replace':
                    confirmMessage = 'Are you sure you want to REPLACE all roles for ' + selectedUsers + ' user(s) with ' + selectedRoles + ' role(s)? This will remove all existing roles.';
                    break;
                case 'remove':
                    confirmMessage = 'Are you sure you want to REMOVE ' + selectedRoles + ' role(s) from ' + selectedUsers + ' user(s)?';
                    break;
            }
            
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            $('#bulkAssignBtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
        });
        
        // Initialize counts
        updateSelectionCounts();
        
        // Smooth scroll to bulk role form
        $('a[href="#bulkRoleForm"]').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('#bulkRoleForm').offset().top - 100
            }, 800);
        });
        
        // Highlight users without roles
        $('.no-roles').closest('tr').addClass('highlight-no-roles');
    });
</script>
<?php $this->load->view("common/footer"); ?>