<?php echo $header?>
<!-- Top Fixed Bar: Breadcrumb -->
<div class="breadcrumb clearfix">

    <!-- Top Fixed Bar: Breadcrumb Container -->
    <div class="container">

        <!-- Top Fixed Bar: Breadcrumb Location -->
        <ul class="pull-left">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><i class="icon-home"></i> <?php echo $breadcrumb['text']; ?></a><li>
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

    <?php if ($error_approved) { ?>
    <!-- Alert -->
    <div class="alert alert-light">
        <a class="close" data-dismiss="alert">&times;</a>
        <i class="icon-remove-sign"></i> <?php echo $error_approved?>
    </div>
    <!-- / Alert -->
    <?php } ?>

    <div class="row-fluid">
        <!-- Information Boxes: Next transfer -->
        <div class="span3 well infobox">
            <div class="pull-left text-left">
                <table>
                    <tr>
                        <td>Completed Transfer(s)</td>
                        <td class="text-right"> : [ <?php echo $this->customer->getTotalSuccessWithdraw()?> ]</td>
                    </tr>
                    <tr>
                        <td>Pending Transfer(s)</td>
                        <td class="text-right"> : [ <?php echo $this->customer->getTotalPendingWithdraw()?> ]</td>
                    </tr>
                    <tr>
                        <td>Total Transaction(s)</td>
                        <td class="text-right"> : [ <?php echo $this->customer->getTotalTransaction()?> ]</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- / Information Boxes: Next transfer -->
        <!-- Information Boxes: Last transfer -->
        <div class="span3 well infobox">
            <i class="icon-6x icon-home"></i>
            <div class="pull-right text-right">
                <?php echo $text_last_transfer?><br>
                <b class="huge"><?php echo $last_transfer?></b><br>
                <span class="caps muted"><?php echo $text_withdraw?></span>
            </div>
        </div>
        <!-- / Information Boxes: Last transfer -->
        <!-- Information Boxes: Next transfer -->
        <div class="span3 well infobox">
            <i class="icon-6x icon-mail-reply"></i>
            <div class="pull-right text-right">
                <?php echo $text_next_transfer?><br>
                <b class="huge"><?php echo $next_transfer?></b><br>
                <span class="caps muted">
                    <?php echo $date?>
                </span>
            </div>
        </div>
        <!-- / Information Boxes: Next transfer -->
        <!-- Information Boxes: Balance -->
        <div class="span3 well infobox pull-right">
            <i class="icon-6x icon-money"></i>
            <div class="pull-right text-right">
                <?php echo $text_balance?><br>
                <b class="huge"><?php echo $balance?></b><br>
                <span class="caps muted">
                    <a href="<?php echo $deposit?>"><?php echo $button_deposit?></a>-
                    <a href="<?php echo $withdraw?>"><?php echo $button_withdraw?></a>
                </span>
            </div>
        </div>
        <!-- / Information Boxes: Balance -->
    </div>

    <!-- Live Stats -->
    <div class="row-fluid">
        <!-- Pie: Box -->
        <div class="span12">
            <!-- Pie: Top Bar -->
            <div class="top-bar">
                <h3><i class="icon-eye-open"></i> Transaction History</h3>
            </div>
            <!-- / Pie: Top Bar -->
            <!-- Pie: Content -->
            <div class="well no-padding">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th class="center">Status</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction) { ?>
                        <tr class="odd gradeX">
                            <td><?php echo $transaction['transaction_id']?></td>
                            <td><?php echo $transaction['type']?></td>
                            <td><?php echo $transaction['description']?></td>
                            <td class="center"> <?php echo $transaction['status']?></td>
                            <td class="center"><a data-transaction="<?php echo $transaction['transaction_id']?>" class="btn btn-success pull-right">Details</a></td>
                        </tr>
                        <tr class="details" id="<?php echo $transaction['transaction_id']?>" style="display: none">
                            <td colspan="5"><h4>Details of ID : <?php echo $transaction['transaction_id']?></h4></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>

            </div>
            <!-- / Pie: Content -->

        </div>
        <!-- / Pie -->

    </div>
    <!-- / Live Stats -->
</div>
<!-- / Content Container -->
<script>
    
    $('.data-table a').bind('click',function(){
        
        var transaction_id = $(this).attr('data-transaction');
        $('.details').hide();
        
        $('#'+transaction_id).toggle();
    });
    
</script>
<?php echo $footer?>