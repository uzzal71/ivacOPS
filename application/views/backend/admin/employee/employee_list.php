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
    <div class="x_content">
      <div class="dropdown">
      <button class="dropbtn">Export</button>
        <div class="dropdown-content">
          <a href="<?php echo site_url('employee_controller/employee_pdf')?>" target="_blank">PDF</a>
          <a href="<?php echo site_url('employee_controller/employee_excel')?>" target="_blank">Excel</a>
        </div>
      </div>
      <table id="datatable-fixed-header" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Center Name</th>            
            <th>E-mail</th>
            <th>Contact Number</th>
            <th>Status</th>
            <th>Download</th>
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
          $where_employee = array('center_id' => $expload_center[$i]);
          $employees= $this->db->get_where('employee', $where_employee)->result_array();
          foreach ($employees as $row):
            ?>
            <tr>
              <td><?php echo $count++;?></td>
              <td><?php echo $row['employee_id'];?></td>
              <td><?php echo $row['employee_name'];?></td>
              <td><?php
                $this->db->select('*');
                $this->db->from('centers');
                $this->db->where('center_id', $row['center_id']);
                $query_result = $this->db->get();
                $result = $query_result->row();
                echo $result->center_name;
              ?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['contact_number'];?></td>
              <td>
              <?php 
               if ($row['status'] == 1) {echo 'Active';}
               else{echo 'Inactive';}
               ?>
               </td>
              <td align="center">
                <a target="_blank" href="<?php echo site_url('employee_controller/employee_detail_download/' . $row['employee_id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-download-alt"></span></a>
              </td>
              <td align="center">
                <a href="<?php echo site_url('employee_controller/edit/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
              <td align="center">
                <a onclick="return confirm(' you want to delete?');" href="<?php echo site_url('employee_controller/destory/' . $row['id']);?>" class="delete-row-default"><span class="glyphicon glyphicon-remove"></span></a>
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
           <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Center Name</th>            
            <th>E-mail</th>
            <th>Contact Number</th>
            <th>Status</th>
            <th>Download</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
</div>


<style type="text/css">
  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 5px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 130px;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #4CAF51;
    min-width: 130px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: white;
    padding: 10px 10px;
    text-decoration: none;
    display: block;
    border-bottom: 1px solid white;
    text-align: center;
}

.dropdown-content a:hover {background-color: red;color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>