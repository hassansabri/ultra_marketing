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
        <meta name="description" content="">
        <meta name="author" content="Ultra Marketing">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.steps.css">
        <!-- SmartAdmin Styles : Caution! DO NOT change the Invoice -->
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
        <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDOdbqj_VlYUEcSaYc-hoasCL6bG29rvsU&sensor=false&libraries=places"></script> -->
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
                <!-- <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div> -->
                <!-- end collapse menu -->
                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <!-- <ul id="" class="header-dropdown-list hidden-xs padding-5">
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
                </ul> -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?php echo site_url(); ?>/login/logout" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- fullscreen button -->
                <!-- <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div> -->
                <!-- end fullscreen button -->
                <!-- multiple lang dropdown : find all flags in the flags page -->
                <ul class="header-dropdown-list hidden-xs">
                    <li>
                        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                            <img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-<?php echo $cflag; ?>" alt="United States"> 
                            <span>
                                <?php echo $cflagText; ?> 
                            </span> 
                            <i class="fa fa-angle-down"></i> 
                        </a> -->
                        <!-- <ul class="dropdown-menu pull-right">
                            <li class="">
                                <a onclick="return chnagetoenglish();" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-us" alt="United States"> English</a>
                            </li>
                            <li class="">
                                <a onclick="return chnagetoarabic();" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/template/img/blank.gif" class="flag flag-ae" alt="United Arab Emirates"> عربي</a>
                            </li>
                        </ul> -->
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
                        <!-- <img src="<?php echo base_url(); ?>script/timthumb.php?src=<?php echo base_url(); ?>images/user/<?php echo $user_image_h; ?>&w=30&h=0&zc=20&q=1" alt="me" class="online" />  -->
                        <!-- <span>
                            <?php echo $name = $this->session->userdata('name'); ?>
                        </span> -->
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
                    <?php  if (has_module_permission('users')&&$this->session->userdata('uid')&&$this->session->userdata('logged_in')){ ?>
                    <?php if (has_module_permission('users')&&$this->session->userdata('uid')&&$this->session->userdata('logged_in')) { ?>
                        <?php } ?> 
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">manage all users</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users" title="All Users"><span class="menu-item-parent"> <?php echo $this->lang->line("all_users"); ?></span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/users/adduser" title="Add User"><span class="menu-item-parent">Add User</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="">      
                            <a href="#" title="Units"><i class="fa fa-lg fa-fw fa-cubes"></i> <span class="menu-item-parent">manage units</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/units" title="All Units"><span class="menu-item-parent">All Units</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/units/addunit" title="Add Unit"><span class="menu-item-parent">Add Unit</span></a>
                                </li>
                            </ul>
                        </li> -->
                    <?php } ?> 

                       <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-shopping-basket"></i> <span class="menu-item-parent">manage packing Options</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/packing_options" title=""><span class="menu-item-parent">All packings</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/packing_options/add" title=""><span class="menu-item-parent">Add packing</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                       <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-shopping-basket"></i> <span class="menu-item-parent">manage all Suppliers</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops/suppliers" title=""><span class="menu-item-parent">All suppliers</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops/addnewsupplier" title=""><span class="menu-item-parent">Add Suppliers</span></a>
                                </li>
                            </ul>	
                        </li> 
                    <?php } ?> 
                       <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Users"><i class="fa fa-lg fa-fw fa-shopping-basket"></i> <span class="menu-item-parent">manage all Crediters</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops/crediters" title=""><span class="menu-item-parent">All crediters</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/shops/addnewcrediter" title=""><span class="menu-item-parent">Add Crediter</span></a>
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
                     <!-- <?php  if ($this->session->userdata('logged_in')){ ?>
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
                    <?php } ?> -->
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage Stock</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/stocks" title=""><span class="menu-item-parent">All Stocks</span></a>
                                    <a href="<?php echo site_url(); ?>/packing_stocks" title=""><span class="menu-item-parent">All Packing Stocks</span></a>
                                </li> 
                            </ul>	
                        </li> 
                    <?php } ?> 
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="javasript:;" title=""><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage Invoices</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders/draftorders" title=""><span class="menu-item-parent">All Draft Invoices</span></a>
                                    <a href="<?php echo site_url(); ?>/orders/completeorders" title=""><span class="menu-item-parent">All Complete Invoices</span></a>
                                    <a href="<?php echo site_url(); ?>/orders/cancelledorders" title="">
                                        <span class="menu-item-parent">Cancelled Invoices</span>
                                        <?php 
                                        // Load the model and get count safely
                                        try {
                                            
                                            $CI =& get_instance();
                                        $CI->load->model('orders/m_orders', 'model_order');
                                            $total =  $CI->model_order->getCancellationStats();
                                         //   print_r($total);
                                            $total_cancelled = $total['total_cancelled'];
                                            if ($total_cancelled > 0): ?>
                                                <span class="badge bg-color-red pull-right"><?php echo $total_cancelled; ?></span>
                                            <?php endif;
                                        } catch (Exception $e) {
                                            // If there's an error, don't show the badge
                                        }
                                        ?>
                                    </a>
                                    <a href="<?php echo site_url(); ?>/orders" title=""><span class="menu-item-parent"> New Invoice</span></a>
                                    </li> 
                            </ul>	
                        </li> 
                    <?php } ?>
                    <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="<?php echo site_url(); ?>/orders/ledger" title="Invoice Ledger"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Invoice Ledger</span></a>
                        </li>
                    <?php } ?>
                    <!-- <?php  if ($this->session->userdata('logged_in')){ ?>
                        <li class="">      
                            <a href="#" title="Reports"><i class="fa fa-lg fa-fw fa-chart-bar"></i> <span class="menu-item-parent">Reports & Analytics</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports" title="Dashboard"><span class="menu-item-parent">Dashboard</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/sales_report" title="Sales Report"><span class="menu-item-parent">Sales Report</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/shop_report" title="Shop Report"><span class="menu-item-parent">Shop Report</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/item_report" title="Item Report"><span class="menu-item-parent">Item Report</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/payment_report" title="Payment Report"><span class="menu-item-parent">Payment Report</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/date_range_report" title="Date Range Report"><span class="menu-item-parent">Date Range Report</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/orders_reports/analytics" title="Analytics"><span class="menu-item-parent">Analytics</span></a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?> -->
                    <!-- Profile Management -->
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="#" title="Profile Management"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Profile Management</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/profile" title="All Profiles"><span class="menu-item-parent">All Profiles</span></a>
                                </li>
                             
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="#" title="country Management"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">Country Management</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries" title="All Countries"><span class="menu-item-parent">All Countries</span></a>
                                    </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries/addcountry" title="Add Country"><span class="menu-item-parent">Add Country</span></a>
                                </li>
                             
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="#" title="state Management"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">State Management</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries/all_states" title="All Profiles"><span class="menu-item-parent">All states</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries/addstate" title=""><span class="menu-item-parent">Add state</span></a>
                                </li>
                             
                            </ul>
                            
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="#" title="city Management"><i class="fa fa-lg fa-fw fa-building"></i> <span class="menu-item-parent">City Management</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries/all_cities" title=""><span class="menu-item-parent">All Cities</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/countries/addcity" title=""><span class="menu-item-parent">Add City</span></a>
                                </li>
                             
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li class="">
                            <a href="#" title="Permissions"><i class="fa fa-lg fa-fw fa-lock"></i> <span class="menu-item-parent">Roles & Permissions</span></a>
                            <ul>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/permissions/assign_user_roles" title="Assign User Roles"><span class="menu-item-parent">Assign User Roles</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/permissions/dashboard" title="Permissions Dashboard"><span class="menu-item-parent">Permissions Dashboard</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/permissions/add_role" title="Add Role"><span class="menu-item-parent">Add Role</span></a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url(); ?>/permissions/roles" title="All Roles"><span class="menu-item-parent">All Roles</span></a>
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
        <!-- Show stock warning under main content on every page -->
        <script>
          // This script will move the warning below the main content if #main exists
          document.addEventListener('DOMContentLoaded', function() {
            var warning = document.getElementById('global-stock-warning');
            var main = document.getElementById('main');
            if (warning && main) {
              main.parentNode.insertBefore(warning, main.nextSibling);
            }
          });
        </script>

            <div id="warnings" style="overflow: hidden;
  word-break: break-all;display:none;">

                <?php
                $CI =& get_instance();
                $CI->load->model('stocks/m_stocks', 'model_stock');
                $not_exists_items = $CI->model_stock->get_items_not_exists_in_stock();
                $out_of_stock_items = $CI->model_stock->get_items_with_low_stock();
                $out_of_stock_packing = $CI->model_stock->get_packings_with_low_stock();
                $not_exists_packing = $CI->model_stock->packing_not_exists_in_stock();
            
                if (!empty($out_of_stock_items)):
                ?>
                <div id="global-stock-warning" class="   alert alert-danger" style="margin-left: 220px;
            padding: 0;
            padding-bottom: 0px;
            padding-bottom: 52px;
            position: relative;display:none;">
                        <?php if($out_of_stock_items){ ?>
                            <h4><i class="fa fa-exclamation-triangle"></i> Warning: The following items are low in stock!</h4>
                            <ul style="margin-bottom:0;">

                          <?php foreach($out_of_stock_items as $item): ?>
                            <li><?php echo $item['item_name']; ?>(<?php echo $item['balance']; ?>)</li>
                        <?php endforeach;
                        } ?>
                    </ul>
                </div>
                <?php endif; ?>
                         <?php  if (!empty($not_exists_items)):
                ?>
                <div id="global-stock-warning" class="mywarning alert alert-danger" style="margin-left: 220px;
            padding: 0;
            padding-bottom: 0px;
            padding-bottom: 52px;
            position: relative;display:none">
                    <h4><i class="fa fa-exclamation-triangle"></i> Warning: The following items are Not In stock!</h4>
                    <ul style="margin-bottom:0;">
                        <?php foreach($not_exists_items as $item): ?>
                            <li><?php echo $name = get_item_name($item);  ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>


                


              <?php  if (!empty($out_of_stock_packing)):
                ?>
                <div id="global-stock-warning2" class="alert alert-danger" style="margin-left: 220px;
            padding: 0;
            padding-bottom: 0px;
            padding-bottom: 52px;
            position: relative;display:none">
                    <h4><i class="fa fa-exclamation-triangle"></i> Warning: The following packings are low in stock!</h4>
                    <ul style="margin-bottom:0;">
                        <?php foreach($out_of_stock_packing as $packing): ?>
                            <li><?php echo $name = getpackingtitle($packing['packing_fk']);  ?>(<?php echo $packing['balance']; ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
              <?php  if (!empty($not_exists_packing)):
                ?>
                <div id="global-stock-warning3" class="alert alert-danger" style="margin-left: 220px;
            padding: 0;
            padding-bottom: 0px;
            padding-bottom: 52px;
            position: relative;display:none">
                    <h4><i class="fa fa-exclamation-triangle"></i> Warning: The following packings are not exits in stock!</h4>
                    <ul style="margin-bottom:0;">
                        <?php foreach($not_exists_packing as $packing): ?>
                            <li><?php echo $name = getpackingtitle($packing);  ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
             
            </div>