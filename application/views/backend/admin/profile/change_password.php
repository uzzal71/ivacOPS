<div class="col-md-6 col-xs-12 col-md-offset-3">
    <?php
  
   $error = $this->session->userdata('error');
    if(isset($error)) {
      ?>

      <div class="alert alert-danger alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> <?php echo $message; ?>
    </div>

      <?php
      $this->session->unset_userdata('message');
    } 

   ?>
  <div class="x_panel">
    <div class="x_title">
      <h2>Password Change Form</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <?php
      $where_data = array('employee_id' => $this->session->userdata('employee_id'));
      $passwords = $this->db->get_where('users', $where_data)->result_array();
      foreach($passwords as $password):
      ?>
      <form class="form-horizontal form-label-left" action="<?php echo site_url('information_controller/save_password');?>" method="POST">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="employee_id" value="<?php echo $this->session->userdata('employee_id');?>" readonly>
          </div>
        </div>
        <div class="clearfix"></div><br />
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">New Passwrod</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="password" placholder="New Password" required>
          </div>
        </div>                      
        <div class="clearfix"></div><br /> 
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="confirm_password" placholder="Confirm Password" required>
          </div>
        </div>                     
        <div class="clearfix"></div><br />                      
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

      </form>
    <?php endforeach;?>
    </div>
  </div>
</div>