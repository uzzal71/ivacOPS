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
      <form class="form-horizontal form-label-left" method="POST">
<div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Center</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control" name="center_id2" id="center_id2">
          <option selected>Center name</option>
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Employee ID</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control employee_id" name="employee_id" id="employee_id" style="width: 310px">
            <!-- get ajax employee info -->
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="password" placeholder="********" id="password" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Comfirm Password</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="confirm_password" placeholder="********" id="comfirm_password" required>
          </div>
        </div>
        <div class="clearfix"></div><br />
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="status" name="status" class="form-control">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-primary">Cancel</button>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="button" class="btn btn-success" id="btn_create_user">Submit</button>
          </div>
        </div>

      </form>
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
              <label for="ckbCheckAll">Select All Roles </label> | <input class="check-all" type="checkbox" name="" id="ckbCheckAll">
              
                <?php 
                
                //include('manual_db_connect.php');
                include APPPATH.'views/backend/admin/'.'manual_db_connect.php';
                
                $GLOBALS['align_depth'] = 0;
                $GLOBALS['max_depth'] = 0;
                
                generate_available_roles(0, $mysqli);       
                
                function generate_available_roles($parent_id, $mysqli)
                {
                  
                  $sql = "SELECT
                        a.id,
                        a.menu,
                        (SELECT count(*) FROM menus b WHERE a.id = b.parent_id) AS no_of_child
                      FROM
                        menus a
                      WHERE  parent_id = ".$parent_id." 
                        ";
                  //echo "<pre>"; print_r($sql); exit();
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
                            <input type="checkbox" class="checkBoxClass" value="<?php echo $each_role['id'];?>" onchange="automatically_select_child(this.value, this.checked)"> <?php echo $each_role['menu'];?>
                          
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
              </table>
      

        <br><h2>Center Permission</h2><hr>
        <input type="checkbox" name="" id="selectAllCenter">&nbsp;Select all<hr>
        <?php
        $centers = $this->db->get('centers')->result_array();
        foreach($centers as $center_row):
        ?>
          <input type="checkbox" class="checkboxCenter" value="<?php echo $center_row['center_id'] ?>"> <?php echo $center_row['center_name']; ?><br>
        <?php 

         ?>
       <?php endforeach; ?>
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
  </script>













</div>


    
<script type="text/javascript">
  
  function automatically_select_child(id, check_status)
  {
    if(check_status)
    {
       $("#"+id).find('input[type=checkbox]').each(function () 
       {
         this.checked = true;
         
      });
    }
    else
    {
       $("#"+id).find('input[type=checkbox]').each(function () 
       {
         this.checked = false;
      });
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

    $("#btn_create_user").click(function(){
                

      if(form_validation())
      {
        
        var employee_id = $('#employee_id').val();
        var center_id = $('#center_id2').val();
        var password = $('#password').val();
        var comfirm_password = $('#comfirm_password').val();

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
      
        var response;
        $.ajax({
          async: false,
          type: 'POST',
          url: '<?php echo base_url();?>user_controller/save_user',
          data:{ 
              employee_id: employee_id,
              center_id: center_id,
              password: password,
              comfirm_password: comfirm_password,
              user_role: user_role,
              center_role: center_role,
            },
          //timeout: 4000,
          success: function(result) {
            response = result;
            alert(response);
            window.location.assign('view');
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
     
    else if($('#password').val() == "")
    {
      alert("Please insert password");
      $('#password').focus();
      return false;
    }     
        
    else if($('#confirm_password').val() == "")
    {
      alert("Please insert confirm password");
      $('#confirm_password').focus();
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



  
  });

  $("#employee_id").change(function(){
    employee_id = this.value;

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
            var emp_info = response.split("#");;
            $("#employee_name").val(emp_info[0]);
            $("#center_id").val(emp_info[1]);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            response = "err--" + XMLHttpRequest.status + " -- " + XMLHttpRequest.statusText;
          }
        });



  });

</script>
