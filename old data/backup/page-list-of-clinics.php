<?php // Template Name: List of clinics ?>

<!DOCTYPE html>
<html>

<body>

    <!-- class loc = list of clinics -->

    <?php get_header(); ?>

    <section class="main loc-main">
        <div class="main-cover loc-main-cover" style='background: url("<?php the_post_thumbnail_url() ?>");'></div>
    </section>
    <section class="list-detail loc-list-detail">
        <div class="container">
            <div class="container-list loc-container-list">
                <div class="row" style="margin:0px;">
                    <div class="col-sm-12">
                        <div class="page-title loc-page-title">
                            <h1><?php the_title() ?></h1>
                        </div>
                    </div>
                    
                    <ul class="nav nav-tabs loc-nav-tabs">
                        <li class="<?= $_GET['section'] == '1' ? 'active' : '' ?>"><a data-toggle="tab" href="#pharmacylist"><b><?php pll_e('List of pharmacies') ?></b></a></li>
                        <li class="<?= $_GET['section'] == '2' ? 'active' : '' ?>"><a data-toggle="tab" href="#clinicslist"><b><?php pll_e('List of clinics') ?></b></a></li>
                        <li class="<?= $_GET['section'] == '3' ? 'active' : '' ?>"><a data-toggle="tab" href="#opticianlist"><b><?php pll_e('List of optics') ?></b></a></li>
                    </ul>




                    <div class="tab-content loc-tab-content">
                        <div id="pharmacylist" class="tab-pane fade in active">
                            <div class="panel-group loc-panel-group" id="accordion">
                                

                            </div>

                            <div class="clinics-map loc-clinics-map">
                                <div id="map" style="height:400px; width:100%"></div>
                            </div>
                        </div>


                        <!------------------------------------------------------------------------------------------------------------------------------------------->


                        <div id="clinicslist" class="tab-pane fade in">

                            <div class="panel-group loc-panel-group" id="accordion2">

                            </div>

                            <div class="clinics-map loc-clinics-map">
                                <div id="map-clinics" style="height:400px; width:100%"></div>
                            </div>
                        </div>


                        <!------------------------------------------------------------------------------------------------------------------------------------------->


                        <div id="opticianlist" class="tab-pane fade in">
                            
                                        <div class="panel-group loc-panel-group" id="accordion3">

                                            </div>

                                            <div class="clinics-map loc-clinics-map">
                                                <div id="map-optics" style="height:400px; width:100%"></div>
                    
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <?php get_footer(); ?>

</body>

</html>