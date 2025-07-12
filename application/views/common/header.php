<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $cflag = "us";
            $cflagText = "English";
      
            ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/arabic_div.css">
        
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title>Marketing</title>
        <!-- <meta name="description" content="Kafaat International Survey"> -->
        <meta name="author" content="Kafaat International">
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
    <body style="background:#F7F7F7;" class="<?php echo $this->config->item('language_class'); ?>">
        <header id="header">
            <div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo" style="font-size:20px; margin-top: 3px;"> 
                     Marketing
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
                            <img src="<?php echo base_url(); ?>script/timthumb.php?src=<?php echo base_url(); ?>images/user/<?php echo $user_image_h; ?>&w=30&h=0&zc=20&q=1"alt="me" class="online" style="">
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/users/editprofile" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i>&nbsp;<?php echo $this->lang->line("edit_profile"); ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/users/changepassword" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i>&nbsp;<?php echo $this->lang->line("change_password"); ?></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/users/update_premission" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-refresh"></i>&nbsp;Update Permission</a>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-<?php echo $cflag; ?>" alt="United States"> 
                            <span>
                                <?php echo $cflagText; ?> 
                            </span> 
                            <i class="fa fa-angle-down"></i> 
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="">
                                <a onclick="return chnagetoenglish();" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-us" alt="United States"> English</a>
                            </li>
                            <li class="">
                                <a onclick="return chnagetoarabic();" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-ae" alt="United Arab Emirates"> عربي</a>
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
            <!-- NAVIGATION : This navigation is also responsive-->
            <nav>
                <!-- 
                NOTE: Notice the gaps after each icon usage <i></i>..
                Please note that these links work a bit different than
                traditional href="" links. See documentation for details.
                -->
               
                <ul>                     
                    <!-- 2 is for users management-->
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">manage all users</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users" title="All Users"><span class="menu-item-parent"> <?php echo $this->lang->line("all_users"); ?></span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users/adduser" title="Add User"><span class="menu-item-parent"> <?php echo $this->lang->line("add_user"); ?></span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="">      
                            <a href="#" title="Units"><i class="fa fa-lg fa-fw fa-cubes"></i> <span class="menu-item-parent">manage units</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/units" title="All Units"><span class="menu-item-parent">All Units</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/units/addunit" title="Add Unit"><span class="menu-item-parent">Add Unit</span></a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?> 

                       <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-shopping-basket"></i> <span class="menu-item-parent">manage all Shops</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops" title="All Shops"><span class="menu-item-parent">All shops</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops/addnewshop" title="New Shop"><span class="menu-item-parent">Add Shop</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                     <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Categories</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/categories" title=""><span class="menu-item-parent">All Categories</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/categories/addcategory" title=""><span class="menu-item-parent">Add new category</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                 <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Items</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/items" title=""><span class="menu-item-parent">All Items</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/items/additem" title=""><span class="menu-item-parent">Add new Item</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?>
                     <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Brands</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/brands" title=""><span class="menu-item-parent">All Brands</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/brands/addbrand" title=""><span class="menu-item-parent">Add new Brand</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Models</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/models" title=""><span class="menu-item-parent">All Models</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/models/addmodel" title=""><span class="menu-item-parent">Add new Model</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Grades</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/grades" title=""><span class="menu-item-parent">All Grades</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/grades/addgrade" title=""><span class="menu-item-parent">Add new grade</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?>
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Sizes</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/sizes" title=""><span class="menu-item-parent">All Sizes</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/sizes/addsize" title=""><span class="menu-item-parent">Add new size</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?>
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Types</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/types" title=""><span class="menu-item-parent">All Types</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/types/addtype" title=""><span class="menu-item-parent">Add new type</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?>
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage all Colours</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/colours" title=""><span class="menu-item-parent">All Colours</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/colours/addcolour" title=""><span class="menu-item-parent">Add new colour</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?>
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage Stock</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/stocks" title=""><span class="menu-item-parent">All Stocks</span></a>
                                </li> 
                            </ul>	
                        </li> 
                    <?php } ?> 
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage Orders</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders/draftorders" title=""><span class="menu-item-parent">All Draft Orders</span></a>
                                    <a href="<?php echo site_url(); ?>/orders/completeorders" title=""><span class="menu-item-parent">All Complete Orders</span></a>
                                    <a href="<?php echo site_url(); ?>/orders" title=""><span class="menu-item-parent"> New Order</span></a>
                                    </li> 
                            </ul>	
                        </li> 
                    <?php } ?>
                    <!-- FAQ Management -->
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="<?php echo site_url('faq/index'); ?>" title="FAQ Management">
                                <i class="fa fa-lg fa-fw fa-question-circle"></i> <span class="menu-item-parent">FAQ Management</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"> 
                <i class="fa fa-arrow-circle-left hit"></i> 
            </span>
        </aside>
        <script type="text/javascript">
            function chnagetoenglish(url) {
                var url = window.location.href;
                var res = url.replace("/ar", "/en");
                window.location.replace(res);
            }
            function chnagetoarabic(url) {
                var url = window.location.href;
                var res = url.replace("/en", "/ar");
                window.location.replace(res);
            }
        </script>