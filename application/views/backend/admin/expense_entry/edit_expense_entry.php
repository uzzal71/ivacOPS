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
          <label for="expense_code">Expense Code:</label>
          <input type="text" class="form-control" id="expense_code" value="<?php ?>" name="expense_code" disabled>
       </div>
      </div>
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
          <input type="text" class="form-control" id="date" name="date">
       </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
          <tr>
            <div class="row">
              <div class="col-md-2"><th>Expense Type:</th></div>
              <div class="col-md-2"><th>Amount:</th></div>
              <div class="col-md-2"><th>Quantity:</th></div>
              <div class="col-md-2"><th>Actual Amount:</th></div>
              <div class="col-md-4"><th>Remarks:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow">
        <div id="entry1" class="clonedInput row">
          
          <?php 

          foreach($expense_info as $expense):

           ?>

          <tr>
            <input type="hidden" name="sl" id="sl" value="1" class="sl" >
            <div class="incomeSelect col-md-2">
            <td>
              <select name="expense_id[]" id="expense_id" class="expense_id">
                <option value="select" selected>Select Expense</option>
                <?php
                        $center_permitted = $this->session->userdata('center_permitted');
                        $expload_center = explode(',', $center_permitted);
                        $center_length = count($expload_center);
                        $count = 1;
                        for($i=0; $i<$center_length;$i++){
                          $where_center = array('center_id' => $expload_center[$i]);
                          $expense_type = $this->db->get_where('expense_type', $where_center)->result_array();
                          foreach($expense_type as $expense)
                          {
                            ?>
                            <option value="<?php echo $expense['expense_id'] ?>"><?php echo $expense['expense_type'] ?></option>
                            <?php
                          }
                        }
                       ?>
              </select>
            </td>
            </div>
            <div class="amountDiv col-md-2">
            <td><input type="text" name="expense_amount[]" id="expense_amount" class="expense_amount"></td>
            </div>
            <div class="quantityDiv col-md-2">
              <td><input type="text" name="quantity[]" id="quantity" class="quantity"></td>
            </div>
            <div class="actualamountDiv col-md-2">
            <td><input type="text" name="actual_amount[]" id="actual_amount" class="actual_amount" disabled></td>
            </div>
            <div class="remarksDiv col-md-4">
            <td>
              <input type="text" name="remarks[]" id="remarks" class="remarks" style="width: 70%">
              <button style="" id="btnDel" name="btnDel[]" class="btnDel"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
            </div>
          </tr>

        <?php endforeach; ?>

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
</center>


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
* Quantity keyup expense_amount * quanity
**/
$("#ItemsRow").on('keyup','#quantity',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var expense_amount = lastRow.find('input.expense_amount').val();
  lastRow.find('input.actual_amount').val(expense_amount*quantity);
});
// ========================================================
/**
* Quantity keyup expense_amount * quanity
**/
$("#ItemsRow").on('keyup','#expense_amount',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var expense_amount = lastRow.find('input.expense_amount').val();
  lastRow.find('input.actual_amount').val(expense_amount*quantity);
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
      
      var expense_code = $('#expense_code').val().trim();
      var date = $('#date').val().trim();
      var center_id  = $('#center_id').val().trim();

      var expense_id= new Array();
      $('.expense_id').each(function(){
          expense_id.push($(this).val().trim());
      });

      var expense_amount= new Array();
      $('.expense_amount').each(function(){
          expense_amount.push($(this).val().trim());
      });

      var quantity= new Array();
      $('.quantity').each(function(){
          quantity.push($(this).val().trim());
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
        url: '<?php echo site_url();?>/expense_entry_controller/save_expense_entry',
        data:{ 
            expense_code: expense_code, 
            center_id: center_id,
            date: date, 
            expense_id: expense_id,
            expense_amount: expense_amount,
            quantity: quantity,
            actual_amount: actual_amount,
            remarks: remarks,
            number_row: number_row
          
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          window.location = '<?php echo site_url()?>/expense_entry_controller/create';
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
    
    else if($('#expense_id').val()=="select")
    {
      alert("Please Select your Expense ID");
      $('#expense_id').focus();
      return false;
    }

    else if($('#expense_amount').val()=="")
    {
      alert("Please Select Expense Amount");
      $('#expense_amount').focus();
      return false;
    }


    else if($('#quantity').val()=="")
    {
      alert("Please Select Quantity");
      $('#quantity').focus();
      return false;
    }

    else if($('#actual_amount').val()=="")
    {
      alert("Please Select Actual Amount");
      $('#actual_amount').focus();
      return false;
    }


    return true;
      
  };


</script>




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

