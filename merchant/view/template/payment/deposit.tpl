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
<div class="container">
    <div class="alert alert-light">
        <a class="close" data-dismiss="alert">&times;</a>
        <i class="icon-remove-sign"></i> <?php echo $text_information?>
    </div>
    <!-- / Alert -->
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form" id="form">
        <div class="form-group">
            <label for="card_holder_name" class="col-sm-3 control-label"><?php echo $entry_name?></label>
            <div class="col-sm-4">
                <input type="text" name="cardholder" value="<?php echo $cardholder; ?>" class="form-control">
                <?php if ($error_cardholder) { ?>
                <span class="error"><?php echo $error_cardholder; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label for="card_number" class="col-sm-3 control-label"><?php echo $entry_card_number?></label>
            <div class="col-sm-3">
                <input type="text" name="cardnum" value="<?php echo $cardnum; ?>" class="form-control">
                <?php if ($error_cardnum) { ?>
                <span class="error"><?php echo $error_cardnum; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label for="card_expire" class="col-sm-3 control-label"><?php echo $entry_expire_date?></label>
                <input type="text" name="expire_date" value="<?php echo $expiredate; ?>" class="form-control">
                <?php if ($error_expire) { ?>
                <span class="error"><?php echo $error_expire; ?></span>
                <?php } ?>
        </div>
        <div class="form-group">
            <label for="card_cvv" class="col-sm-3 control-label"><?php echo $entry_cvv?></label>
            <div class="col-sm-1">
                <input type="text" name="cvv" value="<?php echo $cvv; ?>" class="form-control">
                <?php if ($error_cvv) { ?>
                <span class="error"><?php echo $error_cvv; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label for="amount" class="col-sm-3 control-label"><?php echo $entry_amount?></label>
            <div class="col-sm-3">
                <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control">
                <?php if ($error_amount) { ?>
                <span class="error"><?php echo $error_amount; ?></span>
                <?php } ?>
                <?php if ($error_currency) { ?>
                <span class="error"><?php echo $error_currency; ?></span>
                <?php } ?>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="button" onclick="$('#form').submit();" class="btn btn-primary"><?php echo $button_deposit?></button>
            <button type="button" class="btn" onclick="window.location = '<?php echo $home?>'"><?php echo $button_cancel?></button>
        </div>
    </form>
</div>
<?php echo $footer?>