<?php
    $file="employee_List_".date("Y-m i:s").".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
?>

<table border="1" cellpadding="0" cellspacing="0" style="width: 620px">
<thead>
<tr>
  <th>#</th>
  <th>Center Name</th>
  <th>Employee ID</th>
  <th>Employee Name</th>
  <th>Father Name</th>
  <th>Mother Name</th>            
  <th>E-mail</th>
  <th>Contact Number</th>
  <th>Present Address</th>
  <th>Permanent Address</th>
  <th>Spouse Name</th>
  <th>date Of Birth</th>
  <th>Date Of joining</th>
  <th>Blood Broup</th>
  <th>Emergeracy Name</th>
  <th>Emergeracy Phone</th>
</tr>
</thead>
<tbody>
<?php 
$center_permitted = $this->session->userdata('center_permitted');
$expload_center = explode(',', $center_permitted);
$center_length = count($expload_center);
$count = 1;
for($i=0; $i<$center_length;$i++){
$where_employee = array('center_id' => $expload_center[$i], 'status' => 1);
$employees= $this->db->get_where('employee', $where_employee)->result_array();
foreach ($employees as $row):
?>
<tr>
  <td><?php echo $count++;?></td>
  <td><?php
    $this->db->select('*');
    $this->db->from('centers');
    $this->db->where('center_id', $row['center_id']);
    $query_result = $this->db->get();
    $result = $query_result->row();
    echo $result->center_name;
  ?></td>
  <td><?php echo $row['employee_id'];?></td>
  <td><?php echo $row['employee_name'];?></td>
  <td><?php echo $row['father_name'];?></td>
  <td><?php echo $row['mother_name'];?></td>
  <td><?php echo $row['email'];?></td>
  <td><?php echo $row['contact_number'];?></td>
  <td><?php echo $row['present_address'];?></td>
  <td><?php echo $row['permanent_address'];?></td>
  <td><?php echo $row['spouse_name'];?></td>
  <td><?php echo $row['date_of_birth'];?></td>
  <td><?php echo $row['date_of_joining'];?></td>
  <td><?php echo $row['blood_group'];?></td>
  <td><?php echo $row['em_name'];?></td>
  <td><?php echo $row['em_phone'];?></td>
</tr>
<?php 
endforeach;
}
?>
</tbody>
</table>







