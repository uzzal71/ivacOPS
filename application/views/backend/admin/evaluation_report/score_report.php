<div class="col-md-12 col-xs-12">

<div class="col-md-12 col-xs-12">
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
      <!-- Tap here... -->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">CENTER SUMMARY REPORT</a></li>
    <li><a data-toggle="tab" href="#menu1">CENTER DETAILS REPORT</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">       
      <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">CENTER SUMMARY REPORT</h3>
        <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('report_controller/center_summary_report');?>" method="POST" target="_blank">
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
      <div class="col-md-3"></div>
    </div>
    <div id="menu1" class="tab-pane fade">      
      <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">CENTER DETAILS REPORT</h3>
         <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('report_controller/center_details');?>" method="POST" target="_blank">
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
      <div class="col-md-3"></div>
      </div>
    </div>

  </div>
</div>
      <!-- Tap here... -->
    </div>
  </div>
</div>

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