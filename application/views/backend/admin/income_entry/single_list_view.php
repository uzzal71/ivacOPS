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
<div style='width:1020px; margin: 0 auto;'>
	<br>
    <button style="float: left; padding: 5px 20px;margin-left: 45%" onclick="printDiv2('printMe2')" class="btn btn-success">Print</button>
</div>
<br><br>

<div id='printMe2' style='width:1020px; margin: 0 auto'>

<h3 style="text-align: center; margin: 5px;">Center Performance</h3>
<h4 style="text-align: center; margin: 5px;">DAY INCOME LIST</h4>
<br>

<table style="width: 1020px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="8%">Date</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Income Type</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Unit</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="6%">Quantity</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="15%">Calculated Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Actual Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="35%">Remarks</th>
	</tr>
	</thead>
	<tbody>
	<?php

	$calculated_amount = 0;
	$actual_amount = 0;
	$sql = "SELECT * FROM `tbl_daily_income_log` WHERE `income_code` = '$income_code' ";
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
				<td style="border: 1px solid black; border-collapse: collapse;padding: 1px;text-align:left;" rowspan="<?php echo mysqli_num_rows($result); ?>"><?php echo $row['date'] ?></td>
				<?php
				} 
				 ?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php
				$where_data = array('income_id' => $row['income_id']);
				$income_type = $this->db->get_where('income_type', $where_data)->result_array();
				foreach($income_type as $income):
					echo $income['income_type'];
				endforeach; 
				 ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo number_format(round((float)$row['income_amount'],2),2); ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row['quantity']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo number_format(round((float)$row['calculated_amount'],2),2); ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo number_format(round((float)$row['actual_amount'],2),2); ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php echo $row['remarks']; ?></td>
			</tr>
			<?php
			}
		}


	?>	
	
	</tbody>
</table>

<div style="width: 1020px;margin-top: 10px">
<div style="width: 300px;float: right;">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Actual Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?>TK</th>
	</tr>
	</thead>
</table>
</div>
<div style="width: 300px;float: right;margin-right: 10px">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Calculated Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($calculated_amount)):echo number_format(round((float)$calculated_amount,2),2); endif; ?>TK</th>
	</tr>
	</thead>
</table>
</div>
</div>

</div>
<!-- Table div end -->




 
</div>



</body>
 
<!-- jQuery -->
<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js');?>"></script>
	<script>
		function printDiv2(divName){
		var divToPrint = document.getElementById(divName).innerHTML;
        var myWindow=window.open();
        myWindow.document.write(divToPrint);
        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
        myWindow.close();
		}
	</script>
</html>
