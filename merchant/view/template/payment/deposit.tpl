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
        <?php if ($error_warning) { ?>
        <div class="alert alert-light">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo $error_warning?>
        </div>
        <?php } ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="PostToMPI" class="form-horizontal" role="form" id="form">
        <input type="hidden" name="pOrgNo"  value="<?php echo $vpos['organization']?>" />
        <input type="hidden" name="pFirmNo"  value="<?php echo $vpos['company_code']?>" /> 
        <input type="hidden" name="pTermNo" value="<?php echo $vpos['terminal']?>" /> 
        <input type="hidden" name="pTaksit" value="0" /> 
        <input type="hidden" name="pXid" value="<?php echo $pXid?>" /> 
        <input type="hidden" name="pokUrl" value="<?php echo $pokUrl?>" /> 
        <input type="hidden" name="pfailUrl" value="<?php echo $pfailUrl?>" /> 
        <input type="hidden" name="pSipNo" value="<?php echo $pSipNo?>"/> 
        <!--<input type="text" name="pNotes" value=""/>--> 
        <div class="form-group">
            <label for="amount" class="col-sm-3 control-label"><?php echo $entry_amount?></label>
            <div class="col-sm-3">
                <input type="hidden" name="pAmount" value="" class="form-control">
                <input type="text" name="Amount" value="" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="notes" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-3">
                <textarea name="pNotes" class="form-control span6"></textarea>
            </div>
        </div>
    </form>
        <div class="form-actions">
            <button id="pay" class="btn btn-primary"><?php echo $button_deposit?></button>
            <button type="button" class="btn" onclick="window.location = '<?php echo $home?>'"><?php echo $button_cancel?></button>
        </div>
</div>
<script>
    $('#pay').bind('click',function(){
        var pAmount = $('input[name=\'Amount\']').val() * 100;
        
        $('input[name=\'pAmount\']').val(pAmount);
        
        $('#PostToMPI').submit();
            });
    
</script>
<?php echo $footer?>