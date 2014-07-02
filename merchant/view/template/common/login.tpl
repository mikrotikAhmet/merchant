<?php echo $header?>
<div class="container">  

    <form class="form-signin form-horizontal" id="authenticate">
        <div class="top-bar">
            <h3><i class="icon-leaf"></i> <?php echo $text_heading?></h3>
        </div>
        <div class="well no-padding">

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-user"></i></label>
                <div class="controls">
                    <input type="text" id="username" placeholder="<?php echo $entry_username?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputUsername"><i class="icon-key"></i></label>
                <div class="controls">
                    <input type="password" id="password" placeholder="<?php echo $entry_password?>">
                </div>
            </div>

            <div class="padding">
                <button class="btn btn-primary" type="submit"><?php echo $button_login?></button>
            </div>
        </div>
    </form>
</div>
<script src="merchant/view/assets/js/app/login.js"></script>
<?php echo $footer?>