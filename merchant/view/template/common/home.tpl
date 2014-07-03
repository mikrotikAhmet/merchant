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
<?php echo $footer?>