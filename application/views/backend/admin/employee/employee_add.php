<div class="col-md-12 col-xs-12">

  <?php
 $error = $this->session->userdata('error');
  if(isset($error)) {
    ?>

    <div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $error; ?>
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
    <?php echo $message; ?>
  </div>

    <?php
    $this->session->unset_userdata('message');
  } 

   ?>

</div>

<!-- New Form -->
<div class="col-md-12 col-xs-12">
  <form class="form-horizontal form-label-left" autocomplete="0ff" method="POST" action="<?php echo site_url('employee_controller/save');?>">
  <div class="col-md-6 col-xs-6">
    <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id">
              <option selected>Select Center</option>
              <?php
                $center_permitted = $this->session->userdata('center_permitted');
                $expload_center = explode(',', $center_permitted);
                $center_length = count($expload_center);
                $count = 1;
                for($i=0; $i<$center_length;$i++){
                  $where_center = array('center_id' => $expload_center[$i]);
                  $centers = $this->db->get_where('centers', $where_center)->result_array();
                  foreach($centers as $center)
                  {
                    ?>
                    <option value="<?php echo $center['center_id'] ?>"><?php echo $center['center_name'] ?></option>
                    <?php
                  }
                }
               ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="employee_id" placeholder="Employee ID" id="employee_id" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="employee_name" placeholder="Employee Name" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Father name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Mother name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mother_name" id="father_name" placeholder="Mother name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Present Address</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="present_address" id="present_address" placeholder="Present Address">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Permanent Address</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="permanent_address" id="permanent_address" placeholder="Permanent Address">
          </div>
        </div>
        <div class="clearfix"></div>        
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success" id="create_employee">Submit</button>
          </div>
        </div>      
  </div>
  <!-- Sidebar -->
  <div class="col-md-6 col-xs-6">
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Spouse Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="Spouse name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="date_of_birth" id="birth_day">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Joining</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="date_of_joining" id="join_date">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Blood Group</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="blood_group" placeholder="Blood Group">
          </div>
        </div>
        <fieldset>
          <legend>Emergeracy Contact</legend>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="em_name" id="em_name" placeholder="Name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone No.</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="em_phone" id="em_phone" placeholder="Phone No">
          </div>
        </div>
        </fieldset>
        <br>
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

  </div>
  </form>
</div>