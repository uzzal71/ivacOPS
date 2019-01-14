<?php 
$roles = "$each_user->menu_permitted";
$GLOBALS['roles_array'] = explode(",",$roles);

 ?>
<div class="col-md-12 col-xs-12">
<div class="col-md-6 col-xs-6">
  <div class="x_panel">
    <div class="x_title">
      <h2>New Menu Form</h2>
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
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('id', $id);
      $query_result_status = $this->db->get();
      $result_user_status = $query_result_status->row();
      ?>
      <form class="form-horizontal form-label-left" name="user_form" method="POST">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Center Name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="center_id" id="center_id">
              <option selected>Select Center</option>
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee name</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="employee_name" id="employee_name" readonly>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="status" id="status">
              <?php
                if($result_user_status->status == 1)
                {
                  ?><option value="1" selected>Active</option>
                  <option value="0">Inactive</option>
                  <?php
                }
                else
                {
                  ?>
                  <option value="0" selected>Inactive</option>
                  <option value="1">Active</option>
                  <?php
                } 
               ?>
            </select>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="button" class="btn btn-success" id="btn_update_user">Update</button>
          </div>
        </div>

      
    </div>
  </div>
</div>












<div class="col-md-6 col-xs-6">
  <div class="x_panel">
    <div class="x_title">
      <h2>Menu Permitted</h2>
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


   <table>            
          <tr>
              <td style="text-align:left" colspan="2">
              <label for="ckbCheckAll">Select All Roles &nbsp;</label>  <input class="check-all" type="checkbox" name="" id="ckbCheckAll"> <br>
              
                <?php 
                
                
                //include('manual_db_connect.php');
                include APPPATH.'views/backend/admin/'.'manual_db_connect.php';


                $GLOBALS['align_depth'] = 0;
                $GLOBALS['max_depth'] = 0;
                
                generate_available_roles(0, $mysqli);       
                
                function generate_available_roles($parent_id, $mysqli)
                {
                  //$sql = "SELECT * FROM user_roles WHERE company_id = ".$_SESSION['company_id']." AND parent_id = $parent_id AND id IN (".$_SESSION['permitted_action'].")";
                  $sql = "SELECT
                        a.id,
                        a.menu,
                        (SELECT count(*) FROM menus b WHERE a.id = b.parent_id) AS no_of_child
                      FROM
                        menus a
                      WHERE parent_id = ".$parent_id." 
                        ";
                   //var_dump($sql); exit();
                  if (!$result = $mysqli->query($sql))
                  {
                    echo "Error: Our query failed to execute and here is why: \n Query: " . $sql . "\nErrno: " . $mysqli->errno . "\n Error: " . $mysqli->error . "\n";
                    exit;
                  }
                  else if ($result->num_rows > 0)
                  {                   
                    
                    while ($each_role = $result->fetch_assoc())
                    {                     
                      
                      $GLOBALS['align_depth']++;
                      
                      //if($parent_id == 0)
                      if($each_role['no_of_child'] != 0)
                      {
                        echo "<table id='".$each_role['id']."'>";
                      }
                      ?>
                        
                        <tr>
                          <?php
                          for($i = 1; $i < $GLOBALS['align_depth']; $i++)
                          {
                            echo "<td>&nbsp;</td>";
                          }
                          ?>
                          <td style="text-align:left">
                            <input type="checkbox" class="checkBoxClass" <?php if(in_array($each_role['id'],$GLOBALS['roles_array'])){ echo 'checked ="checked"';}?> value="<?php echo $each_role['id'];?>" onchange="automatically_select_child(this.value, this.checked)"> <?php echo $each_role['menu'];?>
                          
                      <?php
                      
                      generate_available_roles($each_role['id'], $mysqli);                        
                          
                      $GLOBALS['align_depth']--;
                      
                      echo "</td>
                        </tr>"; 
                      
                      //if($parent_id == 0)
                      if($each_role['no_of_child'] != 0)
                        echo "</table>";
                      
                    }
                  }
                }
                
                ?>
             </td>
          </tr>   
        </table>

      <br><h2>Center Permission</h2><hr>
        <input type="checkbox" name="" id="selectAllCenter">&nbsp;Select all<hr>
      <?php

      $sql_centers_ids = "SELECT `center_role` FROM `users` WHERE `id` = $id";
      $result = $mysqli->query($sql_centers_ids); 
      if($result->num_rows > 0)
      {
        while($center_role_row = $result->fetch_assoc())
        {
          $centers=$center_role_row["center_role"];
          $centersArray=explode("," ,$centers);
        }

      }

      $sql_user_center_role = "SELECT `center_id`, `center_name` FROM `centers`";
      // var_dump($sql_user_center_role);
      // exit();
      $result_user_center_role = $mysqli->query($sql_user_center_role); 
      if($result_user_center_role->num_rows > 0)
      {
        while($center_row = $result_user_center_role->fetch_assoc())
        {
          ?>
          <input type="checkbox" class="checkboxCenter" value="<?php echo $center_row['center_id']?>" <?php if(in_array($center_row['center_id'],$centersArray)){echo 'checked';}?> >
          <?php echo $center_row['center_name'] ?><br>
          <?php
        }

      }

       ?>


    </div>
  </div>
</div>
</div>
</form>

<?php 
$this->db->select('*');
$this->db->from('users');
$this->db->where('employee_id', $employee_id);
$query_result = $this->db->get();
$result = $query_result->row();




 ?>









</div>


    
<script type="text/javascript">
  
  function automatically_select_child(id, check_status)
  {

    if(check_status)
    {
      //alert("true");
       $("#"+id).find('input[type=checkbox]').each(function () 
       {
         this.checked = true;
         
      });
      //$("#"+id).find('input[type=checkbox]:first').checked = true;
    }
    else
    {
      //alert("false");
       $("#"+id).find('input[type=checkbox]').each(function () 
       {
         this.checked = false;
      });
      //$("#"+id).find('input[type=checkbox]:first').checked = false;
    }
  }



  $(document).ready(function() {

    $("#selectAllCenter").click(function () {
    if (this.checked){
        $(".checkboxCenter").prop('checked', true);
    }

    else{

        $(".checkboxCenter").prop('checked', false);
    }

});


    $("#btn_update_user").click(function(){
                
      if(form_validation())
      {
        
        var employee_id = $('#employee_id').val();
        var center_id = $('#center_id').val();
        var status = $('#status').val();

        var user_role = [];
        $(".checkBoxClass:checked").each(function() {
          if($(this).is(":checked")){
            user_role.push($(this).val());
          }
        });
        user_role = user_role.toString();

        var center_role = [];
        $(".checkboxCenter:checked").each(function() {
          if($(this).is(":checked")){
            center_role.push($(this).val());
          }
        });
        center_role = center_role.toString();

        //alert(center_role);
        
      
        var response;
        $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/update_user',
          data:{ 
              employee_id: employee_id,
              user_role: user_role,
              center_role: center_role,
              center_id: center_id,
              status: status
            },
          //timeout: 4000,
          success: function(result) {
            response = result;
            alert(response);
            window.location.replace("<?php echo base_url();?>user_controller/view");
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });
        
        //alert(response);
        
      
      }
    

  });
  

  function form_validation()
  {
    //alert("validation");
    
    if($('#employee_id').val() == "select")
    {
      alert("Please Select Employee ID");
      $('#employee_id').focus();
      return false;
    }   

    else if($('#user_type').val() == "select")
    {
      alert("Please Select User Type.");
      $('#user_type').focus();
      return false;
    }   
    return true;
  }


      //  ======  ######  For Selecting All Roles  ######  ======
   $("#ckbCheckAll").click(function () {
        if (this.checked)
            $(".checkBoxClass").prop('checked', "checked");
        else
            $(".checkBoxClass").removeProp('checked');
    });




   // Employee name select
   var employee_id = $("#employee_id").val();

        var response;
        $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/pick_employee_name',
          data:{ 
              employee_id: employee_id
            },
          //timeout: 4000,
          success: function(result) {
            response = result;
            $("#employee_name").val(response);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });

  
  });


</script>
<script type="text/javascript">
  document.forms['user_form'].elements['center_id'].value = <?php echo $result->center_id; ?>
 // document.forms['user_form'].elements['status'].value = <?php echo $result_user_status->status; ?>
</script>

