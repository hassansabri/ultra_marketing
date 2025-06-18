<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line("home"); ?></a></li><li><a href="<?php echo site_url(); ?>/users"><?php echo $this->lang->line("all_users"); ?></a></li><li><?php echo $this->lang->line("AccessRights"); ?></li>
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
                            <form method="post" action="" id="changepassword" class="smart-form client-form">
                                <header>
                                    <?php echo $this->lang->line("AccessRights"); ?>
                                </header>
                                <fieldset>
                                    <?php if ($update == "yes") { ?>
                                        <div class="alert alert-success fade in">
                                            <button class="close" data-dismiss="alert">
                                                ×
                                            </button>
                                            <i class="fa-fw fa fa-check"></i>
                                            <strong>Success</strong> Permissions Updated Successfully.
                                        </div>
                                    <?php } ?>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("name"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input name="name" id="name" type="text" value="<?php echo $user_detail["name"] ?>" readonly disabled/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("UserName"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input name="username" id="username" type="text" value="<?php echo $user_detail["user_name"] ?>" readonly disabled/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("email"); ?></label>
                                        <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                            <input name="email" id="email" type="email" value="<?php echo $user_detail["email"] ?>"  readonly disabled/>
                                        </label>
                                    </section>


                                    <section>
                                        <label class=""><?php echo $this->lang->line("phone"); ?></label>
                                        <label class="input" > <i class="icon-append fa fa-phone"></i>
                                            <input name="phone" id="phone" type="text" value="<?php echo $user_detail["phone"] ?>" readonly disabled/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class=""><?php echo $this->lang->line("AccessRights"); ?> </label>
                                        <br/>
                                        <br/>
                                        <div class="row">
                                            <?php
                                            $counter = "1";
                                            foreach ($user_types as $value) {
                                                ?>
                                                <?php if ($counter == "1") { ?>
                                                    <div class="col col-4">
                                                    <?php } ?>
                                                    <label class="checkbox">
                                                        <input <?php if (in_array($value['users_types_id'], $current_user_types)) { ?> checked="checked" <?php } ?> class="permissions" id='<?php echo $user_detail["users_id"] ?>'   type="checkbox" value="<?php echo $value['users_types_id']; ?>">
                                                        <i></i><?php echo $value['type_title']; ?>
                                                    </label>
                                                    <?php
                                                    $counter++;
                                                    if ($counter == "4") {
                                                        $counter = "1";
                                                        echo '</div>';
                                                    }
                                                }
                                                if ($counter != '1') {
                                                    echo '</div>';
                                                }
                                                ?>

                                            </div>
                                    </section>
                                </fieldset>
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
<script type="text/javascript">
    user.changepermissions();
</script>
<?php $this->load->view("common/footer"); ?>