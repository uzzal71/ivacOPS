<?php 
  
  include('years_months.php');

?>
<?php 

$this->db->select('*');
$this->db->from('behavior');
$this->db->where('id', $id);
$query_result = $this->db->get();
$result = $query_result->row();
$date=date_create($result->date);
$get_date = date_format($date,'F Y');
$expload_date = explode(' ', $get_date);
$month = $expload_date[0];
$year = $expload_date[1];

 ?>
<div class="col-md-6 col-xs-12 col-md-offset-3">
<div class="x_panel">
  <div class="x_title">
    <h2>Edit Behavior Form</h2>
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
    $where_data = array('id' => $id);
    $behaviors = $this->db->get_where('behavior', $where_data)->result_array();
    foreach($behaviors as $score):
    ?>
    <form name="edit_behavior" class="form-horizontal form-label-left" action="<?php echo site_url('scoreboard_controller/update_behavior');?>" method="POST">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="center_id" id="center_id">
              <option selected>Select Center</option>
              <?php 
                $centers = $this->db->get('centers')->result_array();
                  foreach($centers as $center)
                  {
                    ?>
                    <option value="<?php echo $center['center_id'] ?>"><?php echo $center['center_name']; ?></option>
                    <?php
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
          <input class="form-control" type="text" name="employee_id" id="employee_id2" value="<?php echo $score['employee_id']; ?>" readonly>
          <input type="hidden" name="id" id="id2" value="<?php echo $score['id']; ?>">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Month</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="month" id="month">
              <option value="<?php echo $month; ?>" selected><?php echo $month ?></option>
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
              <option value="<?php echo $year ?>" selected><?php echo $year; ?></option>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Behaviour</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="behavior" value="<?php echo $score['behavior']; ?>" placeholder="Behavior">
        </div>
      </div> 
      <div class="clearfix"></div> 
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Late Day</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="late_day" value="<?php echo $score['late_day']; ?>" placeholder="Late day">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Working Day</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="working_day" value="<?php echo $score['working_day']; ?>" placeholder="Working day">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="submit" id="check" class="btn btn-success">Submit</button>
        </div>
      </div>

    </form>
  <?php endforeach; ?>
  </div>
</div>
</center>


  <script type="text/javascript">
  $(document).ready(function() {

    var center_id = $('#center_id').val().trim();
            
      var response;
      $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/pick_employee_list',
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
  });

  

  </script>
<script type="text/javascript">
  document.forms['edit_behavior'].elements['center_id'].value = <?php echo $score['center_id']; ?>
</script>
<script type="text/javascript">

  $(document).ready(function() {
    
    $("#employee_id").hide();
    $("#employee_id2").show();


  });


</script>
  <script type="text/javascript">
 
    $("#center_id").change(function(){
      $('.employee_id').select2();
       $("#employee_id").show(500);
        $("#employee_id2").hide();
      
      var center_id = $('#center_id').val().trim();
            
      var response;
      $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/pick_employee_list',
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

  </script>