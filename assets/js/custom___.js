var availableDates = [];
$(document).ready(function () {


});
var calendar = {
    init: function () {

        $(document).ready(function () {
            $("#createnew").click(function () {
                $(".taskdivs").hide();
                $("#addtaskdiv").show();
            });
            $('#task_date_update').datepicker({
                dateFormat: 'dd-mm-yy',
            });
            $('#task_date').datepicker({
                dateFormat: 'dd-mm-yy',
                autoclose: true,
                beforeShowDay:
                        function (dt)
                        {
                            return [dt.getDay() == 0 || dt.getDay() == 6 || admin_calendar.available(dt), ""];
                        },
            });
            $('#timepicker').timepicker();
            $('#timepicker_update').timepicker();
            // init the calender at the top
            var calendarPicker2 = $("#dsel2").calendarPicker({
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                // useWheel:true,
                // callbackDelay:500,
                years: 0,
                months: 0,
                days: 7,
                showDayArrows: true,
                callback: function (cal) {
                    // get all the project
                    $.ajax({
                        url: baseurl + '/calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {
                        $('#calendarss').html(msg);
                        $.LoadingOverlay("hide");
                    });
                }});

        });
    },
    addNewTask: function (id) {
        $(".taskdivs").hide();
        $("#listing").html("");
        $("#title").val("");
        $("#description").val("");
        $("#timepicker").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#timestamp").val("");
        var objj_id = id;
        var str = objj_id.split('_');
        $("#company_id").val(str[0]);
        $("#project_id").val(str[1]);
        $("#timestamp").val(str[2]);
        $('#edit_task').modal({
            backdrop: 'static',
            keyboard: false
        });
    },
    insertNewTask: function (ele) {
        var thisctb = ele;
        if ($.trim($("#title").val()) != "" && $.trim($("#description").val()) != "" && $.trim($("#task_date").val()) != "") {
            thisctb.attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: baseurl + '/calendar/updateProjectDetail',
                data: $("#add-task-form").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    $.ajax({
                        url: baseurl + '/calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {

                        $('#calendarss').html(msg);
                        $("#title").val("");
                        $("#description").val("");
                        $("#timepicker").val("");
                        $("#company_id").val("");
                        $("#project_id").val("");
                        $("#timestamp").val("");

                        $('#edit_task').modal('hide');
                    });
                    thisctb.removeAttr('disabled');
                }
            });
        } else {
            alert('All Fields are required');
        }
    },
    getAllTasks: function (detail_id, id) {
        // add task fields empty

        $("#title").val("");
        $("#description").val("");
        $("#timepicker").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#timestamp").val("");
        // edit task field empty
        $(".taskdivs").hide();
        $("#listing").html("");
        $("#listing").html("<img style='width:100px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");
        $("#title_update").val("");
        $("#description_update").val("");
        $("#company_id_update").val("");
        $("#project_id_update").val("");
        $("#timepicker_update").val("");
        $("#timestamp_update").val("");
        $("#poject_detail_id").val("");
        $('#attach').html("");
        $('#edit_task').modal({
            backdrop: 'static',
            keyboard: false
        });
        var objj_id = id;
        var str = objj_id.split('_');
        // fill the fields add form 
        $("#company_id").val(str[0]);
        $("#project_id").val(str[1]);
        $("#timestamp").val(str[2]);
        $("#user_id").val(str[3]);
        $.ajax({
            url: baseurl + '/calendar/getAllTaskUnderThisTimeLine',
            data: "timstamp=" + str[2] + "&project_id=" + str[1] + "&company_id=" + str[0],
            type: 'post'
        }).done(function (msg) {
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#listing").html(obj.html);
            } else {
                $("#listing").html("No Task Found");
            }
        });
    },
    editTask: function (detail_id, id, ele) {
        $(".taskdivs").hide();
        ele.parents('label').append("<img id='myloader' style='width:45px;position:absolute;top:0px;right:0px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");
        var $btn = $('#updatetask');
        var $this = $btn;
        $this.attr('disabled', 'disabled').html("Loading...");
        $("#user_id_update").val("");
        $("#title_update").val("");
        $("#description_update").val("");
        $("#company_id_update").val("");
        $("#project_id_update").val("");
        $("#timepicker_update").val("");
        $("#timestamp_update").val("");
        $("#poject_detail_id").val("");
        $('#attach').html("");
        var objj_id = id;
        var str = objj_id.split('_');
        $("#company_id_update").val(str[0]);
        $("#project_id_update").val(str[1]);
        $("#timestamp_update").val(str[2]);
        $("#done").prop("checked", false);
        $.ajax({
            url: baseurl + '/calendar/getProjectDetailInfo',
            data: "poject_detail_id=" + detail_id,
            type: 'post'
        }).done(function (msg) {
            $("#myloader").remove();
            $("#edittaskdiv").show();
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#title_update").val(obj.html.project_detail_title);
                $("#description_update").val(obj.html.project_detail_description);
                $("#company_id_update").val(obj.html.company_id_fk);
                $("#project_id_update").val(obj.html.project_id_fk);
                $("#timestamp_update").val(obj.html.project_date);
                $("#poject_detail_id").val(obj.html.project_detail_id);
                $("#timepicker_update").val(obj.html.project_time);
                $("#task_date_update").val(obj.html.project_date_format);
                if (obj.html.completed == "yes") {
                    $("#done").prop("checked", true);
                    $("#edit-task-form :input").attr("disabled", true);
                    var displaynone = "display:none;";
                } else {
                    var displaynone = "";
                }
                var htm = "";
                var i;
                if (obj.data != "0") {
                    for (i = 0; i < obj.data.length; i++) {
                        var str = obj.data[i]["attachment_name"];
                        str = str.substring(0, 18);
                        htm += '<div  class="col-md-4 deldiv" style=""><i style="' + displaynone + '" onclick="calendar.deleteAttachment($(this))" id="' + obj.data[i]["project_attachments_id"] + '" class="delattachment fa fa-trash-o" style="color: red;"></i>-<a target="_blank" href="' + global_url + 'attachments/' + obj.data[i]["attachment_random_name"] + '">' + str + '</a></div>';
                    }
                    $('#attach').html(htm);
                } else {
                    $('#attach').html("No Attachment Found");
                }
                $('#edit-task-form').find("input[name=iconselect]").parents('label').removeClass('active');
                $('#edit-task-form').find("input[name=priority]").parents('label').removeClass('active');
                $('#edit-task-form').find("input[name=iconselect][value='" + obj.html.project_icon + "']").parents('label').addClass('active');
                $('#edit-task-form').find("input[name=iconselect][value='" + obj.html.project_icon + "']").trigger('click');
                $('#edit-task-form').find("input[name=priority][value='" + obj.html.project_color + "']").parents('label').addClass('active');
                $('#edit-task-form').find("input[name=priority][value='" + obj.html.project_color + "']").trigger('click');
                $this.removeAttr('disabled').html('Update Changes');
            } else {
                alert('Something went wrong');
            }
        });
    },
    updateTask: function (ele) {
        var thisctb = ele;
        if ($.trim($("#title_update").val()) != "" && $.trim($("#description_update").val()) != "" && $.trim($("#task_date_update").val()) != "") {
            thisctb.attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: baseurl + '/calendar/editProjectDetail',
                data: $("#edit-task-form").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    $.ajax({
                        url: baseurl + '/calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {
                        $('#calendarss').html(msg);
                        $("#title_update").val("");
                        $("#description_update").val("");
                        $("#timepicker_update").val("");
                        $("#company_id_update").val("");
                        $("#project_id_update").val("");
                        $("#timestamp_update").val("");
                        $("#poject_detail_id").val("");
                        $("#user_id_update").val("");
                        $('#edit_task').modal('hide');
                    });
                    thisctb.removeAttr('disabled');
                }
            });
        } else {
            alert('All Fields are required');
        }
    },
    available: function (date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, availableDates) != -1) {
            return false;
        } else {
            return true;
        }
    },
    deleteAttachment: function (ele) {
        // var flag = confirm("Are you sure you want to delete?");
        var thisvar = ele;
        var srtimplod = thisvar.attr('id');
        thisvar.parent('.deldiv').remove();
        if (srtimplod) {
            $.ajax({
                type: "POST",
                url: global_url + 'en/calendar/deleteAttachment',
                data: "attachment_id=" + srtimplod,
            }).done(function (msg) {
                if (msg == "0") {

                } else {

                }
            });
        }
    },
    uploadAttachment: function (ele) {
        var current_attachment;
        current_attachment = ele;
        ele.siblings('label').append("<img id='myloaderupload' style='width:45px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");
        var form_data = new FormData(); // Creating object of FormData class
        var file_data = $("#current_attachment").prop("files")[0]; // Getting the properties of file from file field
        if (file_data) {
            form_data.append("file", file_data)                     // Appending parameter named file with properties of file_field to form_data   
        }
        form_data.append("company_id", $("#company_id_update").val())                    // Adding extra parameters to form_data
        form_data.append("project_id", $("#project_id_update").val())                     // Adding extra parameters to form_data
        form_data.append("timestamp", $("#timestamp_update").val())                     // Adding extra parameters to form_data
        form_data.append("poject_detail_id", $("#poject_detail_id").val())                     // Adding extra parameters to form_data
        $.ajax({
            url: global_url + 'en/calendar/uploadAttachment',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post'
        }).done(function (msg) {
            $('#myloaderupload').remove();
            if (msg != "0") {
                var i;
                var htm = "";
                for (i = 0; i < msg.data.length; i++) {
                    var str = msg.data[i]["attachment_name"];
                    str = str.substring(0, 18);
                    htm += '<div class="col-md-4 deldiv" style=""><i id="' + msg.data[i]["project_attachments_id"] + '" class="delattachment fa fa-trash-o" style="color: red;"></i>-<a target="_blank" href="' + global_url + 'attachments/' + msg.data[i]["attachment_random_name"] + '">' + str + '</a></div>';
                }
                $('#attach').html(htm);
                current_attachment.val("");
            } else {

            }

        });
    },
    disabledForm: function (ele) {
        if (ele.is(":checked")) {
//            $("#formfields :input").attr("disabled", true);
        } else {
//            $("#formfields :input").attr("disabled", false);
        }
    }
};
var admin_calendar = {
    init: function () {
        $(document).ready(function () {



            $("#createnew").click(function () {
                $(".taskdivs").hide();
                $("#addtaskdiv").show();
            });
            $('#task_date_update').datepicker({
                dateFormat: 'dd-mm-yy',
            });
            $('#task_date').datepicker({
                dateFormat: 'dd-mm-yy',
                autoclose: true,
                beforeShowDay:
                        function (dt)
                        {
                            return [dt.getDay() == 0 || dt.getDay() == 6 || admin_calendar.available(dt), ""];
                        },
            });
            // init the calender at the top
            var calendarPicker2 = $("#dsel2").calendarPicker({
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                //useWheel:true,
                //callbackDelay:500,
                years: 0,
                months: 0,
                days: 7,
                showDayArrows: true,
                callback: function (cal) {
                    // get all the project
                    $.ajax({
                        url: baseurl + '/admin_calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {
                        $('#calendarss').html(msg);
                        $.LoadingOverlay("hide");
                    });
                }});
            // save daily task
            // open add event model
            $('#timepicker').timepicker();
            $('#timepicker_update').timepicker();
        });
    },
    addNewTask: function (id) {
        $(".taskdivs").hide();
        $("#listing").html("");
        $("#title").val("");
        $("#user_id").val("");
        $("#description").val("");
        $("#timepicker").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#timestamp").val("");
        var objj_id = id;
        var str = objj_id.split('_');
        $("#company_id").val(str[0]);
        $("#project_id").val(str[1]);
        $("#timestamp").val(str[2]);
        $("#user_id").val(str[3]);
        $('#edit_task').modal({
            backdrop: 'static',
            keyboard: false
        });
    },
    insertNewTask: function (ele) {
        var thisctb = ele;
        if ($.trim($("#title").val()) != "" && $.trim($("#description").val()) != "" && $.trim($("#task_date").val()) != "") {
            thisctb.attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: baseurl + '/admin_calendar/updateProjectDetail',
                data: $("#add-task-form").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    $.ajax({
                        url: baseurl + '/admin_calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {
                        $('#calendarss').html(msg);
                        $("#title").val("");
                        $("#description").val("");
                        $("#timepicker").val("");
                        $("#company_id").val("");
                        $("#project_id").val("");
                        $("#timestamp").val("");
                        $('#edit_task').modal('hide');
                    });
                    thisctb.removeAttr('disabled');
                }
            });
        } else {
            alert('All Fields are required');
        }
    },
    getAllTasks: function (detail_id, id) {
        // add task fields empty
        $("#title").val("");
        $("#user_id").val("");
        $("#description").val("");
        $("#timepicker").val("");
        $("#company_id").val("");
        $("#project_id").val("");
        $("#timestamp").val("");
        // edit task field empty
        $(".taskdivs").hide();
        $("#listing").html("");
        $("#user_id_update").val("");
        $("#title_update").val("");
        $("#description_update").val("");
        $("#company_id_update").val("");
        $("#project_id_update").val("");
        $("#timepicker_update").val("");
        $("#timestamp_update").val("");
        $("#poject_detail_id").val("");
        $('#attach').html("");
        $('#edit_task').modal({
            backdrop: 'static',
            keyboard: false
        });
        var objj_id = id;
        var str = objj_id.split('_');
        // fill the fields add form 
        $("#company_id").val(str[0]);
        $("#project_id").val(str[1]);
        $("#timestamp").val(str[2]);
        $("#user_id").val(str[3]);
        $.ajax({
            url: baseurl + '/admin_calendar/getAllTaskUnderThisTimeLine',
            data: "timstamp=" + str[2] + "&user_id=" + str[3] + "&project_id=" + str[1] + "&company_id=" + str[0],
            type: 'post'
        }).done(function (msg) {
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#listing").html(obj.html);
            }
        });
    },
    editTask: function (detail_id, id, ele) {
        $(".taskdivs").hide();
        ele.parents('label').append("<img id='myloader' style='width:45px;position:absolute;top:0px;right:0px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");
        var cellthis = $(this);
        var $btn = $('#updatetask');
        var $this = $btn;
        $this.attr('disabled', 'disabled').html("Loading...");
        $("#user_id_update").val("");
        $("#title_update").val("");
        $("#description_update").val("");
        $("#company_id_update").val("");
        $("#project_id_update").val("");
        $("#timepicker_update").val("");
        $("#timestamp_update").val("");
        $("#poject_detail_id").val("");
        $('#attach').html("");
        var objj_id = id;
        var str = objj_id.split('_');
        $("#company_id_update").val(str[0]);
        $("#project_id_update").val(str[1]);
        $("#timestamp_update").val(str[2]);
        $("#user_id_update").val(str[3]);
//        $("#formfields :input").attr("disabled", false);
//        $("#edit-task-form :input").attr("disabled", false);
        $("#done").prop("checked", false);
        $.ajax({
            url: baseurl + '/admin_calendar/getProjectDetailInfo',
            data: "poject_detail_id=" + detail_id,
            type: 'post'
        }).done(function (msg) {
            $("#myloader").remove();
            $("#edittaskdiv").show();
            var obj = JSON.parse(msg);
            if (obj.success == "yes") {
                $("#title_update").val(obj.html.project_detail_title);
                $("#description_update").val(obj.html.project_detail_description);
                $("#company_id_update").val(obj.html.company_id_fk);
                $("#project_id_update").val(obj.html.project_id_fk);
                $("#timestamp_update").val(obj.html.project_date);
                $("#poject_detail_id").val(obj.html.project_detail_id);
                $("#timepicker_update").val(obj.html.project_time);
                $("#task_date_update").val(obj.html.project_date_format);
                $("#user_id_update").val(obj.html.user_id_fk);
                if (obj.html.completed == "yes") {
                    $("#done").prop("checked", true);
//                    $("#edit-task-form :input").attr("disabled", true);
                }
                var htm = "";
                var i;
                if (obj.data != "0") {
                    for (i = 0; i < obj.data.length; i++) {
                        var str = obj.data[i]["attachment_name"];
                        str = str.substring(0, 18);
                        htm += '<div  class="col-md-4 deldiv" style=""><i onclick="admin_calendar.deleteAttachment($(this))" id="' + obj.data[i]["project_attachments_id"] + '" class="delattachment fa fa-trash-o" style="color: red;"></i>-<a target="_blank" href="' + global_url + 'attachments/' + obj.data[i]["attachment_random_name"] + '">' + str + '</a></div>';
                    }
                    $('#attach').html(htm);
                } else {
                    $('#attach').html("No Attachment Found");
                }
                $('#edit-task-form').find("input[name=iconselect]").parents('label').removeClass('active');
                $('#edit-task-form').find("input[name=priority]").parents('label').removeClass('active');
                $('#edit-task-form').find("input[name=iconselect][value='" + obj.html.project_icon + "']").parents('label').addClass('active');
                $('#edit-task-form').find("input[name=iconselect][value='" + obj.html.project_icon + "']").trigger('click');
                $('#edit-task-form').find("input[name=priority][value='" + obj.html.project_color + "']").parents('label').addClass('active');
                $('#edit-task-form').find("input[name=priority][value='" + obj.html.project_color + "']").trigger('click');
                $this.removeAttr('disabled').html('Update Changes');
            } else {
                alert('Something went wrong');
            }
        });
    },
    updateTask: function (ele) {
        var thisctb = ele;
        if ($.trim($("#title_update").val()) != "" && $.trim($("#description_update").val()) != "" && $.trim($("#task_date_update").val()) != "") {
            thisctb.attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: baseurl + '/admin_calendar/editProjectDetail',
                data: $("#edit-task-form").serialize(), // serializes the form's elements.
                success: function (data)
                {
                    $.ajax({
                        url: baseurl + '/admin_calendar/getInfo',
                        data: {datearray: datearray},
                        type: 'post'
                    }).done(function (msg) {
                        $('#calendarss').html(msg);
                        $("#title_update").val("");
                        $("#description_update").val("");
                        $("#timepicker_update").val("");
                        $("#company_id_update").val("");
                        $("#project_id_update").val("");
                        $("#timestamp_update").val("");
                        $("#poject_detail_id").val("");
                        $("#user_id_update").val("");
                        $('#edit_task').modal('hide');
                    });
                    thisctb.removeAttr('disabled');
                }
            });
        } else {
            alert('All Fields are required');
        }
    },
    available: function (date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, availableDates) != -1) {
            return false;
        } else {
            return true;
        }
    },
    deleteAttachment: function (ele) {
        // var flag = confirm("Are you sure you want to delete?");
        var thisvar = ele;
        var srtimplod = thisvar.attr('id');
        thisvar.parent('.deldiv').remove();
        if (srtimplod) {
            $.ajax({
                type: "POST",
                url: global_url + 'en/admin_calendar/deleteAttachment',
                data: "attachment_id=" + srtimplod,
            }).done(function (msg) {
                if (msg == "0") {

                } else {

                }
            });
        }
    },
    uploadAttachment: function (ele) {
        var current_attachment;
        current_attachment = ele;
        ele.siblings('label').append("<img id='myloaderupload' style='width:45px;position:absolute;top:0px;right:0px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");

        var form_data = new FormData(); // Creating object of FormData class
        var file_data = $("#current_attachment").prop("files")[0]; // Getting the properties of file from file field
        if (file_data) {
            form_data.append("file", file_data)                     // Appending parameter named file with properties of file_field to form_data   
        }
        form_data.append("company_id", $("#company_id_update").val())                    // Adding extra parameters to form_data
        form_data.append("project_id", $("#project_id_update").val())                     // Adding extra parameters to form_data
        form_data.append("timestamp", $("#timestamp_update").val())                     // Adding extra parameters to form_data
        form_data.append("poject_detail_id", $("#poject_detail_id").val())                     // Adding extra parameters to form_data
        $.ajax({
            url: global_url + 'en/admin_calendar/uploadAttachment',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post'
        }).done(function (msg) {
            $('#myloaderupload').remove();
            if (msg != "0") {
                var i;
                var htm = "";
                for (i = 0; i < msg.data.length; i++) {
                    var str = msg.data[i]["attachment_name"];
                    str = str.substring(0, 18);
                    htm += '<div class="col-md-4 deldiv" style=""><i id="' + msg.data[i]["project_attachments_id"] + '" class="delattachment fa fa-trash-o" style="color: red;"></i>-<a target="_blank" href="' + global_url + 'attachments/' + msg.data[i]["attachment_random_name"] + '">' + str + '</a></div>';
                }
                $('#attach').html(htm);
                current_attachment.val("");
            } else {

            }

        });
    },
    disabledForm: function (ele) {
        if (ele.is(":checked")) {
//            $("#formfields :input").attr("disabled", true);
        } else {
//            $("#formfields :input").attr("disabled", false);
        }
    },
    deleteTask: function (detail_id, id, ele) {
        var flag = confirm("Are you sure you want to delete this task?");
        if (flag) {
            ele.parents('.paddingclass').remove();
//        ele.parents('label').append("<img id='myloader' style='width:45px;position:absolute;top:0px;right:0px;' src='" + global_url + "/assets/img/loading_spinner.gif'/>");
            var $btn = $('#updatetask');
            $.ajax({
                url: baseurl + '/admin_calendar/deleteTask',
                data: "poject_detail_id=" + detail_id,
                type: 'post'
            }).done(function (msg) {
                $.ajax({
                    url: baseurl + '/admin_calendar/getInfo',
                    data: {datearray: datearray},
                    type: 'post'
                }).done(function (msg) {
                    $('#calendarss').html(msg);
                    $("#title_update").val("");
                    $("#description_update").val("");
                    $("#timepicker_update").val("");
                    $("#company_id_update").val("");
                    $("#project_id_update").val("");
                    $("#timestamp_update").val("");
                    $("#poject_detail_id").val("");
                    $("#user_id_update").val("");
                    $('#edit_task').modal('hide');
                });
            });
        }
    },
};
var projects = {
    init: function () {
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
                                message: 'The Title is required'
                            },
                        }
                    },
                    description: {
                        validators: {
                            notEmpty: {
                                message: 'The Description is required'
                            },
                        }
                    },
                    company: {
                        validators: {
                            notEmpty: {
                                message: 'The Company is required'
                            },
                        }
                    },
                    users: {
                        validators: {
                            notEmpty: {
                                message: 'The Users are required'
                            },
                        }
                    },
                }
            });
        });
        $(document).on("change", ".changestatus", function () {
            var status;
            if ($(this).val() == "1") {
                $(this).val("0");
                status = "0";
            } else {
                $(this).val("1");
                status = "1";
            }
            var project_id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: baseurl + '/project/changestatus',
                data: "project_id=" + project_id + "&status=" + status,
                success: function (response)
                {

                }
            });
        });

    },
};
var user = {
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
            $.ajax({
                type: "POST",
                url: baseurl + '/users/changestatus',
                data: "user_id=" + userid + "&status=" + status,
                success: function (response)
                {

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
            $.ajax({
                type: "POST",
                url: baseurl + '/users/updatepermissions',
                data: "user_id=" + user_id + "&type_id=" + type_id + "&action=" + action,
                success: function (response)
                {

                }
            });
        });
    },
};
var inbox = {
    request: null,
    request2: null,
    first: null,
    startchating: function (user_id, name) {
        $("#user_full_name").html(name);
        $('#pid').val(user_id);
        if ($("#chatstrat").val() == "0") {
            $("#chatstrat").val("1");
            setInterval(function () {

                inbox.GetLatestMessage($("#loginid").val(), $("#time").val());
            }, 5000);
        } else {

        }



    },
    init: function () {
        $(document).ready(function () {
           
            $('#msgReply').keydown(function (e) {
                if (e.keyCode == 13 && !e.shiftKey)
                {
                    // send message
                    e.preventDefault();
                    $("#sendmessage").trigger("click");
                } else if (e.keyCode == 13) {

                }
            });
            $('#msgNewReply').keydown(function (e) {
                if (e.keyCode == 13 && !e.shiftKey)
                {
                    // send message
                    e.preventDefault();
                    $("#sendNewmessage").trigger("click");
                } else if (e.keyCode == 13) {

                }
            });
//            $('.tooltips').tooltipster({
//                content: 'Loading...',
//                contentAsHTML: true,
//                interactive: true,
//                trigger: 'click',
//                functionBefore: function (origin, continueTooltip) {
//                    // we'll make this function asynchronous and allow the tooltip to go ahead and show the loading notification while fetching our data
//                    continueTooltip();
//                    // next, we want to check if our data has already been cached
//                    if (origin.data('ajax') !== 'cached') {
//                        $.ajax({
//                            type: 'POST',
//                            url: global_url + 'index.php/smileys',
//                            success: function (data) {
//                                // update our tooltip content with our returned data and cache it
//                                origin.tooltipster('content', data).data('ajax', 'cached');
//                            }
//                        });
//                    }
//                }
//            });
        });



    },
    showchckboxes: function () {
        $("#msgReply").val("");
        $(".sndmessage").css("display", "none");
        $(".del-message").css("display", "block");
        $(".delmessage").css("display", "inline");
    },
    canceldelete: function () {
        $("#msgReply").val("");
        $(".sndmessage").css("display", "block");
        $(".del-message").css("display", "none");
        $(".delmessage").css("display", "none");
    },
    showall: function () {
        $(".hideallusers").slideToggle("slow", function () {
            if ($('.hideallusers').is(':hidden')) {
                $("#chatingdiv").show();
            } else {
                $("#chatingdiv").hide();
            }
        });
    },
    delconvlist: function (threaad_id, elem) {
        $.Zebra_Dialog('' + alertmessage.Sureyouwantconversation + '?', {
            'type': 'warning',
            'title': ' ',
            'custom_class': 'myclass',
            'buttons': [
                {caption: '' + alertmessage.Yes + '', callback: function (ele) {
                        $(".lithread_" + threaad_id).remove();
                        var pos2 = $("#mesageuser").find('li').html();
                        if (!pos2) {
                            $("#mesagethread").html("<div class='noconvesation'><div align='center'>" + alertmessage.NoConversationselected + "</div></div>");
                            $("#chatwith").attr("");
                            $("#chatwith").html("");
                            $("#sndmessage").remove();
                            $(".widget-content").css("overflow", "hidden");
                        } else {
                            $("#mesageuser").find('li').find('a').trigger('click')
                        }
                        $.ajax({
                            type: "POST",
                            url: global_url + 'index.php/inbox/delconvlist/',
                            data: "threaad_id=" + threaad_id,
                        }).done(function (msg) {
                            if (msg == '1') {
                                $.Zebra_Dialog('' + alertmessage.Yourconversationdeleted + '.', {
                                    'type': 'Confirmation',
                                    'title': ' ',
                                    'custom_class': 'myclass',
                                });
                            } else {
                                $.Zebra_Dialog('' + alertmessage.Erroroccureddeletingthevideo + '', {
                                    'title': ' ',
                                    'custom_class': 'myclass',
                                    'type': 'error',
                                    'position': ['right - 20', 'top + 20']
                                });
                                $(ele).html(htm);
                            }
                        });
                    }},
                {caption: '' + alertmessage.No + '', callback: function () {
                    }},
            ]
        });
    },
    deleteMessage: function () {
        $("#delete").attr("disabled", "disabled");
        var x = 0;
        var chk = document.getElementsByName('messageid[]');
        var len = chk.length;
        for (i = 0; i < len; i++)
        {
            if (chk[i].checked) {
                x = x + 1;
            }
        }
        if (x > 0) {
            $(".del-message").append("<img  class='delmessageloader' src='" + global_url + "assets/common/img/loadersvg_2.svg' />");
            var url = global_url + 'index.php/inbox/deleteMessage';
            var message = $("#messageid").val();
            $.ajax({
                type: "POST",
                url: url,
                data: $('.delmessage:checked').serialize(),
            }).done(function (msg) {

                var data = jQuery.parseJSON(msg);

                for (i = 0; i < data.ids.length; i++) {
                    text = data.ids[i];
                    $("#" + text).remove();

                }

                $(".delmessageloader").remove();
                $.Zebra_Dialog('' + alertmessage.Yourmessagedeleted + '.', {
                    'type': 'Confirmation',
                    'title': ' ',
                    'custom_class': 'myclass',
                });
                $("#delete").removeAttr("disabled");
            });
        } else {
            $.Zebra_Dialog('' + alertmessage.Kindlyselectatleast + '.', {
                'type': 'error',
                'title': ' ',
                'custom_class': 'myclass',
            });
            $("#delete").removeAttr("disabled");
        }
    },
    GetLatestMessage: function (id, curTime) {
        if (inbox.request2) {
            inbox.request2.abort();
        }
        inbox.request2 = $.ajax({
            type: "POST",
            url: baseurl + '/inbox/GetLatestMessage/',
            data: "userid=" + id + "&curTime=" + curTime + "&thread_id=" + $("#threadid").val(),
        }).done(function (msg) {
            var data = jQuery.parseJSON(msg);

            if (data.html != "") {
                if (inbox.request2) {
                    inbox.request2.abort();
                }
                $("#time").val(data.time);
                var uniqid = randString(4);
                if (parseInt($("#loginid").val()) != parseInt(data.senderid)) {
                    var aSound = document.createElement('audio');
                    aSound.setAttribute('src', global_url + '/assets/hello.mp3');
                    aSound.play();
                }
                data.html += '<span id="' + uniqid + '"></span>'
                $("#mesagethread").append(data.html);
            } else {
                $("#time").val(curTime);
            }
        });
    },
    sendMessage: function (loginUserId) {
        if (inbox.request) {
            inbox.request.abort();
        }
//        $(".newwidget-content").removeClass("nano");
//        $("#mesagethread").removeClass("nano-content");
//        $(".newwidget-content").nanoScroller({destroy: true});
        if ($("#sendmsgvalue").val() == "0") {
            $("#sendmsgvalue").val("1");
            setTimeout('$("#sendmsgvalue").val("0");', 5000);
            $('#sendmessage').attr('disabled', 'disabled');
            var url = baseurl + '/inbox/sendMessageInbox';
            var ids = $("#pid").val();
            var curTime = $("#time").val();
            var message = $("#msgReply").val();
            $("#msgReply").val("");
            $("#msgReply").val();
            var uniqid = randString(4);
            var uniqid2 = randString(5);
            if (message != "" && ids != '') {
                var htm = "<li  id=''  class='current-user " + uniqid2 + "' >\n\
                        <img width='30' height='30' src='" + $("#logoss").val() + "'><div class='bubble'>\n\
                        <a class='user-name' href='javascript:;'>" + $("#name").val() + "</a>\n\
                        <p class='message'>" + escapeHtml(message) + "</p>\n\
                        <p class='time'><strong>2 seconds ago</strong></p>\n\
                        </div>\n\
                        </li>\n\
                        <span id='myspan'></span><span id='" + uniqid + "'><span>";
                $('#sendmessage').removeAttr('disabled');
                $("#mesagethread").append(htm);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: "pid=" + ids + "&msgReply=" + message,
                }).done(function (msg) {
                    var data = jQuery.parseJSON(msg);
                    $("." + uniqid).val(data.inserted_id);
                    $("." + uniqid2).attr("id", data.inserted_id);
                    $("." + uniqid2).find(".bubble").find(".message").html(data.message);
                });
            } else {
                $('#sendmessage').removeAttr('disabled');
            }
        } else {
            alert("please Wait...");
        }

    },
    getFirstMessage: function (username, fullname, uid) {
        $(".inboxclass").removeClass("inboxclass");
        $(".my_" + uid).addClass("inboxclass");
        $(".my_" + uid).removeClass("isread");
        if ($(".newwidget-content").hasClass('nano')) {
//            $(".newwidget-content").removeClass("nano");
//            $("#mesagethread").removeClass("nano-content");
//            $(".newwidget-content").nanoScroller({destroy: true});
        }

        $("#allmessages").val("0");
        $("#messageoffset").val("10");
        $(".newwidget-content").css("overflow", "hidden");
        $("#newmessagediv").css("display", "none");
        $("#chatingdiv").css("display", "block");
        $("#delete_messages").attr("disabled", "disabled");
        $("#new_messages").attr("disabled", "disabled");
        $("#loadmore").remove();
        if (inbox.request) {
            inbox.request.abort();
        }
        if (inbox.first) {
            inbox.first.abort();
        }
        $("#mesagethread").html("<img src='" + global_url + "assets/common/img/loadersvg_2.svg' />");
        $("#chatwith").html(fullname);
        $("#chatwith").attr("href", global_url + username);
        inbox.first = $.ajax({
            type: "POST",
            url: global_url + 'index.php/inbox/getFirstMessage/',
            data: "username=" + username,
        }).done(function (msg) {
            var data = jQuery.parseJSON(msg);
            var httml = '<span id="scrolltothis"></span>';
            httml += data.html + httml;
            $("#mesagethread").html(httml);
            $("#threadid").val(data.thread_id);
            $("#pid").val(uid);
            $("#allmessages").val(data.allmessages);
            $("#delete_messages").removeAttr("disabled");
            $("#new_messages").removeAttr("disabled");
            if (parseInt($("#allmessages").val()) > parseInt($("#messageoffset").val())) {
                $("#ldmr").html("<div class='loadmore' id='loadmore' onclick='inbox.loadMoreMessage(" + data.thread_id + ")'><div align='center' class='loadmoreinner'>" + alertmessage.LoadMoreMessages + "</div></div><br/>");
            }
            var areaheight = parseInt(parseInt($("#chatingdiv").height()) - (parseInt($(".heading").height()) + parseInt($(".sndmessage").height())));
            if (parseInt($("#mesagethread").height()) > parseInt($(".newwidget-content").height())) {
                if ($(".newwidget-content").hasClass('nano')) {
//                    console.log("ok");
                    $(".newwidget-content").nanoScroller({scroll: 'bottom'});

                } else {
//                    console.log("ok2");
                    $(".newwidget-content").addClass("nano");
                    $("#mesagethread").addClass("nano-content");
                    $(".newwidget-content").nanoScroller({scroll: 'bottom'});
                }

            } else {
                if ($(".newwidget-content").hasClass('nano')) {

                    $(".newwidget-content").nanoScroller({scroll: 'bottom'});

                }
            }
        });
    },
    loadMoreMessage: function (thread_id) {
        $(".loadmoreinner").html("<img src='" + global_url + "assets/common/img/loadersvg_2.svg' />");
        var offset = $("#messageoffset").val();
        $("#messageoffset").val(parseInt(parseInt($("#messageoffset").val()) + 10));
        $.ajax({
            type: "POST",
            url: global_url + 'index.php/inbox/loadMoreMessage/',
            data: "thread_id=" + thread_id + "&offset=" + offset,
        }).done(function (msg) {
            var data = jQuery.parseJSON(msg);


            $("#mesagethread").prepend(data.html);
            $(".loadmoreinner").html("Load More Messages");
            if (parseInt($("#allmessages").val()) <= parseInt($("#messageoffset").val())) {
                $("#loadmore").remove();
            }
            if (parseInt($("#mesagethread").height()) > parseInt($(".newwidget-content").height())) {
                if ($(".newwidget-content").hasClass('nano')) {
                    $(".newwidget-content").nanoScroller({scrollTo: $('#scrolltothis')});

                } else {
                    $(".newwidget-content").addClass("nano");
                    $("#mesagethread").addClass("nano-content");
                    $(".newwidget-content").nanoScroller({scrollTo: $('#scrolltothis')});

                }
            } else {
                if ($(".newwidget-content").hasClass('nano')) {
                    $(".newwidget-content").nanoScroller({scrollTo: $('#scrolltothis')});

                }
            }
            $("#scrolltothis").remove();
            var httml = '<span id="scrolltothis"></span>';
            $("#mesagethread").prepend(httml);
        });
    },
    newMessage: function () {
        $("#newmessagediv").css("display", "block");
        $("#chatingdiv").css("display", "none");
        $(".newwidget-content").css("overflow", "hidden");
    }
};
function randString(n)
{
    if (!n)
    {
        n = 5;
    }

    var text = '';
    var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for (var i = 0; i < n; i++)
    {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return text;
}
function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}