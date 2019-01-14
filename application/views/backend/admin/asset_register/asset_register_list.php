
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
            <th>Asset Type</th>            
            <th>Asset Name</th>            
            <th>Purchase value</th>            
            <th>Quantity</th>            
            <th>Asset Amount</th>            
            <th>Depreciation Rate(%)</th>            
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
          $this->db->from('tbl_asset_register_log');
          $this->db->where('center_id', $expload_center[$i]);
          $this->db->order_by('id', 'desc');
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
              <td><?php
              if($row['asset_id'] == 1){
                echo "Written Down";
              } 
              else {
                echo "Straight Line";
              }
              ?></td>
              <td><?php echo $row['asset_name'];?></td>
              <td><?php echo $row['purchase_value'];?></td>
              <td><?php echo $row['quantity'];?></td>
              <td><?php echo $row['asset_amount'];?></td>
              <td><?php echo $row['depreciation_rate'];?>%</td>              
              <td align="center">
                <a href="<?php echo site_url('asset_register_controller/edit/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td align="center">
                <a onclick="return confirm(' you want to delete?');" href="<?php echo site_url('asset_register_controller/destory/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-remove"></span></a>
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