<?php $this->load->view("common/header"); ?>
<?php
if ($form_type == "survey") {
    $firstname = "";
    $lastname = "";
    $emails = "";
    $phones = "";
} else {
    $firstname = $user_detail["name"];
    $lastname = $user_detail["name"];
    $emails = $user_detail["email"];
    $phones = $user_detail["phone"];
}
?>
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
    <?php
    if ($assign_detail["form_language"] == "arabic") {
        $first_name = "الاسم الاول";
        $last_name = "الاسم آخر";
        $email = "البريد الإلكتروني";
        $phone = "هاتف";
        $post_fix = "_ar";
    } else {
        $first_name = "First Name";
        $last_name = "Last Name";
        $email = "Email";
        $phone = "Phone";
        $post_fix = "";
    }
    ?>
    <?php if ($assign_detail["form_language"] == "arabic") { ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/arabic_div.css">
    <?php } ?>
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="" style="<?php if ($department["form_language"] == "arabic") { ?>direction: rtl;<?php } ?>">
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
                    <form  id="survey_form" class="" method="post" onsubmit="return survey_validation.init();">
                        <div id="wizard" class="arabicright">
                            <?php if (sizeof($department["form_questions"]) > 0) { ?>
                                <?php $counter = 1; ?>
                                <?php foreach ($department["form_questions"] as $value) { ?>
                                    <h2><?php echo $value["form_title"]["title" . $post_fix]; ?></h2>
                                    <fieldset>
                                        <?php if ($counter == "1") { ?>
                                            <div class="row  padding-12 " >
                                                <div class="col-md-6">
                                                    <label class="control-label" for="fname"><?php echo $first_name; ?></label>
                                                    <input value="<?php echo $firstname; ?>" class="form-control" name="fname" id="fname" placeholder="<?php echo $first_name; ?>" type="text">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label" for="lname"><?php echo $last_name; ?></label>
                                                    <input value="<?php echo $lastname; ?>" class="form-control" name="lname" id="lname" placeholder="<?php echo $last_name; ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row padding-12 ">
                                                <div class="col-md-6">
                                                    <label class="control-label" for="email"><?php echo $email; ?></label>
                                                    <input value="<?php echo $emails; ?>" class="form-control" name="email" id="email" placeholder="<?php echo $email; ?>" type="text">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label" for="phone"><?php echo $phone; ?></label>
                                                    <input value="<?php echo $phones; ?>" class="form-control" name="phone" id="phone" placeholder="<?php echo $phone; ?>" type="text">
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (sizeof($value["statements"]) > 0) { ?>
                                            <?php foreach ($value["statements"] as $value2) { ?>
                                                <input type="hidden" name="questions[]" value="<?php echo $value2["questions_id"]; ?>"/>
                                                <div class="row form-group padding-10">
                                                    <div class="col-md-12">
                                                        <h6 style="font-size: 14px;font-weight: bold;margin-bottom: 10px;"><?php echo $counter++; ?>-&nbsp;<?php echo $value2["question_statement" . $post_fix]; ?></h6>
                                                        <?php if ($value2["question_type"] == "radio") { ?>
                                                            <?php if (sizeof($value2["options"]) > 0) { ?>
                                                                <?php $cnt = 1; ?>
                                                                <div class="inline-group" id="radio_<?php echo $value2["questions_id"]; ?>">
                                                                    <?php foreach ($value2["options"] as $vl) { ?>
                                                                        <label class="radio-inline" >
                                                                            <input qid="<?php echo $value2["questions_id"]; ?>"  class="radiobtn" required="" <?php if ($cnt == 1) { ?><?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $value2["questions_id"]; ?>" /><?php echo $vl["op_txt" . $post_fix]; ?>    
                                                                        </label>
                                                                        <?php $cnt++; ?>
                                                                    <?php } ?>
                                                                    <?php if (trim($value2["is_notes"]) == "yes") { ?>
                                                                        <label class="textarea"  style="width: 100%;">
                                                                            <div>
                                                                                <textarea style="width: 100%;" class="form-control" name="<?php echo $value2["questions_id"]; ?>_notes">none</textarea>
                                                                            </div>
                                                                            <i></i>
                                                                        </label>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="col-md-12" id="text_<?php echo $value2["questions_id"]; ?>">
                                                                <textarea style="height: 100px;" class="form-control" name="<?php echo $value2["questions_id"]; ?>"></textarea>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if (sizeof($value["child_section"]) > 0) { ?>
                                            <?php foreach ($value["child_section"] as $til) { ?>
                                                <div class="alert alert-warning alert-block col-md-12 padding-left-0" style="margin-bottom: 0px;">
                                                    <h6 class="alert-heading" style="text-align: center;"><?php echo $til["title" . $post_fix]; ?></h6>
                                                </div>
                                                <?php if (sizeof($til["statements"]) > 0) { ?>
                                                    <?php foreach ($til["statements"] as $stat) { ?>
                                                        <input type="hidden" name="questions[]" value="<?php echo $stat["questions_id"]; ?>"/>
                                                        <div class="row form-group padding-10">
                                                            <div class="col-md-12">
                                                                <h6 style="font-size: 14px;font-weight: bold;margin-bottom: 10px;"><?php echo $counter++; ?>-&nbsp;<?php echo $stat["question_statement" . $post_fix]; ?></h6>
                                                                <?php if ($stat["question_type"] == "radio") { ?>
                                                                    <?php if (sizeof($stat["options"]) > 0) { ?>
                                                                        <?php $cnt2 = 1; ?>
                                                                        <div class="inline-group"  id="radio_<?php echo $stat["questions_id"]; ?>">
                                                                            <?php foreach ($stat["options"] as $vl) { ?>
                                                                                <label class="radio-inline">
                                                                                    <input  qid="<?php echo $stat["questions_id"]; ?>"  class="radiobtn" required="" <?php if ($cnt2 == 1) { ?><?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $stat["questions_id"]; ?>" /><?php echo $vl["op_txt" . $post_fix]; ?>    
                                                                                </label>
                                                                                <?php $cnt2++; ?>
                                                                            <?php } ?>
                                                                            <?php if (trim($stat["is_notes"]) == "yes") { ?>
                                                                                <label class="textarea"  style="width: 100%;">
                                                                                    <div>
                                                                                        <textarea  class="form-control" style="width: 100%;" name="<?php echo $stat["questions_id"]; ?>_notes">none</textarea>
                                                                                    </div>
                                                                                    <i></i>
                                                                                </label>
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    <div id="text_<?php echo $stat["questions_id"]; ?>">
                                                                        <textarea style="height: 100px;" class="form-control" class="form-control" name="<?php echo $stat["questions_id"]; ?>"></textarea>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </fieldset>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <input type="hidden" value="sbmt" name="sbmt"/>
                        <input type="hidden" id="start_time" name="start_time"/>
                        <input type="hidden" id="form_type" name="form_type" value="<?php echo $assign_detail["form_type"]; ?>"/>
                        <input type="hidden" id="category" name="category" value="<?php echo $assign_detail["category"]; ?>"/>
                        <input type="hidden" id="department_id" name="department_id" value="<?php echo $assign_detail["department_id"]; ?>"/>
                        <input type="hidden" id="project_id" name="project_id" value="<?php echo $assign_detail["project_id"]; ?>"/>
                        <input type="hidden" id="master_plan_id" name="master_plan_id" value="<?php echo $assign_detail["master_plan_id"]; ?>"/>
                        <input type="hidden" id="dep_entity_id" name="dep_entity_id" value="<?php echo $assign_detail["dep_ent"]; ?>"/>
                        <input type="hidden" id="order_id" name="order_id" value="<?php echo $assign_detail["order_id"]; ?>"/>
                        <input type="hidden" id="branch_id" name="branch_id" value="<?php echo $assign_detail["branch_id"]; ?>"/>
                        <input type="hidden" id="assign_id_fk" name="assign_id_fk" value="<?php echo $assign_detail["form_assign_id"]; ?>"/>


                        <input type="hidden" value="<?php echo $form_id; ?>" name="form_id"/>
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
<?php if ($assign_detail["form_language"] == "arabic") { ?>
    <style type="text/css">
        .wizard > .steps > ul > li, .wizard > .actions > ul > li{
            float: right;
        }
        .arabicright{
            text-align: right;
            float: right;
            direction: rtl;
        }
        .checkbox-inline + .checkbox-inline, .radio-inline + .radio-inline{
            margin-right: 10px;
        }
        .checkbox-inline, .radio-inline{
            padding-right: 20px;
        }
        .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"]{
            margin-right: -20px;
        }
        .wizard > .actions > ul{
            float: left;
        }
    </style>    
<?php } ?>
<script type="text/javascript">
    survey_steps.init();
    $(function () {

        var docHeight = $(document).height();

        $(".well").append("<div id='overlay'><a onclick='survey_steps.removeoverlay()' class='btn btn-primary btn-group-lg' style='opacity:1;z-index:9999; position:relative; margin: -20px -50px; top:30%; left:50%;'>Start Survey</a></div>");

        $("#overlay")
                .height(docHeight)
                .css({
                    'opacity': 0.6,
                    'position': 'absolute',
                    'top': 0,
                    'left': 0,
                    'background-color': 'black',
                    'width': '100%',
                    'z-index': 5000
                });

    });
</script>
<?php $this->load->view("common/footer"); ?>