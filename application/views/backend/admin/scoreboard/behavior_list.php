
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
      <h2>Behaviour & working Score</h2>
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
      <table id="datatable-fixed-header" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Center</th>
            <th>Date</th>
            <th>Behaviour</th>
            <th>Late Day</th>
            <th>Working Day</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $center_permitted = $this->session->userdata('center_permitted');
          $expload_center = explode(',', $center_permitted);
          $center_length = count($expload_center);
          $count = 1;
          for($i=0; $i<$center_length;$i++){
            $where_behaviour = array('center_id' => $expload_center[$i]);
          $behavior = $this->db->get_where('behavior', $where_behaviour)->result_array();
          foreach ($behavior as $score):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php 
                $where_data = array('employee_id' => $score['employee_id']);
                $employee = $this->db->get_where('employee', $where_data)->result_array();
                foreach($employee as $row):
                  echo $row['employee_name'];
                endforeach;
              ?></td>
              <td><?php echo $score['employee_id'];?></td>
              <td><?php 
                $where_data = array('center_id' => $score['center_id']);
                $center = $this->db->get_where('centers', $where_data)->result_array();
                foreach($center as $row):
                  echo $row['center_name'];
                endforeach;
              ?></td>
              <td><?php echo $score['date'];?></td>
              <td><?php echo $score['behavior'];?></td>
              <td><?php echo $score['late_day'];?></td>
              <td><?php echo $score['working_day'];?></td>
              <td style="text-align: center;">
                <a href="<?php echo site_url('scoreboard_controller/edit_behavior/' . $score['id']);?>" class=""><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td style="text-align: center;">
                <a onclick="return confirm(' you want to delete?');"  href="<?php echo site_url('scoreboard_controller/destory_behavior/' . $score['id']);?>" class=""><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          <?php
          endforeach;
        }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Center</th>
            <th>Date</th>
            <th>Behaviour</th>
            <th>Late Day</th>
            <th>Working Day</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
      </table>
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