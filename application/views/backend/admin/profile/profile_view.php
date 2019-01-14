
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

  <?php
  
   $message = $this->session->userdata('message');
    if(isset($message)) {
      ?>

      <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> <?php echo $message; ?>
    </div>

      <?php
      $this->session->unset_userdata('message');
    } 

   ?>

  <div class="x_panel">
    <div class="x_title">
      <h2>Profile : <?php echo $this->session->userdata('employee_id') ?></h2>
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
     
        <?php
            $employee_id = $this->session->userdata('employee_id');
            $where_data = array('employee_id'=> $employee_id);
            $profiles = $this->db->get_where('employee', $where_data)->result_array();
            foreach($profiles as $profile): 
         ?>
        <div>
          <div style="float: left;margin-left: 100px;width: 500px;background-color: #FFFFFF" border="1px">
            <h2>Profile Details</h2>
            <table class="table table-bordered">
              <tr>
                <td>Employee ID</td>
                <td><?php echo $profile['employee_id']; ?></td>
              </tr>
              <tr>
                <td>Employee Name</td>
                <td><?php echo $profile['employee_name']; ?></td>
              </tr>
              <tr>
                <td>Father Name</td>
                <td><?php echo $profile['father_name']; ?></td>
              </tr>
              <tr>
                <td>Mother Name</td>
                <td><?php echo $profile['mother_name']; ?></td>
              </tr>
              <tr>
                <td>E-mail</td>
                <td><?php echo $profile['email']; ?></td>
              </tr>
              <tr>
                <td>Contact</td>
                <td><?php echo $profile['contact_number']; ?></td>
              </tr>
              <tr>
                <td>Present Address</td>
                <td><?php echo $profile['present_address']; ?></td>
              </tr>
              <tr>
                <td>Permanent Address</td>
                <td><?php echo $profile['permanent_address']; ?></td>
              </tr>
            </table>
          </div>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
</div>
</div>

<script type="text/javascript">

  $(document).ready(function() {
    
    $('#add_center_button').click(function() {
      window.location = '<?php echo site_url('admin/center_add');?>';
    });

  });

</script>