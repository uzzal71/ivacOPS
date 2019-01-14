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
      <h2>Change User Password</h2>
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
      <form class="form-horizontal form-label-left" autocomplete="off" method="POST">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">New Passwrod</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="employee_id" id="employee_id">
          <option value="select" selected>Select Employee</option>
          <?php
          $center_permitted = $this->session->userdata('center_permitted');
          $expload_center = explode(',', $center_permitted);
          $center_length = count($expload_center);
          $count = 1;
          for($i=0; $i<$center_length;$i++){
          $where_employee = array('center_id' => $expload_center[$i]);
          $employees= $this->db->get_where('employee', $where_employee)->result_array();
          foreach ($employees as $row):
          ?>
          <option value="<?php echo $row['employee_id'];?>"><?php echo $row['employee_name'];?></option>
          <?php  endforeach; } ?>
          </select>
          </div>
        </div>  
        <div class="clearfix"></div><br />
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Passwrod</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="password" id="password" placholder="Password" required>
          </div>
        </div>                      
        <div class="clearfix"></div><br /> 
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placholder="Confirm Password" required>
          </div>
        </div>                     
        <div class="clearfix"></div><br />                      
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-success" id="cup_btn">Submit</button>
            <!-- cup = Change User Password -->            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

$("#cup_btn").click(function()
{     
  if(form_validation())
  {
    
    var employee_id = $('#employee_id').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();

    
    var response;
    $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/Admin_Change_User_Password_Save',
      data:{ 
          employee_id: employee_id,
          password: password
        },
      //timeout: 4000,
      success: function(result) {
        response = result;
        alert(response);
        window.location.replace("<?php echo base_url();?>user_controller/Admin_Change_User_Password");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
    
    //alert(response);
    
  
  }


});
  

  function form_validation()
  {
    //alert("validation");
    
    if($('#employee_id').val() == "select")
    {
      alert("Please Select Employee");
      $('#employee_id').focus();
      return false;
    }   

    else if($('#password').val() == "")
    {
      alert("Enter Password.");
      $('#password').focus();
      return false;
    }

    else if($('#confirm_password').val() == "")
    {
      alert("Enter Confirm Password.");
      $('#password').focus();
      return false;
    }

    else if($('#password').val() != $('#confirm_password').val())
    {
      alert("Enter Password.");
      $('#password').focus();
      return false;
    }


    return true;
  }
</script>