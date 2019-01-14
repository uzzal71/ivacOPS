<?php
    $file="center_excel_" .$_GET['year_month'].".xls";
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
		$year_month = $_GET['year_month'];
		$sl = 0;

	if($center_id != '' && $year_month != '')
		{
			?>
		<table border="1" cellpadding="0" cellspacing="0">
		<tr>
		<th colspan="7">
			<span style="font-weight: bold; font-size: 18px">Employee Evaluation</span><br />
			<span style="font-weight: bold; font-size: 15px">Employee Score report</span><br />
			<span style="font-weight: bold; font-size: 15px"><?php echo $_GET['year_month'].' ' ?></span><br />
		</th>
		</tr>
		 <tr>
			<th>Serial</th>
			<th>Employee name</th>
			<th>Performance Score</th>
			<th>Punctuality Score</th>
			<th>Employee Behavior Score</th>
			<th>Final score</th>
		</tr>
		<?php




			$sql_employee = "SELECT DISTINCT `employee_id` FROM `employee` WHERE `center_id` = $center_id ";
			$result_employee = mysqli_query($conn, $sql_employee);
			// :CODE :: 1000-100 IF - START
			if(mysqli_num_rows($result_employee))
			{

			while($row_employee = mysqli_fetch_array($result_employee))
			{// WHITE START : CODE 2001

			



			$sql_score = "SELECT * FROM `employee_score` WHERE `employee_id` = '$row_employee[employee_id]' AND  `center_id` = $center_id AND DATE_FORMAT(CAST(`date` as DATE), '%Y-%m') = '$year_month' ";
			$result_score = mysqli_query($conn, $sql_score);
			// ****Check row is found****** 
			// CODE : 10001 IF - START
			if(mysqli_num_rows($result_score) > 0)
			{
				$recive=0;$delivery=0;$scanning=0;$backend=0;
				while($row_score = mysqli_fetch_array($result_score))
				{// WHITE START : CODE 2002
					$receive = $recive + $row_score['receive'];
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

				$sql_dehavior = "SELECT * FROM `behavior` WHERE `employee_id` = '$row_employee[employee_id]' AND `center_id` = $center_id AND DATE_FORMAT(CAST(`date` as DATE), '%Y-%m') = '$year_month' ";
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
			    	<td rowspan="<?php echo $sl;?>"><?php echo $sl; ?></td>
			    	<td>
			    	<?php
	                  $where_data = array('employee_id' => $row_employee['employee_id'], 'center_id' => $center_id);
	                  $employees = $this->db->get_where('employee', $where_data)->result_array();
	                  foreach($employees as $employee):
	                  	echo $employee['employee_name'];
	                  endforeach;
                    ?>
			    	</td>
			    	<td><?php echo $perform; ?></td>
			    	<td><?php echo $punctuality; ?></td>
			    	<td><?php echo $behavior; ?></td>
			    	<td><?php if($final_score){echo $final_score;}else{echo '0';} ?></td>>
			    </tr>



			<?php
			// TABLE CODE :: 30001 END TABLE

			$sl++;

			}// WHITE END : CODE 2001








			}// :CODE :: 1000-100 IF - END





		?>
		</table>
		<br>
		<br>
		<?php
		}
		
	 ?>





