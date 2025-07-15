<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li><a href="<?php echo site_url(); ?>/profile">All Profiles</a></li>
            <li>View Profile</li>
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
                                    <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                                    <h2>View Company Profile</h2>
                                    <div class="widget-toolbar">
                                        <a href="<?php echo site_url(); ?>/profile/editprofile/<?php echo $profile_detail['profile_id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit Profile
                                        </a>
                                        <a href="<?php echo site_url(); ?>/profile" class="btn btn-default btn-sm">
                                            <i class="fa fa-arrow-left"></i> Back to Profiles
                                        </a>
                                    </div>
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <?php if(isset($profile_detail) && !empty($profile_detail)): ?>
                                            <div class="row">
                                                <!-- Profile Information -->
                                                <div class="col-md-8">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4><i class="fa fa-building"></i> Company Information</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Shop/Company Name:</strong></label>
                                                                        <p class="form-control-static"><?php echo $profile_detail['shop_name']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Contact Person:</strong></label>
                                                                        <p class="form-control-static"><?php echo $profile_detail['name']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Email Address:</strong></label>
                                                                        <p class="form-control-static">
                                                                            <a href="mailto:<?php echo $profile_detail['email']; ?>">
                                                                                <i class="fa fa-envelope"></i> <?php echo $profile_detail['email']; ?>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Phone Number:</strong></label>
                                                                        <p class="form-control-static">
                                                                            <a href="tel:<?php echo $profile_detail['phone']; ?>">
                                                                                <i class="fa fa-phone"></i> <?php echo $profile_detail['phone']; ?>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Address:</strong></label>
                                                                        <p class="form-control-static">
                                                                            <i class="fa fa-map-marker"></i> <?php echo $profile_detail['adress']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Logo Section -->
                                                <div class="col-md-4">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4><i class="fa fa-image"></i> Company Logo</h4>
                                                        </div>
                                                        <div class="panel-body text-center">
                                                            <?php if(isset($profile_detail['logo']) && $profile_detail['logo'] != ''): ?>
                                                                <div class="logo-container">
                                                                    <img src="<?php echo base_url(); ?>images/<?php echo $profile_detail['logo']; ?>" 
                                                                         alt="Company Logo" class="img-responsive" style="max-width: 100%; max-height: 200px;">
                                                                </div>
                                                                <div class="logo-info" style="margin-top: 15px;">
                                                                    <small class="text-muted">
                                                                        <strong>File:</strong> <?php echo $profile_detail['logo']; ?>
                                                                    </small>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="no-logo">
                                                                    <i class="fa fa-image fa-4x text-muted"></i>
                                                                    <p class="text-muted">No logo uploaded</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Additional Information -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4><i class="fa fa-info-circle"></i> Additional Information</h4>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Profile ID:</strong></label>
                                                                        <p class="form-control-static"><?php echo $profile_detail['profile_id']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Created Date:</strong></label>
                                                                        <p class="form-control-static">
                                                                            <i class="fa fa-calendar"></i> 
                                                                            <?php echo date('F j, Y \a\t g:i A', strtotime($profile_detail['created_date'])); ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="info-group">
                                                                        <label class="control-label"><strong>Last Modified:</strong></label>
                                                                        <p class="form-control-static">
                                                                            <i class="fa fa-clock-o"></i> 
                                                                            <?php echo date('F j, Y \a\t g:i A', strtotime($profile_detail['modified_date'])); ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <div class="btn-group" style="margin-top: 20px;">
                                                        <a href="<?php echo site_url(); ?>/profile/editprofile/<?php echo $profile_detail['profile_id']; ?>" class="btn btn-primary">
                                                            <i class="fa fa-edit"></i> Edit Profile
                                                        </a>
                                                        <a href="<?php echo site_url(); ?>/profile" class="btn btn-default">
                                                            <i class="fa fa-arrow-left"></i> Back to Profiles
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-danger">
                                                <i class="fa fa-exclamation-triangle"></i> Profile not found or invalid profile ID.
                                            </div>
                                            <a href="<?php echo site_url(); ?>/profile" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Back to Profiles
                                            </a>
                                        <?php endif; ?>
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

<style>
.info-group {
    margin-bottom: 20px;
}

.info-group label {
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.info-group p {
    font-size: 14px;
    margin-bottom: 0;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.logo-container {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.no-logo {
    padding: 30px;
    color: #999;
}

.logo-info {
    font-size: 11px;
}

.btn-group .btn {
    margin: 0 5px;
}

@media (max-width: 768px) {
    .btn-group .btn {
        margin: 5px;
        display: block;
        width: 100%;
    }
}
</style>

<?php $this->load->view("common/footer"); ?> 