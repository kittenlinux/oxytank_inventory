<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="th">

<head>

    <!-- Basic -->
    <title>Oxygen Tank Inventory</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="Oxygen Tank Inventory">
    <meta name="author" content="shadowshi">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css"
        media="screen">

    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/default/css/slicknav.css"
        media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/default/css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/default/css/responsive.css"
        media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/default/css/animate.css"
        media="screen">

    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/default/css/colors/green.css"
        title="red" media="screen" />

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css"
        media="screen" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>

    <!-- Margo JS  -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-migrate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
    <!-- <script src="https://polyfill.io/v3/polyfill.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.fitvids.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/nivo-lightbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.appear.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>themes/default/js/count-to.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.textillate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.lettering.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-parallax-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mediaelement-and-player.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>themes/default/js/jquery.slicknav.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/th.min.js"></script>
    <script
        src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js">
    </script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-4.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2@9"></script>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

    <!--[if IE 8]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->

    <style>
    ::selection {
        background-color: #E13300;
        color: white;
    }

    ::-moz-selection {
        background-color: #E13300;
        color: white;
    }
    </style>

    <link href="<?php echo base_url(); ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>

<body>

    <!-- Full Body Container -->
    <div id="container">

        <!-- Start Header Section -->
        <div class="hidden-header"></div>
        <header class="clearfix">

            <!-- Start Top Bar -->
            <div class="top-bar">
                <?php if ($this->ion_auth->logged_in()) {
    $this->load->view('core/top_bar_auth');
} else {
    $this->load->view('core/top_bar');
}
      ?>
            </div>
            <!-- .top-bar -->
            <!-- End Top Bar -->

            <!-- Start  Logo & Naviagtion  -->
            <div class="navbar navbar-default navbar-top">
                <?php if ($this->ion_auth->logged_in()&&$this->ion_auth->is_admin()) {
          $this->load->view('core/menu_nav_admin');
      } elseif ($this->ion_auth->logged_in()) {
          $this->load->view('core/menu_nav_user');
      } else {
          $this->load->view('core/menu_nav');
      }
      ?>
            </div>
            <!-- End Header Logo & Naviagtion -->

        </header>
        <!-- End Header Section -->

        <!--BODY_CONTENT-->