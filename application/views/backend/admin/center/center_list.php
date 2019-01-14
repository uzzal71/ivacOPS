
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

  <?php
  // Success Message Showing
   $message = $this->session->userdata('message');
    if(isset($message)) {
      ?>

      <div class="alert alert-success alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>SUCCESS!</strong> <?php echo $message; ?>
    </div>

      <?php
      $this->session->unset_userdata('message');
    } 

    // Errors Message Showing
    $error = $this->session->userdata('error');
    if(isset($error)) {
      ?>

      <div class="alert alert-danger alert-dismissible fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>ERRORS!</strong> <?php echo $error; ?>
    </div>

      <?php
      $this->session->unset_userdata('error');
    } 

   ?>

  <div class="x_panel">
    <div class="x_title">
      <h2>List Of Centers</h2>
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
            <th>Name</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 1;
          // $center_permitted = $this->session->userdata('center_permitted');
          // $expload_center = explode(',', $center_permitted);
          // $center_length = count($expload_center);
          // $count = 1;
          // for($i=0; $i<$center_length;$i++){
          // $where_center = array('center_id' => $expload_center[$i]);
          //$centers= $this->db->get_where('centers', $where_center)->result_array();
          $centers= $this->db->get('centers')->result_array();
          foreach ($centers as $row):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php echo $row['center_name'];?></td>
              <td><?php
               if($row['status'] == 1) {
                echo "Active";
               }
               else{
                echo "Inactive";
               }
               ?></td>
              <td style="text-align: center;">
                <a href="<?php echo site_url('center_controller/edit/' . $row['center_id']);?>" class=""><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td style="text-align: center;">
                <a onclick="return confirm(' you want to delete?');"  href="<?php echo site_url('center_controller/destory/' . $row['center_id']);?>" class=""><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          <?php endforeach;  ?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Name</th>
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