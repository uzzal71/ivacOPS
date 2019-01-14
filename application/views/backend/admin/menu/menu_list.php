<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
      <?php
  
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

   ?>
  <div class="x_panel">
    <div class="x_content">
      <table id="datatable-fixed-header" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Parent ID</th>
            <th>Url Link</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 1;
          $menus= $this->db->get('menus')->result_array();
          foreach ($menus as $row):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php echo $row['menu'];?></td>
              <td><?php echo $row['parent_id'];?></td>
              <td><?php echo $row['url_link'];?></td>
              <td>
              <?php 
               if ($row['status'] == 1) {echo 'Active';}
               else{echo 'Inactive';}
               ?>
               </td>
              <td align="center">
                <a href="<?php echo site_url('menu_controller/edit/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td align="center">
                <a onclick="return confirm(' you want to delete?');" href="<?php echo site_url('menu_controller/destory/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Parent ID</th>
            <th>Url Link</th>
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