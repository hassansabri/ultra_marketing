

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo base_url(); ?>assets/template/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

<!-- BOOTSTRAP JS -->
<script src="<?php echo base_url(); ?>assets/template/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo base_url(); ?>assets/template/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="<?php echo base_url(); ?>assets/template/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/fastclick/fastclick.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<script src="<?php echo base_url(); ?>assets/template/js/demo.min.js"></script>

<!-- MAIN APP JS FILE -->
<script src="<?php echo base_url(); ?>assets/template/js/app.min.js"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="<?php echo base_url(); ?>assets/template/js/speech/voicecommand.min.js"></script>

<!-- SmartChat UI : plugin -->
<script src="<?php echo base_url(); ?>assets/template/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/smart-chat-ui/smart.chat.manager.min.js"></script>

<!-- PAGE RELATED PLUGIN(S) -->

<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- Full Calendar -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/bootstrapvalidator/bootstrapValidator.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/loadingoverlay.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/loadingoverlay_progress.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/template/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function () {

        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        pageSetUp();

        /*
         * PAGE RELATED SCRIPTS
         */

        $(".js-status-update a").click(function () {
            var selText = $(this).text();
            var $this = $(this);
            $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
            $this.parents('.dropdown-menu').find('li').removeClass('active');
            $this.parent().addClass('active');
        });

        /*
         * TODO: add a way to add more todo's to list
         */

        // initialize sortable
        $(function () {
            $("#sortable1, #sortable2").sortable({
                handle: '.handle',
                connectWith: ".todo",
                update: countTasks
            }).disableSelection();
        });

        // check and uncheck
        $('.todo .checkbox > input[type="checkbox"]').click(function () {
            var $this = $(this).parent().parent().parent();

            if ($(this).prop('checked')) {
                $this.addClass("complete");

                // remove this if you want to undo a check list once checked
                //$(this).attr("disabled", true);
                $(this).parent().hide();

                // once clicked - add class, copy to memory then remove and add to sortable3
                $this.slideUp(500, function () {
                    $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                    $this.remove();
                    countTasks();
                });
            } else {
                // insert undo code here...
            }

        })
        // count tasks
        function countTasks() {

            $('.todo-group-title').each(function () {
                var $this = $(this);
                $this.find(".num-of-tasks").text($this.next().find("li").size());
            });

        }

        /*
         * RUN PAGE GRAPHS
         */

        /* TAB 1: UPDATING CHART */
        // For the demo we use generated data, but normally it would be coming from the server

        var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);
            // do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }
            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]])
            return res;
        }
        // setup control widget
        var updateInterval = 1500;
        $("#updating-chart").val(updateInterval).change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                $(this).val("" + updateInterval);
            }
        });
        /*
         * FULL CALENDAR JS
         */
        if ($("#calendar").length) {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
//            console.log(new Date(y, m, 1));
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                draggable: true,
                selectable: false,
                selectHelper: true,
                unselectAuto: false,
                disableResizing: false,
                height: "auto",
                header: {
                    left: 'title', //,today
                    center: 'prev, next, today',
//                    right: 'month, agendaWeek, agenDay' //month, agendaDay,
                },
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        }, true // make the event "stick"
                                );
                    }
                    calendar.fullCalendar('unselect');
                },
                events: [{
                        title: 'Route Finish Today',
                        start: new Date(y, m, 1),
//                        description: 'long description',
                        className: ["event", "bg-color-greenLight"],
                        icon: 'fa-check'
                    }, {
                        title: 'Route Finish Today',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        className: ["event", "bg-color-darken"]
                    }],
                eventRender: function (event, element, icon) {
                    if (!event.description == "") {
                        element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                    }
                    if (!event.icon == "") {
                        element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                    }
                }
            });

        }
        /* hide default buttons */
        $('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();
        // calendar prev
        $('#calendar-buttons #btn-prev').click(function () {
            $('.fc-prev-button').click();
            return false;
        });
        // calendar next
        $('#calendar-buttons #btn-next').click(function () {
            $('.fc-next-button').click();
            return false;
        });
        // calendar today
        $('#calendar-buttons #btn-today').click(function () {
            $('.fc-button-today').click();
            return false;
        });
        // calendar month
        $('#mt').click(function () {
            $('#calendar').fullCalendar('changeView', 'month');
        });
        // calendar agenda week
        $('#ag').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });
        // calendar agenda day
        $('#td').click(function () {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });
        /*
         * CHAT
         */
        $.filter_input = $('#filter-chat-list');
        $.chat_users_container = $('#chat-container > .chat-list-body')
        $.chat_users = $('#chat-users')
        $.chat_list_btn = $('#chat-container > .chat-list-open-close');
        $.chat_body = $('#chat-body');
        /*
         * LIST FILTER (CHAT)
         */
        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function (a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };
        function listFilter(list) {// header is any element, list is an unordered list
            // create and add the filter form to the header

            $.filter_input.change(function () {
                var filter = $(this).val();
                if (filter) {
                    // this finds all links in a list that contain the input,
                    // and hide the ones not containing the input while showing the ones that do
                    $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                    $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
                } else {
                    $.chat_users.find("li").slideDown();
                }
                return false;
            }).keyup(function () {
                // fire the above change event after every letter
                $(this).change();
            });
        }
        // on dom ready
//        listFilter($.chat_users);

        // open chat list
        $.chat_list_btn.click(function () {
            $(this).parent('#chat-container').toggleClass('open');
        });
        $.chat_body.animate({
//            scrollTop: $.chat_body[0].scrollHeight
            scrollTop: 0
        }, 500);

    });

</script>
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white"><?php echo $this->lang->line("AllRights"); ?> <?php echo date('Y'); ?>.</span>
        </div>
        <!--        <div class="col-xs-6 col-sm-6 text-right hidden-xs">
                    <div class="txt-color-white inline-block">
                        <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
                        <div class="btn-group dropup">
                            <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                                <i class="fa fa-link"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right text-left">
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Server Load</p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                                        <div class="progress progress-micro no-margin">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="padding-5">
                                        <button class="btn btn-block btn-default">refresh</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>-->
    </div>
</div>
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.fillbetween.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.orderBar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/plugin/flot/jquery.flot.barnumbers.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<!-- SmartChat UI : plugin -->
<!--<script src="<?php echo base_url(); ?>assets/template/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/js/smart-chat-ui/smart.chat.manager.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/switch/dist/js/bootstrap-switch.js"></script>
<script src="<?php echo base_url(); ?>assets/switch/docs/js/main.js"></script>-->
</body>
</html>