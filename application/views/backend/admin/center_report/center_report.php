<?php
//require 'connection.php';
include APPPATH.'views/backend/admin/center_report/'.'years.php';
?>
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
    <li class="active"><a data-toggle="tab" href="#home">INCOME REPORT</a></li>
    <li><a data-toggle="tab" href="#menu1">EXPENSE REPORT</a></li>
    <li><a data-toggle="tab" href="#menu2">MONTHLY BALANCE SHEET</a></li>
    <li><a data-toggle="tab" href="#menu3">YEARLY BALANCE SHEET</a></li>
    <li><a data-toggle="tab" href="#menu4">ASSET REPORT</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">       
      <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">INCOME REPORT</h3>
        <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('center_report_controller/income_report_details');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id" required="">
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
          <input type='text' id='income_report_from' name="from" class="form-control" placeholder="From Date" required />
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type='text' id="income_report_to" name="to" class="form-control" placeholder="To Date" required />
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Report Request</button>
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
        <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">EXPENSE REPORT</h3>
        <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('center_report_controller/expense_report_details');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id" required>
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
          <input type="text" id="expense_report_from" name="from" class="form-control" placeholder="From Date" required />
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">To</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" id="expense_report_to" name="to" class="form-control" placeholder="To Date" required />
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Report Request</button>
          </div>
        </div>
      </form>
      </div>
      <div class="col-md-3"></div>
      </div>
    </div>
    <div id="menu2" class="tab-pane fade">      
      <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">MONTHLY BALANCE SHEET</h3>
        <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('center_report_controller/monthly_balance_sheet');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id" required>
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
          <input type='text' id='txtDate' name="year_month" class="form-control" placeholder="Select Month, Year" required />
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Report Request</button>
          </div>
        </div>
      </form>
      </div>
      <div class="col-md-3"></div>
      </div>
    </div>
    <div id="menu3" class="tab-pane fade">      
      <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">YEARLY BALANCE SHEET</h3>
          <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('center_report_controller/yearly_balance_sheet');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id" required>
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
         <select class="form-control" name="year" id="selear" required>
          <option selected>Select Year</option>
          <?php
          $length = count($year_load);
          for($i=0; $i<$length;$i++)
          {
            ?>
            <option value="<?php echo $year_load[$i]; ?>">
              <?php echo $year_load[$i]; ?>                
              </option>
            <?php
          }
           ?>
         </select>
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Report Request</button>
          </div>
        </div>
      </form>
      </div>
      <div class="col-md-3"></div>
      </div>
    </div>
    <div id="menu4" class="tab-pane fade">      
      <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h3 style="text-align: center;font-size: 18px;color: #169F85;font-weight: bold;">ASSET REPORT</h3>
          <form class="form-horizontal form-label-left" autocomplete="off" action="<?php echo site_url('center_report_controller/asset_sheet');?>" method="POST" target="_blank">
         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id" required>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="year" id="selear" required>
          <option selected>Select Year</option>
          <?php
          $length = count($year_load);
          for($i=0; $i<$length;$i++)
          {
            ?>
            <option value="<?php echo $year_load[$i]; ?>">
              <?php echo $year_load[$i]; ?>                
              </option>
            <?php
          }
           ?>
         </select>
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-success" id="">Report Request</button>
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