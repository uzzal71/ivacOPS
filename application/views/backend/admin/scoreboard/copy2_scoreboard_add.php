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
    <form action="" method="post" autocomplete="off">
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
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="date">Select Date:</label>
          <input type="text" class="form-control" id="date" name="date">
       </div>
      </div>
    </div><hr>
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
                    $center_permitted = $this->session->userdata('center_permitted');
                    $expload_center = explode(',', $center_permitted);
                    $center_length = count($expload_center);
                    $count = 1;
                    for($i=0; $i<$center_length;$i++){
                      $where_center = array('center_id' => $expload_center[$i]);
                      $employees = $this->db->get_where('employee', $where_center)->result_array();
                      foreach($employees as $row)
                      {
                        ?>
                        <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_id'] ?></option>
                        <?php
                      }
                    }
                   ?>
              </select>
            </td>
            </div>
            <div class="employeeNameDiv col-md-2">
            <td><input type="text" name="employee_name[]" id="employee_name" class="employee_name" disabled></td>
            </div>
            <div class="quantityDiv col-md-2">
              <td><input type="text" name="quantity[]" id="quantity" class="quantity"></td>
            </div>
            <div class="calculatedamountDiv col-md-2">
            <td><input type="text" name="calculated_amount[]" id="calculated_amount" class="calculated_amount" disabled></td>
            </div>
            <div class="actualamountDiv col-md-2">
            <td><input type="text" name="actual_amount[]" id="actual_amount" class="actual_amount"></td>
            </div>
            <div class="remarksDiv col-md-2">
            <td>
              <input type="text" name="remarks[]" id="remarks" class="remarks" style="width: 70%">
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
      <div class="col-md-2">
        <button style="float: left;" type="button" id="btnAdd" name="btnAdd">Add New</button>
        <button style="float: right;" type="button" id="submit_button">Submit</button>
      </div>
      <div class="col-md-6"></div>
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
* Date select last income code get
**/
$("#date").change(function(){
//alert("Here")
var date = $('#date').val().trim();
alert(incode_code);   
var response;
$.ajax({
  async: false,
  type: 'POST',
  url: '<?php echo site_url();?>/income_entry_controller/pick_latest_expense_code',
  data:{ 
      date: date
    },
  success: function(result) {
    alert(result);
  response = result;
  $('#expense_date').val(response);

  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
    response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
  }
});
});
/**
* Date select last income code get
**/
// ============================================
/**
* Quantity keyup income_amount * quanity
**/
$("#ItemsRow").on('keyup','#quantity',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var income_amount = lastRow.find('input.income_amount').val();
  lastRow.find('input.calculated_amount').val(income_amount*quantity);
});
// ========================================================
/**
* Quantity keyup income_amount * quanity
**/
$("#ItemsRow").on('blur','#income_amount',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var income_amount = lastRow.find('input.income_amount').val();
  lastRow.find('input.calculated_amount').val(income_amount*quantity);
});
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
      
      var income_code = $('#income_code').val().trim();
      var date = $('#date').val().trim();
      var center_id  = $('#center_id').val().trim();

      var income_id= new Array();
      $('.income_id').each(function(){
          income_id.push($(this).val().trim());
      });

      var income_amount= new Array();
      $('.income_amount').each(function(){
          income_amount.push($(this).val().trim());
      });

      var quantity= new Array();
      $('.quantity').each(function(){
          quantity.push($(this).val().trim());
      });  

      var calculated_amount= new Array();
      $('.calculated_amount').each(function(){
          calculated_amount.push($(this).val().trim());
      });

      var actual_amount= new Array();
      $('.actual_amount').each(function(){
          actual_amount.push($(this).val().trim());
      });  

      var remarks= new Array();        
      $('.remarks').each(function(){
          remarks.push($(this).val().trim());
      });  

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/income_entry_controller/save_income_entry',
        data:{ 
            income_code: income_code, 
            center_id: center_id,
            date: date, 
            income_id: income_id,
            income_amount: income_amount,
            quantity: quantity,
            calculated_amount: calculated_amount,
            actual_amount: actual_amount,
            remarks: remarks,
            number_row: number_row
          
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/income_entry_controller/create';
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
    
    else if($('#income_id').val()=="select")
    {
      alert("Please Select your Income ID");
      $('#income_id').focus();
      return false;
    }

    else if($('#income_amount').val()=="")
    {
      alert("Please Select Income Amount");
      $('#income_amount').focus();
      return false;
    }


    else if($('#quantity').val()=="")
    {
      alert("Please Select Quantity");
      $('#quantity').focus();
      return false;
    }

    else if($('#calculated_amount').val()=="")
    {
      alert("Please Select Calculated Amount");
      $('#calculated_amount').focus();
      return false;
    }


    return true;
      
  };

  /**
  * Get Income Amount
  **/
$("#ItemsRow").on('change','#income_id',function(){
   var income_id = $(this).val(); 
   $.ajax({  
        url: '<?php echo site_url();?>/income_entry_controller/get_income_amount',  
        method:"POST",  
        data:{income_id:income_id},  
        success:function(data){   
             response = data 
             var lastRow = $("#ItemsRow .clonedInput:last");
             lastRow.find('input.income_amount').val(response);
        }  
   });  
}); 



</script>


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

<!-- Get Employee  ID -->
<!-- Get Employee  ID -->
<script type="text/javascript">

$(document).ready(function() {

// Inner Employee Name
$('.employee_name').select2();

$("#employee_id").change(function(){
  
  var employee_id = $('#employee_id').val().trim();
  var center_id = $('#center_id').val().trim();

  alert(employee_id);
        
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

