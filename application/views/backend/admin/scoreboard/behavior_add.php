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
      <strong>Success!</strong> <?php echo $error; ?>
    </div>

      <?php
      $this->session->unset_userdata('error');
    } 

   ?>
<div class="x_panel">
  <div class="x_title">
    <h2>Employee Behavior Form</h2>
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
    <form class="form-horizontal form-label-left" method="POST" action="<?php echo site_url('scoreboard_controller/save_behavior'); ?>">
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
          <select class="form-control employee_id" name="employee_id" id="employee_id">
            <!-- get ajax employee info -->
          </select>
        </div>
      </div>
     <div class="clearfix"></div>
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Month</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="month" id="month">
              <option selected>Select month</option>
              <?php
               
                foreach($months as $month):  
               ?>
               <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
             <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="year" id="year">
              <option selected>Select year</option>
              <?php
               
                foreach($year_load as $year):  
               ?>
               <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
             <?php endforeach; ?>
              
            </select>
          </div>
        </div>
        <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Behaviour Score</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="behavior" id="behavior" placeholder="Behaviour">
        </div>
      </div> 
      <div class="clearfix"></div> 
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Late Day</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="late_day" id="late_day" placeholder="Late day">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Working Day</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="working_day" id="working_day" placeholder="Working day">
        </div>
      </div>
      <div class="clearfix"></div>
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
          //timeout: 4000,
          success: function(result) {
            response = result;
            $('#employee_id').html(response);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });
          

      //$('#employee_name').val(response);
    
    });


  });





  </script>
