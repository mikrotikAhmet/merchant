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
        <link href='merchant/view/assets/css/fullcalendar.css' rel='stylesheet' tyle="text/css">
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

        <!-- HTML5, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php if ($logged) { ?>
        <a href="<?php echo $logout?>">Logout</a>
        <?php } ?>