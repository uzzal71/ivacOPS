<?php
 //require 'connection.php'
include APPPATH.'views/backend/admin/'.'manual_db_connect.php'; 
?>

<!DOCTYPE html>
<html>
<head>
  <title>INDIAN VISA APPLICATION CENTER</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	table tr th{
		text-align: center;
	}
</style>
</head>
<body>
<div style='width:1020px; margin: 0 auto;'>
	<button style="float: right; margin-left:10px; padding: 5px 20px" onClick="exportExcel()">Export</button>
    <button style="float: right; padding: 5px 20px" onClick="printDiv()">Print</button>
</div>
<br><br>
<div id="report" style='width:1020px; margin: 0 auto'>
<h3 style="text-align: center; margin: 5px;">Employee Evaluation</h3>
<h4 style="text-align: center; margin: 5px;">Employee Performance Details</h4>
<b>Employee ID: <?php echo $employee_id;?></b>
<p>
<b> Employee Name: 
<?php
$where_data = array('employee_id' => $employee_id, 'center_id' => $center_id);
$employees = $this->db->get_where('employee', $where_data)->result_array();
foreach($employees as $employee_row):
	echo $employee_row['employee_name'];
endforeach;
?>
</b>
<b style="float: right;">
	<?php echo $from_date.' To '.$to_date;?>
</b>
</p>
<div style='margin: 0 auto; width: 1020px;'>
<table border="1" style="width: 1020px;padding: 10px;text-align: center;">
	<tr>
		<th>Serial</th>
		<th>Date</th>
		<th colspan="4">Performance Score(Max Score - 80)</th>
	</tr>
	<?php 

	$sql = "SELECT * FROM `employee_score` WHERE `center_id` = $center_id AND `employee_id` = '$employee_id' AND (`date` BETWEEN '$from_date' AND '$to_date')";

	$query = $this->db->query($sql);
	$perfor_emp= $query->result_array();
	$perfor_length =  count($perfor_emp);
	$config = 1;
	$serial_no = 1;
	foreach($perfor_emp as $row)
	{
	?>
	<tr>
		<td rowspan="5"><?php echo $serial_no++; ?></td>
		<th rowspan="5"><?php echo $row['date']; ?></th>
		<?php 
		if($config == 1) {
		 ?>
		<th style="font-size: 11px">Performance Type</th>
		<th style="font-size: 11px">No.of files</th>
		<th style="font-size: 11px">Score</th>
		<th style="font-size: 11px">Total</th>
		<?php
		}
		 ?>
	</tr>
	<tr>
		<th>Receive</th>
		<td><?php echo $row['receive']; ?></td>
		<td><?php echo $row['receive']*2.5; ?></td>
		<td rowspan="4"><?php echo ($row['receive']*2.5 + $row['delivery']*.2 + $row['backend']*1 + $row['scanning']*0.5); ?></td>
	</tr>
	<tr>
		<th>Delivery</th>
		<td><?php echo $row['delivery']; ?></td>
		<td><?php echo $row['delivery']*.2; ?></td>

	</tr>
	<tr>
		<th>Backend</th>
		<td><?php echo $row['backend']; ?></td>
		<td><?php echo $row['backend']*1; ?></td>

	</tr>
	<tr>
		<th>Scanning</th>
		<td><?php echo $row['scanning']; ?></td>
		<td><?php echo $row['scanning']*0.5; ?></td>

	</tr>
	<?php
	$config = 0;
	}
	
	 ?>
</table>
		
</div>
</div>
</body>

<script>
    function printDiv() {
        var divToPrint = document.getElementById('report').innerHTML;
        var myWindow=window.open();
        myWindow.document.write(divToPrint);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
    }
	
	//  ======  ######  For Export Excel ######  ======
	
	function exportExcel() {
		var employee_id='<?php echo $employee_id?>';
        var from_date='<?php echo $from_date?>';
        var to_date='<?php echo $to_date?>';
        var center_id='<?php echo $center_id?>';
        var url = 'http://166.62.16.132/ivacOPS/index.php/report_controller/employee_performance_excel?employee_id='+employee_id+'&from_date='+from_date+'&to_date='+to_date+'&center_id'+center_id;
        //var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/Report_controller/employee_performance_excel?employee_id='+employee_id+'&from_date='+from_date+'&to_date='+to_date;

        window.open(url);
    }
</script>
</html>
