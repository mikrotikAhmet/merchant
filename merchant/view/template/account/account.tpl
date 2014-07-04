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
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form" id="form">
                        <!-- Create Account: Form Name -->
                        <div class="control-group">
                            <label class="control-label" for="inputName"><i class="icon-user"></i> <?php echo $entry_fullname?></label>
                            <div class="controls">
                                <input type="text" id="inputName" placeholder="<?php echo $entry_fullname?>" disabled="disabled" value="<?php echo $this->customer->getUsername()?>">
                            </div>
                        </div>
                        <!-- / Create Account: Form Name -->

                        <!-- Create Account: Form Email -->
                        <div class="control-group">
                            <label class="control-label" for="inputUsername"><i class="icon-user"></i> <?php echo $entry_email?></label>
                            <div class="controls">
                                <input type="text" id="inputUsername" name="email" placeholder="<?php echo $entry_email?>" value="<?php echo $this->customer->getEmail()?>">
                                <?php if ($error_email) { ?>
                                <br/>
                                    <span class="error"><?php echo $error_email; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- / Create Account: Form Email -->

                        <!-- Create Account: Form Nationality -->
                        <div class="control-group">
                            <label class="control-label" for="inputNationality"><i class="icon-flag"></i> <?php echo $entry_country?></label>
                            <div class="controls">
                                <select name="country_id" class="span3" title="countries">
                                    <option value=""><?php echo $text_select?></option>
                                    <?php foreach ($countries as $country) { ?>
                                    <?php if ($country_id == $country['country_id']) { ?>
                                    <option value="<?php echo $country['country_id']?>" selected="selected" ><?php echo $country['name']?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $country['country_id']?>" ><?php echo $country['name']?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                                <?php if ($error_country) { ?>
                                    <span class="error"><?php echo $error_country; ?></span>
                                <?php } ?>
                                <select name="zone_id" class="span3" title="zones" id="zones">
                                    <option value=""><?php echo $text_select?></option>
                                </select>
                                
                                <?php if ($error_zone) { ?>
                                
                                    <span class="error"><?php echo $error_zone; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- / Create Account: Form Nationality -->

                        <!-- Create Account: Form Password -->
                        <div class="control-group">
                            <label class="control-label" for="inputPassword"><i class="icon-key"></i> <?php echo $entry_password?></label>
                            <div class="controls">
                                <a class="btn" href="#password" data-toggle="modal"><i class="icon-unlock"></i> <?php echo $button_password?></a>
                            </div>
                        </div>
                        <!-- / Create Account: Form Password -->

                        <!-- Create Account: 2 Step Authentication -->
                        <div class="control-group">
                            <label class="control-label" for="inputPassword"><i class="icon-shield"></i> <?php echo $entry_two_step?></label>
                            <div class="controls">
                                <button class="btn" type="button"><i class="icon-shield"></i> <?php echo $button_enable?></button>
                            </div>
                        </div>
                        <!-- / Create Account: 2 Step Authentication -->
                        <!-- Create Account: Charges Settings -->
                        <div class="control-group">
                            <label class="control-label" for="inputInline"></label>
                            <div class="controls">
                                <?php if ($this->customer->getDeclineCVC()) { ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="decline_cvc" value="1" checked>
                                    <?php echo $text_decline_cvc?>				
                                </label>
                                <?php } else { ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="decline_cvc" value="1">
                                    <?php echo $text_decline_cvc?>				
                                </label>
                                <?php } ?>
                                
                                <?php if ($this->customer->getDeclineZIP()) { ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="decline_zip" value="1" checked>
                                    <?php echo $text_decline_zip?>				
                                </label>
                                <?php } else { ?>
                                <label class="checkbox">
                                    <input type="checkbox" name="decline_zip" value="1" >
                                    <?php echo $text_decline_zip?>				
                                </label>
                                <?php } ?>

                            </div>
                        </div>	
                        <!-- / Create Account: Charges Settings -->

                        <!-- Create Account: Form Actions -->
                        <div class="form-actions">
                            <button type="button" onclick="$('#form').submit();" class="btn btn-primary"><?php echo $button_update?></button>
                            <button type="button" class="btn" onclick="window.location = '<?php echo $home?>'"><?php echo $button_cancel?></button>
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

<!-- Moldule: Password -->
<div id="password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Changing Password" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-key"></i> Change Password</h3>
    </div>

    <div class="modal-body">

        <form class="form-horizontal" id="updatePassword">

            <div class="control-group">
                <label class="control-label" for="inputName"><i class="icon-key"></i> Old Password</label>
                <div class="controls">
                    <input type="password" name="oldpassword" id="inputName" placeholder="">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputUsername"><i class="icon-key"></i> New Password</label>
                <div class="controls">
                    <input type="password" name="newpassword" id="inputUsername" placeholder="">
                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">

        <button class="btn btn-primary" data-dismiss="modal" onclick="updatePassword()"><?php echo $button_update?></button>
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $button_cancel?></button>

    </div>

</div> 
<!-- / Module: Password -->
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {

        $.ajax({
            url: 'index.php?route=account/account/country&token=<?php echo $token; ?>&country_id=' + this.value,
            dataType: 'json',
            beforeSend: function() {
                //$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('.wait').remove();
            },
            success: function(json) {
                html = '<option value=""><?php echo $text_select; ?></option>';

                if (json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';

                        if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }

                $('select[name=\'zone_id\']').html(html);
                $('select[name=\'zone_id\']').css('display', 'inline');
                $('#zones_chosen').hide();


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('select[name=\'country_id\']').trigger('change');


    function updatePassword() {

        var data = $('#updatePassword').serialize();
        
        $.ajax({
            url: 'index.php?route=account/account/updatePassword&token=<?php echo $token; ?>',
            data : data,
            type : 'POST',
            dataType: 'json',
            success: function(json) {
                alert(json);
                
                $('#updatePassword').each(function(){
                    this.reset();
                });
            }
        });
    }
//--></script> 
<?php echo $footer?>