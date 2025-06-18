<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line("home"); ?></a></li><li><a href="<?php echo site_url(); ?>/users"><?php echo $this->lang->line("all_users"); ?></a></li><li><?php echo $this->lang->line("create_new"); ?></li>
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
                        <div class="well">
                            <div class="widget-body">
                                <form id="adduser-form" method="post" action="<?php echo site_url(); ?>/users/adduser/" class="" enctype="multipart/form-data">
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
                                        <legend>
                                            <?php echo $this->lang->line("create_new"); ?>
                                        </legend>
                                        <div class="form-group">
                                            <label> <?php echo $this->lang->line("name"); ?></label>
                                            <input name="name" id="name" class="form-control" type="text" value="<?php
                                            if (isset($_POST["name"])) {
                                                echo $_POST["name"];
                                            }
                                            ?>">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label> <?php echo $this->lang->line("UserName"); ?> </label>
                                            <input name="username" id="username" class="form-control" type="text" value="<?php
                                            if (isset($_POST["username"])) {
                                                echo $_POST["username"];
                                            }
                                            ?>"/>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("email"); ?></label>
                                            <input name="email" id="email" class="form-control" type="email" value="<?php
                                            if (isset($_POST["email"])) {
                                                echo $_POST["email"];
                                            }
                                            ?>"/>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("password"); ?></label>
                                            <input type="password" class="form-control" name="password" />
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("phone"); ?></label>
                                            <input name="phone" id="phone" class="form-control" type="text" value="<?php
                                            if (isset($_POST["phone"])) {
                                                echo $_POST["phone"];
                                            }
                                            ?>"/>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("Gender"); 
                                            $genders = getGenders();
                                            ?></label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="0"><?php echo $this->lang->line("ChooseGender"); ?></option>
                                                <?php if ($genders) { ?>
                                                    <?php foreach ($genders as $value) { ?>
                                                        <option value="<?php echo $value["gender_id"]; ?>"><?php echo $value["gender_title"]; ?></option>
                                                    <?php } ?>]   
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </fieldset>
                                    <section>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("Designation"); ?></label>
                                            <input name="designation" class="form-control input" id="designation" type="text" value="<?php
                                            if (isset($_POST["designation"])) {
                                                echo $_POST["designation"];
                                            }
                                            ?>">
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("EmergencyNumber"); ?></label>
                                            <input name="emergency_number" id="emergency_number" class="form-control" type="text" value="<?php
                                            if (isset($_POST["emergency_number"])) {
                                                echo $_POST["emergency_number"];
                                            }
                                            ?>">
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("PassportNumber"); ?></label>                                       
                                            <input name="passport_no" id="passport_no" class="form-control" type="text" value="<?php
                                            if (isset($_POST["passport_no"])) {
                                                echo $_POST["passport_no"];
                                            }
                                            ?>">
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("BloodGroup"); ?> </label>
                                            <input name="blood_group" id="blood_group" class="form-control" type="text" value="<?php
                                            if (isset($_POST["blood_group"])) {
                                                echo $_POST["blood_group"];
                                            }
                                            ?>">
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("Image"); ?> </label>
                                            <input name="user_image" class="form-control" id="user_image" type="file" value="">  
                                        </div>   
                                    </section>
                                    <div class="form-group">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" value="sbmt" name="sbmt"/>
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="fa fa-eye"></i>
                                                        <?php echo $this->lang->line("Submit"); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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