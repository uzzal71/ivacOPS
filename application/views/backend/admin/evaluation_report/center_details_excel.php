<?php
    $file="center_excel_" .$_GET['from_date'] ."_" .$_GET['to_date'] .".xls";
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

$performances = $this->db->get('performances')->result_array();
foreach($performances as $row):
	$r_per = $row['receive'];
	$d_per = $row['delivery'];
	$b_per = $row['backend'];
	$s_per = $row['scanning'];
endforeach;


 ?>

	<?php
		 
		$center_id = $_GET['center_id'];
		$from_date = $_GET['from_date'];
		$to_date = $_GET['to_date'];
		$sl = 0;

	if($center_id != '' && $from_date != '' && $to_date != '')
		{
			?>
		<table border="1" cellpadding="0" cellspacing="0">
		<tr>
		<th colspan="6">
			<span style="font-weight: bold; font-size: 18px">Employee Evaluation</span><br />
			<span style="font-weight: bold; font-size: 15px">Employee Score report</span><br />
			<span style="font-weight: bold; font-size: 15px"><?php echo $_GET['to_date'].' ' ?> To <?php echo $_GET['from_date'].' ' ?></span><br />
		</th>
		</tr>
		 <tr>
			<th>Employee</th>
			<th>Performance Score(Max Score - 80)</th>
			<th>Punchuality Score(Max 10)</th>
			<th>Customer Behaviour Score</th>
			<th>Final Score of The Staff(Max Score - 100)</th>
		</tr>
		<?php



			$sql_employee = "SELECT DISTINCT `employee_id` FROM `employee` WHERE `center_id` = $center_id ";
			$result_employee = mysqli_query($conn, $sql_employee);
			// :CODE :: 1000-100 IF - START
			if(mysqli_num_rows($result_employee))
			{

			while($row_employee = mysqli_fetch_array($result_employee))
			{// WHITE START : CODE 2001

			



			$sql_score = "SELECT * FROM `employee_score` WHERE `employee_id` = '$row_employee[employee_id]' AND  `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
			$result_score = mysqli_query($conn, $sql_score);
			// ****Check row is found****** 
			// CODE : 10001 IF - START
			if(mysqli_num_rows($result_score) > 0)
			{
				$receive=0;$delivery=0;$scanning=0;$backend=0;
				while($row_score = mysqli_fetch_array($result_score))
				{// WHITE START : CODE 2002
					$receive = $receive + $row_score['receive'];
					$delivery = $delivery + $row_score['delivery'];
					$scanning = $scanning + $row_score['scanning'];
					$backend = $backend + $row_score['backend'];
				}// WHITE END : CODE 2002

				$perform = ((($receive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;

				// echo $row_employee['employee_id'];
				// echo '<br>';
				// echo "Performance = ";
				// echo $perform;
				// echo '<br>';

				$sql_dehavior = "SELECT * FROM `behavior` WHERE `employee_id` = '$row_employee[employee_id]' AND `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
				$result_behabiour = mysqli_query($conn, $sql_dehavior);
				// CODE : 10002 IF - START
				if(mysqli_num_rows($result_behabiour) > 0)
				{
					$row_behavior = mysqli_fetch_array($result_behabiour);
					$punctuality = (($row_behavior['working_day'] - $row_behavior['late_day'])*10) / $row_behavior['working_day'];
					// echo $punctuality;
					// echo '<br>';
				}
				// CODE : 10002 IF - END
				else
				{
					$punctuality = 0;
				}
				//CODE : 10002 ELSE - END

			}
			//CODE: 10001 IF - END
			else
			{
				$receive=0;$delivery=0;$scanning=0;$backend=0;

				$perform = ((($receive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;
			}
			// CODE: 10001 ELSE - END

			if(isset($row_behavior['behavior']))
			{
				$behavior = $row_behavior['behavior'];
			}
			else{
				$behavior = 0;
			}

			if(isset($punctuality)) {
				$punctuality = $punctuality;
			}
			else {
				$punctuality = 0;
			}

			$final_score = $perform + $punctuality + $behavior;
			

			// TABLE CODE :: 30001 START TABLE
			?>


				<tr>
			    	<td rowspan="<?php echo $sl; ?>"><?php echo $row_employee['employee_id']; ?></td>
			    	<td>
			    		

			    		<table border="1">
			    			<tr>
			    				<td>
			    					<table border="1">
			    						<tr>
			    							<td>Receive</td>
			    						</tr>
			    						<tr>
			    							<td>Delivery</td>
			    						</tr>
			    						<tr>
			    							<td>Backend</td>
			    						</tr>
			    						<tr>
			    							<td>Scaning</td>
			    						</tr>
			    					</table>
			    				</td>
			    				<td>
			    					<?php
					                  $where_data = array('employee_id' => $row_employee['employee_id']);
					                  $employees = $this->db->get_where('employee', $where_data)->result_array();
					                  foreach($employees as $employee):
					                  	echo $employee['employee_name'];
					                  endforeach;
				                    ?>
			    				</td>
			    				<td style="border-bottom: 0px">
			    					<table border="">
			    						<tr>
			    							<td><?php echo $receive; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $delivery; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $backend; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $scanning; ?></td>
			    						</tr>
			    					</table>
			    				</td>
			    				<td>
			    					<table border="1">
			    						<tr>
			    							<td><?php echo $receive*$r_per; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $delivery*$d_per; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $backend*$b_per; ?></td>
			    						</tr>
			    						<tr>
			    							<td><?php echo $scanning*$s_per; ?></td>
			    						</tr>
			    					</table>
			    				</td>
			    				<td><?php echo $final_score; ?></td>
			    			</tr>
			    		</table>



			    	</td>
			    	<td>
			    		<table border="1">
			    			<tr>
			    				<td>Number of day delay > 10 mins</td>
			    				<td><?php echo $behavior; ?></td>
			    				<td><?php echo (int)$punctuality; ?></td>
			    			</tr>
			    		</table>
			    	</td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php echo $behavior; ?></td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php if($final_score){echo $final_score;}else{echo '0';} ?></td>
			    </tr>



			<?php
			// TABLE CODE :: 30001 END TABLE



			}// WHITE END : CODE 2001








			}// :CODE :: 1000-100 IF - END





		?>
		</table>
		<br>
		<br>
		<?php
		}
		
	 ?>





