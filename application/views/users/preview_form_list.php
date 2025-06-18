<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li><li><a href="<?php echo site_url(); ?>/users/allassignform">All Assign Survey Form</a></li><li>Preview Survey Questions</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <fieldset>
                <?php
                if (isset($update)) {
                    if ($update == 'yes') {
                        ?>
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

                        <?php
                    }
                }
                ?>
            </fieldset>
            <!-- row -->
            <div class="row">
                <div class="well ">
                    <div class="col-md-12 padding-left-0">
                        <h2 class="margin-top-0"  style="text-align: center;">
                            <?php echo $department["form_title"]; ?>
                            <br>
                        </h2>
                        <p>
                            <?php echo $department["form_desc"]; ?>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <form class="smart-form" method="post" onsubmit="return survey_validation.init();">
                        <fieldset>

                            <div class="row">
                                <section class="col col-6">
                                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                        <input name="fname" id="fname" placeholder="First name" type="text">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                        <input name="lname" id="lname" placeholder="Last name" type="text">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                                        <input name="email" id="email" placeholder="E-mail" type="email">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                        <input name="phone" id="phone" placeholder="Phone" data-mask="(999) 999-9999" type="tel">
                                    </label>
                                </section>
                            </div>
                        </fieldset>
                        <div class="clearfix"></div>
                        <?php if (sizeof($department["form_questions"]) > 0) { ?>
                            <?php $counter = 1; ?>
                            <?php foreach ($department["form_questions"] as $value) { ?>
                                <table class="table table-striped table-forum" style="margin-bottom: 0px;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <div class="alert alert-info alert-block col-md-12 padding-left-0"  style="margin-bottom: 0px;">
                                                    <h3 class="alert-heading" style="text-align: center;"><?php echo $value["form_title"]; ?></h3>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if (sizeof($value["statements"]) > 0) { ?>
                                    <?php foreach ($value["statements"] as $value2) { ?>
                                        <input type="hidden" name="questions[]" value="<?php echo $value2["questions_id"]; ?>"/>
                                        <fieldset>
                                            <section>
                                                <label class="label" style="margin-bottom: 25px;"><h4 style="font-size: 14px;font-weight: bold;"><?php echo $counter++; ?>-&nbsp;<?php echo $value2["question_statement"]; ?></h4></label>
                                                <?php if ($value2["question_type"] == "radio") { ?>
                                                    <?php if (sizeof($value2["options"]) > 0) { ?>
                                                        <?php $cnt = 1; ?>
                                                        <div class="inline-group">
                                                            <?php foreach ($value2["options"] as $vl) { ?>
                                                                <label class="radio">
                                                                    <input <?php if ($cnt == 1) { ?>checked=""<?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $value2["questions_id"]; ?>" /><?php echo $vl["op_txt"]; ?>    
                                                                    <i></i>
                                                                </label>
                                                                <?php $cnt++; ?>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div>
                                                        <textarea style="height: 100px;" class="form-control" name="<?php echo $value2["questions_id"]; ?>"></textarea>
                                                    </div>
                                                <?php } ?>
                                            </section>
                                        </fieldset>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (sizeof($value["child_section"]) > 0) { ?>
                                    <?php foreach ($value["child_section"] as $til) { ?>
                                        <fieldset>
                                            <section>
                                                <div class="alert alert-warning alert-block col-md-12 padding-left-0" style="margin-bottom: 0px;">
                                                    <h6 class="alert-heading" style="text-align: center;"><?php echo $til["title"]; ?></h6>
                                                </div>
                                            </section>
                                        </fieldset>
                                        <?php if (sizeof($til["statements"]) > 0) { ?>
                                            <?php foreach ($til["statements"] as $stat) { ?>
                                                <input type="hidden" name="questions[]" value="<?php echo $stat["questions_id"]; ?>"/>
                                                <fieldset>
                                                    <section>
                                                        <label class="label" style="margin-bottom: 25px;"><h4 style="font-size: 14px;font-weight: bold;"><?php echo $counter++; ?>-&nbsp;<?php echo $stat["question_statement"]; ?></h4></label>
                                                        <?php if ($stat["question_type"] == "radio") { ?>
                                                            <?php if (sizeof($stat["options"]) > 0) { ?>
                                                                <?php $cnt2 = 1; ?>
                                                                <div class="inline-group">
                                                                    <?php foreach ($stat["options"] as $vl) { ?>
                                                                        <label class="radio">
                                                                            <input <?php if ($cnt2 == 1) { ?>checked=""<?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $stat["questions_id"]; ?>" /><?php echo $vl["op_txt"]; ?>    
                                                                            <i></i>
                                                                        </label>
                                                                        <?php $cnt2++; ?>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div>
                                                                <textarea style="height: 100px;" class="form-control" name="<?php echo $stat["questions_id"]; ?>"></textarea>
                                                            </div>
                                                        <?php } ?>
                                                    </section>
                                                </fieldset>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>

                            <?php } ?>
                        <?php } ?>
                        <footer>
                            <input type="hidden" value="sbmt" name="sbmt"/>
                            <input type="hidden" value="<?php echo $form_id; ?>" name="form_id"/>
                            <button type="submit" class="btn btn-primary" >
                                <i class="fa fa-refresh"></i> Submit
                            </button>
                        </footer>
                    </form>
                </div>
            </div>
        </section>
        <!--end widget grid -->
    </div>
    <!--END MAIN CONTENT -->
</div>
<style type="text/css">
    .smart-form section {
        margin-bottom: 10px;
        margin-top: 10px;
        position: relative;
    }
    .smart-form fieldset{
        padding-top: 0px;
    }
</style>
<?php $this->load->view("common/footer"); ?>