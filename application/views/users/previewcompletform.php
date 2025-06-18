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
    $total = $this->utils->getHowManyTimeAssessed($form_id,$assign_id);
    ?>
    <?php if ($assign_detail["form_language"] == "arabic") { ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/arabic_div.css">
    <?php } ?>
    <div id="content">
        <header style="margin-top: 0px;padding-top: 0px;margin-bottom: 30px;">
            <?php $remaining = 0; ?>
            <div style="text-align: center;width: 100%;">
                <h2>
                    <?php echo $department["form_title"]; ?> 
                </h2>
            </div>
            <div style="text-align: center;width: 100%;">
                <h6 style="font-weight: normal;">
                    (Start Time: <?php echo date('G:ia', $total[0]['start_time']); ?> -  End Time: <?php echo date('G:ia', $total[0]['end_time']); ?>)
                </h6>
            </div>
        </header>
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
                    <!--                    <div class="col-md-12 padding-left-0">
                                            <h2 class="margin-top-0"  style="text-align: center;">
                    <?php //echo $department["form_title"]; ?>
                                                <br>
                                            </h2>
                                            <p>
                    <?php //echo $department["form_desc"]; ?>
                                            </p>
                                        </div>-->
                    <div class="clearfix"></div>
                    <!--<form  id="survey_form" class="" method="post" onsubmit="return survey_validation.init();">-->
                    <div id="wizard" class="arabicright">
                        <?php
//                        echo "<pre>";
//                        print_r($department["form_questions"]);
//                        echo "</pre>";
                        if (sizeof($department["form_questions"]) > 0) {
                            ?>
                            <?php $counter = 1; ?>
                            <?php foreach ($department["form_questions"] as $value) { ?>
                                <h2 id="<?php echo $value["form_title"]["group_titles_id"]; ?>"><?php echo $value["form_title"]["title" . $post_fix]; ?>
                                    &nbsp;&nbsp;<i onclick="uploadattachments.getAttachments($(this), '<?php echo $value["form_title"]["group_titles_id"]; ?>', '<?php echo $value["form_title"]["title" . $post_fix]; ?>');" class="fa fa-clipboard" style="cursor: pointer;font-size: 15px;color: #000;"></i>
                                </h2>
                                <fieldset>
                                    <?php if ($counter == "1") { ?>

                                    <?php } ?>
                                    <?php if (sizeof($value["statements"]) > 0) { ?>
                                        <?php foreach ($value["statements"] as $value2) { ?>
                                            <input type="hidden" name="questions[]" value="<?php echo $value2["questions_id"]; ?>"/>
                                            <div class="row form-group padding-10">
                                                <div class="col-md-12">
                                                    <h6 style="font-size: 14px;font-weight: bold;margin-bottom: 10px;"><?php echo $counter++; ?>-&nbsp;<?php echo $value2["question_statement" . $post_fix]; ?></h6>
                                                    <?php if ($value2["question_type"] == "radio") { ?>
                                                        <?php $selected_answer = $this->utils->getAnswerInDetailNew($total[0]['answers_id'], $value2["questions_id"]); ?>
                                                        <?php if (sizeof($value2["options"]) > 0) { ?>
                                                            <?php $cnt = 1; ?>
                                                            <div class="inline-group" id="radio_<?php echo $value2["questions_id"]; ?>">
                                                                <?php foreach ($value2["options"] as $vl) { ?>
                                                                    <label class="radio-inline" >
                                                                        <input disabled=""  <?php if ($selected_answer['selected_answer'] == $vl["op_val"]) { ?>checked=""<?php } ?> qid="<?php echo $value2["questions_id"]; ?>"  class="radiobtn" required="" <?php if ($cnt == 1) { ?><?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $value2["questions_id"]; ?>" /><?php echo $vl["op_txt" . $post_fix]; ?>    
                                                                    </label>
                                                                    <?php $cnt++; ?>
                                                                <?php } ?>
                                                                <?php if (trim($value2["is_notes"]) == "yes") { ?>
                                                                    <label class="textarea"  style="width: 100%;">
                                                                        <div>
                                                                            <textarea disabled=""  style="width: 100%;" class="form-control" name="<?php echo $value2["questions_id"]; ?>_notes"><?php echo $selected_answer['notes']; ?></textarea>
                                                                        </div>
                                                                        <i></i>
                                                                    </label>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php $selected_answer = $this->utils->getAnswerInDetailNew($total[0]['answers_id'], $value2["questions_id"]); ?>
                                                        <div class="col-md-12" id="text_<?php echo $value2["questions_id"]; ?>">
                                                            <textarea  id="<?php echo $selected_answer["answer_data_id"];?>"  style="height: 100px;" class="form-control updatetext" name="<?php echo $value2["questions_id"]; ?>"><?php echo $selected_answer['selected_answer']; ?></textarea>
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
                                                                <?php $selected_answer = $this->utils->getAnswerInDetailNew($total[0]['answers_id'], $stat["questions_id"]); ?>
                                                                <?php if (sizeof($stat["options"]) > 0) { ?>
                                                                    <?php $cnt2 = 1; ?>
                                                                    <div class="inline-group"  id="radio_<?php echo $stat["questions_id"]; ?>">
                                                                        <?php foreach ($stat["options"] as $vl) { ?>
                                                                            <label class="radio-inline">
                                                                                <input disabled="" <?php if ($selected_answer['selected_answer'] == $vl["op_val"]) { ?>checked=""<?php } ?>  qid="<?php echo $stat["questions_id"]; ?>"  class="radiobtn" required="" <?php if ($cnt2 == 1) { ?><?php } ?>  type="radio" value="<?php echo $vl["op_val"]; ?>" name="<?php echo $stat["questions_id"]; ?>" /><?php echo $vl["op_txt" . $post_fix]; ?>    
                                                                            </label>
                                                                            <?php $cnt2++; ?>
                                                                        <?php } ?>
                                                                        <?php if (trim($stat["is_notes"]) == "yes") { ?>
                                                                            <label class="textarea"  style="width: 100%;">
                                                                                <div>
                                                                                    <textarea  disabled=""  class="form-control" style="width: 100%;" name="<?php echo $stat["questions_id"]; ?>_notes"><?php echo $selected_answer['notes'] ?></textarea>
                                                                                </div>
                                                                                <i></i>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <?php $selected_answer = $this->utils->getAnswerInDetailNew($total[0]['answers_id'], $stat["questions_id"]); ?>
                                                                <div id="text_<?php echo $stat["questions_id"]; ?>">
                                                                    <textarea  id="<?php echo $selected_answer["answer_data_id"];?>"  style="height: 100px;" class="form-control updatetext" class="form-control" name="<?php echo $stat["questions_id"]; ?>"><?php echo $selected_answer['selected_answer']; ?></textarea>
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
                    <!--</form>-->
                </div>
            </div>
        </section>
        <!--end widget grid -->
    </div>
    <!--END MAIN CONTENT -->
</div>
<div  class="modal" id="attachments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px;max-width: 100%;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span id="mainheading"></span></h4>
            </div>
            <div class="modal-body" id='attachments_body' style="padding-top: 0px;"></div>
            <form class="smart-form"  id="user_location" method="post" onsubmit="return false;">
                <fieldset>
                    <section>
                        <label class="label">Attachment</label>
                        <div class="input input-file">
                            <span class="button">
                                <input id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value" type="file"/>Browse
                            </span>
                            <input placeholder="attach some files" readonly="" type="text"/>
                        </div>
                    </section>
                    <section>
                        <label class="label">Notes</label>
                        <label class="textarea"> 										
                            <textarea name="notes" id="notes" rows="3" class="custom-scroll"></textarea> 
                        </label>
                    </section>
                </fieldset>
                <input type="hidden" id="form_assign_id_popup" name="form_assign_id_popup" value="<?php echo $assign_detail["form_assign_id"]; ?>" />
                <input type="hidden" id="form_id_popup" name="form_id_popup" value="<?php echo $form_id; ?>" />
                <input type="hidden" id="section_id_popup" name="section_id_popup" value="" />
                <footer>
                    <button type="submit" class="btn btn-primary" onclick="uploadattachments.doupload($(this))">
                        Save
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </footer>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
</script>
<?php $this->load->view("common/footer"); ?>