<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">

        <!-- Top Fixed Bar: Breadcrumb Location -->
        <ul class="pull-left">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"> <?php echo $breadcrumb['text']; ?></a><li>
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
    <div class="row-fluid">
        <div class="span12">
            <!-- Create Account: Form -->
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form" id="form">
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class="icon-user"></i> <?php echo $entry_fullname?></label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="<?php echo $entry_fullname?>" disabled="disabled" value="<?php echo $this->customer->getUsername()?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputUsername"><i class="icon-mail-reply"></i> <?php echo $entry_email?></label>
                    <div class="controls">
                        <input type="text" id="inputUsername" name="email" placeholder="<?php echo $entry_email?>" disabled="disabled" value="<?php echo $this->customer->getEmail()?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $footer?>