<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ivacOPS</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>./assets/icon/icon.png"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css');?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets/vendors/animate.css/animate.min.css');?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js');?>"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
              <?php
  
                 $error = $this->session->userdata('error');
                  if(isset($error)) {
                    ?>

                    <div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" id="message">&times;</a>
                    <strong>Error!</strong> <?php echo $error; ?>
                  </div>

                    <?php
                    $this->session->unset_userdata('error');
                  } 

                 ?>
                 <?php
  
                  $message = $this->session->userdata('message');
                  if(isset($message)) {
                    ?>

                    <div class="alert alert-success alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" id="message">&times;</a>
                    <strong>Success!</strong> <?php echo $message; ?>
                  </div>

                    <?php
                    $this->session->unset_userdata('message');
                  } 

                 ?>
          <section class="login_content">
            <?php echo form_open('login/attempt_login');?>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Employee ID" name="employee_id" required="" autocomplete="off"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-user"></i> Employee Evaluation</h1>
                  <p>©2018 All Rights Reserved. <a href="http:\\www.2ra-bd.com" >2RA Technology Ltd</a></p>
                </div>
              </div>
            <?php echo form_close();?>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <?php echo form_open();?>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-user"></i> Employee Evaluation</h1>
                  <p>©2018 All Rights Reserved. <a href="http:\\www.2ra-bd.com">2RA Technology Ltd</a></p>
                </div>
              </div>
            <?php echo form_close();?>
          </section>
        </div>
      </div>
    </div>

<script type="text/javascript">
$(document).ready(function() {
  $('#message').click(function(){
    $('.alert').fadeOut(2000);
  });
});
</script>

  </body>
</html>
