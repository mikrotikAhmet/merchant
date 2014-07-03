<?php echo $header?>
<div class="container">  
    <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-signin form-horizontal" id="authenticate">
        <div class="top-bar">
            <h3><i class="icon-leaf"></i> <?php echo $heading_title; ?></h3>
        </div>
        <div class="well no-padding">

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-mail-reply"></i></label>
                <div class="controls">
                    <input type="text" name="email" placeholder="<?php echo $entry_email?>">
                </div>
            </div>
            <div class="padding">
                <button class="btn btn-primary" type="submit"><?php echo $button_reset?></button>
                <button class="btn btn-primary" type="button" onclick="window.location='<?php echo $cancel; ?>'"><?php echo $button_cancel?></button>
            </div>
        </div>
    </form>
</div>
<?php echo $footer?>