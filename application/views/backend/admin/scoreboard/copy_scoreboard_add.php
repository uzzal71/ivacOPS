<?php 
  
  include('years_months.php');

?>
<div class="col-md-6 col-xs-12 col-md-offset-3">
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
<div class="x_panel">
  <div class="x_title">
    <h2>New Score Form</h2>
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
    <form class="form-horizontal form-label-left" action="<?php echo site_url('scoreboard_controller/save');?>" method="POST">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="center_id" id="center_id">
          <option selected>Center name</option>
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
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="employee_id" id="employee_id">
            
          </select>
        </div>
      </div>
       <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="employee_name" id="employee_name" disabled>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="date" placeholder="xxxx-xx-xx" id="datepicker">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Receive</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="recive" placeholder="Receive">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="delivery" placeholder="Delivery">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Scanning</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="scanning" placeholder="Scanning">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Backend</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="backend" placeholder="Backend">
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

<script type="text/javascript">
  $(document).ready(function() {
  $('.employee_id').select2();

    $("#center_id").change(function(){
      
      var center_id = $('#center_id').val().trim();

      var response;
      $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/pick_employee_list_without_status',
          data:{ 
              center_id: center_id
            },
          success: function(result) {
            response = result;
            $('#employee_id').html(response);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });
     
    });

  });
</script>


<script type="text/javascript">

$(document).ready(function() {

// Inner Employee Name
$('.employee_name').select2();

$("#employee_id").change(function(){
  
  var employee_id = $('#employee_id').val().trim();
  var center_id = $('#center_id').val().trim();
        
  var response;
  $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/pick_employee_name_check_center',
      data:{ 
          employee_id: employee_id,
          center_id: center_id
        },
      success: function(result) {
        response = result;
        $('#employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });    
});



});
  </script>
