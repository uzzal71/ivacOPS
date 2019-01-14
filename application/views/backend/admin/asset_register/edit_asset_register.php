<div class="col-md-6 col-xs-12 col-md-offset-3">
<div class="x_panel">
  <div class="x_title">
    <h2>Edit Asset Form</h2>
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
    $specific_asset = $this->db->get_where('tbl_asset_register_log', $where_data)->result_array();
    foreach($specific_asset as $row):
    ?>
    <form name="edit_asset" autocomplete="off" class="form-horizontal form-label-left" action="<?php echo site_url('asset_register_controller/update/'.$id);?>" method="POST">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center ID</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
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
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Type</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select name="asset_id" id="asset_id" class="form-control" required>
            <option value="select" selected>Select Asset</option>
            <option value="1">Written Down</option>
            <option value="2">Straight Line</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Name</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="asset_name" id="asset_name" value="<?php echo $row['asset_name'];?>" required>
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id;?>" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Value</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="purchase_value" id="purchase_value" value="<?php echo (int)$row['purchase_value'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $row['quantity'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Amount</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="asset_amount" id="asset_amount" value="<?php echo (int)$row['asset_amount'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Depreciation Rate</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="depreciation_rate" id="depreciation_rate" value="<?php echo $row['depreciation_rate'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="remarks" id="remarks" value="<?php echo $row['remarks'];?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="text" class="form-control" name="date" id="date_asset2" value="<?php echo $row['date'];?>">
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <button type="button" class="btn btn-primary">Cancel</button>
          <button type="reset" class="btn btn-primary">Reset</button>
          <button type="button" class="btn btn-success" id="submit_button">Submit</button>
        </div>
      </div>

    </form>
  <?php endforeach;?>
  </div>
</div>
</div>

<script type="text/javascript">
  document.forms['edit_asset'].elements['center_id'].value = <?php echo $row['center_id']; ?>
</script>

<script type="text/javascript">
  document.forms['edit_asset'].elements['asset_id'].value = <?php echo $row['asset_id']; ?>
</script>

<script type="text/javascript">

$("#quantity").keyup(function(){
  var quantity = $('#quantity').val().trim();
  var purchase_value = $('#purchase_value').val().trim();
  $('#asset_amount').val(purchase_value*quantity)
});
// ========================================================
/**
* Quantity keyup income_amount * quanity
**/
  $("#purchase_value").keyup(function(){
  var quantity = $('#quantity').val().trim();
  var purchase_value = $('#purchase_value').val().trim();
  $('#asset_amount').val(purchase_value*quantity)
});
//=======================================
/**
** Update Expense data
**/
$("#submit_button").click(function(){

    //alert("Testing");
    if(form_validation() == true)
    {
      var date = $('#date_asset2').val().trim();
      var quantity  = $('#quantity').val().trim();
      var center_id  = $('#center_id').val().trim();
      var asset_id  = $('#asset_id').val().trim();
      var asset_name  = $('#asset_name').val().trim();
      var asset_amount  = $('#asset_amount').val().trim();
      var remarks  = $('#remarks').val().trim();
      var depreciation_rate  = $('#depreciation_rate').val().trim();
      var purchase_value  = $('#purchase_value').val().trim();
      var id  = $('#id').val().trim();

      $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo site_url();?>/asset_register_controller/update_asset_info',
        data:{  
            center_id: center_id,
            asset_id: asset_id,
            asset_name: asset_name,
            purchase_value: purchase_value,
            quantity: quantity,            
            asset_amount: asset_amount,
            depreciation_rate: depreciation_rate, 
            remarks: remarks,
            date: date,
            id: id
          },
        //timeout: 4000,
        success: function(result) {
          response = result;
          if (response) {
          alert(response);
          window.location = '<?php echo site_url()?>/asset_register_controller/view';
        }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
        }
      });

    }

    return true;

});


function form_validation(){

  //alert('GOT IT');
  if($('#center_id').val()== "select")
  {
    alert("Please Select Center ID");
    $('#center_id').focus();
    return false;
  }

  else if($('#date_asset2').val().trim() == "")
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



</script>