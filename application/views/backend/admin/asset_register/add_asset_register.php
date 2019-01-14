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
    <!-- Form Here -->

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
              <div class="col-md-2"><th>Asset Type:</th></div>
              <div class="col-md-2"><th>Asset Name:</th></div>
              <div class="col-md-2"><th>Purchase Value:</th></div>              
              <div class="col-md-2"><th>Quantity:</th></div>
              <div class="col-md-2"><th>Asset Amount:</th></div>              
              <div class="col-md-2"><th>Remarks:</th></div>
            </div>            
          </tr>
          <div id="ItemsRow">
        <div id="entry1" class="clonedInput row">
          <input type="hidden" name="sl" id="sl" value="1" class="sl" >
          <tr>
            <div class="incomeSelect col-md-2">
            <td>
              <select name="asset_id[]" id="asset_id" class="asset_id">
                <option value="select" selected>Select Asset</option>
                <option value="1">Written Down</option>
                <option value="2">Straight Line</option>
              </select>
            </td>
            </div>
            <div class="assetNametDiv col-md-2">
            <td><input type="text" name="asset_name[]" id="asset_name" class="asset_name"></td>
            </div>
            <div class="purchaseValuetDiv col-md-2">
            <td><input type="text" name="purchase_value[]" id="purchase_value" class="purchase_value"></td>
            </div>
            <div class="quantityDiv col-md-2">
              <td><input type="text" name="quantity[]" id="quantity" class="quantity"></td>
            </div>
            <div class="assetAmountDiv col-md-2">
            <td><input type="text" name="asset_amount[]" id="asset_amount" class="asset_amount"></td>
            </div>            
            <div class="remarksDiv col-md-2">
            <td>
              <input type="text" name="remarks[]" id="remarks" class="remarks" style="width: 70%">
              <button style="" id="btnDel" name="btnDel[]" class="btnDel"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
            </div>
          </tr>
          <div class="row">
      <div class="depreciationRateDiv col-md-2" style="margin-left: 10px">
        <td>
          <label>Depreciation Rate(%):</label>
          <input type="number" name="depreciation_rate[]" id="depreciation_rate" class="depreciation_rate" required></td>
      </div> 
    </div>
    <br>
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
* Quantity keyup income_amount * quanity
**/
$("#ItemsRow").on('keyup','#quantity',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var purchase_value = lastRow.find('input.purchase_value').val();
  lastRow.find('input.asset_amount').val(purchase_value*quantity);
});
// ========================================================
/**
* Quantity keyup income_amount * quanity
**/
$("#ItemsRow").on('blur','#purchase_value',function(){
  var lastRow = $("#ItemsRow .clonedInput:last");
  var quantity = lastRow.find('input.quantity').val();
  var purchase_value = lastRow.find('input.purchase_value').val();
  lastRow.find('input.asset_amount').val(purchase_value*quantity);
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
      var date = $('#date').val().trim();
      var center_id  = $('#center_id').val().trim();

      var asset_id= new Array();
      $('.asset_id').each(function(){
          asset_id.push($(this).val().trim());
      });

      var asset_name= new Array();
      $('.asset_name').each(function(){
          asset_name.push($(this).val().trim());
      });

      var purchase_value= new Array();
      $('.purchase_value').each(function(){
          purchase_value.push($(this).val().trim());
      });

      var quantity= new Array();
      $('.quantity').each(function(){
          quantity.push($(this).val().trim());
      });  

      var asset_amount= new Array();
      $('.asset_amount').each(function(){
          asset_amount.push($(this).val().trim());
      });

      var remarks= new Array();        
      $('.remarks').each(function(){
          remarks.push($(this).val().trim());
      }); 

       var depreciation_rate= new Array();        
      $('.depreciation_rate').each(function(){
          depreciation_rate.push($(this).val().trim());
      }); 


      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/asset_register_controller/save_asset_entry',
        data:{  
            center_id: center_id,
            asset_id: asset_id,
            asset_name: asset_name,
            purchase_value: purchase_value,
            quantity: quantity,            
            asset_amount: asset_amount,
            date: date, 
            remarks: remarks,
            depreciation_rate: depreciation_rate,
            number_row: number_row
          
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          //console.log(response);
          window.location = '<?php echo site_url()?>/asset_register_controller/create';
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
    
    else if($('#asset_id').val()=="select")
    {
      alert("Please Select Your Asset Type");
      $('#asset_id').focus();
      return false;
    }

    else if($('#asset_name').val()=="")
    {
      alert("Please Select Asset Name");
      $('#asset_name').focus();
      return false;
    }

    else if($('#purchase_value').val()=="")
    {
      alert("Please Select Purchase Value");
      $('#purchase_value').focus();
      return false;
    }  

    else if($('#quantity').val()=="")
    {
      alert("Please Select Quantity");
      $('#quantity').focus();
      return false;
    }

    else if($('#asset_amount').val()=="")
    {
      alert("Please Select Asset Amount");
      $('#asset_amount').focus();
      return false;
    }

    else if($('#depreciation_rate').val()=="")
    {
      alert("Please Select Depreciation Rate");
      $('#depreciation_rate').focus();
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

