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
</head>
<body>
<div style='width:1024px; margin: 0 auto;'>
	<button style="float: right; margin-left:10px; padding: 5px 20px" onClick="exportExcel()">Export</button>
    <button style="float: right; padding: 5px 20px" onClick="printDiv()">Print</button>
</div>
<br><br>
<div id="report" style='width:1024px; margin: 0 auto'>
<h3 style="text-align: center; margin: 5px;">Center Performance</h3>
<h4 style="text-align: center; margin: 5px;">INCOME REPORT</h4>
<br>
<!-- Table div start -->
<div style='margin: 0 auto; width: 1024px;'>
	<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black">Center Name: 
		<?php foreach($centers as $center_row){echo $center_row->center_name;}?>
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black"><?php echo ' FROM '. $from .' - TO '. $to; ?>
</p>

<table style="width: 1024px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Date</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Income Type</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Income Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Quantity</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Calculated Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Actual Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Remarks</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$calculated_amount = 0;
	$actual_amount = 0;
	for($from; $from <= $to;  $from = date ("Y-m-d", strtotime("+1 day", strtotime($from))))
	{
		$sql = "SELECT * FROM `tbl_daily_income_log` WHERE `center_id` = $center_id AND `date` = '$from' ";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$count++;
				$calculated_amount = $calculated_amount + $row['calculated_amount'];
				$actual_amount = $actual_amount + $row['actual_amount'];
			?>
			<tr>
				<?php
				if($count==1) {
				?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;" rowspan="<?php echo mysqli_num_rows($result); ?>"><?php echo $from ?></td>
				<?php
				} 
				 ?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php
				$where_data = array('income_id' => $row['income_id']);
				$income_type = $this->db->get_where('income_type', $where_data)->result_array();
				foreach($income_type as $income):
					echo $income['income_type'];
				endforeach; 
				 ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo $row['income_amount']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo $row['quantity']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo $row['calculated_amount']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo $row['actual_amount']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo $row['remarks']; ?></td>
			</tr>
			<?php
			}
		}
	//FOR LOOP END 
	} 


	?>	
	
	</tbody>
	<!-- <tfoot>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;" colspan="6">Sub Total Income</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">5000 tk</th>
	</tfoot> -->
</table>

<div style="width: 1024px;margin-top: 10px">
<div style="width: 300px;float: right;">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Actual Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($actual_amount)): echo $actual_amount; endif; ?>TK</th>
	</tr>
	</thead>
</table>
</div>
<div style="width: 300px;float: right;margin-right: 10px">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Calculated Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($calculated_amount)): echo $calculated_amount; endif; ?>TK</th>
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
	
	// function exportExcel() {
	// 	var center_id='<?php echo $_POST['center_id']?>';
 //        var year_month='<?php echo $_POST['year_month']?>';
 //        var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/report_controller/center_summary_excel?center_id='+center_id+'&year_month='+year_month;

 //        window.open(url);
 //    }
</script>
</html>
