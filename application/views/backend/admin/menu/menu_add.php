<div class="col-md-6 col-xs-12 col-md-offset-3">
  <?php
$error = $this->session->userdata('error');
if(isset($error)) {
  ?>

  <div class="alert alert-danger alert-dismissible fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>ERROR!</strong> <?php echo $error; ?>
</div>

  <?php
  $this->session->unset_userdata('error');
} 

   ?>
  <div class="x_panel">
    <div class="x_title">
      <h2>New Menu Form</h2>
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
      <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('menu_controller/save');?>" method="POST">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="menu" placeholder="Menu Name" autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent/Parent Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="parent_id">
              <option selected>Select Parent</option>
              <option value="0">Self Parent</option>
              <?php 
                  foreach($parent_select as $parent)
                  {
                    ?>
                    <option value="<?php echo $parent['id'] ?>"><?php echo $parent['menu'] ?></option>
                    <?php
                  }
               ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Url Link</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="url_link" placeholder="Url Link" autocomplete="off">
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
</div>