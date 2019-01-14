<?php
    $file="employee_performance_excel_" .$_GET['from_date'] ."_" .$_GET['to_date'] .".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
?>
<!-- ======================== -->
<!-- ======================== -->
<!-- ======================== -->
<!-- ======================== -->
<?php
 //require 'connection.php';
include APPPATH.'views/backend/admin/'.'manual_db_connect.php';
 ?>


	<?php
		 
		$employee_id = $_GET['employee_id'];
		$from_date = $_GET['from_date'];
		$to_date = $_GET['to_date'];
		$center_id = $_GET['center_id'];
		$sl = 0;

		?>
		<table border="1" cellpadding="0" cellspacing="0" style="width: 620px">
		<tr>
		<th colspan="6">
			<span style="font-weight: bold; font-size: 18px">Employee Evaluation</span><br />
			<span style="font-weight: bold; font-size: 15px">Employee Score report</span><br />
			<span style="font-weight: bold; font-size: 15px"><?php echo $_GET['to_date'].' ' ?> To <?php echo $_GET['from_date'].' ' ?></span><br />
		</th>
		</tr>
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
		<?php
		
	 ?>





