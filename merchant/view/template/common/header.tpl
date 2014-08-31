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
        <link href="merchant/view/assets/css/theme/style.css" rel="stylesheet" type="text/css">
        <link href='merchant/view/assets/font/css43ad.css?family=Open+Sans:300italic,400italic,600italic,400,600,300' rel='stylesheet' type='text/css'> 
        <style type="text/css">
            body { padding-top: 102px; }
        </style>
        <link href="merchant/view/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- JavaScript/jQuery, Pre-DOM -->
        <script src="merchant/view/assets/js/jquery/1.7.1/jquery-1.7.1.min.js"></script> 
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
                            <li id="transaction"><a href="<?php echo $transaction?>"><i class="icon-align-justify"></i> Transactions</a></li>
                            <li id="deposit"><a href="<?php echo $deposit?>"><i class="icon-align-justify"></i> Deposit</a></li>
                            <li id="withdraw"><a href="<?php echo $withdraw?>"><i class="icon-align-justify"></i> Withdraw</a></li>
                            <!-- / Main Navigation: Dashboard -->
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
                                <li><a href="<?php echo $account?>"><i class="icon-user"></i> <?php echo $text_account?></a></li>
                                <li><a href="<?php echo $activate?>"><i class="icon-check"></i> <?php echo $text_activate?></a></li>
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