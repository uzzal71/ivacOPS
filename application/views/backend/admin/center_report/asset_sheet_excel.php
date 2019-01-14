<?php
    $file="expense_report_Details_excel_" .date('F Y i:s').".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
	include APPPATH.'views/backend/admin/'.'manual_db_connect.php'; 
?>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th colspan="8">
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
			<span style="font-weight: bold; font-size: 15px">From: <?php echo $_GET['year'].' ' ?> </span><br />
		</th>
	</tr>
	 <tr>
		<th>Purchase Date</th>
		<th>Asset Name</th>
		<th>Asset Type</th>
		<th>Purchase Value</th>
		<th>Quantity</th>
		<th>Amount(TK)</th>
		<th>Depreciation Rate(%)</th>
		<th>Present Value(TK)</th>
	</tr>

		<?php
		$year = $_GET['year'];
		$center_id = $_GET['center_id'];
		if(isset($year) AND isset($center_id)){

		$sql_asset = "SELECT * FROM `tbl_asset_register_log` WHERE `center_id` = $center_id ";
	    $result_asset = mysqli_query($conn, $sql_asset);
		$count = 0;
		if(mysqli_num_rows($result_asset) > 0)
		{
			$total_preset_value = 0;
			while($row_asset = mysqli_fetch_array($result_asset))
			{
			$present_value = $row_asset['asset_amount'];
			$get_year = date('Y', strtotime($row_asset['date']));
			$count_year = $year - $get_year;
			if($count_year == 0 OR $year < $get_year) {
				$present_value = $row_asset['asset_amount'];
			}
			else{
				if($row_asset['asset_id'] == 1){
					for($i=1;$i<=$count_year;$i++){
						$present_value = $present_value -(($row_asset['depreciation_rate'] / 100)*$present_value);
					}
				}
				else if($row_asset['asset_id'] == 2){
					$present_value = $present_value -((($row_asset['depreciation_rate'] *$count_year) / 100)*$present_value);
				}
			}
			?>
			<tr>
				<td><?php echo $row_asset['date']; ?></td>
				<td><?php echo $row_asset['asset_name']; ?></td>
				<td><?php
				if($row_asset['asset_id'] == 1) {echo "Written Down";}
				else{echo "Straight Line";}
				?></td>
				<td><?php echo number_format(round((float)$row_asset['purchase_value'],2),2); ?></td>
				<td><?php echo $row_asset['quantity']; ?></td>
				<td><?php echo number_format(round((float)$row_asset['asset_amount'],2),2); ?></td>
				<td><?php echo $row_asset['depreciation_rate']; ?>%</td>
				<td><?php if(isset($present_value)){echo number_format(round((float)$present_value,2),2);} ?></td>
			</tr>
			<?php
			$total_preset_value = $total_preset_value + $present_value;
			}
		}

		}
		else{
			echo "<h2>Data Not Found!</h2>";
		} 

		 ?>		 
</table>

<table>
 <tr>
	<th>Total Amount</th>
	<th><?php if(isset($total_preset_value)){echo number_format(round((float)$total_preset_value,2),2);} ?>TK</th>
</tr>
</table>

