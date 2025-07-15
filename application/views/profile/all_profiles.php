<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>All Profiles</li>
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
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-deletebutton="false" data-widget-editbutton="false">
                                <header>
                                    <span class="widget-icon"> <i class="fa fa-building"></i> </span>
                                    <h2>All Company Profiles</h2>

                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <?php if($this->session->flashdata('success')): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="fa fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-class="expand">Logo</th>
                                                    <th data-hide="">Shop Name</th>
                                                    <th data-hide="">Contact Person</th>
                                                    <th data-hide="">Email</th>
                                                    <th data-hide="">Phone</th>
                                                    <th data-hide="">Address</th>
                                                    <th data-hide="">Created Date</th>
                                                    <th data-hide=""><?php echo $this->lang->line("option"); ?></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if (isset($all_profiles) && sizeof($all_profiles) > 0): ?>
                                                    <?php foreach($all_profiles as $profile): ?>
                                                        <tr>
                                                            <td>
                                                                <?php if(isset($profile['logo']) && $profile['logo'] != ''): ?>
                                                                    <img src="<?php echo base_url(); ?>images/<?php echo $profile['logo']; ?>" 
                                                                         alt="Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                                                <?php else: ?>
                                                                    <div style="width: 50px; height: 50px; background-color: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                                                        <i class="fa fa-building" style="color: #999;"></i>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <strong><?php echo $profile['shop_name']; ?></strong>
                                                            </td>
                                                            <td><?php echo $profile['name']; ?></td>
                                                            <td>
                                                                <a href="mailto:<?php echo $profile['email']; ?>">
                                                                    <?php echo $profile['email']; ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="tel:<?php echo $profile['phone']; ?>">
                                                                    <?php echo $profile['phone']; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $profile['adress']; ?></td>
                                                            <td><?php echo date('M j, Y', strtotime($profile['created_date'])); ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary">
                                                                        <?php echo $this->lang->line("dropdown"); ?>
                                                                    </button>
                                                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a href="<?php echo site_url(); ?>/profile/viewprofile/<?php echo $profile['profile_id']; ?>">
                                                                                <i class="fa fa-eye"></i> View Profile
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo site_url(); ?>/profile/editprofile/<?php echo $profile['profile_id']; ?>">
                                                                                <i class="fa fa-edit"></i> Edit Profile
                                                                            </a>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="8" class="text-center">
                                                            <div class="alert alert-info">
                                                                <i class="fa fa-info-circle"></i> No profiles found. 
                                                                <a href="<?php echo site_url(); ?>/profile/addprofile">Add your first profile</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end widget content -->
                                </div>
                                <!-- end widget div -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Initialize DataTable
    $('#datatable_fixed_column').DataTable({
        "responsive": true,
        "language": {
            "search": "Search profiles:",
            "lengthMenu": "Show _MENU_ profiles per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ profiles",
            "infoEmpty": "Showing 0 to 0 of 0 profiles",
            "infoFiltered": "(filtered from _MAX_ total profiles)"
        }
    });
});
</script>

<?php $this->load->view("common/footer"); ?> 