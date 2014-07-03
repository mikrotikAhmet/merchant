<?php echo $header?>
<div class="container">  
    <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-signin form-horizontal" id="authenticate">
        <div class="top-bar">
            <h3><i class="icon-leaf"></i> <?php echo $text_heading?></h3>
        </div>
        <div class="well no-padding">

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-user"></i></label>
                <div class="controls">
                    <input type="text" name="username" placeholder="<?php echo $entry_username?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputUsername"><i class="icon-key"></i></label>
                <div class="controls">
                    <input type="password" name="password" placeholder="<?php echo $entry_password?>">
                </div>
            </div>
             <div class="control-group">
                <label class="control-label" for=""><a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a></label>
                <br/>
            </div>
            
            <div class="padding">
                <button class="btn btn-primary" type="submit"><?php echo $button_login?></button>
            </div>
        </div>
        <?php if ($redirect) { ?>
          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
          <?php } ?>
    </form>
</div>
<?php echo $footer?>