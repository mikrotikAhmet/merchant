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

        <!-- Account Settings: Box -->
        <div class="span12">
            <!-- Account Settings: Top Bar -->
            <div class="top-bar" style="padding-left: 0px;">
                <ul class="tab-container">
                    <li class="active"><a href="#tab-general"><i class="icon-gears"></i> <?php echo $tab_general?></a></li>
                    <li class=""><a href="#tab-api"><i class="icon-key"></i> API Keys</a></li>
                    <li class=""><a href="#tab-transfer"><i class="icon-exchange"></i> Transfers</a></li>
                    <li class=""><a href="#tab-email"><i class="icon-globe"></i> EMails</a></li>
                </ul>
            </div>
            <!-- / Account Settings: Top Bar -->

            <!-- Account: Settings -->
            <div class="well no-padding tab-content">

                <!-- Customer General Information -->
                <div class="tab-pane active" id="tab-general">
                    <!-- Create Account: Form -->
                    <form class="form-horizontal">

                        <!-- Create Account: Top Information -->
                        <div class="top-info">

                            <!-- Alert -->
                            <div class="alert alert-info">
                                <a class="close" data-dismiss="alert">&times;</a>
                                <i class="icon-info"></i> You can add users through this panel
                            </div>
                            <!-- / Alert -->

                        </div>
                        <!-- / Create Account: Top Information -->

                        <!-- Create Account: Form Name -->
                        <div class="control-group">
                            <label class="control-label" for="inputName"><i class="icon-user"></i> Full Name</label>
                            <div class="controls">
                                <input type="text" id="inputName" placeholder="Full Name" disabled="disabled" value="<?php echo $this->customer->getUsername()?>">
                            </div>
                        </div>
                        <!-- / Create Account: Form Name -->

                        <!-- Create Account: Form Email -->
                        <div class="control-group">
                            <label class="control-label" for="inputUsername"><i class="icon-user"></i> EMail</label>
                            <div class="controls">
                                <input type="text" id="inputUsername" placeholder="EMail" value="<?php echo $this->customer->getEmail()?>">
                            </div>
                        </div>
                        <!-- / Create Account: Form Email -->

                        <!-- Create Account: Form Nationality -->
                        <div class="control-group">
                            <label class="control-label" for="inputNationality"><i class="icon-flag"></i> Country</label>
                            <div class="controls">
                                <select class="span3">
                                    <?php foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country['country_id']?>"><?php echo $country['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- / Create Account: Form Nationality -->

                        <!-- Create Account: Form Password -->
                        <div class="control-group">
                            <label class="control-label" for="inputPassword"><i class="icon-key"></i> Password</label>
                            <div class="controls">
                                <button class="btn" type="button"><i class="icon-unlock"></i> Change password...</button>
                            </div>
                        </div>
                        <!-- / Create Account: Form Password -->
                        
                        <!-- Create Account: 2 Step Authentication -->
                        <div class="control-group">
                            <label class="control-label" for="inputPassword"><i class="icon-shield"></i> Two-step Key</label>
                            <div class="controls">
                                <button class="btn" type="button"><i class="icon-shield"></i> Enable...</button>
                            </div>
                        </div>
                        <!-- / Create Account: 2 Step Authentication -->
                        <!-- Create Account: Charges Settings -->
                        <div class="control-group">
                                <label class="control-label" for="inputInline"></label>
                                <div class="controls">
                                  <label class="checkbox">
                                        <input type="checkbox" value="">
                                          Decline charges that fail CVC verification.				
                                </label>
                                    <label class="checkbox">
                                        <input type="checkbox" value="">
                                          Decline charges that fail Zip Code verification.				
                                </label>
                                        
                                </div>
                        </div>	
                        <!-- / Create Account: Charges Settings -->

                        <!-- Create Account: Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Changes</button>
                            <button type="button" class="btn" onclick="window.location='<?php echo $home?>'">Cancel</button>
                        </div>
                        <!-- / Create Account: Form Actions -->

                    </form> 
                    <!-- / Create Account: Form --> 
                </div>
                <!-- / Customer General Information --> 

            </div>
            <!-- / Account: Settings -->

        </div>
        <!-- / Account Settings: Box -->

    </div>
</div>
<!-- / Content Container -->
<?php echo $footer?>