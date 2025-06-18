<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line("home"); ?></a>
            </li>
            <li><a href="<?php echo site_url(); ?>/users"><?php echo $this->lang->line("all_users"); ?></a>
            </li>
            <li><?php echo $this->lang->line("edit_profile"); ?></li>
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
                            <form method="post" action="<?php echo site_url(); ?>/users/editprofileuser/<?php echo $users_id; ?>" id="changepassword" class="smart-form client-form" enctype="multipart/form-data">
                                <header> <?php echo $this->lang->line("edit_profile"); ?> </header>
                                <fieldset>
                                    <?php if ($update == "yes") { ?>
                                        <div class="alert alert-success fade in">
                                            <button class="close" data-dismiss="alert"> × </button> <i class="fa-fw fa fa-check"></i> <strong>Success</strong> Profile Updated Successfully. </div>
                                    <?php } ?>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("name"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input name="name" id="name" type="text" value="<?php echo $user_detail["name"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("UserName"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input name="username" id="username" type="text" value="<?php echo $user_detail["user_name"] ?>" readonly disabled> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("email"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input name="email" id="email" type="email" value="<?php echo $user_detail["email"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("password"); ?> (Note: Leave blank if you don't want to change your password)</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input name="password" id="password" type="password" value=""> </label>
                                    </section>
                                    <section>
                                        <section>
                                            <label class=""><?php 
                                            $genders = getGenders();
                                      //      print_r($genders);
                                            echo $this->lang->line("Gender"); ?></label>
                                            <label class="select">
                                                <select class="input-sm" name="gender" id="gender">
                                                <option value="">Select Gender</option>
                                                <?php if ($genders) { ?>
                                                    <?php foreach ($genders as $value) { ?>
                                                        <option <?php if ($user_detail["gender"] == $value["gender_id"]) { ?>selected="selected"<?php  } ?> value="<?php echo $value["gender_id"]; ?>"><?php echo $value["gender_title"]; ?></option>
                                                    <?php } ?>]   
                                                <?php } ?>   
                                            </select> 
                                                <i></i> 
                                            </label>
                                        </section>
                                    </section>
                                    <section>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                            <label>select country</label>
                                            <select class="form-control" name="entity_id" id="entity_id">
                                                <option value="">Select Country</option>
                                                <?php if ($departments) { ?>
                                                    <?php foreach ($departments as $value) { ?>
                                                        <option <?php if ($user_detail["entity_id"] == $value["department_id"]) { ?>selected="selected"<?php } ?> value="<?php echo $value["department_id"]; ?>"><?php echo $value["department_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                            <div class="col-md-6">
                                            <label>select city</label>
                                            <select class="form-control" name="entity_id" id="entity_id">
                                                <option value="">Select City</option>
                                                <?php if ($departments) { ?>
                                                    <?php foreach ($departments as $value) { ?>
                                                        <option <?php if ($user_detail["entity_id"] == $value["department_id"]) { ?>selected="selected"<?php } ?> value="<?php echo $value["department_id"]; ?>"><?php echo $value["department_name"]; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            </div>
                                         
                                        </div>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("phone"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input name="phone" id="phone" type="text" value="<?php echo $user_detail["phone"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("Designation"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input name="designation" id="designation" type="text" value="<?php echo $user_detail["designation"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("EmergencyNumber"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input name="emergency_number" id="emergency_number" type="text" value="<?php echo $user_detail["emergency_number"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("PassportNumber"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input name="passport_no" id="passport_no" type="text" value="<?php echo $user_detail["passport_no"] ?>"> </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("BloodGroup"); ?> </label>
                                        <label class="input"> <i class="icon-append fa fa-hospital-o"></i>
                                            <input name="blood_group" id="blood_group" type="text" value="<?php echo $user_detail["blood_group"] ?>"> </label>
                                    </section>
                                    <!-- <section>
                                        <label class="">Nationality</label>
                                        <label class="input"> <i class="icon-append fa fa-hospital-o"></i>
                                            <input name="nationality" id="nationality" type="text" value="<?php echo $user_detail["nationality"] ?>"> </label>
                                    </section> -->
                                    <?php if (isset($user_detail["user_image"]) && $user_detail["user_image"] != "") { ?>
                                        <section>
                                            <label class=""> <?php echo $this->lang->line("Image"); ?> </label>
                                            <label class="input"> <i class="icon-append fa fa-phone"></i> <img src="<?php echo base_url(); ?>script/timthumb.php?src=<?php echo base_url(); ?>images/user/<?php echo $user_detail["user_image"]; ?>&w=150&h=150&zc=20&q=1"/> </label>
                                        </section>
                                    <?php } ?>
                                    <section>
                                        <label class=""> <?php echo $this->lang->line("Image"); ?> </label>
                                        <label class="input"> <i class="icon-append fa fa-phone"></i>
                                            <input name="user_image" id="user_image" type="file" value="<?php echo $user_detail["user_image"] ?>"> </label>
                                    </section>
                               
                                        <div id="google_map" style="height: 500px;"></div>
                                    </section>
                                </fieldset>
                                <footer>
                                    <input type="hidden" value="sbmt" name="sbmt" />
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-refresh"></i><?php echo $this->lang->line("update"); ?> </button>
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