<div class="col-md-12 col-xs-12">
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
  <div class="x_content">
    <!-- start -->
    <div class="container">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Remarks</a></li>
        <li><a data-toggle="tab" href="#menu1">Add Receive</a></li>
        <li><a data-toggle="tab" href="#menu2">Add Delivery</a></li>
        <li><a data-toggle="tab" href="#menu3">Add Scanning</a></li>
        <li><a data-toggle="tab" href="#menu4">Add Backend</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>HOME</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>

<!-- Receive- -->
<div id="menu1" class="tab-pane fade">
<h2 style="text-align: center;border-bottom: 1px solid green">Receive</h2>
<form action="" method="post" autocomplete="off" name="add_receive_score">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="center_id">Select Center:</label><br>
          <select id="rv_center_id" name="rv_center_id" class="form-control">
          <option value="select" selected>Select Center</option>
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
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="rv_date">Select Date:</label>
          <input type="date" data-date="" data-date-format="YYYY-MM-DD" name="rv_date" id="rv_date" class="form-control">
       </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row" style="border-bottom: 1px solid green;padding: 5px;">
              <div class="col-md-3"><th>Employee ID:</th></div>
              <div class="col-md-3"><th>Employee Name</th></div>
              <div class="col-md-3"><th>Receive:</th></div>
              <div class="col-md-3"><th>Action:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow_receive">
        <div id="entry_receive1" class="clonedInput_receive row" style="margin-top: 5px;">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="employeeIdSelect col-md-3">
              <select name="rv_employee_id[]" id="rv_employee_id" class="form-control rv_employee_id">
                <option value="select" selected>Select Emplyee ID</option>
                    <?php
                      $where_center = array('center_id' => $this->session->userdata('set_center'));
                      $employees = $this->db->get_where('employee', $where_center)->result_array();
                      foreach($employees as $row)
                      {
                        ?>
                        <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_id'] ?></option>
                        <?php
                      }
                   ?>
              </select>
            </div>
            <div class="rv_employeeNameDiv col-md-3">
            <input type="text" name="rv_employee_name[]" id="rv_employee_name" class="form-control rv_employee_name" disabled style="font-size:12px; ">
            </div>
            <div class="receiveDiv col-md-3">
              <input type="number" name="receive[]" id="receive" class="form-control receive">
            </div>
            <div class="receiveActionDiv col-md-3">
              <button style="" id="btnDel_receive" name="btnDel_receive[]" class="btn btn-danger btnDel_receive"><span class="glyphicon glyphicon-remove"></span></button>
            </div>             
          </tr>
        </div>
        </div>
      </div>
    </div>
    <!-- Action ex: Submit, Add Delete -->
    <hr>
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-4"></div>
      <div class="col-md-6"></div>
      <div class="col-md-2">
        <button style="float: left;" type="button" id="btnAdd_receive" name="btnAdd_receive">Add New</button>
        <button style="float: right;" type="button" id="submit_button_receive">Submit</button>
      </div>
    </div>
    </form>
    </div>
<!-- Receive -->

<!-- Delivery -->
<div id="menu2" class="tab-pane fade">
  <h2 style="text-align: center;border-bottom: 1px solid green">Delivery</h2>
  <form action="" method="post" autocomplete="off" name="add_delivery_score">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="center_id">Select Center:</label><br>
          <select name="dy_center_id" id="dy_center_id" name="dy_center_id" class="form-control">
          <option value="select" selected>Select Center</option>
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
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="date">Select Date:</label>
          <input type="date" data-date="" data-date-format="YYYY-MM-DD" name="dy_date" id="dy_date" class="form-control">
       </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row" style="border-bottom: 1px solid green;padding: 5px;">
              <div class="col-md-3"><th>Employee ID:</th></div>
              <div class="col-md-3"><th>Employee Name</th></div>
              <div class="col-md-3"><th>Delivery:</th></div>
              <div class="col-md-3"><th>Action:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow_delivery">
        <div id="entry_delivery1" class="clonedInput_delivery row" style="margin-top: 5px;">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="employeeIdSelect col-md-3">
            <td>
              <select name="dy_employee_id[]" id="dy_employee_id" class="form-control dy_employee_id">
                <option value="select" selected>Select Emplyee ID</option>
                    <?php
                      $where_center = array('center_id' => $this->session->userdata('set_center'));
                      $employees = $this->db->get_where('employee', $where_center)->result_array();
                      foreach($employees as $row)
                      {
                        ?>
                        <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_id'] ?></option>
                        <?php
                      }
                   ?>
              </select>
            </td>
            </div>
            <div class="dy_employeeNameDiv col-md-3">
            <td><input type="text" name="dy_employee_name[]" id="dy_employee_name" class="form-control dy_employee_name" disabled style="font-size:12px; "></td>
            </div>
            <div class="deliveryDiv col-md-3">
              <td><input type="number" name="delivery[]" id="delivery" class="form-control delivery"></td>
            </div>
            <div class="deliveryActionDiv col-md-3">
              <button style="" id="btnDel_delivery" name="btnDel_delivery[]" class="btn btn-danger btnDel_delivery"><span class="glyphicon glyphicon-remove"></span></button>
            </div>             
          </tr>
        </div>
        </div>
      </div>
    </div>
    <!-- Action ex: Submit, Add Delete -->
    <hr>
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-4"></div>
      <div class="col-md-6"></div>
      <div class="col-md-2">
        <button style="float: left;" type="button" id="btnAdd_delivery" name="btnAdd_delivery">Add New</button>
        <button style="float: right;" type="button" id="submit_button_delivery">Submit</button>
      </div>
    </div>
    </form>
</div>
<!-- Delivery -->

<!-- Scanning -->
<div id="menu3" class="tab-pane fade">
  <h2 style="text-align: center;border-bottom: 1px solid green">Scanning</h2>
  <form action="" method="post" autocomplete="off" name="add_scanning_score">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="center_id">Select Center:</label><br>
          <select name="sc_center_id" id="sc_center_id" name="sc_center_id" class="form-control">
          <option value="select" selected>Select Center</option>
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
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="date">Select Date:</label>
          <input type="date" data-date="" data-date-format="YYYY-MM-DD" name="sc_date" id="sc_date" class="form-control">
       </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row" style="border-bottom: 1px solid green;padding: 5px;">
              <div class="col-md-3"><th>Employee ID:</th></div>
              <div class="col-md-3"><th>Employee Name</th></div>
              <div class="col-md-3"><th>Scanning:</th></div>
              <div class="col-md-3"><th>Action:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow_scanning">
        <div id="entry_scanning1" class="clonedInput_scanning row" style="margin-top: 5px;">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="employeeIdSelect col-md-3">
            <td>
              <select name="employee_id[]" id="employee_id" class="form-control employee_id">
                <option value="select" selected>Select Emplyee ID</option>
                    <?php
                      $where_center = array('center_id' => $this->session->userdata('set_center'));
                      $employees = $this->db->get_where('employee', $where_center)->result_array();
                      foreach($employees as $row)
                      {
                        ?>
                        <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_id'] ?></option>
                        <?php
                      }
                   ?>
              </select>
            </td>
            </div>
            <div class="sc_employeeNameDiv col-md-3">
            <td><input type="text" name="sc_employee_name[]" id="sc_employee_name" class="form-control sc_employee_name" disabled style="font-size:12px; "></td>
            </div>
            <div class="scanningDiv col-md-3">
              <td><input type="number" name="scanning[]" id="scanning" class="form-control scanning"></td>
            </div>
            <div class="scanningActionDiv col-md-3">
              <button style="" id="btnDel_scanning" name="btnDel_scanning[]" class="btn btn-danger btnDel_scanning"><span class="glyphicon glyphicon-remove"></span></button>
            </div>             
          </tr>
        </div>
        </div>
      </div>
    </div>
    <!-- Action ex: Submit, Add Delete -->
    <hr>
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-4"></div>
      <div class="col-md-6"></div>
      <div class="col-md-2">
        <button style="float: left;" type="button" id="btnAdd_scanning" name="btnAdd_scanning">Add New</button>
        <button style="float: right;" type="button" id="submit_button_scanning">Submit</button>
      </div>
    </div>
    </form>
</div>
<!-- Scanning -->


<!-- BackEnd -->
<div id="menu4" class="tab-pane fade">
  <h2 style="text-align: center;border-bottom: 1px solid green">Backend</h2>
<form action="" method="post" autocomplete="off" name="add_backend_score">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="center_id">Select Center:</label><br>
          <select name="be_center_id" id="be_center_id" name="be_center_id" class="form-control">
          <option value="select" selected>Select Center</option>
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
      
      <div class="col-md-4">
        <div class="form-group">
          <label for="date">Select Date:</label>
          <input type="date" data-date="" data-date-format="YYYY-MM-DD" name="be_date" id="be_date" class="form-control">
       </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row" style="border-bottom: 1px solid green;padding: 5px;">
              <div class="col-md-3"><th>Employee ID:</th></div>
              <div class="col-md-3"><th>Employee Name</th></div>
              <div class="col-md-3"><th>Backend:</th></div>
              <div class="col-md-3"><th>Action:</th></div>
            </div>            
          </tr>
        <div id="ItemsRow_backend">
        <div id="entry_backend1" class="clonedInput_backend row" style="margin-top: 5px;">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="employeeIdSelect col-md-3">
            <td>
              <select name="be_employee_id[]" id="be_employee_id" class="form-control be_employee_id">
                <option value="select" selected>Select Emplyee ID</option>
                    <?php
                      $where_center = array('center_id' => $this->session->userdata('set_center'));
                      $employees = $this->db->get_where('employee', $where_center)->result_array();
                      foreach($employees as $row)
                      {
                        ?>
                        <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_id'] ?></option>
                        <?php
                      }
                   ?>
              </select>
            </td>
            </div>
            <div class="be_employeeNameDiv col-md-3">
            <td><input type="text" name="be_employee_name[]" id="be_employee_name" class="form-control be_employee_name" disabled style="font-size:12px; "></td>
            </div>
            <div class="backendDiv col-md-3">
              <input type="number" name="backend[]" id="backend" class="form-control backend"">
            </div>
            <div class="backendActionDiv col-md-3">
              <button style="" id="btnDel_backend" name="btnDel_backend[]" class="btn btn-danger btnDel_backend"><span class="glyphicon glyphicon-remove"></span></button>
            </div>             
          </tr>
        </div>
        </div>
      </div>
    </div>
    <!-- Action ex: Submit, Add Delete -->
    <hr>
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-4"></div>
      <div class="col-md-6"></div>
      <div class="col-md-2">
        <button style="float: left;" type="button" id="btnAdd_backend" name="btnAdd_backend">Add New</button>
        <button style="float: right;" type="button" id="submit_button_backend">Submit</button>
      </div>
    </div>
    </form>
</div>
<!-- Backend -->

      </div>
    </div>
    <!-- start -->
  </div>
</div>
</div>


<script type="text/javascript">
/**
* Add Row Function
*/  
$('#btnAdd_receive').click(function () {
var lastRow_receive = $("#ItemsRow_receive .clonedInput_receive:last");
var clonnedRow_receive = lastRow_receive.clone().find('input').val('').end();
var nextSlNumber = lastRow_receive.find('input.sl').val()*1+1;
clonnedRow_receive.find('input.sl').val(nextSlNumber);
$("#ItemsRow_receive").append(clonnedRow_receive);
$('#btnDel_receive').attr('disabled', false);
});

/**
* Delete Row
*/
$("#ItemsRow_receive").on('click','#btnDel_receive',function(){
var lastRow_receive = $("#ItemsRow_receive .clonedInput_receive:last");
var sl = lastRow_receive.find('input.sl').val();
if (sl > 1) {
  var con= confirm("Are you sure you wish to remove this section? This cannot be undone.");

  if (con==true) {
    $(this).parent().parent().remove();
  }else {

  }
}
else
{
  alert("You cannot remove First Row");
  return false;
}
});

/**
* Save Expense data
**/
$("#submit_button_receive").click(function(){
    var number_row = $('.clonedInput_receive').length;
    if(form_validation() == true)
    {
      var center_id = $('#rv_center_id').val().trim();
      var date = $('#rv_date').val().trim();

      var employee_id= new Array();
      $('.rv_employee_id').each(function(){
          employee_id.push($(this).val().trim());
      });

      var receive= new Array();
      $('.receive').each(function(){
          receive.push($(this).val().trim());
      });  

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/scoreboard_controller/save_receive_score',
        data:{
          number_row: number_row, 
          employee_id: employee_id, 
          center_id: center_id,
          date: date, 
          receive: receive       
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/scoreboard_controller/create';
        }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
        }
      });

    }

    return true;

});

/**
* Form Validation
**/
  function form_validation(){
  

    //alert('GOT IT');
    if($('#rv_center_id').val()== "select")
    {
      alert("Please Select Center ID");
      $('#rv_center_id').focus();
      return false;
    }

    else if($('#rv_date').val().trim() == "")
    {
      alert("Please Select Date");
      $('#rv_date').focus();
      return false;
    }
    
    else if($('#rv_employee_id').val()=="select")
    {
      alert("Please Select your Employee ID");
      $('#rv_employee_id').focus();
      return false;
    }

    return true;
      
  };


$("#rv_center_id").change(function(){
      
var center_id = $('#rv_center_id').val().trim();

var response;
$.ajax({
    async: false,
    type: 'POST',
    url: '<?php echo base_url();?>user_controller/center_set_session',
    data:{ 
        center_id: center_id
      },
    success: function(result) {
      response = result;
      alert(response);
      window.location = '<?php echo site_url()?>/scoreboard_controller/create';
      $('#rv_employee_id').focus();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
    }
  });

});




$("#ItemsRow_receive").on('change','.rv_employee_id',function(){
  var employee_id=$(this).val().trim();
  var EmployeeElement    = $(this);
  var response;
  $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/pick_employee_name_check_center',
      data:{ 
          employee_id: employee_id
        },
      success: function(result) {
        response = result;

        if (!response) {
              alert('no data found!!');
              return 0;
      }
      EmployeeElement.parent().parent().find('.rv_employeeNameDiv .rv_employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
})


</script>
<script type="text/javascript">
  document.forms['add_receive_score'].elements['rv_center_id'].value = <?php echo $this->session->userdata('set_center'); ?>
</script>
<!-- Receive End -->

<!-- ============================================================================================== -->
<!-- ======================================== Receive ============================================= -->
<!-- ============================================================================================== -->

<!-- Delivery Start -->
<script type="text/javascript">
/**
* Add Row Function
*/  
$('#btnAdd_delivery').click(function () {
var lastRow_delivery = $("#ItemsRow_delivery .clonedInput_delivery:last");
var clonnedRow_delivery = lastRow_delivery.clone().find('input').val('').end();
var nextSlNumber = lastRow_delivery.find('input.sl').val()*1+1;
clonnedRow_delivery.find('input.sl').val(nextSlNumber);
$("#ItemsRow_delivery").append(clonnedRow_delivery);
$('#btnDel_delivery').attr('disabled', false);
});

/**
* Delete Row
*/
$("#ItemsRow_delivery").on('click','#btnDel_delivery',function(){
var lastRow_delivery = $("#ItemsRow_delivery .clonedInput_delivery:last");
var sl = lastRow_delivery.find('input.sl').val();
if (sl > 1) {
  var con= confirm("Are you sure you wish to remove this section? This cannot be undone.");

  if (con==true) {
    $(this).parent().parent().remove();
  }else {

  }
}
else
{
  alert("You cannot remove First Row");
  return false;
}
});

/**
* Save Expense data
**/
$("#submit_button_delivery").click(function(){
    var number_row = $('.clonedInput_delivery').length;
    if(form_validation() == true)
    {
      var center_id = $('#dy_center_id').val().trim();
      var date = $('#dy_date').val().trim();

      var employee_id= new Array();
      $('.dy_employee_id').each(function(){
          employee_id.push($(this).val().trim());
      });

      var delivery= new Array();
      $('.delivery').each(function(){
          delivery.push($(this).val().trim());
      });  

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/scoreboard_controller/save_delivery_score',
        data:{
          number_row: number_row, 
          employee_id: employee_id, 
          center_id: center_id,
          date: date, 
          delivery: delivery       
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/scoreboard_controller/create';
        }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
        }
      });

    }

    return true;

});

/**
* Form Validation
**/
  function form_validation(){
  

    //alert('GOT IT');
    if($('#dy_center_id').val()== "select")
    {
      alert("Please Select Center ID");
      $('#dy_center_id').focus();
      return false;
    }

    else if($('#dy_date').val().trim() == "")
    {
      alert("Please Select Date");
      $('#dy_date').focus();
      return false;
    }
    
    else if($('#dy_employee_id').val()=="select")
    {
      alert("Please Select your Employee ID");
      $('#dy_employee_id').focus();
      return false;
    }

    return true;
      
  };


$("#dy_center_id").change(function(){
      
var center_id = $('#dy_center_id').val().trim();

var response;
$.ajax({
    async: false,
    type: 'POST',
    url: '<?php echo base_url();?>user_controller/center_set_session',
    data:{ 
        center_id: center_id
      },
    success: function(result) {
      response = result;
      alert(response);
      window.location = '<?php echo site_url()?>/scoreboard_controller/create';
      $('#dy_employee_id').focus();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
    }
  });

});




$("#ItemsRow_delivery").on('change','.dy_employee_id',function(){
  var employee_id=$(this).val().trim();
  var EmployeeElement    = $(this);
  var response;
  $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/pick_employee_name_check_center',
      data:{ 
          employee_id: employee_id
        },
      success: function(result) {
        response = result;

        if (!response) {
              alert('no data found!!');
              return 0;
      }
      EmployeeElement.parent().parent().find('.dy_employeeNameDiv .dy_employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
})


</script>
<script type="text/javascript">
  document.forms['add_delivery_score'].elements['dy_center_id'].value = <?php echo $this->session->userdata('set_center'); ?>
</script>
<!-- Delivery End -->


<!-- ============================================================================================== -->
<!-- ======================================== Delivery ============================================ -->
<!-- ============================================================================================== -->

<!-- Scanning -->
<script type="text/javascript">
/**
* Add Row Function
*/  
$('#btnAdd_scanning').click(function () {
var lastRow_scanning = $("#ItemsRow_scanning .clonedInput_scanning:last");
var clonnedRow_scanning = lastRow_scanning.clone().find('input').val('').end();
var nextSlNumber = lastRow_scanning.find('input.sl').val()*1+1;
clonnedRow_scanning.find('input.sl').val(nextSlNumber);
$("#ItemsRow_scanning").append(clonnedRow_scanning);
$('#btnDel_scanning').attr('disabled', false);
});

/**
* Delete Row
*/
$("#ItemsRow_scanning").on('click','#btnDel_scanning',function(){
var lastRow_scanning = $("#ItemsRow_scanning .clonedInput_scanning:last");
var sl = lastRow_scanning.find('input.sl').val();
if (sl > 1) {
  var con= confirm("Are you sure you wish to remove this section? This cannot be undone.");

  if (con==true) {
    $(this).parent().parent().remove();
  }else {

  }
}
else
{
  alert("You cannot remove First Row");
  return false;
}
});

/**
* Save Expense data
**/
$("#submit_button_scanning").click(function(){
    var number_row = $('.clonedInput_scanning').length;
    if(form_validation() == true)
    {
      var center_id = $('#sc_center_id').val().trim();
      var date = $('#sc_date').val().trim();

      var employee_id= new Array();
      $('.sc_employee_id').each(function(){
          employee_id.push($(this).val().trim());
      });

      var scanning= new Array();
      $('.scanning').each(function(){
          scanning.push($(this).val().trim());
      });  

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/scoreboard_controller/save_multiple_score',
        data:{
          number_row: number_row, 
          employee_id: employee_id, 
          center_id: center_id,
          date: date, 
          scanning: scanning       
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/scoreboard_controller/create';
        }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
        }
      });

    }

    return true;

});

/**
* Form Validation
**/
  function form_validation(){
  

    //alert('GOT IT');
    if($('#sc_center_id').val()== "select")
    {
      alert("Please Select Center ID");
      $('#sc_center_id').focus();
      return false;
    }

    else if($('#sc_date').val().trim() == "")
    {
      alert("Please Select Date");
      $('#sc_date').focus();
      return false;
    }
    
    else if($('#sc_employee_id').val()=="select")
    {
      alert("Please Select your Employee ID");
      $('#sc_employee_id').focus();
      return false;
    }

    return true;
      
  };


$("#sc_center_id").change(function(){
      
var center_id = $('#sc_center_id').val().trim();

var response;
$.ajax({
    async: false,
    type: 'POST',
    url: '<?php echo base_url();?>user_controller/center_set_session',
    data:{ 
        center_id: center_id
      },
    success: function(result) {
      response = result;
      alert(response);
      window.location = '<?php echo site_url()?>/scoreboard_controller/create';
      $('#sc_employee_id').focus();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
    }
  });

});




$("#ItemsRow_scanning").on('change','.sc_employee_id',function(){
  var employee_id=$(this).val().trim();
  var EmployeeElement    = $(this);
  var response;
  $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/pick_employee_name_check_center',
      data:{ 
          employee_id: employee_id
        },
      success: function(result) {
        response = result;

        if (!response) {
              alert('no data found!!');
              return 0;
      }
      EmployeeElement.parent().parent().find('.sc_employeeNameDiv .sc_employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
})


</script>
<script type="text/javascript">
  document.forms['add_scanning_score'].elements['sc_center_id'].value = <?php echo $this->session->userdata('set_center'); ?>
</script>
<!-- Scanning -->

<!-- ============================================================================================== -->
<!-- ======================================== Scanning ============================================ -->
<!-- ============================================================================================== -->

<!-- Backend -->
<script type="text/javascript">
/**
* Add Row Function
*/  
$('#btnAdd_backend').click(function () {
var lastRow_backend = $("#ItemsRow_backend .clonedInput_backend:last");
var clonnedRow_backend = lastRow_backend.clone().find('input').val('').end();
var nextSlNumber = lastRow_backend.find('input.sl').val()*1+1;
clonnedRow_backend.find('input.sl').val(nextSlNumber);
$("#ItemsRow_backend").append(clonnedRow_backend);
$('#btnDel_backend').attr('disabled', false);
});

/**
* Delete Row
*/
$("#ItemsRow_backend").on('click','#btnDel_backend',function(){
var lastRow_backend = $("#ItemsRow_backend .clonedInput_backend:last");
var sl = lastRow_backend.find('input.sl').val();
if (sl > 1) {
  var con= confirm("Are you sure you wish to remove this section? This cannot be undone.");

  if (con==true) {
    $(this).parent().parent().remove();
  }else {

  }
}
else
{
  alert("You cannot remove First Row");
  return false;
}
});

/**
* Save Expense data
**/
$("#submit_button_backend").click(function(){
    var number_row = $('.clonedInput_backend').length;
    if(form_validation() == true)
    {
      var center_id = $('#be_center_id').val().trim();
      var date = $('#be_date').val().trim();

      var employee_id= new Array();
      $('.be_employee_id').each(function(){
          employee_id.push($(this).val().trim());
      });

      var backend= new Array();
      $('.backend').each(function(){
          backend.push($(this).val().trim());
      });  

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/scoreboard_controller/save_multiple_score',
        data:{
          number_row: number_row, 
          employee_id: employee_id, 
          center_id: center_id,
          date: date, 
          backend: backend       
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/scoreboard_controller/create';
        }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
        }
      });

    }

    return true;

});

/**
* Form Validation
**/
  function form_validation(){
  

    //alert('GOT IT');
    if($('#be_center_id').val()== "select")
    {
      alert("Please Select Center ID");
      $('#be_center_id').focus();
      return false;
    }

    else if($('#be_date').val().trim() == "")
    {
      alert("Please Select Date");
      $('#be_date').focus();
      return false;
    }
    
    else if($('#be_employee_id').val()=="select")
    {
      alert("Please Select your Employee ID");
      $('#be_employee_id').focus();
      return false;
    }

    return true;
      
  };


$("#be_center_id").change(function(){
      
var center_id = $('#be_center_id').val().trim();

var response;
$.ajax({
    async: false,
    type: 'POST',
    url: '<?php echo base_url();?>user_controller/center_set_session',
    data:{ 
        center_id: center_id
      },
    success: function(result) {
      response = result;
      alert(response);
      window.location = '<?php echo site_url()?>/scoreboard_controller/create';
      $('#sc_employee_id').focus();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
    }
  });

});




$("#ItemsRow_backend").on('change','.be_employee_id',function(){
  var employee_id=$(this).val().trim();
  var EmployeeElement    = $(this);
  var response;
  $.ajax({
      async: false,
      type: 'POST',
      url: '<?php echo base_url();?>user_controller/pick_employee_name_check_center',
      data:{ 
          employee_id: employee_id
        },
      success: function(result) {
        response = result;

        if (!response) {
              alert('no data found!!');
              return 0;
      }
      EmployeeElement.parent().parent().find('.be_employeeNameDiv .be_employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
})


</script>
<script type="text/javascript">
  document.forms['add_backend_score'].elements['be_center_id'].value = <?php echo $this->session->userdata('set_center'); ?>
</script>
<!-- Backend -->

<!-- ============================================================================================== -->
<!-- ======================================== Backend ============================================= -->
<!-- ============================================================================================== -->


<style type="text/css">
table th{
  text-align: center;
}
  input{
    width: 150px;
  }
  select{
    width: 150px;
    padding: 3px 3px;
  }

  table tr td a{
    margin-left: 15px;
  }
</style>