<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>Home</li><li>Change Password</li>
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
                            <form method="post" action="<?php echo site_url(); ?>/users/changepassword" id="changepassword" class="smart-form client-form">
                                <header>
                                    Change Password
                                </header>
                                <fieldset>
                                    <?php if ($update == "yes") { ?>
                                        <?php if ($error == "yes") { ?>
                                            <div class="alert alert-danger fade in">
                                                <button class="close" data-dismiss="alert">
                                                    ×
                                                </button>
                                                <i class="fa-fw fa fa-times"></i>
                                                <strong>Error!</strong> <?php echo $msg; ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-success fade in">
                                                <button class="close" data-dismiss="alert">
                                                    ×
                                                </button>
                                                <i class="fa-fw fa fa-check"></i>
                                                <strong>Success</strong> <?php echo $msg; ?>
                                            </div>
                                        <?php } ?>

                                    <?php } ?>
                                    <section>
                                        <label class="label">Enter your old password</label>
                                        <label class="input"> <i class="icon-append fa fa-key"></i>
                                            <input name="oldpassword" type="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter your old password</b>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Enter your new password</label>
                                        <label class="input"> <i class="icon-append fa fa-key"></i>
                                            <input name="newpassword" type="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter your new password</b>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Confirm password</label>
                                        <label class="input"> <i class="icon-append fa fa-key"></i>
                                            <input name="confirmpassword" type="password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Enter confirm password</b> 
                                        </label>
                                    </section>
                                </fieldset>
                                <footer>
                                     <input type="hidden" value="sbmt" name="sbmt"/>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-refresh"></i> Change Password
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>
<?php $this->load->view("common/footer"); ?>