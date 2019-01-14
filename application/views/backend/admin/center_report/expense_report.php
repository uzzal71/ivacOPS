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
</head>
<body>
<div style='width:600px; margin: 0 auto;'>
	<button style="float: right; margin-left:10px; padding: 5px 20px" onClick="exportExcel()">Export</button>
    <button style="float: right; padding: 5px 20px" onClick="printDiv()">Print</button>
</div>
<br><br>
<div id="report" style='width:600px; margin: 0 auto'>
<h3 style="text-align: center; margin: 5px;">Center Performance</h3>
<h4 style="text-align: center; margin: 5px;">EXPENSE REPORT</h4>
<br>
<!-- Table div start -->
<div style='margin: 0 auto; width: 600px;'>
	<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black">Center Name: 
<!-- <?php
$sql_center = "SELECT `center_name` FROM `centers` WHERE `center_id` = $_POST[center_id] ";
$result_center= mysqli_query($conn, $sql_center);
if(mysqli_num_rows($result_center)){
	while($row_center = mysqli_fetch_array($result_center))
	{
		echo $row_center['center_name'];
	}
} 
?> -->
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black"><!-- <?php echo $_POST['year_month'] ?> --></a>
</p>

<table style="width: 600px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Date</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Expense Amount(TK)</th>
	</tr>
	</thead>
	<tbody>
		<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">2018-09-27</td>
		<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">5000</td>
	</tbody>
	<tfoot>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Sub Total Expense</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">5000 tk</th>
	</tfoot>
</table>

<div style="width: 600px;margin-top: 10px">
	<div style="width: 300px;float: right;">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Expense</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">500.00TK</th>
	</tr>
	</thead>
</table>
</div>
</div>

</div>
<!-- Table div end -->

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
        var year_month='<?php echo $_POST['year_month']?>';
        var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/report_controller/center_summary_excel?center_id='+center_id+'&year_month='+year_month;

        window.open(url);
    }
</script>
</html>
