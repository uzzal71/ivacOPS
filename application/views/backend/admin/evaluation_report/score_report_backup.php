
<?php 
  
    include('years_months.php');

 ?>

<div class="col-md-12 col-xs-12">

<div class="col-md-6 col-xs-6">
  <div class="x_panel">
    <div class="x_title">
      <h2>Report Choice</h2>
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
      <form class="form-horizontal form-label-left" action="<?php echo site_url('menu_controller/save');?>" method="POST">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Report Option</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="report_choice" id="report_choice">
              <option value="0">Select report option</option>
              <option value="1">Center summary Report</option>
              <option value="3">center details Report</option>
              <!-- <option value="2">Staff summary Report</option> -->
            </select>
          </div>
        </div>
        <div class="clearfix"></div><br />
      </form>
    </div>
  </div>
</div>











<!-- Staff summary report -->
<div class="col-md-6 col-xs-6" id="report_center">
  <div class="x_panel">
    <div class="x_title">
      <h2>Center summary Report</h2>
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

        <form class="form-horizontal form-label-left" action="<?php echo site_url('report_controller/center_summary_report');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id">
              <option value="all" selected>Select Center</option>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year, Month</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type='text' id='txtDate' name="year_month" class="form-control" placeholder="Select Month, Year" />
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Submit</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Staff summary report -->

<!-- Staff details report -->
<div class="col-md-6 col-xs-6" id="report_details">
  <div class="x_panel">
    <div class="x_title">
      <h2>Center Details Report</h2>
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

        <form class="form-horizontal form-label-left" action="<?php echo site_url('report_controller/center_details');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id">
              <option value="all" selected>Select Center</option>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">From</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="from_date" placeholder="xxxx-xx-xx" id="datepicker_c1" autocomplete="off">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="to_date" placeholder="xxxx-xx-xx" id="datepicker_c2" autocomplete="off">
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Submit</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Staff details report -->






</div>












</div>


    
<script type="text/javascript">

  $(document).ready(function() {
    
    $("#report_center").hide();
    $("#report_employee").hide();
     $("#report_details").hide();

  });

  // Report
  // Report
  $("#report_choice").change(function(){
    report_choice = this.value;

    if(report_choice == 0)
    {
      $("#report_center").hide();
      $("#report_employee").hide();
       $("#report_details").hide();
    }
    else if(report_choice == 1)
    {
      $("#report_center").fadeIn(500);
      $("#report_employee").hide();
       $("#report_details").hide();
    }
    else if(report_choice == 2)
    {
      $("#report_employee").fadeIn(500);
      $("#report_details").hide();
      $("#report_center").hide();
    }
    else if(report_choice == 3)
    {
      $("#report_details").fadeIn(500);
      $("#report_employee").hide();
      $("#report_center").hide();
    }

    
  });
  // Report
  // Report

</script>


  <script type="text/javascript">
  $(document).ready(function() {
  $('.employee_id').select2();


    $("#center_id2").change(function(){
      
      var center_id = $('#center_id2').val().trim();
            
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


  });

  // Date picker
  $(document).ready(function() {
   $('#txtDate').datepicker({
     changeMonth: true,
     changeYear: true,
     dateFormat: 'MM yy',
       
     onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
     },
       
     beforeShow: function() {
       if ((selDate = $(this).val()).length > 0) 
       {
          iYear = selDate.substring(selDate.length - 4, selDate.length);
          iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
           $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
       }
    }
  });
});
  </script>
