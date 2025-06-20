var availableDates = [];
var questions_id = [];
var form_id_global;
var assign_gloabl_id;
var global_map;
var hasvalue_global = false;
$(document).ready(function () {
    $('#demo-setting').css('display', 'none');
    $(document).on('click', '.getuser', function (ele) {
        var question_id = $(this).attr('id');
        var optval = $(this).attr('opval');
        $('#question_id').val(question_id);
        $('#optval').val(optval);
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/getUserNameByQuestionAndOptVal',
            type: 'post',
            data: $("#usernames").serialize(),
        }).done(function (msg) {
            $.LoadingOverlay("hide");

            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $('#allusernames').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#allusernames_body').html(obj.html);
            } else {
                alert(obj.msg);
            }
        });
    });
    $(document).on('change', '.radiobtn', function (ele) {
        console.log('change');
        var qid = $(this).attr('qid');
        console.log(qid);
        $('#radio_' + qid).css('background', 'none');
        $('#radio_' + qid).css('color', '#000');
    });
    $(document).on('change', '.approved', function (ele) {
        var project_id = $(this).attr('id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/changeApproveStatus',
            type: 'post',
            data: 'is_approved=' + val + '&projects_id=' + project_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                location.reload(true);
            } else {
                alert(obj.msg);
            }
        });

    });
    $(document).on('change', '.approval', function (ele) {
        var question_id = $(this).attr('id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/changeQuestionStatus',
            type: 'post',
            data: 'is_approved=' + val + '&question_id=' + question_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {

            } else {
                alert(obj.msg);
            }
        });

    });
    $(document).on('change', '.approved_form', function (ele) {
        var question_id = $(this).attr('id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/changeFormStatus',
            type: 'post',
            data: 'is_approved=' + val + '&form_id=' + question_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                location.reload(true);
            } else {
                alert(obj.msg);
            }
        });

    });
    $(document).on('change', '.rating_section', function (ele) {
        var form_id = $(this).attr('form_id');
        var section_id = $(this).attr('section_id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/markSectionAsRating',
            type: 'post',
            data: 'is_rating=' + val + '&form_id=' + form_id + '&section_id=' + section_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {

            } else {
                alert(obj.msg);
            }
        });

    });
    $(document).on('change', '.rating_subsection', function (ele) {
        var group_titles_id = $(this).attr('group_titles_id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/markSubSectionAsRating',
            type: 'post',
            data: 'is_rating=' + val + '&group_titles_id=' + group_titles_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {

            } else {
                alert(obj.msg);
            }
        });

    });
    $(document).on('change', '.rating_q', function (ele) {
        var question_id = $(this).attr('id');
        var val = "";
        if ($(this).is(':checked')) {
            val = "yes";
        } else {
            val = "no";
        }
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/markQuestionAsRating',
            type: 'post',
            data: 'is_rating=' + val + '&question_id=' + question_id
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {

            } else {
                alert(obj.msg);
            }
        });

    });
});
var attributes={
    init:function(){
  
   
      $(document).on("click", "#sc", function () {
            $.LoadingOverlay("show");

            $.ajax({
                url: baseurl + '/attributes/submitattribute',
                data: $("#sbmtatt").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                
                // var obj = JSON.parse(msg);
                // if (obj.success == "yes") {
                //     // $("#option_id_" + obj.question_id).append(obj.html);
                // } else {
                //     alert(obj.msg);
                // }
            });
        });
     
   
           $(document).on("click", "#att", function (ele) {
           $('#showModal').modal();
           var itemid = $('#att').attr('itemid')
                $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/attributes/add_new_attribute',
                data: "item_id=" + itemid
       
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                $.LoadingOverlay("hide");
                 $('#html').html(obj);
         var el=        $('.js-example-basic-multiple').select2();
                 el.on('change', function() {
    
});
            });
        });
}
    
};
var brands={
    init:function(){
         $(document).on("change", ".changestatusbrand", function () {
            var status;

            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var brandid = $(this).attr('id');
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/brands/changestatus',
                data: "brand_id=" + brandid + "&status=" + status,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
    }
};
var items={
    init:function () {
              $(document).on("change", ".changestatusitems", function () {
            var status;

            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var itemid = $(this).attr('id');
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/items/changestatus',
                data: "item_id=" + itemid + "&status=" + status,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
            $(document).ready(function () {
                
             $("#item_expire_date").datepicker({
                        dateFormat: "yy-m-d",

                    });
        });
    }
};
var shops={
    init: function () {
          $(document).on("change", ".changestatusshop", function () {
            var status;

            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var shopid = $(this).attr('id');
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/shops/changestatus',
                data: "shop_id=" + shopid + "&status=" + status,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
        $(document).on('change', '#country_id', function (ele) {
            var country_id = $(this).val();
            var val = "";
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/shops/getstates',
                type: 'post',
                data: 'country_id=' + country_id
            }).done(function (msg1) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg1);
                $('#state1').html(obj);
                                      });
    
        });
       $(document).on('change', '#state1', function (ele) {
            var country_id = $('#country_id').val();
            var val = "";
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/shops/getcities',
                type: 'post',
                data: 'country_id=' + country_id+'&state_id='+$(this).val()
            }).done(function (msg1) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg1);
                $('#city_id').html(obj);
        });
    
        });
    }
  
    
};
var ckeditor = {
    init: function () {
        $(document).ready(function () {
            CKEDITOR.replace('form_desc', {height: '380px', startupFocus: true});
        });
    }
};
var survey_validation = {
    init: function () {
//        if ($.trim($("#fname").val()) == "") {
//            alert('First Name is required');
//            return false;
//        }
//        else if ($.trim($("#lname").val()) == "") {
//            alert('Last Name is required');
//            return false;
//        }
//        else if ($.trim($("#email").val()) == "") {
//            alert('Email is required');
//            return false;
//        }
//        else if ($.trim($("#phone").val()) == "") {
//            alert('Phone is required');
//            return false;
//        } else {
//            return true;
//        }
//        return true;
    },
}
var assign_survey = {
    deleteMasterPlan: function (ele, id) {
        var flag = confirm('Sure you want to delete?');
        if (flag) {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/deleteMasterPlan',
                data: 'project_master_plan_id=' + id,
                type: 'post'
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#row_" + id).remove();
                    location.reload(true);
                } else {

                }
                $.LoadingOverlay("hide");
            });
        }
    },
    applyautocplete: function (services) {
        console.log(services);
        var availableTags = services;
        $(".tags")
                // don't navigate away from the field on tab when selecting an item
                .bind("keydown", function (event) {

//    if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
//        event.preventDefault();
//    }
                }).autocomplete({
            minLength: minWordLength,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                var term = extractLast(request.term);
                if (term.length >= minWordLength) {
                    response($.ui.autocomplete.filter(availableTags, term));
                }
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(" ");
                return false;
            }
        });
    },
    getProjectDetail: function (ele) {
        var project_id = $(ele).val();
        if (project_id != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/assignformajax',
                data: 'project_id=' + project_id,
                type: 'post'
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                    $("#assign_form").html(obj.html);
                    $(".datepicker").datepicker({
                        dateFormat: "dd-mm-yy",
                        minDate: obj.mindate,
                        maxDate: obj.maxdate,
                    });

                    var responsiveHelper_dt_basic = undefined;
                    var responsiveHelper_datatable_fixed_column = undefined;
                    var responsiveHelper_datatable_col_reorder = undefined;
                    var responsiveHelper_datatable_tabletools = undefined;

                    var breakpointDefinition = {
                        tablet: 1024,
                        phone: 480
                    };

                    $('#dt_basic').dataTable({
                        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                                "t" +
                                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                        "autoWidth": true,
                        "oLanguage": {
                            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                        },
                        "preDrawCallback": function () {
                            // Initialize the responsive datatables helper once.
                            if (!responsiveHelper_dt_basic) {
                                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                            }
                        },
                        "rowCallback": function (nRow) {
                            responsiveHelper_dt_basic.createExpandIcon(nRow);
                        },
                        "drawCallback": function (oSettings) {
                            responsiveHelper_dt_basic.respond();
                        }
                    });

                    /* END BASIC */

                    /* COLUMN FILTER  */
                    var otable = $('#datatable_fixed_column').DataTable({
                        //"bFilter": false,
                        //"bInfo": false,
                        //"bLengthChange": false
                        //"bAutoWidth": false,
                        //"bPaginate": false,
                        //"bStateSave": true // saves sort state using localStorage
                        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                                "t" +
                                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                        "autoWidth": true,
                        "oLanguage": {
                            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                        },
                        "preDrawCallback": function () {
                            // Initialize the responsive datatables helper once.
                            if (!responsiveHelper_datatable_fixed_column) {
                                responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                            }
                        },
                        "rowCallback": function (nRow) {
                            responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
                        },
                        "drawCallback": function (oSettings) {
                            responsiveHelper_datatable_fixed_column.respond();
                        }

                    });

                    // custom toolbar
//                    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

                    // Apply the filter
                    $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {

                        otable
                                .column($(this).parent().index() + ':visible')
                                .search(this.value)
                                .draw();

                    });
                    /* END COLUMN FILTER */

                    /* COLUMN SHOW - HIDE */
                    $('#datatable_col_reorder').dataTable({
                        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>" +
                                "t" +
                                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                        "autoWidth": true,
                        "oLanguage": {
                            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                        },
                        "preDrawCallback": function () {
                            // Initialize the responsive datatables helper once.
                            if (!responsiveHelper_datatable_col_reorder) {
                                responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
                            }
                        },
                        "rowCallback": function (nRow) {
                            responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
                        },
                        "drawCallback": function (oSettings) {
                            responsiveHelper_datatable_col_reorder.respond();
                        }
                    });

                    /* END COLUMN SHOW - HIDE */
                } else {
                    $("#assign_form").html("");
                }
                $.LoadingOverlay("hide");
                assign_survey.applyautocplete(obj.services);
            });
        } else {
            $("#assign_form").html("");
        }
    },
    savelocation: function (ele) {
        if ($.trim($("#latitude").val()) == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if ($.trim($("#longitude").val()) == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if ($.trim($("#radius").val()) == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if ($.trim($("#geo_address").val()) == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if ($.trim($("#real_location").val()) == "") {
            alert('Field with sign(*) required');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/insertLocation',
                data: $('#user_location').serialize(),
                type: 'post'
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert(obj.msg);
                }
                $.LoadingOverlay("hide");
            });
        }
    },
    assign: function (ele, project_master_plan_id, order) {
        var ent = $('#main_' + project_master_plan_id + "_" + order).find("#ent").attr('ent');
        var dep = $('#main_' + project_master_plan_id + "_" + order).find("#dep").attr('dep');
        var branch = $('#main_' + project_master_plan_id + "_" + order).find("#dep").attr('branch');
        var cat = $('#main_' + project_master_plan_id + "_" + order).find("#cat").attr('cat');
        var target_org = $("#target_org_" + project_master_plan_id + "_" + order).val();
        var target_services = $("#target_services_" + project_master_plan_id + "_" + order).val();
        var target_emp = $("#target_emp_" + project_master_plan_id + "_" + order).val();
        var user_id = $("#user_" + project_master_plan_id + "_" + order).val();
        var form_id = $("#form_" + project_master_plan_id + "_" + order).val();
        var form_language = $("#form_language_" + project_master_plan_id + "_" + order).val();
        var date = $("#date_" + project_master_plan_id + "_" + order).val();
        var project_id = $("#project_id").val();
        var form_type = $("#form_type").val();
        var flag = $(ele).attr('id');
        var main_id = $(ele).attr('main_id');
        var dataarray = {
            'flag': flag,
            'main_id': main_id,
            'order_id': order,
            'project_id': project_id,
            'master_plan_id': project_master_plan_id,
            'form_type': form_type,
            'department': ent,
            'dep_ent': dep,
            'branch': branch,
            'category': cat,
            'target_org': target_org,
            'target_services': target_services,
            'target_emp': target_emp,
            'user': user_id,
            'survey_form': form_id,
            'form_language': form_language,
            'date': date,
            'sbmt': 'sbmt',
        }
        if (project_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_type == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (ent == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (dep == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (cat == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (target_org == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (target_services == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (user_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_language == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (date == "") {
            alert('Field with sign(*) required');
            return false;
        } else {
//            console.log(dataarray);
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/insertAssignForm',
                data: dataarray,
                type: 'post'
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    if (flag == "insert") {
                        $(ele).attr('id', 'update');
                        $(ele).attr('main_id', obj.insert_id);
                        $('#map_' + project_master_plan_id + "_" + order).attr('main_val', obj.insert_id);
                        $('#attachment_' + project_master_plan_id + "_" + order).attr('asign_id', obj.insert_id);
                        $('#par_' + project_master_plan_id + "_" + order).show();
                    } else {

                    }
                } else {
                    alert(obj.msg);
                }
                $.LoadingOverlay("hide");
            });
            return true;
        }
    },
    assign_main_survey: function (ele, project_master_plan_id, order) {
        var ent = $('#main_' + project_master_plan_id + "_" + order).find("#ent").attr('ent');
        var dep = $('#main_' + project_master_plan_id + "_" + order).find("#dep").attr('dep');
        var branch = $('#main_' + project_master_plan_id + "_" + order).find("#dep").attr('branch');
        var cat = $('#main_' + project_master_plan_id + "_" + order).find("#cat").attr('cat');
        var user_id = $("#user_" + project_master_plan_id + "_" + order).val();
        var form_id = $("#form_" + project_master_plan_id + "_" + order).val();
        var form_language = $("#form_language_" + project_master_plan_id + "_" + order).val();
        var date = $("#date_" + project_master_plan_id + "_" + order).val();
        var project_id = $("#project_id").val();
        var form_type = $("#form_type").val();
        var flag = $(ele).attr('id');
        var main_id = $(ele).attr('main_id');
        var dataarray = {
            'flag': flag,
            'main_id': main_id,
            'order_id': order,
            'project_id': project_id,
            'master_plan_id': project_master_plan_id,
            'form_type': form_type,
            'department': ent,
            'dep_ent': dep,
            'branch': branch,
            'category': cat,
            'user': user_id,
            'survey_form': form_id,
            'form_language': form_language,
            'date': date,
            'sbmt': 'sbmt',
        }
        if (project_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_type == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (ent == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (dep == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (cat == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (user_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_id == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (form_language == "") {
            alert('Field with sign(*) required');
            return false;
        }
        else if (date == "") {
            alert('Field with sign(*) required');
            return false;
        } else {
//            console.log(dataarray);
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/insertAssignForm',
                data: dataarray,
                type: 'post'
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    if (flag == "insert") {
                        $(ele).attr('id', 'update');
                        $(ele).attr('main_id', obj.insert_id);
                        $('#map_' + project_master_plan_id + "_" + order).attr('main_val', obj.insert_id);
                        $('#attachment_' + project_master_plan_id + "_" + order).attr('asign_id', obj.insert_id);
                        $('#par_' + project_master_plan_id + "_" + order).show();
                    } else {

                    }
                } else {
                    alert(obj.msg);
                }
                $.LoadingOverlay("hide");
            });
            return true;
        }
    }
};
var survey = {
    getEntities: function (ele) {
        if ($(ele).val() != "") {
            survey.getCategoryInProjectSelect(ele, 'mystry_shopper', $(ele).val())
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getEntities',
                data: 'project_id=' + $(ele).val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#department").html(obj.html);
                    $("#form_type").html(obj.types);
                } else {
                    alert(obj.msg);
                }
            });
        } else {
            $("#department").html('<option value="">Select Entity</option>');
            $("#branches").html('<option value="">Select Branch</option>');
            $("#dep_ent").html('<option value="">Select Department</option>');
            $("#form_type").html('<option value="">Select Form Type</option>');
            $("#category").html('<option value="">Select Category</option>');
            $("#survey_form").html('<option value="">Select Survey Form</option>');
        }
    },
    project_detail: function () {
        if ($("#department").val() == "") {
            alert('All Fields are required');
            return false;
        }
        else if ($("#dep_ent").val() == "") {
            alert('All Fields are required');
            return false;
        }
        else if ($("#form_type").val() == "") {
            alert('All Fields are required');
            return false;
        }
        else if ($("#category").val() == "") {
            alert('All Fields are required');
            return false;
        }
        else if ($("#quantity").val() == "") {
            alert('All Fields are required');
            return false;
        }
        else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/checkRecordExistOrNot',
                data: "department=" + $("#department").val() + "&project_id=" + $("#projects_id").val() + "&category=" + $("#category").val() + "&dep_ent=" + $("#dep_ent").val() + "&branches=" + $("#branches").val() + "&form_type=" + $("#form_type").val(),
                type: 'post',
                async: false
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                if (msg == "yes") {
                    $("#master-form").submit();
//                    return true;
                } else {
                    alert('Already assign with this criteria');
                    return false;
                }
            });
//            return false;
        }
    },
    setlocation: function (ele, latitude_pop, longitude_pop, radius_pop) {
        var geo_address;
        var id = $(ele).attr('main_val');
        $('#location_popup').modal({
            backdrop: 'static',
            keyboard: false
        });
//        $('#location_popup').on('shown.bs.modal', function (e) {
//            // do something…
//            var script = document.createElement('script');
//            script.type = 'text/javascript';
//            script.src = global_url + 'assets/js/locationpicker.jquery.min.js';
//            $("body").append(script);
//        })
//        $('#location_popup').on('hidden.bs.modal', function () {
//            $('html').find('script').filter(function () {
//                return $(this).attr('src') === global_url + 'assets/js/locationpicker.jquery.min.js'
//            }).remove();
//
//        })
        $('#latitude').val("");
        $('#longitude').val("");
        $('#radius').val("");
        $('#geo_address').val("");
        $('#form_assign_id').val("");
        $('#real_location').val("");

        // has id get value else use above arguments
        if (id != "") {
            $('#google_map').html('');
            var randm = Math.floor((Math.random() * 1000) + 1);
            $('.mymap').attr('id', randm);
            $("#form_assign_id").val(id);
//            $('#' + randm).html('');
//            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/survey/getLatLongAndAddress',
                data: "id=" + id,
            }).done(function (msg) {
//                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    if (obj.latitude != "0") {
                        latitude_pop = obj.latitude;
                        longitude_pop = obj.longitude;
                        radius_pop = obj.radius;
                        geo_address = obj.location;
                        $('#latitude').val(obj.latitude);
                        $('#longitude').val(obj.longitude);
                        $('#radius').val(obj.radius);
                        $('#geo_address').val(geo_address);
                        $('#real_location').val(obj.real_location);
                    }
                    console.log('em here');

                    $('#' + randm).locationpicker({
                        location: {
                            latitude: latitude_pop,
                            longitude: longitude_pop
                        },
                        radius: radius_pop,
                        zoom: 19,
                        scrollwheel: false,
                        inputBinding: {
                            latitudeInput: $('#latitude'),
                            longitudeInput: $('#longitude'),
                            radiusInput: $('#radius'),
                            locationNameInput: $('#geo_address')
                        },
                        enableAutocomplete: true,
                    });

//                    $('#google_map').locationpicker('autosize');
//                    console.log(global_map.map);
//                    google.maps.event.trigger(global_map.map, 'resize');

                }
            });
        } else {
            $('#google_map').locationpicker({
                location: {
                    latitude: latitude_pop,
                    longitude: longitude_pop
                },
                radius: radius_pop,
                zoom: 19,
                scrollwheel: false,
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longitude'),
                    radiusInput: $('#radius'),
                    locationNameInput: $('#geo_address')
                },
                enableAutocomplete: true,
            });
        }




    },
    getCategoryInProject: function (ele) {
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: baseurl + '/survey/getCategoryInProject',
            data: "fomr_type=" + $(ele).val() + "&project_id=" + $("#project_id").val(),
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            $("#category").html(obj.html);
        });
    },
    getCategoryInProjectSelect: function (ele, fomr_type, project_id) {
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: baseurl + '/survey/getCategoryInProject',
            data: "fomr_type=" + fomr_type + "&project_id=" + project_id,
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            $("#category").html(obj.html);
        });
    },
    getCategory: function (ele) {
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: baseurl + '/survey/getCategory',
            data: "fomr_type=" + $(ele).val(),
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            $("#category").html(obj.html);
        });
    },
    delSubStatement: function (ele, id) {
        var flag = confirm('Sure you want to delete. All the Question and option will also be deleted?');
        if (flag) {
            $.LoadingOverlay("show");
            var data = {
                id: id,
            };
            $("#table_sub_" + id).remove();
            $("#option_sub_" + id).remove();
            $.ajax({
                type: "POST",
                url: baseurl + '/survey/delSubStatement',
                data: data,
            }).done(function (msg) {
                $.LoadingOverlay("hide");
            });
        }
    },
    updateQuestion: function (ele, id, type) {
        var input_value = "";
        input_value = $.trim($("#question_text_" + type + "_" + id).val());
        if (input_value == "") {
            alert('Field cannot be empty');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/updateQuestion',
                data: 'id=' + id + "&input_value=" + input_value + "&type=" + type,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    updateOptionField: function (ele, id, field_name, type) {
        var input_value = "";
        if (field_name == "op_txt") {
            input_value = $.trim($("#op_txt_" + type + "_" + id).val());
        } else {
            input_value = $.trim($("#op_val_" + id).val());
        }
        if (input_value == "") {
            alert('Field cannot be empty');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/updateOptionField',
                data: 'id=' + id + '&field_name=' + field_name + "&input_value=" + input_value + "&type=" + type,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert(obj.msg);
                }
            });
        }

    },
    getForms: function (ele) {
        var department = $(ele).val();
        $("#survey_form").html('<option value=""  >Select Survey Forms</option>');
        if (department != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getForms',
                data: 'department=' + department,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#survey_form").html(obj.html);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    getBranches: function (ele) {
        var dep_ent = $(ele).val();
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/getBranches',
            data: 'dep_ent=' + dep_ent,
            type: 'post'
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#branches").html(obj.html);
            } else {
                alert(obj.msg);
            }
        });
    },
    getBranchesInProject: function (ele) {
        var dep_ent = $(ele).val();
        $.LoadingOverlay("show");
        $.ajax({
            url: baseurl + '/survey/getBranchesInProject',
            data: 'dep_ent=' + dep_ent + "&project_id=" + $("#project_id").val(),
            type: 'post'
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#branches").html(obj.html);
            } else {
                alert(obj.msg);
            }
        });
    },
    getAllForms: function (ele) {
        var category = $("#category").val();
        $("#survey_form").html('<option value=""  >Select Survey Forms</option>');
        if (category != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getFormsByCategory',
                data: 'category=' + category + "&form_type=" + $("#form_type").val() + "&department=" + $("#department").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#survey_form").html(obj.html);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    getFormsByCategory: function (ele) {

        if ($("#department").val() != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getDepEnt',
                data: "department=" + $("#department").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#dep_ent").html(obj.dep_ent);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    getAllDepUnderEnt: function (ele) {

        if ($("#entity").val() != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getDepEnt',
                data: "department=" + $("#entity").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#dep_ent").html(obj.dep_ent);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    getFormsByCategoryInProject: function (ele) {

        if ($("#department").val() != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/getDepEntInProject',
                data: "department=" + $("#department").val() + "&project_id=" + $("#project_id").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#dep_ent").html(obj.dep_ent);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    delOption: function (ele, id) {
        var flag = confirm('Sure you want to delete?');
        if (flag) {
            $.LoadingOverlay("show");
            var data = {
                id: id,
            };
            $("#option_" + id).remove();
            $.ajax({
                type: "POST",
                url: baseurl + '/survey/delOption',
                data: data,
            }).done(function (msg) {
                $.LoadingOverlay("hide");
            });
        }

    },
    delQuestion: function (ele, id) {
        var flag = confirm('Sure you want to delete?');
        if (flag) {
            $.LoadingOverlay("show");
            var data = {
                id: id,
            };
            $("#question_id_" + id).remove();
            $.ajax({
                type: "POST",
                url: baseurl + '/survey/delQuestion',
                data: data,
            }).done(function (msg) {
                $.LoadingOverlay("hide");
            });
        }

    },
    addOptions: function (ele, question_id, fomr_id, section) {
        $("#form_id_options").val("");
        $("#section_options").val("");
        $("#question_id_option").val("");
        $('#options_modal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#form_id_options").val(fomr_id);
        $("#section_options").val(section);
        $("#question_id_option").val(question_id);
    },
    openSubSection: function (ele, fomr_id, section) {
        $("#sub_section_title").val("");
        $("#sub_form_id").val("");
        $("#main_section").val("");
        $('#sub_section').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#sub_form_id").val(fomr_id);
        $("#main_section").val(section);

    },
    insertSubSection: function (ele) {
        if ($.trim($("#sub_section_title").val()) == "" && $.trim($("#sub_section_title_ar").val()) == "") {
            alert('Title is required');
            return false;
        }
        else if ($.trim($("#sub_form_id").val()) == "") {
            alert('Form Id is Missing');
            return false;
        }
        else if ($.trim($("#main_section").val()) == "") {
            alert('Section Id is Missing');
            return false;
        }
        else {
            $(ele).attr('disabled', 'disabled');
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/insertSubSection',
                data: $("#sub_section_form").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                $(ele).removeAttr('disabled', 'disabled');
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#sub_section_title").val("");
                    $("#sub_section_title_ar").val("");

//                    $("#option_id_" + obj.question_id).append(obj.html);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    addStatement: function (ele, section, fomr_id, sub_id) {
        $("#form_id").val("");
        $("#section").val("");
        $("#sub_id").val("");
        $('#statements').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#form_id").val(fomr_id);
        $("#section").val(section);
        $("#sub_id").val(sub_id);
    },
    insertOption: function (ele) {
        if ($.trim($("#op_txt").val()) == "" && $.trim($("#op_txt_ar").val()) == "") {
            alert('Kindly insert Option text');
            return false;
        }
        else if ($.trim($("#op_val").val()) == "") {
            alert('Kindly select Option value');
            return false;
        }
        else if ($.trim($("#form_id_options").val()) == "") {
            alert('Survey Form Id is Missing');
            return false;
        }
        else if ($.trim($("#section_options").val()) == "") {
            alert('Section Id is Missing');
            return false;
        }
        else if ($.trim($("#question_id_option").val()) == "") {
            alert('Section Question Id is Missing');
            return false;
        }
        else {
            $.LoadingOverlay("show");
            $(ele).attr('disabled', 'disabled');
            $.ajax({
                url: baseurl + '/survey/insertOptions',
                data: $("#options_form").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                $(ele).removeAttr('disabled', 'disabled');
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#op_txt").val("");
                    $("#op_txt_ar").val("");
                    $("#op_val").val("");
                    $("#option_id_" + obj.question_id).append(obj.html);
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    insertStatement: function (ele) {
        if ($.trim($("#question_statement").val()) == "" && $.trim($("#question_statement_ar").val()) == "") {
            alert('Kindly insert question statement');
            return false;
        }
        else if ($.trim($("#question_type").val()) == "") {
            alert('Kindly select question type');
            return false;
        }
        else if ($.trim($("#form_id").val()) == "") {
            alert('Survey Form Id is Missing');
            return false;
        }
        else if ($.trim($("#section").val()) == "") {
            alert('Section Id is Missing');
            return false;
        } else {
            $.LoadingOverlay("show");
            $(ele).attr('disabled', 'disabled');
            $.ajax({
                url: baseurl + '/survey/insertStatement',
                data: $("#question_form").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                $(ele).removeAttr('disabled', 'disabled');
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#question_type').prop('selectedIndex', 0);
                    $("#question_statement").val("");
                    $("#question_statement_ar").val("");
                    if (obj.sub == "no") {
                        $("#body_" + obj.section).append(obj.html);
                    } else {
                        $("#sub_body_" + obj.sub).append(obj.html);
                    }
                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    insertSectionTitle: function (ele, form_id, section_id, type) {
        if ($.trim($("#section_" + type + "_" + section_id).val()) == "") {
//            alert($("#section_" + section_id).val());
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/insertSectionTitle',
                data: "section_title=" + $("#section_" + type + "_" + section_id).val() + "&form_id=" + form_id + "&section_id=" + section_id + "&type=" + type,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert(obj.msg);
                }
            });
        }
    },
    insertSubSectionTitle: function (ele, group_titles_id, type) {
        if ($.trim($("#sub_section_" + type + "_" + group_titles_id).val()) == "") {
//            alert($("#section_" + section_id).val());
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/updateSubSectionTitle',
                data: "section_title=" + $("#sub_section_" + type + "_" + group_titles_id).val() + "&group_titles_id=" + group_titles_id + "&type=" + type,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert(obj.msg);
                }
            });
        }
    }
};
var category = {
    init:function(){
            $(document).on("change", ".changestatuscategory", function () {
            var status;

            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var categoryid = $(this).attr('id');
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/categories/changestatus',
                data: "category_id=" + categoryid + "&status=" + status,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
    }
};
var user = {
    getlocation: function (ele, form_id) {
        if (navigator.geolocation) {
            form_id_global = form_id;
            navigator.geolocation.getCurrentPosition(showPositionNew, showErrorNew, {maximumAge: 600000, enableHighAccuracy: true});
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    },
    init: function () {
        $(document).on("change", ".changestatus", function () {
            var status;

            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var userid = $(this).attr('id');
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/users/changestatus',
                data: "user_id=" + userid + "&status=" + status,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
        $(document).ready(function () {
            $('#adduser-form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The Name is required'
                            },
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'The Username is required'
                            },
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email address is required'
                            },
                            emailAddress: {
                                message: 'The email address is not valid'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    }
                }
            });
            /* // DOM Position key index //
             
             l - Length changing (dropdown)
             f - Filtering input (search)
             t - The Table! (datatable)
             i - Information (records)
             p - Pagination (paging)
             r - pRocessing 
             < and > - div elements
             <"#id" and > - div with an id
             <"class" and > - div with a class
             <"#id.class" and > - div with an id and class
             
             Also see: http://legacy.datatables.net/usage/features
             */

            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                        "t" +
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_dt_basic.respond();
                }
            });

            /* END BASIC */

            /* COLUMN FILTER  */
            var otable = $('#datatable_fixed_column').DataTable({
                //"bFilter": false,
                //"bInfo": false,
                //"bLengthChange": false
                //"bAutoWidth": false,
                //"bPaginate": false,
                //"bStateSave": true // saves sort state using localStorage
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                        "t" +
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_fixed_column) {
                        responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_datatable_fixed_column.respond();
                }

            });

            // custom toolbar
            $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

            // Apply the filter
            $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {

                otable
                        .column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();

            });
            /* END COLUMN FILTER */

            /* COLUMN SHOW - HIDE */
            $('#datatable_col_reorder').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>" +
                        "t" +
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "autoWidth": true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_col_reorder) {
                        responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_datatable_col_reorder.respond();
                }
            });

            /* END COLUMN SHOW - HIDE */

            /* TABLETOOLS */
            $('#datatable_tabletools').dataTable({
                // Tabletools options: 
                //   https://datatables.net/extensions/tabletools/button_options
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                        "t" +
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "oTableTools": {
                    "aButtons": [
                        "copy",
                        "csv",
                        "xls",
                        {
                            "sExtends": "pdf",
                            "sTitle": "SmartAdmin_PDF",
                            "sPdfMessage": "SmartAdmin PDF Export",
                            "sPdfSize": "letter"
                        },
                        {
                            "sExtends": "print",
                            "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                        }
                    ],
                    "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
                },
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_tabletools) {
                        responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_datatable_tabletools.respond();
                }
            });
        });
    },
    changepermissions: function () {
        $(document).on("change", ".permissions", function () {
            var ischecked = $(this).is(':checked');
            var type_id;
            var user_id;
            var action;
            if (!ischecked) {
                type_id = $(this).val();
                user_id = $(this).attr('id');
                action = 'delete';

            } else {
                type_id = $(this).val();
                user_id = $(this).attr('id');
                action = 'add';

            }
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: baseurl + '/users/updatepermissions',
                data: "user_id=" + user_id + "&type_id=" + type_id + "&action=" + action,
                success: function (response)
                {
                    $.LoadingOverlay("hide");
                }
            });
        });
    },
};
function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}
var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};
var publishing = {
    init: function () {
        $(document).ready(function () {
            $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "fieldset",
                transitionEffect: "slide",
                labels: {
                    finish: "Publish",
                },
                onFinishing: function (event, currentIndex) {
                    var hasValue = true;
                    counter = 1;
                    $("#wizard-p-" + currentIndex).find('input[type="radio"]').each(function () {
                        var name = $(this).attr("name");
                        if ($("input:radio[name=" + name + "]:checked").length == 0)
                        {
                            hasValue = false;
                            $('#radio_' + name).css('background', '#ff3333');
                            $('#radio_' + name).css('color', '#ffffff');
                        } else {
                            $('#radio_' + name).css('background', 'none');
                            $('#radio_' + name).css('color', '#000');
                        }
                    });
                    $("#wizard-p-" + currentIndex).find('textarea').each(function () {
                        var name = $(this).attr("name");
                        if ($.trim($("textarea[name=" + name + "]").val()) == "")
                        {
                            hasValue = false;
                            $('#text_' + name).css('background', '#ff3333');
                            $('#text_' + name).css('color', '#ffffff');
                        } else {
                            $('#text_' + name).css('background', 'none');
                            $('#text_' + name).css('color', '#000');
                        }
                    });
                    if (hasValue === false) {
                        hasvalue_global = false;
                        return false;
                    } else {
                        $("#survey_form").submit();
                        return true;
                    }
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    if (newIndex > currentIndex) {
                        var hasValue = true;
                        counter = 1;
                        $("#wizard-p-" + currentIndex).find('input[type="radio"]').each(function () {
                            var name = $(this).attr("name");
                            if ($("input:radio[name=" + name + "]:checked").length == 0)
                            {
                                hasValue = false;
                                $('#radio_' + name).css('background', '#ff3333');
                                $('#radio_' + name).css('color', '#ffffff');
                            } else {
                                $('#radio_' + name).css('background', 'none');
                                $('#radio_' + name).css('color', '#000');
                            }
                        });
                        $("#wizard-p-" + currentIndex).find('textarea').each(function () {
                            var name = $(this).attr("name");
                            if ($.trim($("textarea[name=" + name + "]").val()) == "")
                            {
                                hasValue = false;
                                $('#text_' + name).css('background', '#ff3333');
                                $('#text_' + name).css('color', '#ffffff');
                            } else {
                                $('#text_' + name).css('background', 'none');
                                $('#text_' + name).css('color', '#000');
                            }
                        });
                        if (hasValue === false) {
                            hasvalue_global = false;
                            return false;
                        } else {
                            hasvalue_global = true;
                            return true;
                        }
                    } else {
                        return true;
                    }
                }

            });
        });
    },
};
var survey_steps = {
    getAssignLocation: function (position) {
        $.LoadingOverlay("show");
        $.ajax({
            type: "POST",
            url: baseurl + '/survey/getLatLongAndAddress',
            data: "id=" + assign_gloabl_id,
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            $('#location_popup').modal({
                backdrop: 'static',
                keyboard: false
            });

            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                if (obj.latitude != "0") {
                    var latitude_pop = obj.latitude;
                    var longitude_pop = obj.longitude;
                    var mapCenter = new google.maps.LatLng(latitude_pop, longitude_pop);
                    var map = new google.maps.Map(document.getElementById('google_map'), {
                        'zoom': 18,
                        'center': mapCenter,
                        'mapTypeId': google.maps.MapTypeId.ROADMAP
                    });
                    // Create marker
                    var marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        position: new google.maps.LatLng(latitude_pop, longitude_pop),
                    });
                    var marker2 = new google.maps.Marker({
                        map: map,
                        icon: global_url + 'assets/img/man.png',
                        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                        title: 'The armpit of Cheshire'
                    });

// Add circle overlay and bind to marker
                    var circle = new google.maps.Circle({
                        map: map,
                        radius: 100, // metres
                        fillColor: '#AA0000'
                    });
                    circle.bindTo('center', marker, 'position');
                    marker2.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(function () {
                        marker2.setAnimation(null)
                    }, 20000);
                }

            }
        });
    },
    removeoverlay: function () {
        $('#overlay').remove();
        $.ajax({
            url: baseurl + '/users/gettimestamp',
            type: 'post'
        }).done(function (msg) {
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#start_time").val(obj.html);
            } else {
                alert(obj.msg);
            }
        });

    },
    init: function () {
        $(document).ready(function () {
            $(document).on('focusout', '.updatetext', function (ele) {
                var answer_data_id = $(this).attr('id');
                var dat = $(this).val();
                console.log(answer_data_id);
                console.log(dat);
                if ($.trim(dat) != "") {
                    $.LoadingOverlay("show");
                    $.ajax({
                        url: baseurl + '/users/updatetextarea',
                        data: 'answer_data_id=' + answer_data_id + "&dat=" + encodeURIComponent(dat),
                        type: 'post'
                    }).done(function (msg) {
                        $.LoadingOverlay("hide");
                        var obj = JSON.parse(msg);
                        if (obj.success == "yes") {

                        } else {
                            alert(obj.msg);
                        }
                    });
                }
            });
            $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "fieldset",
                transitionEffect: "slide",
                onFinishing: function (event, currentIndex) {
                    var hasValue = true;
                    counter = 1;
                    $("#wizard-p-" + currentIndex).find('input[type="radio"]').each(function () {
                        var name = $(this).attr("name");
                        if ($("input:radio[name=" + name + "]:checked").length == 0)
                        {
                            hasValue = false;
                            $('#radio_' + name).css('background', '#ff3333');
                            $('#radio_' + name).css('color', '#ffffff');
                        } else {
                            $('#radio_' + name).css('background', 'none');
                            $('#radio_' + name).css('color', '#000');
                        }
                    });
                    $("#wizard-p-" + currentIndex).find('textarea').each(function () {
                        var name = $(this).attr("name");
                        if ($.trim($("textarea[name=" + name + "]").val()) == "")
                        {
                            hasValue = false;
                            $('#text_' + name).css('background', '#ff3333');
                            $('#text_' + name).css('color', '#ffffff');
                        } else {
                            $('#text_' + name).css('background', 'none');
                            $('#text_' + name).css('color', '#000');
                        }
                    });
                    if (hasValue === false) {
                        hasvalue_global = false;
                        return false;
                    } else {
                        $("#survey_form").submit();
                        return true;
                    }

                },
                onStepChanging: function (event, currentIndex, newIndex) {

                    if (newIndex > currentIndex) {
                        var hasValue = true;
                        counter = 1;
                        $("#wizard-p-" + currentIndex).find('input[type="radio"]').each(function () {
                            var name = $(this).attr("name");
                            if ($("input:radio[name=" + name + "]:checked").length == 0)
                            {
                                hasValue = false;
                                $('#radio_' + name).css('background', '#ff3333');
                                $('#radio_' + name).css('color', '#ffffff');
                            } else {
                                $('#radio_' + name).css('background', 'none');
                                $('#radio_' + name).css('color', '#000');
                            }
                        });
                        $("#wizard-p-" + currentIndex).find('textarea').each(function () {
                            var name = $(this).attr("name");
                            if ($.trim($("textarea[name=" + name + "]").val()) == "")
                            {
                                hasValue = false;
                                $('#text_' + name).css('background', '#ff3333');
                                $('#text_' + name).css('color', '#ffffff');
                            } else {
                                $('#text_' + name).css('background', 'none');
                                $('#text_' + name).css('color', '#000');
                            }
                        });
                        if (hasValue === false) {
                            hasvalue_global = false;
                            return false;
                        } else {
                            hasvalue_global = true;
                            return true;
                        }
                    } else {
                        return true;
                    }

                }

            });
        });
    },
    checklocation: function (ele, id) {

        $('#google_map').html('');
        if (navigator.geolocation) {
            assign_gloabl_id = id;
            navigator.geolocation.getCurrentPosition(survey_steps.getAssignLocation, showErrorNew, {maximumAge: 600000, enableHighAccuracy: true});
        } else {
            alert("Geolocation is not supported by this browser.");
        }


    }
};
function showPositionNew(position) {
    // check the distance between two points 
    $.LoadingOverlay("show");
    $.ajax({
        url: baseurl + '/users/checkUserDistance',
        data: "form_id=" + form_id_global + "&latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude,
        type: 'post'
    }).done(function (msg) {
        $.LoadingOverlay("hide");
        var obj = JSON.parse(msg);
        if (obj.success == "yes") {
            window.location.href = baseurl + "/users/startsurvey/" + form_id_global;
        } else {
            alert(obj.msg);
        }
    });
}
function showErrorNew(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}
$(document).on('change', '.attachments', function () {
    var ele = $(this);
    if (ele.attr('asign_id') != "") {
        var assign_id = ele.attr('asign_id');
        var form_data = new FormData();
        var file_data = $(ele).prop('files')[0];
//        console.log(file_data);
        if (file_data) {
            form_data.append("file", file_data);
            form_data.append("assign_id", assign_id);
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/uploadAttachment',
                data: form_data,
                type: 'post',
                processData: false,
                contentType: false,
                cache: false
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#attachment_div_' + assign_id).html('<a target=""_blank href="' + global_url + 'attachments/assign/' + obj.random_name + '">' + obj.name + '</a>');
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        } else {
            alert('Error: Your Browser Does not support HTML5.');
        }

    } else {
        alert('Error: Kindly first save and then upload attachments.');
    }
});
var uploadattachments = {
    deleteAttachment: function (ele, evidence_id) {
        var flag = confirm('Sure you want to delete?');
        if (flag) {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/deleteAttachment',
                data: "evidence_id=" + evidence_id,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#row_' + evidence_id).remove();
                } else {
                    alert(obj.msg);
                }
            });
        } else {

        }
    },
    getAttachments: function (ele, section_id, heading) {
        $('#mainheading').html(heading);
        $('#attachments').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#section_id_popup').val(section_id);
        $('#attachments_body').html("");
        $.ajax({
            url: baseurl + '/survey/getAllAttachments',
            data: 'form_id=' + $('#form_id_popup').val() + "&section_id=" + section_id + "&assign_id=" + $('#form_assign_id_popup').val(),
            type: 'post',
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $('#attachments_body').html(obj.html);
            } else {
                alert('Error: Something went wrong.');
            }
        });
    },
    doupload: function (ele) {
        var form_data = new FormData();
        var file_data = $('#file').prop('files')[0];
        if (file_data) {
            form_data.append("file", file_data);
            form_data.append("form_id", $('#form_id_popup').val());
            form_data.append("section_id", $('#section_id_popup').val());
            form_data.append("assign_id", $('#form_assign_id_popup').val());
            form_data.append("notes", $('#notes').val());
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/survey/uploadSectionAttachment',
                data: form_data,
                type: 'post',
                processData: false,
                contentType: false,
                cache: false
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#attachments_body').html(obj.html);
                    $('#file').val('');
                    $('#notes').val('');
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        } else {
            alert('Error: Your Browser Does not support HTML5.');
        }
    }
};
var MaP_new = {
    getLocation: function (ele, latitude_pop, longitude_pop, radius_pop) {
        var geo_address;
        var id = $(ele).attr('main_val');
        $("#form_assign_id").val(id);
        if (id != "") {
            $.ajax({
                type: "POST",
                url: baseurl + '/survey/getLatLongAndAddress',
                data: "id=" + id,
                async: false,
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
//                    if (obj.latitude != "0") {
                    latitude_pop = obj.latitude;
                    longitude_pop = obj.longitude;
                    radius_pop = obj.radius;
                    geo_address = obj.location;
                    $('#latitude').val(obj.latitude);
                    $('#longitude').val(obj.longitude);
                    $('#radius').val(obj.radius);
                    $('#geo_address').val(geo_address);
                    $('#real_location').val(obj.real_location);
                    MaP_new.init(ele, latitude_pop, longitude_pop, radius_pop, geo_address);
//                    }
                }

            });
        } else {
            MaP_new.init(ele, latitude_pop, longitude_pop, radius_pop, geo_address);
        }
    },
    map: null,
    init: function (ele, latitude_pop, longitude_pop, radius_pop, address)
    {
        var lat;
        var lng;
        var geo_address;
        var radius;
        $('#location_popup').modal({
            backdrop: 'static',
            keyboard: false
        });
        //TODO: Check why error is coming .. Remove try catch if posssible .. or log error somewhere..
        try
        {

            lat = latitude_pop;
            lng = longitude_pop;
            geo_address = address;
            radius = radius_pop;
            if (lat == 0)
                lat = 25.073858;
            if (lng == 0)
                lng = 55.2298444;

            var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 18
            };
            MaP_new.map = new google.maps.Map(document.getElementById('mymap'),
                    mapOptions);
            var input = /** @type {HTMLInputElement} */(
                    document.getElementById('geo_address'));
            var autocomplete = new google.maps.places.Autocomplete(input);
//             MaP_new.map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            autocomplete.bindTo('bounds', MaP_new.map);
            var infowindow = new google.maps.InfoWindow();
            var latLng = new google.maps.LatLng(lat, lng);
            var marker = new google.maps.Marker({
                map: MaP_new.map,
                position: latLng,
                draggable: true,
//                anchorPoint: new google.maps.Point(0, -29)
            });
            var circle = new google.maps.Circle({
                map: MaP_new.map,
                radius: parseFloat(radius), // 10 miles in metres
                fillColor: '#AA0000'
            });
            circle.bindTo('center', marker, 'position');
            google.maps.event.addListener(marker, 'dragend', function ()
            {
                var pos = marker.getPosition();
                $("#latitude").val(pos.lat());
                $("#longitude").val(pos.lng());
            });
            google.maps.event.addDomListener(
                    document.getElementById('radius'), 'change', function () {
                circle.setRadius(parseFloat(document.getElementById('radius').value))
            });
            console.log(radius);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    MaP_new.map.fitBounds(place.geometry.viewport);
                } else {
                    MaP_new.map.setCenter(place.geometry.location);
                    MaP_new.map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                $("#latitude").val(place.geometry.location.lat());
                $("#longitude").val(place.geometry.location.lng());
                MaP_new.setTimeZone();
                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(MaP_new.map, marker);
            });

        }
        catch (e) {
        }
    }
};
var reports = {
    ExportBarChart: function (ele) {
        var object = $(ele).val();
        if ($('#department').val() == "") {
            alert('Kindly select the Entity');
            return false;
        } else if ($('#survey_form').val() == "") {
            alert('Kindly select the form');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/exportBarChart',
                data: $("#search-master-sheet").serialize() + "&project_id=" + $("#project_id").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    window.location = global_url + '/attachments/reports/' + obj.name
                }
            });
        }
    },
    getBarChart: function (ele) {
        var object = $(ele).val();
        if ($('#department').val() == "") {
            alert('Kindly select the Entity');
            return false;
        } else if ($('#survey_form').val() == "") {
            alert('Kindly select the form');
            return false;
        } else {
            $('#report').html("");
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/getBarChart',
                data: $("#search-master-sheet").serialize() + "&project_id=" + $("#project_id").val(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#report').html(obj.html);
                }
            });
        }
    },
    getMasterSheet: function (ele) {
        var object = $(ele).val();
        if ($('#department').val() == "") {
            alert('Kindly select the department');
            return false;
        } else if ($('#survey_form').val() == "") {
            alert('Kindly select the form');
            return false;
        } else {
            $('#report').html("");
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/getMasterSheet',
                data: $("#search-master-sheet").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#report').html(obj.html);
                }
            });
        }
    },
    getMasterSheetExport: function (ele) {

        var object = $(ele).val();
        if ($('#department').val() == "") {
            alert('Kindly select the department');
            return false;
        } else if ($('#survey_form').val() == "") {
            alert('Kindly select the form');
            return false;
        } else {
            $('#report').html("");
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/getMasterReportByCriteriaAndSub',
                data: $("#search-master-sheet").serialize(),
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#report').html(obj.html);
                }
            });
        }
    },
    getAllEntityDepBranch: function (ele) {
        var project_id = $(ele).val();
        if (project_id != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/getAllEntityDepBranchUnderProject',
                data: 'project_id=' + project_id,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                }
            });
        }
    },
    getAllComoleteProjects: function (ele) {
        var project_id = $(ele).val();
        if (project_id != "") {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/reports/getAllComoleteProjects',
                data: 'project_id=' + project_id,
                type: 'post'
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $("#assign_form").html(obj.html);
                    $("#exportword").attr('project_id', obj.project_id);
                }
            });
        }
    },
};
var report3 = {
    updateevidence: function (id, ele) {
        var is_published;
        var notes = $('#note_' + id).val();
        if ($.trim(notes) == "") {
            return false;
        } else {
            $.LoadingOverlay("show");
            if ($('#is_published_' + id).is(':checked')) {
                is_published = 'yes';
            } else {
                is_published = 'no';
            }
            $.ajax({
                url: baseurl + '/reports/update_evidence',
                data: 'is_published=' + is_published + "&notes=" + notes + "&id=" + id,
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {

                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }

    },
    getAttachments: function (ele, section_id, heading) {
        $('#mainheading').html(heading);
        $('#attachments').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#section_id_popup').val(section_id);
        $('#attachments_body').html("");
        $.ajax({
            url: baseurl + '/reports/getAllAttachments',
            data: 'form_id=' + $('#form_id_popup').val() + "&section_id=" + section_id + "&assign_id=" + $('#form_assign_id_popup').val(),
            type: 'post',
        }).done(function (msg) {
            $.LoadingOverlay("hide");
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $('#attachments_body').html(obj.html);
            } else {
                alert('Error: Something went wrong.');
            }
        });
    },
};
var evidence_verification = {
    getallevidence: function (ele) {
        if ($("#department").val() == "") {
            alert('Kindly select any entity');
            return false;
        }
        else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        }
        else if ($("#category").val() == "") {
            alert('Kindly select category');
            return false;
        }
        else if ($("#survey_form").val() == "") {
            alert('Kindly select Form');
            return false;
        }
        else {

        }
    }
};
var overall = {
    exportoverall: function () {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        }
        else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/report_counter/exportoverall',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    window.location = global_url + '/attachments/reports/' + obj.name
                }
            });
        }
    },
    updateoverall: function () {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        }
        else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/report_counter/getOverAllReportInsertInDb',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    console.log(obj.data);
                    google.charts.load("current", {packages: ['corechart']});
                    google.charts.setOnLoadCallback(drawStuff);
                    function drawStuff() {

                        var data = google.visualization.arrayToDataTable(obj.data);
                        var view = new google.visualization.DataView(data);
                        var options = {
                            title: "نتائج الجهات",
                            bar: {groupWidth: "70%"},
                            legend: {position: "none"},
                            hAxis: {
                                textStyle: {
                                    fontSize: 18 // or the number you want
                                }
                            }
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div"));
                        chart.draw(view, options);

                    }
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }
    },
    getoverall: function (ele) {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        }
        else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/report_counter/getOverAllNew',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    console.log(obj.data);
                    google.charts.load("current", {packages: ['corechart']});
                    google.charts.setOnLoadCallback(drawStuff);
                    function drawStuff() {

                        var data = google.visualization.arrayToDataTable(obj.data);
                        var view = new google.visualization.DataView(data);
                        var options = {
                            title: "نتائج الجهات",
                            bar: {groupWidth: "70%"},
                            legend: {position: "none"},
                            hAxis: {
                                textStyle: {
                                    fontSize: 18 // or the number you want
                                }
                            }
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("top_x_div"));
                        chart.draw(view, options);

                    }
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }
    }
};
var report_counter = {
    exportcounterreport: function () {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/report_counter/exportCounterReport',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    window.location = global_url + '/attachments/reports/' + obj.name
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }
    },
    getNewcounterreport: function (ele) {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/new_reports/reports/getCounterReport',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#reporting').html(obj.html);
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }
    },
    getcounterreport: function (ele) {
        if ($("#entity").val() == "") {
            alert('Kindly select any entity');
            return false;
        } else if ($("#form_type").val() == "") {
            alert('Kindly select Form Type');
            return false;
        } else {
            $.LoadingOverlay("show");
            $.ajax({
                url: baseurl + '/report_counter/getCounterReport',
                data: $("#counter-form").serialize(),
                type: 'post',
            }).done(function (msg) {
                $.LoadingOverlay("hide");
                var obj = JSON.parse(msg);
                if (obj.success == "yes") {
                    $('#reporting').html(obj.html);
                } else {
                    alert('Error: Something went wrong.');
                }
            });
        }
    }
};

var minWordLength = 2;
function split(val) {
    return val.split(' ');
}
function extractLast(term) {
    return split(term).pop();
}
$(function () {

});
