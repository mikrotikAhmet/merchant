<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">

        <!-- Top Fixed Bar: Breadcrumb Location -->
        <ul class="pull-left">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><i class="icon-home"></i> <?php echo $breadcrumb['text']; ?></a><li>
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

    <?php if ($error_approved) { ?>
    <!-- Alert -->
    <div class="alert alert-light">
        <a class="close" data-dismiss="alert">&times;</a>
        <i class="icon-remove-sign"></i> <?php echo $error_approved?>
    </div>
    <!-- / Alert -->
    <?php } ?>

    <div class="row-fluid">
        <!-- Information Boxes: Last transfer -->
        <div class="span3 well infobox">
            <i class="icon-6x icon-home"></i>
            <div class="pull-right text-right">
                <?php echo $text_last_transfer?><br>
                <b class="huge"><?php echo $last_transfer?></b><br>
                <span class="caps muted"><?php echo $text_withdraw?></span>
            </div>
        </div>
        <!-- / Information Boxes: Last transfer -->
        <!-- Information Boxes: Balance -->
        <div class="span3 well infobox pull-right">
            <i class="icon-6x icon-money"></i>
            <div class="pull-right text-right">
                <?php echo $text_balance?><br>
                <b class="huge"><?php echo $balance?></b><br>
                <span class="caps muted"></span>
            </div>
        </div>
        <!-- / Information Boxes: Balance -->
    </div>

</div>
<!-- / Content Container -->
<?php echo $footer?>