<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Start Home Page Slider -->
<section id="home">
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#main-slide" data-slide-to="0" class="active"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="img-responsive" src="<?php echo base_url(); ?>themes/default/images/slider/bg1.jpg"
                    alt="slider">
                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated7">
                            <span>ยินดีต้อนรับสู่ <strong>Oxygen Tank Inventory</strong></span>
                        </h2>
                        <!-- <h3 class="animated8 white">
                            <span>-</span>
                        </h3> -->
                        <p class="animated6"><a href="<?php echo base_url(); ?>Dashboard"
                                class="slider btn btn-system btn-large">เข้าสู่หน้าจัดการข้อมูล</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <!-- <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a> -->
    </div>
    <!-- /carousel -->
</section>
<!-- End Home Page Slider -->

<!-- Set active navigator bar menu -->
<script>
var nav_bar_active = 'nav-bar-home';
</script>