<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title>Marketing</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.steps.css">
        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-skins.min.css">
        <!-- SmartAdmin RTL Support  -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-rtl.min.css">
        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/demo.min.css">
        <!-- FAVICONS -->
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo base_url(); ?>assets/favicons/manifest.json">
        <link rel="mask-icon" href="<?php echo base_url(); ?>assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/template/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/template/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/template/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/template/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/template/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/template/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/template/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
        <!--<link href="<?php echo base_url(); ?>assets/js/pnotify/dist/pnotify.css" rel="stylesheet">-->
        <!-- jQuery -->
   <!--<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>-->
        <!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/template/js/plugin/pace/pace.min.js"></script>
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.steps.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDOdbqj_VlYUEcSaYc-hoasCL6bG29rvsU&sensor=false&libraries=places"></script>
        <!--<script language="javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDBpVrFqgWFLyobGU5zf4oiivAyzYae0L0"></script>--> 
        <script type="text/javascript">
            var baseurl = '<?php echo site_url(); ?>';
            var global_url = '<?php echo base_url(); ?>';
            var globarray = [];
            var datearray = [];
            var montharray = [];
        </script>
        <link rel=stylesheet href="<?php echo base_url(); ?>assets/css/jquery.calendarPicker.css" type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.calendarPicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    </head>
    <body style="background:#F7F7F7;" class="">
        <header id="header">
            <div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo" style="margin-top: 3px;"> 
                    <img style="height: 46px;    width: 63px;" src="<?php echo base_url(); ?>assets/img/ki-logo.png" alt="Kafaat International"> Kafaat International 
                </span>
            </div>
            <!-- projects dropdown -->
            <!-- end projects dropdown -->
            <!-- pulled right: nav area -->
            <div class="pull-right">
                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->
                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown " data-toggle="dropdown"> 
                            <?php
                            $user_image_h = $this->session->userdata('user_image');
                            if (isset($user_image_h) && $user_image_h != "") {
                                $user_image_h = $user_image_h;
                            } else {
                                $user_image_h = 'noimage.png';
                            }
                            ?>
                            <!-- <img src="<?php echo base_url(); ?>script/timthumb.php?src=<?php echo base_url(); ?>images/user/<?php echo $user_image_h; ?>&w=30&h=0&zc=20&q=1"alt="me" class="online" style=""> -->
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/users/editprofile" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> Edit Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/users/changepassword" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> Change Password</a>
                            </li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?php echo site_url(); ?>/login/logout" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->
                <!-- multiple lang dropdown : find all flags in the flags page -->
                <ul class="header-dropdown-list hidden-xs">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="active">
                                <a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- end multiple lang -->
            </div>
            <!-- end pulled right: nav area -->
        </header>
        <aside id="left-panel">
            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?php echo base_url(); ?>script/timthumb.php?src=<?php echo base_url(); ?>images/user/<?php echo $user_image_h; ?>&w=30&h=0&zc=20&q=1" alt="me" class="online" /> 
                        <span>
                            <?php echo $name = $this->session->userdata('name'); ?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a> 
                </span>
            </div>
            <!-- end user info -->
            <?php $user_type = $this->session->userdata('user_type'); ?>
            <!-- NAVIGATION : This navigation is also responsive-->
            <nav>
                <!-- 
                NOTE: Notice the gaps after each icon usage <i></i>..
                Please note that these links work a bit different than
                traditional href="" links. See documentation for details.
                -->
                <?php
                if (!$this->session->userdata('access')) {
                    redirect(site_url());
                }
//                print_r($this->session->userdata('access'));
                ?>
                <ul>                     
                    <!-- 2 is for users management-->
                    <?php if (in_array(1, $this->session->userdata('access'))) { ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Users</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users" title="All Users"><span class="menu-item-parent"> All Users</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users/adduser" title="New User"><span class="menu-item-parent">Add New User</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 

                    <?php if (in_array(1, $this->session->userdata('access'))) { ?>
                        <li class="">    
                            <a href="#" title="Departments"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Entity</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/department" title="All Departments"><span class="menu-item-parent"> All Entities</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 

                    <?php if (in_array(3, $this->session->userdata('access'))) { ?>
                        <li class="">    
                            <a href="#" title="Manage Survey Forms"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Manage Forms</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/survey" title="All Survey Forms"><span class="menu-item-parent">All Survey Forms</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/survey/add" title="Add Survey Forms"><span class="menu-item-parent">Add Survey Forms</span></a>
                                </li>

                            </ul>
                        </li> 
                    <?php } ?>
                    <?php if (in_array(4, $this->session->userdata('access'))) { ?>
                        <li class="">    
                            <a href="<?php echo site_url(); ?>/projects" title="Departments"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Projects</span></a>
                            <!--                            <ul>
                                                            <li class="">
                                                                <a href="<?php echo site_url(); ?>/projects" title="All Projects"><span class="menu-item-parent"> All Projects</span></a>
                                                            </li>
                                                            <li class="">
                                                                <a href="<?php echo site_url(); ?>/projects/create_project" title="Add Projects"><span class="menu-item-parent"> Add Projects</span></a>
                                                            </li>
                                                        </ul>	-->
                        </li> 
                        <li class="">    
                            <a href="<?php echo site_url(); ?>/survey/assignform" title="Assign  Survey Forms"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Assign Survey Forms</span></a>
                            <!--                            <ul>
                            
                                                                                            <li>
                                                                                                <a href="<?php echo site_url(); ?>/survey/allassignform" title="Assign Survey Form"><span class="menu-item-parent">All Assign Survey Form</span></a>
                                                                                            </li>
                                                            <li>
                                                                <a href="<?php echo site_url(); ?>/survey/assignform" title="Assign Survey Form"><span class="menu-item-parent">Assign Survey Form</span></a>
                                                            </li>
                                                        </ul>	-->
                        </li>
                    <?php } ?>

                    <!-- 2 is for Statistics / Graphs-->

                    <?php if (in_array(2, $this->session->userdata('access'))) { ?>
                        <li class="">    
                            <a href="<?php echo site_url(); ?>/users/allassignform" title="Survey Forms"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Survey Forms (USER)</span></a>
                            <!--                            <ul>
                                                            <li>
                                                                <a href="" title="Assign Survey Form"><span class="menu-item-parent">All Assign Survey Form</span></a>
                                                            </li>
                            
                                                        </ul>	-->
                        </li>
                    <?php } ?>
                    <?php if (in_array(8, $this->session->userdata('access'))) { ?>
                        <li class="">      
                            <a href="<?php echo site_url(); ?>/reports/report_one/27" title="Master Review Sheet"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Master Review Sheet</span></a>
                        </li> 
                    <?php } ?> 
                    <?php if (in_array(9, $this->session->userdata('access'))) { ?>
                        <li class="">      
                            <a href="<?php echo site_url(); ?>/reports/reportbydepartment" title="Master Review Sheet"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Bar Chart By Department</span></a>
                        </li> 
                    <?php } ?> 
                    <?php if (in_array(1, $this->session->userdata('access'))) { ?>
                        <li class="">      
                            <a href="<?php echo site_url(); ?>/reports/reviewCompleteSurvey" title="Report3"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Report Verification</span></a>
                        </li>
                    <?php } ?> 
                    <?php if (in_array(1, $this->session->userdata('access'))) { ?>
                        <li class="">    
                            <a href="#" title="MS Reports"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">MS Reports</span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo site_url(); ?>/report_counter/" title="Evidence Verification"><span class="menu-item-parent">Report Counter</span></a>
                                </li>
                            </ul>	
                        </li>
                    <?php } ?> 
                </ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"> 
                <i class="fa fa-arrow-circle-left hit"></i> 
            </span>
        </aside>