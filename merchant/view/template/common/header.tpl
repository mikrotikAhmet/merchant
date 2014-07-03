<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">

    <!-- Mirrored from lycheedesigns.com/projects/avocadopanel/login.html by HTTrack Website Copier/3.x [XR&CO'2006], Wed, 02 Jul 2014 12:06:00 GMT -->
    <head>

        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <base href="<?php echo $base; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <?php } ?>
        <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <?php } ?>
        <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php } ?>

        <!-- Styles -->
        <link href='merchant/view/assets/css/chosen.css' rel='stylesheet' tyle="text/css">
        <link href="merchant/view/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="merchant/view/assets/css/theme/avocado.css" rel="stylesheet" type="text/css" id="theme-style">
        <link href="merchant/view/assets/css/prism.css" rel="stylesheet/less" type="text/css">
        <link href='merchant/view/assets/font/css43ad.css?family=Open+Sans:300italic,400italic,600italic,400,600,300' rel='stylesheet' type='text/css'> 
        <style type="text/css">
            body { padding-top: 102px; }
        </style>
        <link href="merchant/view/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- JavaScript/jQuery, Pre-DOM -->
        <script src="merchant/view/assets/js/jquery/1.9.1/jquery.min.js"></script> 
        <script src="merchant/view/assets/js/charts/excanvas.min.js"></script>
        <script src="merchant/view/assets/js/charts/jquery.flot.js"></script>
        <script src="merchant/view/assets/js/jquery.jpanelmenu.min.js"></script>
        <script src="merchant/view/assets/js/jquery.cookie.js"></script>
        <script src="merchant/view/assets/js/avocado-custom-predom.js"></script>
        <script src="merchant/view/assets/js/common.js"></script>

        <!-- HTML5, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php if ($logged) { ?>
        <!-- Top Fixed Bar -->
        <div class="navbar navbar-inverse navbar-fixed-top">

            <!-- Top Fixed Bar: Navbar Inner -->
            <div class="navbar-inner">

                <!-- Top Fixed Bar: Container -->
                <div class="container">

                    <!-- Mobile Menu Button -->
                    <a href="#">
                        <button type="button" class="btn btn-navbar mobile-menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </a>
                    <!-- / Mobile Menu Button -->

                    <!-- / Logo / Brand Name -->
                    <a class="brand" href="<?php echo $home?>">Semite<b>Payment</b></a>
                    <!-- / Logo / Brand Name -->
                    <!-- Main Navigation: Box -->
                    <ul class="nav pull-left">
                        <ul class="nav">
                            <!-- Main Navigation: Dashboard -->
                            <li id="dashboard"><a href="<?php echo $home?>"><i class="icon-align-justify"></i> <?php echo $text_dashboard?></a></li>
                            <!-- / Main Navigation: Dashboard -->
                            <!-- Main Navigation: General -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-th"></i> General <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="grid.html"><i class="icon-th"></i> Grid</a></li>
                                    <li><a href="icons.html"><i class="icon-circle"></i> Icons</a></li>
                                    <li><a href="typography.html"><i class="icon-font"></i> Typography</a></li>
                                    <li><a href="buttons.html"><i class="icon-circle-blank"></i> Buttons</a></li>
                                </ul>
                            </li>
                            <!-- / Main Navigation: General -->
                            <!-- Main Navigation: UI Elements -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-magic">
                                    </i> UI Elements <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="forms.html"><i class="icon-check"></i> Forms</a></li>
                                    <li><a href="wysiwyg.html"><i class="icon-edit"></i> WYSIWYG</a></li>
                                    <li><a href="tabs.html"><i class="icon-th-large"></i> Tabs / Accordion</a></li>
                                </ul>
                            </li>
                            <!-- / Main Navigation: UI Elements -->
                            <!-- Main Navigation: Components -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-th-large"></i> Components <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="calendar.html"><i class="icon-calendar"></i> Calendar</a></li>
                                    <li><a href="maps.html"><i class="icon-map-marker"></i> Maps</a></li>
                                    <li><a href="tables.html"><i class="icon-table"></i> Tables</a></li>
                                    <li><a href="charts.html"><i class="icon-bar-chart"></i> Charts</a></li>
                                    <li><a href="login.html"><i class="icon-key"></i> Login</a></li>
                                    <li class="dropdown-submenu">
                                        <a href="#"><i class="icon-signin"></i> Sub-Menu</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="icon-signout"></i> This</a></li>
                                            <li><a href="#"><i class="icon-sitemap"></i> Is</a></li>
                                            <li><a href="#"><i class="icon-share-alt"></i> An</a></li>
                                            <li><a href="#"><i class="icon-reorder"></i> Example</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- / Main Navigation: Components -->
                            <!-- Main Navigation: Gallery -->
                            <li><a href="gallery.html"><i class="icon-picture"></i> Gallery</a></li>
                            <!-- / Main Navigation: Gallery -->
                        </ul>
                    </ul>

                    <!-- User Navigation -->
                    <ul class="nav pull-right">
                        <!-- User Navigation: User -->
                        <li class="dropdown">

                            <!-- User Navigation: User Link -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user icon-white"></i> 
                                <span class="hidden-phone"><?php echo $logged_as?></span>
                            </a>
                            <!-- / User Navigation: User Link -->

                            <!-- User Navigation: User Dropdown -->
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-user"></i> Account</a></li>
                                <li><a href="#settings" data-toggle="modal"><i class="icon-cog"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo $logout?>"><i class="icon-off"></i> <?php echo $logged?></a></li>
                            </ul>
                            <!-- / User Navigation: User Dropdown -->

                        </li>
                        <!-- / User Navigation: User -->

                    </ul>
                    <!-- / User Navigation -->

                </div>
                <!-- / Top Fixed Bar: Container -->

            </div>
            <!-- / Top Fixed Bar: Navbar Inner -->
        </div>
        <!-- / Top Fixed Bar -->
        <?php } ?>