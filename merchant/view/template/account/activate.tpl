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
    <div class="row">
        <?php if ($this->customer->isSale()) { ?>
        <div class="span8">
            <!-- Create Account: Form -->
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form" id="form">
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Account Type</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="<?php echo $this->customer->getAccountType()?>" disabled="disabled" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> <?php echo $entry_fullname?></label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="<?php echo $entry_fullname?>" disabled="disabled" value="<?php echo $this->customer->getUsername()?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputUsername"><i class=""></i> <?php echo $entry_email?></label>
                    <div class="controls">
                        <input type="text" id="inputUsername" name="email" placeholder="<?php echo $entry_email?>" disabled="disabled" value="<?php echo $this->customer->getEmail()?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Company Name</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Company ID</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> TAX ID</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Address</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Address (2)</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> City</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputName"><i class=""></i> Post Code</label>
                    <div class="controls">
                        <input type="text" id="inputName" placeholder="" value="">
                    </div>
                </div>
                <div class="control-group">
                            <label class="control-label" for="inputNationality"><i class=""></i> Country / State</label>
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
            </form>
        </div>
        <div class="span4">
            <h5>Required Documents for Pre-Approval</h5>
            <p class="brand">All applicants for merchant accounts need to be compliant with the following general requirements:</p>
            <ul>
                <li><b>Legal presence</b> for all merchant account applicants must be legally incorporated as businesses in their country or at least registered with the local city or town and obtain a “Doing Business As” (DBA) name.</li>
                <li><b>Physical presence</b> for all applicants must maintain a physical address in their country that can be verified. A P.O. Box is insufficient.</li>
                <li><b>Bank account.</b> The bank account into which the merchant would have their funds deposited must be set up with a bank.</li>
            </ul>
            <p>For more information please check our <a href="http://local.semitepayment.com/merchant-account-requirement" target="_blank">Merchant Account Application</a> Informations</p>
        </div>
        <?php } else { ?>
        <h4>Congragulations!</h4>
        <h5>Your Semite Payment Account has been already Approved.</h5>
        <?php } ?>
    </div>
</div>
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
    //--></script>
<?php echo $footer?>