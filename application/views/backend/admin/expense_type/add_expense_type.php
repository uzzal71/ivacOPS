<div class="col-md-6 col-xs-12 col-md-offset-3">
<?php
// Error Message Display
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

// Success message display
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
    <h2>Add Income Type</h2>
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
    <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('expense_type_controller/save');?>" method="POST">
      <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Center Name</label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="form-control" name="center_id" id="center_id" required>
          <option selected>Select Center</option>
          <?php
              $centers = $this->db->get('centers')->result_array();
              foreach($centers as $center)
              {
                ?>
                <option value="<?php echo $center['center_id'] ?>"><?php echo $center['center_name'] ?></option>
                <?php
              }
           ?>
        </select>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expense Type</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="expense_type" placeholder="Expense type" autocomplete="off" required>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="form-control" name="status" id="status" required>
          <option value="1" selected>Active</option>
          <option value="0">Inactive</option>
        </select>
      </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="submit" class="btn btn-success">Add Expense</button>
        </div>
      </div>

    </form>
  </div>
</div>
</center>