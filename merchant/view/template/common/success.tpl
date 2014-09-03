<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">
        <h1><?php echo $heading_title; ?></h1>
        <?php echo $text_message; ?>
        <!-- Top Fixed Bar: Breadcrumb Right Navigation -->
        <ul class="pull-right">

        </ul>
        <!-- / Top Fixed Bar: Breadcrumb Right Navigation -->
        <button type="button" class="btn btn-success" onclick="window.location = '<?php echo $continue; ?>'">Continue</button>
    </div>
    <!-- / Top Fixed Bar: Breadcrumb Container -->

</div>
<!-- / Top Fixed Bar: Breadcrumb -->  
<?php echo $footer?>