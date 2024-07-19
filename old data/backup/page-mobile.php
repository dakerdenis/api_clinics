<?php // Template Name: Mobile application ?>

<!DOCTYPE html>
<html>
<body>

    <?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- START Header  -->
    <section class="application-main">
        <!-- <div class="mobile-title">
            <h1><?php //the_title() ?></h1>
        </div> -->
        <div class="mobile-download-icons">
            <a href="https://play.google.com/store/apps/details?id=agroup.com.healthmobapp&hl=ru"> <img src="<?php templateDir() ?>/img/mobile-page/google_play.png" /> </a>
            <a href="https://apps.apple.com/ru/app/a-group-mobile-concierge/id1121971467"> <img src="<?php templateDir() ?>/img/mobile-page/app_store.png" /> </a>
        </div>
    </section>
    <!-- END Header  -->


    <!-- START Steps  -->
    <section class="mobile-steps">
        <div class="container">

            <div class="row mob-blocks mobile-background1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mobile-title">
                            <h3>МОБИЛЬНЫЙ КОНСЬЕРЖ обеспечивает:</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="offers-item-image "><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile1.png"></div>
                </div>
                <div class="col-sm-6 step-text">
                    <h1>1</h1><br>
                    <h4><?php pll_e('Step 1 title'); ?></h4><br>
                    <h5><?php pll_e('Step 1 content'); ?></h5>
                </div>
            </div>


            <div class="row mob-blocks mobile-background2">
                <div class="col-sm-6 step-text">
                    <h1>2</h1><br>
                    <h4><?php pll_e('Step 2 title'); ?></h4><br>
                    <h5><?php pll_e('Step 2 content'); ?></h5>
                </div>
                <div class="col-sm-6 ">
                    <div class="offers-item-image"><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile2.png"></div>
                </div>
            </div>


            <div class="row mob-blocks mobile-background3">
                <div class="col-sm-6">
                    <div class="offers-item-image"><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile3.png"></div>
                </div>
                <div class="col-sm-6 step-text">
                    <h1>3</h1><br>
                    <h4><?php pll_e('Step 3 title'); ?></h4><br>
                    <h5><?php pll_e('Step 3 content'); ?></h5>
                </div>
            </div>


            <div class="row mob-blocks mobile-background4">
                <div class="col-sm-6 step-text">
                    <h1>4</h1><br>
                    <h4><?php pll_e('Step 4 title'); ?></h4><br>
                    <h5><?php pll_e('Step 4 content'); ?></h5>
                </div>
                <div class="col-sm-6">
                    <div class="offers-item-image"><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile4.png"></div>
                </div>
            </div>


            <div class="row mob-blocks mobile-background5">
                <div class="col-sm-6">
                    <div class="offers-item-image"><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile5.png"></div>
                </div>
                <div class="col-sm-6 step-text">
                    <h1>5</h1><br>
                    <h4><?php pll_e('Step 5 title'); ?></h4><br>
                    <h5><?php pll_e('Step 5 content'); ?></h5>
                </div>
            </div>


            <div class="row mob-blocks mobile-background6">
                <div class="col-sm-6 step-text">
                    <h1>6</h1><br>
                    <h4><?php pll_e('Step 6 title'); ?></h4><br>
                    <h5><?php pll_e('Step 6 content'); ?></h5>
                </div>
                <div class="col-sm-6">
                    <div class="offers-item-image"><img
                            src="<?php templateDir() ?>/img/mobile-page/mobilepage-mobile6.png"></div>
                </div>
            </div>

        </div>
    </section>
    <!-- END Steps  -->

    <?php endwhile; endif; ?>


    <?php get_footer(); ?>

</body>
</html>