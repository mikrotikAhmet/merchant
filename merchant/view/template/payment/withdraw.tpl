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

<div class="container">
    <div class="span12" style="margin-bottom: 7px">
        <?php if ($error_warning) { ?>
        <div class="alert alert-light">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo $error_warning?>
        </div>
        <?php } ?>
    </div>
    <div class="span3 well infobox pull-left">
            <i class="icon-6x icon-renren"></i>
            <div class="pull-right text-right">
                <?php echo $text_balance_withdraw?><br>
                <b class="huge" id="available"><?php echo $withdrawbalance?></b><br>
            </div>
        </div>
    <div class="span3 well infobox pull-right">
            <i class="icon-6x icon-money"></i>
            <div class="pull-right text-right">
                <?php echo $text_balance?><br>
                <b class="huge" id="balance"><?php echo $balance?></b><br>
            </div>
    </div>
    <div class="clearfix"></div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal" role="form" id="form">
        
        <div class="control-group">
            <label for="bank_select" class="col-sm-3 control-label"> <?php echo $entry_account?></label>
            <div class="controls">
                <select name="bank_id">
                    <option value=""><?php echo $text_select?></option>
                    <?php foreach ($banks as $bank) { ?>
                    <?php 
                        if ($bank['status'] != $this->config->get('config_complete_bankaccount_status_id')){
                            continue;
                        }
                    ?>
                    <option value="<?php echo $bank['customer_bank_id']?>"><?php echo $bank['bank_name']?> - <?php echo $bank['settlement_currency']?></option>
                    <?php } ?>
                </select>
                <br/>
                <?php if ($error_bank) { ?>
                <span class="error"><?php echo $error_bank; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="bank_select" class="col-sm-3 control-label"> <?php echo $entry_amount?></label>
            <div class="controls">
                <input type="text" id="inputUsername" name="amount" placeholder="" value="0">
                <br/>
                <?php if ($error_amount) { ?>
                <span class="error"><?php echo $error_amount; ?></span>
                <?php } ?>
                <?php if ($error_currency) { ?>
                <span class="error"><?php echo $error_currency; ?></span>
                <?php } ?>
            </div>
        </div> 
        <div class="control-group">
            <label for="bank_select" class="col-sm-3 control-label"> <?php echo $entry_comment?></label>
            <div class="controls">
                <textarea name="comment" rows="7" class="span9"></textarea>
            </div>
        </div> 
        
        <div class="form-actions">
            <button type="button" onclick="$('#form').submit();" class="btn btn-primary"><?php echo $button_withdraw?></button>
            <button type="button" class="btn" onclick="window.location = '<?php echo $home?>'"><?php echo $button_cancel?></button>
        </div>
    </form>
</div>
<script>

    $('select[name=\'bank_id\']').bind('change',function(){
        
        var selection = $('select[name=\'bank_id\'] option:selected').text();
        var parts = selection.split(" - ");
        
        $.ajax({
            url: 'index.php?route=payment/withdraw/currencyChange&token=<?php echo $token; ?>',
            data : 'curr='+parts[1],
            type : 'POST',
            dataType: 'json',
            success: function(json) {
                $('#balance').html(json[0].balance);
                $('#available').html(json[0].withdraw);
            }
        });
        
        
    });
</script>
<?php echo $footer?>