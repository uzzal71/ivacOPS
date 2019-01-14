<?php 

   $user_type = $this->session->userdata('login_type');
   $logged_in_user = $this->session->userdata('logged_in_user');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>./assets/icon/icon.png"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | <?php
    $where_data = array('employee_id' =>$this->session->userdata('employee_id'));
    $ename = $this->db->get_where('employee', $where_data)->result_array();
    foreach($ename as $row):
      echo $row['employee_name'];
    endforeach;
     ?></title>

    <?php include APPPATH.'views/backend/styles.php';?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <img src="">
                <h2 style="color: #fff;margin-left: 10px;"><i class="fa fa-medium" aria-hidden="true"></i>
                Manage ivacOPS</h2>
                <h2 style="color: #fff;margin-left: 10px;">
                  <i class='fa fa-circle' style="color: #e84118"></i>
                  <?php
                    $where_data = array('employee_id' =>$this->session->userdata('employee_id'));
                    $ename = $this->db->get_where('employee', $where_data)->result_array();
                    foreach($ename as $row):
                      echo $row['employee_name'];
                    endforeach;
                     ?>

                </h2>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
           <!--  <div class="profile clearfix">
              <div class="profile_info">
                <h2><span>Welcome,</span>
                <?php echo $this->session->userdata('employee_id');?></h2>
              </div>
              <div class="clearfix"></div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include APPPATH.'views/backend/'.$user_type . '/navigation.php';?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php include APPPATH.'views/backend/menu_footer.php';?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
       <?php include APPPATH.'views/backend/'.$user_type . '/top_navigation.php';?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <!-- <div class="title_left">
                <h3><i class="fa fa-user"></i> Employee Evaluation</h3>
              </div> -->

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Hint...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Search!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo strtoupper($page_title) ;?></h2>
                   
                   <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <?php include APPPATH.'views/backend/'.$user_type . '/' . $page_name . '.php';?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
       <?php include APPPATH.'views/backend/'.'footer.php';?>
        <!-- /footer content -->
      </div>
    </div>

    <?php include APPPATH.'views/backend/'.'scripts.php';?>

  </body>
</html>
