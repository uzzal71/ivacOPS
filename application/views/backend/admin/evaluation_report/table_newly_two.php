<?php
 //require 'connection.php'
include APPPATH.'views/backend/admin/'.'manual_db_connect.php'; 
?>
<?php 

$performances = $this->db->get('performances')->result_array();
foreach($performances as $row):
	$r_per = $row['recive'];
	$d_per = $row['delivery'];
	$b_per = $row['backend'];
	$s_per = $row['scanning'];
endforeach;


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
<h4 style="text-align: center; margin: 5px;">Employee Score Details</h4>
<br>
<div style='margin: 0 auto; width: 1020px;'>

<table border="1" style="width: 1020px;padding: 10px;text-align: center;">
	<tr>
		<th>Serial</th>
		<th>Date</th>
		<th colspan="4">Performance Score(Max Score - 80)</th>
	</tr>
	<tr>
		<td rowspan="5">1</td>
		<th rowspan="5">2018-09-01</th>
		<th></th>
		<th>No.of files</th>
		<th>Score</th>
		<th>Total</th>
	</tr>
	<tr>
		<th>Receive</th>
		<td>24</td>
		<td>232</td>
		<td rowspan="4">3455</td>
	</tr>
	<tr>
		<th>Delivery</th>
		<td>24</td>
		<td>232</td>

	</tr>
	<tr>
		<th>Backend</th>
		<td>24</td>
		<td>232</td>

	</tr>
	<tr>
		<th>Scaning</th>
		<td>24</td>
		<td>232</td>

	</tr>
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
		var center_id='<?php echo $_POST['center_id']?>';
        var from_date='<?php echo $_POST['from_date']?>';
        var to_date='<?php echo $_POST['to_date']?>';
        var url = 'http://localhost:8080/software/EmployeeEvaluation/index.php/report_controller/center_details_excel?center_id='+center_id+'&from_date='+from_date+'&to_date='+to_date;

        window.open(url);
    }
</script>
</html>
