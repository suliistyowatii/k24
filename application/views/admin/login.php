<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>login</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>
 <body class="login">
 
    <p>
</p>
    <div class="container">
 <div class="row">
       <div class="col-md-4"></div>
            <div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-body">
  <h3><i class="fa fa-user"></i> <span>Login </span></h3><hr/>
  <?php echo form_open('admin/clogin'); ?>
         <div class="form-group">
       <label for="username">Username</label>
        <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
       <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required="">
        </div>
        </div>

        <div class="form-group">
       <label for="password">Password</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
       <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required="">
       </div>
     </div>
       <button type="submit" class="btn btn-primary">Submit</button>
  <?php echo form_close(); ?>
             </div>
             </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
  </body>
</html>
