<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title ?></title>
   <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/vendors/iCheck/skins/flat/green.css"rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
 <link href="<?php echo base_url();?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.min.css"  rel="stylesheet">

    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css"  rel="stylesheet">
    <link href="<?php echo base_url();?>assets/production/css/-datepicker.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/production/images/k24.png">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><i class="fa fa-building-o"></i> <span>K-24</span></a>
            </div>


            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>assets/production/images/k24.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $username; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <?php $this->load->view('admin/menu/menu') ?>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>


<div class="top_nav">
<div class="nav_menu">
<div class="nav toggle">
<a id="menu_toggle"><i class="fa fa-bars"></i></a>
</div>
<nav class="nav navbar-nav">
<ul class=" navbar-right">
<li class="nav-item dropdown open" style="padding-left: 15px;">
<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
<?php echo $username; ?>
  
</a>
<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
 <a class="dropdown-item" href="javascript:;"> Profile</a>

<a class="dropdown-item" href="<?php echo base_url();?>admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
</div>
</li>

</div>
</li>
</ul>
</li>
</ul>
</nav>
</div>
</div>

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
            <?php $this->load->view($main);?>

          </div>
          <br />

              </div>
            </div>
          </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           K-24 PHP_DEV Test(Sulistyowati)
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/jquery/dist/jquery.min.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/fastclick/lib/fastclick.js'?>"></script>

  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/nprogress/nprogress.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/Chart.js/dist/Chart.min.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/gauge.js/dist/gauge.min.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'?>"></script>
  <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/vendors/skycons/skycons.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.js"></script>
 <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.time.js"></script>

    <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.stack.js"></script>

     <script src="<?php echo base_url();?>assets/vendors/Flot/jquery.flot.resize.js"></script>
     <script src="<?php echo base_url();?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>

     <script src="<?php echo base_url();?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
     <script src="<?php echo base_url();?>assets/vendors/flot.curvedlines/curvedLines.js" ></script>
     <script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js" ></script>
     <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js" ></script>
     <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js" ></script>
<script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js" ></script>
   <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js" ></script>
   <script src="<?php echo base_url();?>assets/build/js/custom.min.js"></script>  
   <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="d559a9d33c5217e3ba638576-|49" defer=""></script></body>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('assets/production/js/bootstrap-select.js');?>"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  </body>
</html>
