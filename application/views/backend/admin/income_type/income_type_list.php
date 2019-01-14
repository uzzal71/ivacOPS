
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

  <?php
  // Success Message showing
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

    // Errors Message showing
   $error = $this->session->userdata('error');
    if(isset($error)) {
      ?>

      <div class="alert alert-danger alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>ERROR!</strong> <?php echo $error; ?>
    </div>

      <?php
      $this->session->unset_userdata('error');
    }  

   ?>

  <div class="x_panel">
    <div class="x_content">
      <table id="datatable-fixed-header" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Center Name</th>
            <th>Income Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 1;
          $center_permitted = $this->session->userdata('center_permitted');
          $expload_center = explode(',', $center_permitted);
          $center_length = count($expload_center);
          $count = 1;
          for($i=0; $i<$center_length;$i++){
          $where_center = array('center_id' => $expload_center[$i]);
          $income_types= $this->db->get_where('income_type', $where_center)->result_array();
          //$income_types= $this->db->get('income_type')->result_array();
          foreach ($income_types as $row):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php
              $where_date = array('center_id' => $row['center_id']);
              $centers = $this->db->get_where('centers', $where_date)->result_array();
              foreach($centers as $center)
              {
                echo $center['center_name'];
              }
              ?></td>
              <td><?php echo $row['income_type'];?></td>
              <td><?php echo $row['income_amount'];?></td>
              <td><?php
               if($row['status'] == 1) {
                echo "Active";
               }
               else{
                echo "Inactive";
               }
               ?></td>
              <td style="text-align: center;">
                <a href="<?php echo site_url('income_type_controller/edit/' . $row['income_id']);?>" class=""><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td style="text-align: center;">
                <a onclick="return confirm(' you want to delete?');"  href="<?php echo site_url('income_type_controller/destory/' . $row['income_id']);?>" class=""><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          <?php endforeach; } ?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Center Name</th>
            <th>Income Type</th>
            <th>Income Amount</th>
            <th>Status</th>
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