<!DOCTYPE html>
<html lang="en-us" id="lock-page">
    <head>
        <meta charset="utf-8">
        <title>Studies and Research</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/font-awesome.min.css">
        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-skins.min.css">
        <!-- SmartAdmin RTL Support -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/smartadmin-rtl.min.css"> 
        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->
        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/demo.min.css">
        <!-- page related CSS -->

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/template/css/lockscreen.min.css">
        <!-- #FAVICONS -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/template/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>assets/template/img/favicon/favicon.ico" type="image/x-icon">
        <!-- #GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        <!-- #APP SCREEN / ICONS -->
        <!-- Specifying a Webpage Icon for Web Clip 
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
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
    </head>
    <body>
        <div id="main" role="main">
            <!-- MAIN CONTENT -->
            <form id="login-form" class="lockscreen animated flipInY" action="<?php echo site_url(); ?>/login/verify" method="post" >
                <div class="logo">
                    <h1 class="semi-bold">Kafaat International Studies and Research</h1>
                </div>
                <div>
                    <img src="<?php echo base_url(); ?>assets/img/ki-logo.png" alt="" width="120" height="120" />
                    <div>
                        <?php if (isset($message) && sizeof($message) > 0) { ?>
                            <div style="color: red;">
                                <?php echo $message["msg"]; ?>
                            </div>
                        <?php } ?>
                        <h1>User Login</h1>
                        <div class="">
                            <input class="form-control" name="email" type="text" placeholder="Username">
                        </div>
                        <br/>
                        <div class="">
                            <input class="form-control"name="password" type="password" placeholder="Password">
                        </div>
                        <br/>
                        <button class="btn btn-primary" type="button" onclick="getLocation()">
                            <i class="fa fa-key"></i> Login
                        </button>
                    </div>
                </div>
                <p class="font-xs margin-top-5">
                    <?php echo $this->lang->line("AllRights"); ?> <?php echo date('Y'); ?>
                </p>
            </form>
        </div>
        <!--================================================== -->	
        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script src="<?php echo base_url(); ?>assets/template/js/plugin/pace/pace.min.js"></script>
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
        <script  type="text/javascript">
                            if (!window.jQuery) {
                                document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
                            }
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript">
                            if (!window.jQuery.ui) {
                                document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
                            }
        </script>
        <!-- IMPORTANT: APP CONFIG -->
        <script src="<?php echo base_url(); ?>assets/template/js/app.config.js"></script>
        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
        <script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->
        <!-- BOOTSTRAP JS -->		
        <script src="<?php echo base_url(); ?>assets/template/js/bootstrap/bootstrap.min.js"></script>
        <!-- JQUERY VALIDATE -->
        <script src="<?php echo base_url(); ?>assets/template/js/plugin/jquery-validate/jquery.validate.min.js"></script>
        <!-- JQUERY MASKED INPUT -->
        <script src="<?php echo base_url(); ?>assets/template/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
        <!--[if IE 8]>
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->
        <!-- MAIN APP JS FILE -->
        <script src="<?php echo base_url(); ?>assets/template/js/app.min.js"></script>
        <script type="text/javascript">
                            function getLocation() {
                                
                                $("#login-form").submit();
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                                } else {
                                    alert("Geolocation is not supported by this browser.");
                                }
                            }
                            function showPosition(position) {
                                alert("Latitude: " + position.coords.latitude +
                                        "<br>Longitude: " + position.coords.longitude);
                              
                                $("#login-form").submit();
                            }
                            function showError(error) {
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
        </script>
    </body>
</html>