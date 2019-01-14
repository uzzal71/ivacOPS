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
    <form action="" method="post" autocomplete="off" name="add_score_form">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="center_id">Select Center:</label><br>
          <select name="center_id" id="center_id" name="center_id" class="form-control">
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
          <input type="date" data-date="" data-date-format="YYYY-MM-DD" name="date" id="date" class="form-control">
       </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <hr>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row">
              <div class="col-md-2"><th>Employee ID:</th></div>
              <div class="col-md-2"><th>Employee Name</th></div>
              <div class="col-md-2"><th>Receive:</th></div>
              <div class="col-md-2"><th>Delivery:</th></div>
              <div class="col-md-2"><th>Scanning:</th></div>
              <div class="col-md-2"><th>Backend:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow">
        <div id="entry1" class="clonedInput row">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="employeeIdSelect col-md-2">
            <td>
              <select name="employee_id[]" id="employee_id" class="employee_id">
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
            <div class="employeeNameDiv col-md-2">
            <td><input type="text" name="employee_name[]" id="employee_name" class="employee_name" disabled style="font-size:12px; "></td>
            </div>
            <div class="receiveDiv col-md-2">
              <td><input type="number" name="receive[]" id="receive" class="receive"></td>
            </div>
            <div class="deliveryDiv col-md-2">
            <td><input type="number" name="delivery[]" id="delivery" class="delivery"></td>
            </div>
            <div class="scanningDiv col-md-2">
            <td><input type="number" name="scanning[]" id="scanning" class="scanning"></td>
            </div>
            <div class="backendDiv col-md-2">
            <td>
              <input type="number" name="backend[]" id="backend" class="backend" style="width: 70%">
              <button style="" id="btnDel" name="btnDel[]" class="btnDel"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
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
        <button style="float: left;" type="button" id="btnAdd" name="btnAdd">Add New</button>
        <button style="float: right;" type="button" id="submit_button">Submit</button>
      </div>
    </div>
    </form>
    <!-- Action ex: Submit, Add Delete -->
  </div>
</div>
</div>

<script type="text/javascript">
/**
* Add Row Function
*/  
$('#btnAdd').click(function () {
var lastRow = $("#ItemsRow .clonedInput:last");
var clonnedRow = lastRow.clone().find('input').val('').end();
var nextSlNumber = lastRow.find('input.sl').val()*1+1;
clonnedRow.find('input.sl').val(nextSlNumber);
$("#ItemsRow").append(clonnedRow);
$('#btnDel').attr('disabled', false);

});
/**
* Add Row Function
*/
// ================================
/**
* Delete Row
*/
$("#ItemsRow").on('click','#btnDel',function(){
var lastRow = $("#ItemsRow .clonedInput:last");
var sl = lastRow.find('input.sl').val();
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
* Delete Row
*/
// =============================================
/**


//=======================================
/**
* Save Expense data
**/
$("#submit_button").click(function(){

    var number_row = $('.clonedInput').length;

    //alert("Testing");
    if(form_validation() == true)
    {
      //alert("validation true");
      
      var center_id = $('#center_id').val().trim();
      var date = $('#date').val().trim();

      var employee_id= new Array();
      $('.employee_id').each(function(){
          employee_id.push($(this).val().trim());
      });

      var receive= new Array();
      $('.receive').each(function(){
          receive.push($(this).val().trim());
      });

      var delivery= new Array();
      $('.delivery').each(function(){
          delivery.push($(this).val().trim());
      });  

      var scanning= new Array();
      $('.scanning').each(function(){
          scanning.push($(this).val().trim());
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
          receive: receive,
          delivery: delivery,
          scanning: scanning,
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

// ======================================================
/**
*
**/
  function form_validation(){
  

    //alert('GOT IT');
    if($('#center_id').val()== "select")
    {
      alert("Please Select Center ID");
      $('#center_id').focus();
      return false;
    }

    else if($('#date').val().trim() == "")
    {
      alert("Please Select Date");
      $('#date').focus();
      return false;
    }
    
    else if($('#employee_id').val()=="select")
    {
      alert("Please Select your Employee ID");
      $('#employee_id').focus();
      return false;
    }


    return true;
      
  };


$("#center_id").change(function(){
      
var center_id = $('#center_id').val().trim();

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
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
    }
  });

});




$("#ItemsRow").on('change','.employee_id',function(){
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
      EmployeeElement.parent().parent().find('.employeeNameDiv .employee_name').val(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
      }
    });
})


</script>
<script type="text/javascript">
  document.forms['add_score_form'].elements['center_id'].value = <?php echo $this->session->userdata('set_center'); ?>
</script>


<!-- Get Employee  ID -->

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
<script>
        $(document).ready(function () {
            $('#date').datepicker({ dateFormat: 'yy-mm-dd' }).val();
        });
  </script>
