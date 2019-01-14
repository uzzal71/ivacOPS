<div class="col-md-6 col-xs-12 col-md-offset-3">
<?php
// Error Message showing
$error = $this->session->userdata('error');
if(isset($error)) {
  ?>

  <div class="alert alert-danger alert-dismissible fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>ERRORS!</strong> <?php echo $error; ?>
</div>

  <?php
  $this->session->unset_userdata('error');
} 
// Success Message showing
$message = $this->session->userdata('message');
if(isset($message)) {
  ?>

  <div class="alert alert-success alert-dismissible fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>SUCCESS!</strong> <?php echo $message; ?>
</div>

  <?php
  $this->session->unset_userdata('message');
}
   ?>
<div class="x_panel">
  <div class="x_title">
    <h2>New Center Form</h2>
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
    <form class="form-horizontal form-label-left" action="<?php echo site_url('center_controller/save');?>" method="POST">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center Name</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="center_name" placeholder="Center Name" autocomplete="off">
        </div>
      </div>
      <div class="clearfix"></div><br />
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="">
            <label>
              <input type="checkbox" class="js-switch" checked name="status" /> Active
            </label>
          </div>
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>

    </form>
  </div>
</div>
</center>