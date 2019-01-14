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
	<button style="float: right; margin-left:10px; padding: 5px 20px" onClick="exportExcel()">Export</button>
    <button style="float: right; padding: 5px 20px" onclick="printDiv2('printMe2')">Print</button>
</div>
<br><br>

<div id='printMe2' style='width:1020px; margin: 0 auto'>

<h3 style="text-align: center; margin: 5px;">Center Performance</h3>
<h4 style="text-align: center; margin: 5px;">EXPENSE REPORT</h4>
<br>
<!-- Table div start -->
<div style='margin: 0 auto; width: 1020px;'>
	<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black;">
		<span style="font-weight: bold;">Center Name: 
		<?php foreach($centers as $center_row){echo $center_row->center_name;}?></span>
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black;"><span style="font-weight: bold;"><?php if(isset($from) AND isset($to)){echo ' FROM '. $from .' - TO '. $to;} ?></span>
</p>

<table style="width: 1020px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="8%">Date</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Expense Type</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Unit</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="6%">Quantity</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="12%">Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" width="35%">Remarks</th>
	</tr>
	</thead>
	<tbody>
	<?php
	if(isset($from) AND isset($to)){
	$actual_amount = 0;
	for($from; $from <= $to;  $from = date ("Y-m-d", strtotime("+1 day", strtotime($from))))
	{
		$sql = "SELECT * FROM `tbl_daily_expense_log` WHERE `center_id` = $center_id AND `date` = '$from' ";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$count++;;
				$actual_amount = $actual_amount + $row['actual_amount'];
			?>
			<tr>
				<?php
				if($count==1) {
				?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 1px;text-align:left;" rowspan="<?php echo mysqli_num_rows($result); ?>"><?php echo $from ?></td>
				<?php
				} 
				 ?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php
				$where_data = array('expense_id' => $row['expense_id']);
				$expense_type = $this->db->get_where('expense_type', $where_data)->result_array();
				foreach($expense_type as $expense):
					echo $expense['expense_type'];
				endforeach; 
				 ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo number_format(round((float)$row['expense_amount'],2),2); ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row['quantity']; ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php echo number_format(round((float)$row['actual_amount'],2),2); ?></td>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php echo $row['remarks']; ?></td>
			</tr>
			<?php
			}
		}
	//FOR LOOP END 
	} 
}
else{
	echo "<h2>Data Not Found!</h2>";
}


	?>	
	
	</tbody>
</table>

<div style="width: 1020px;margin-top: 10px">
<div style="width: 300px;float: right;">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?>TK</th>
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
	
	//  ======  ######  For Export Excel ######  ======
	
	function exportExcel() {
		var center_id='<?php echo $_POST['center_id']?>';
        var from='<?php echo $_POST['from']?>';
        var to='<?php echo $_POST['to']?>';
        var url = 'http://166.62.16.132/ivacOPS/index.php/center_report_controller/expense_report_details_excel?center_id='+center_id+'&from='+from+'&to='+to;
        //var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/center_report_controller/expense_report_details_excel?center_id='+center_id+'&from='+from+'&to='+to;

        window.open(url);
    }
</script>
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
