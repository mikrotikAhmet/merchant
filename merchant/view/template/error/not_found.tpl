<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">

        <!-- Top Fixed Bar: Breadcrumb Location -->
        <ul class="pull-left">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><li>
                <?php } ?>
        </ul>
        <!-- / Top Fixed Bar: Breadcrumb Location -->

        <!-- Top Fixed Bar: Breadcrumb Right Navigation -->
        <ul class="pull-right">

        </ul>
        <!-- / Top Fixed Bar: Breadcrumb Right Navigation -->

    </div>
    <!-- / Top Fixed Bar: Breadcrumb Container -->

</div>
<!-- / Top Fixed Bar: Breadcrumb -->
<!-- Content Container -->
<div class="container">

    <!-- Error wrapper -->
    <div class="error-wrapper text-center">
        <h1>404</h1>
        <h6><?php echo $text_not_found; ?></h6>
    </div>  
    <!-- /error wrapper -->
</div>
<!-- / Content Container -->
<?php echo $footer?>