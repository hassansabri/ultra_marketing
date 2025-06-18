<?php $this->load->view("common/header"); ?>
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li><li><?php echo $this->lang->line("AllAssignedForms"); ?></li>
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
                                    <header>
                                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                        <h2><?php echo $this->lang->line("AllAssignedForms"); ?></h2>
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
                                            <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">

                                                <thead>
                                                    <tr>
                                                        <th colspan="12">
                                                            <select id="filtering" class="form-control">
                                                                <option value="all"><?php echo $this->lang->line("ShowAll"); ?></option>
                                                                <option value="Customers"><?php echo $this->lang->line("Customers"); ?></option>
                                                                <option value="Employees"><?php echo $this->lang->line("Employees"); ?></option>
                                                                <option value="Community"><?php echo $this->lang->line("Community"); ?></option>
                                                                <option value="Suppliers"><?php echo $this->lang->line("Suppliers"); ?></option>
                                                                <option value="Parteners"><?php echo $this->lang->line("Parteners"); ?></option>
                                                                <option value="FacetoFaceVisit"><?php echo $this->lang->line("FacetoFaceVisit"); ?></option>
                                                                <option value="Website"><?php echo $this->lang->line("Website"); ?></option>
                                                                <option value="TelephoneTransactions"><?php echo $this->lang->line("TelephoneTransactions"); ?></option>
                                                                <option value="MobileApplication"><?php echo $this->lang->line("MobileApplication"); ?></option>

                                                            </select>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo $this->lang->line("ID"); ?></th>
                                                        <th><?php echo $this->lang->line("Entity"); ?> / <?php echo $this->lang->line("Department"); ?></th>
                                                        <th><?php echo $this->lang->line("Branches"); ?></th>
                                                        <th><?php echo $this->lang->line("FormType"); ?> / <?php echo $this->lang->line("Category"); ?></th>
                                                        <th><?php echo $this->lang->line("TargetOrganization"); ?></th>
                                                        <th><?php echo $this->lang->line("TargetServices"); ?></th>
                                                        <th><?php echo $this->lang->line("TargetEmployee"); ?></th>
                                                        <th><?php echo $this->lang->line("SurveyDate"); ?></th>
                                                        <th><?php echo $this->lang->line("Quantity"); ?></th>
                                                        <!--<th>Done</th>-->
                                                        <th><?php echo $this->lang->line("Location"); ?></th>
                                                        <th><?php echo $this->lang->line("Attachment"); ?></th>
                                                        <th><?php echo $this->lang->line("options"); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (sizeof($allassign) > 0) {
                                                        ?>
                                                        <?php $count = 1; ?>
                                                        <?php foreach ($allassign as $value) { ?>
                                                            <?php
                                                            if ($value["form_type"] == "mystry_shopper") {
                                                                $quntity = '1';
                                                            } else {
                                                                $quntity = $value["quantity"];
                                                            }
                                                            $return = $this->utils->checkHowManyTimeAssignFormCompleted($value["form_assign_id"], $quntity);
                                                            ?>
                                                            <?php $n = str_replace(' ', '', $value["category"]) ?>
                                                            <tr class="hideall <?php echo $n; ?>">
                                                                <td><?php echo $count++; ?></td>
                                                                <td><?php echo $this->utils->getDepartmentName($value["department_id"]); ?> / <?php echo $this->utils->getDepEntityName($value["dep_ent"]); ?></td>
                                                                <td><?php echo $this->utils->getBranchName($value["branch_id"]); ?></td>
                                                                <td><?php echo $value["form_type"]; ?> / <?php echo $value["category"]; ?></td>
                                                                <td><?php echo $value["target_organization"]; ?></td>
                                                                <td><?php echo $value["target_services"]; ?></td>
                                                                <td><?php echo $value["target_employee"]; ?></td>
                                                                <td><?php echo date('d/M/Y', $value["start_date"]); ?></td>
                                                                <td><?php echo $value["quantity"]; ?></td>
                                                                <!--<td><?php echo $return["total_complete"]; ?></td>-->
                                                                <td><a onclick="survey_steps.checklocation($(this), '<?php echo $value['form_assign_id']; ?>');" href="javascript:;"><?php echo $value["real_location"]; ?></a></td>
                                                                <td> <?php if ($value['form_assign_id'] != "") { ?>
                                                                        <?php $attach = $this->utils->getAttachments($value['form_assign_id']) ?>
                                                                        <?php if (sizeof($attach) > 0) { ?>
                                                                            <a href="<?php echo base_url(); ?>attachments/assign/<?php echo $attach["attachment_random_name"]; ?>" target="_blank"><?php echo $attach["attachment_name"]; ?></a>
                                                                        <?php } else { ?>
                                                                           <?php echo $this->lang->line("NoAttachment"); ?>
                                                                        <?php } ?>
                                                                    <?php } ?></td>
                                                                <?php if ($return["success"] == "no") { ?>
                                                                    <td>
                                                                        <a class="btn btn-primary" onclick="user.getlocation($(this), '<?php echo $value['form_assign_id']; ?>')" href="javascript:;"><?php echo $this->lang->line("StartSurvey"); ?> </a>
                                                                    </td>
                                                                <?php } else { ?>
                                                                    <td>
                                                                        <span style="color: green;font-size: 14px;font-weight: bold;"><i style="color: green;font-size: 12px;font-weight: bold;" class="fa fa-check"></i>&nbsp;<?php echo $this->lang->line("Completed"); ?></span> 
                                                                        <a class="btn btn-primary" href="<?php echo site_url(); ?>/users/preview/<?php echo $value["form_assign_id"]; ?>"><?php echo $this->lang->line("Preview"); ?></a>
                                                                    </td>
                                                                <?php } ?>
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
<div  class="modal" id="location_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line("CheckLocation"); ?></h4>
            </div>
            <div class="modal-body" id='location_popup_body' style="padding-top: 0px;">
                <div class="">
                    <div id="google_map" style="height: 400px;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
            </div>  

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#filtering', function () {
            var val = $(this).val();
            $('.hideall').hide();
            if (val == "all") {
                $('.hideall').show();
            } else {
                $('.' + val).show();
            }
        });
    });
</script>
<script type="text/javascript">
//    var mapCenter = new google.maps.LatLng(25.4195477, 55.45291939999993);
//    var map = new google.maps.Map(document.getElementById('map'), {
//        'zoom': 18,
//        'center': mapCenter,
//        'mapTypeId': google.maps.MapTypeId.ROADMAP
//    });
//    // Create marker
//    var marker = new google.maps.Marker({
//        map: map,
//        draggable: true,
//        position: new google.maps.LatLng(25.4195477, 55.45291939999993),
//        title: 'The armpit of Cheshire'
//    });
//    var marker2 = new google.maps.Marker({
//        map: map,
//        icon: '<?php echo base_url(); ?>assets/img/man.png',
//        position: new google.maps.LatLng(25.419540432375555, 55.45330295588906),
//        title: 'The armpit of Cheshire'
//    });
//
//// Add circle overlay and bind to marker
//    var circle = new google.maps.Circle({
//        map: map,
//        radius: 100, // metres
//        fillColor: '#AA0000'
//    });
//    circle.bindTo('center', marker, 'position');
//    marker2.setAnimation(google.maps.Animation.BOUNCE);
//    setTimeout(function () {
//        marker2.setAnimation(null)
//    }, 20000);
</script>
<?php $this->load->view("common/footer"); ?>