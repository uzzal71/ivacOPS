
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">

  <?php
  
   $message = $this->session->userdata('message');
    if(isset($message)) {
      ?>

      <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>ERROR!</strong> <?php echo $message; ?>
    </div>

      <?php
      $this->session->unset_userdata('message');
    } 

   ?>

  <div class="x_panel">
    <div class="x_content">
      <!-- Code Here -->
            <table id="datatable-fixed-header" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Center Name</th>
            <th>Entry By(Employee ID)</th>
            <th>Income Code</th>            
            <th>Calculated Amount</th>            
            <th>Actual Amount</th>            
            <th>View</th>
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
          $this->db->select('*');
          $this->db->from('tbl_daily_income_log');
          $this->db->group_by('income_code');
          $this->db->where('center_id', $expload_center[$i]);
          $this->db->order_by('income_code', 'desc');
          $query = $this->db->get();
          $income_list =  $query->result_array();
          foreach ($income_list as $row):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php echo $row['date'];?></td>
              <td><?php
                $this->db->select('*');
                $this->db->from('centers');
                $this->db->where('center_id', $row['center_id']);
                $query_result = $this->db->get();
                $result = $query_result->row();
                echo $result->center_name;
              ?></td>
              <td><?php echo $row['created_by'];?></td>
              <td><?php echo $row['income_code'];?></td>
              <td><?php
              $sql_cal_amount = "SELECT SUM(calculated_amount) AS calculated_amount FROM `tbl_daily_income_log` where income_code='$row[income_code]' ";
              
              $query_result = $this->db->query($sql_cal_amount);
              $result = $query_result->row();
              echo number_format(round((float)$result->calculated_amount,2),2);
              ?></td>
              <td><?php
              $sql_actual_amount = "SELECT SUM(actual_amount) AS actual_amount FROM `tbl_daily_income_log` where income_code='$row[income_code]' ";
              
              $query_result = $this->db->query($sql_actual_amount);
              $result = $query_result->row();
              echo number_format(round((float)$result->actual_amount,2),2);
              ?>
                
              </td>
              <td align="center">
                <a target="_blank" href="<?php echo site_url('income_entry_controller/single_list_view/' . $row['income_code']);?>" class="delete-row-default"><span class="glyphicon glyphicon-th-list"></span></a>
              </td>
              <td align="center">
                <a href="<?php echo site_url('income_entry_controller/edit/' . $row['income_code']);?>" class="delete-row-default"><span class="glyphicon glyphicon-pencil"></span></a>
              </td>              
              <td align="center">
                <a onclick="return confirm(' you want to delete?');" href="<?php echo site_url('income_entry_controller/destory/' . $row['income_code']);?>" class="delete-row-default"><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          <?php 
          endforeach;
        }
          ?>
        </tbody>
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