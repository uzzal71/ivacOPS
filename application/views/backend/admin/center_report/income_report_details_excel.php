<?php
    $file="income_report_details_excel_" .date('F Y i:s').".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
	include APPPATH.'views/backend/admin/'.'manual_db_connect.php'; 
?>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th colspan="7">
			<span style="font-weight: bold; font-size: 18px">Ceter Performace</span><br />
			<span style="font-weight: bold; font-size: 15px">Expense Report</span><br />
			<span style="font-weight: bold; font-size: 15px">Center:
				<?php
					$sql_center = "SELECT `center_name` FROM `centers` WHERE `center_id` = $_GET[center_id] ";
					$result_center= mysqli_query($conn, $sql_center);
					if(mysqli_num_rows($result_center)){
						while($row_center = mysqli_fetch_array($result_center))
						{
							echo $row_center['center_name'];
						}
					} 
					?>
			</span><br />
			<span style="font-weight: bold; font-size: 15px">From: <?php echo $_GET['from'].' ' ?> To: <?php echo $_GET['to'].' ' ?></span><br />
		</th>
	</tr>
	 <tr>
		<th>Date</th>
		<th>Income Type</th>
		<th>Unit</th>
		<th>Quantity</th>
		<th>Calculated Amount</th>
		<th>Actual Amount</th>
		<th>Remarks</th>
	</tr>

	<?php
	$from = $_GET['from'];
	$to = $_GET['to'];
	$center_id = $_GET['center_id'];
	if(isset($from) AND isset($to)){
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
				<td rowspan="<?php echo mysqli_num_rows($result); ?>"><?php echo $from ?></td>
				<?php
				} 
				 ?>
				<td><?php
				$where_data = array('income_id' => $row['income_id']);
				$income_type = $this->db->get_where('income_type', $where_data)->result_array();
				foreach($income_type as $income):
					echo $income['income_type'];
				endforeach; 
				 ?></td>
				<td><?php echo number_format(round((float)$row['income_amount'],2),2); ?></td>
				<td><?php echo $row['quantity']; ?></td>
				<td><?php echo number_format(round((float)$row['calculated_amount'],2),2); ?></td>
				<td><?php echo number_format(round((float)$row['actual_amount'],2),2); ?></td>
				<td><?php echo $row['remarks']; ?></td>
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

</table>

<table>
	 <tr>
		<th>Total Actual Amount</th>
		<th><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?>TK</th>
	</tr>
</table>

<table>
	 <tr>
		<th>Total Calculated Amount</th>
		<th><?php if(isset($calculated_amount)):echo number_format(round((float)$calculated_amount,2),2); endif; ?>TK</th>
	</tr>
</table>

