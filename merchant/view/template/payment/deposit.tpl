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
        <!--img src="merchant/view/assets/img/logo-provus.png"--/>
        <?php echo $text_information?>
    </div>
    <!-- / Alert -->
        <?php if ($error_warning) { ?>
        <div class="alert alert-light">
        <a class="close" data-dismiss="alert">×</a>
        <?php echo $error_warning?>
        </div>
        <?php } ?>
        <?php //print_r($vpos)?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="PostToMPI" class="form-horizontal" role="form" id="form">
        <p class="brand"><h4><?php echo $vpos['company_name']?></h4></p>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> Card Holder Name:</label>
            <div class="controls">
                <input name="pCardHolder" value="" class="form-control span3"/><br/>
                <?php if ($error_cardholder) { ?>
                <span class="error"><?php echo $error_cardholder ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> Card Number:</label>
            <div class="controls">
                <input name="pCardNo" class="form-control span3"/><br/>
                <?php if ($error_cardnum) { ?>
                <span class="error"><?php echo $error_cardnum ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> CVV2:</label>
            <div class="controls">
                <input name="pCVV2" class="form-control span1"/><br/>
                <?php if ($error_cvv) { ?>
                <span class="error"><?php echo $error_cvv ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> Expire Date:</label>
            <div class="controls">
                <select name="pExpYear" class="form-control span1">
                    <?php
                        for($i = date("Y"); $i < date("Y")+10; $i++){
                          echo "<option>" . $i . "</option>";
                        }
                       ?>
                </select>
                <select name="pExpMonth" class="form-control span2">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <br/>
                <?php if ($error_expire) { ?>
                <span class="error"><?php echo $error_expire ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> Amount:</label>
            <div class="controls">
                <input name="pAmountManual" class="form-control span2"/><br/>
                <span class="help">Default Currency is TRY.</span>
                <br/>
                <?php if ($error_currency) { ?>
                <span class="error"><?php echo $error_currency ?></span>
                <?php } ?>
                <br/>
                <?php if ($error_amount) { ?>
                <span class="error"><?php echo $error_amount ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="control-group">
            <label for="" class="col-sm-3 control-label"> Description:</label>
            <div class="controls">
                <textarea name="pNotes" rows="7" class="span3"></textarea>
            </div>
        </div> 
        <div class="form-actions">
            <button type="button" id="pay" class="btn btn-primary"><?php echo $button_deposit?></button>
            <button type="button" class="btn" onclick="window.location = '<?php echo $home?>'"><?php echo $button_cancel?></button>
        </div>
    </form>
        <script>
            $('#pay').on('click',function(){
                $('#PostToMPI').submit();
            });
        </script>
<?php echo $footer?>