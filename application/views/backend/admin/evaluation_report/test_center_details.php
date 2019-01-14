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
<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black">Center Name: 
<?php
$sql_center = "SELECT `center_name` FROM `centers` WHERE `center_id` = $_POST[center_id] ";
$result_center= mysqli_query($conn, $sql_center);
if(mysqli_num_rows($result_center)){
	while($row_center = mysqli_fetch_array($result_center))
	{
		echo $row_center['center_name'];
	}
} 
?>
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black"><?php echo $_POST['from_date'].' ' ?> To <?php echo $_POST['to_date'].' ' ?></a>
</p>
<br>
<div style='margin: 0 auto; width: 1020px;'>
<?php
	 
	$center_id = $_POST['center_id'];
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$sl = 1;

	// CODE : 10000
	if($center_id != '' && $from_date != '' && $to_date != '')
		{
			?>
		<table style="width: 1020px; border: 1px solid black; border-collapse: collapse;">
		<thead>
		 <tr>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Serial</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Name</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" colspan="4">Performance Score(Max Score - 80)</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;" colspan="2">Punchuality Score(Max 10)</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Customer Behaviour Score(Max 10)</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Final Score of The Staff(Max Score - 100)</th>
		</tr>
		</thead>
		<?php

			$config = 0;

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
				$recive=0;$delivery=0;$scanning=0;$backend=0;
				while($row_score = mysqli_fetch_array($result_score))
				{// WHITE START : CODE 2002
					$recive = $recive + $row_score['recive'];
					$delivery = $delivery + $row_score['delivery'];
					$scanning = $scanning + $row_score['scanning'];
					$backend = $backend + $row_score['backend'];
				}// WHITE END : CODE 2002

				$perform = ((($recive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;

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
					$working_day = 0;
					$late_day = 0;
					$punctuality = (($working_day - $late_day)*10) / $working_day;
				}
				//CODE : 10002 ELSE - END

			}
			//CODE: 10001 IF - END
			else
			{
				$recive=0;$delivery=0;$scanning=0;$backend=0;

				$perform = ((($recive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;
				$sql_dehavior = "SELECT * FROM `behavior` WHERE `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
				$result_behabiour = mysqli_query($conn, $sql_dehavior);
				if(mysqli_num_rows($result_behabiour) > 0)
				{
					$row_behavior = mysqli_fetch_array($result_behabiour);
					$punctuality = (($row_behavior['working_day'] - $row_behavior['late_day'])*10) / $row_behavior['working_day'];
				}
				else
				{
					$working_day = 0;
					$late_day = 0;
					$punctuality = 0;
				}
			}
			// CODE: 10001 ELSE - END
			if(isset($row_behavior['behavior']))
			{
				$behavior = $row_behavior['behavior'];
			}
			else{
				$behavior = 0;
			}

			$final_score = $perform + $punctuality + $behavior;

			// TABLE CODE :: 30001 START TABLE
			?>


				 <tr style="border-bottom: 1px solid black;">
			    	<td style="border-bottom: 1px solid black; border-collapse: collapse;padding: 2px;width: 50px">
			    		<table width="100%" style="margin-top: 0px">
			    			<?php
			    			if($config == 0)
			    			{
			    				?>
			    				<tr style="height: 38px">
			    				<td>&nbsp;</td>
			    			</tr>
			    				<?php
			    			} 
			    			 ?>
			    			<tr style="height: 91px">
			    				<td style="border-top: 1px solid black">
			    					<?php
	                  					echo $sl++;
                    				?>
			    				</td>
			    			</tr>

			    		</table>
			    	</td>
			    	<td width="180px" style="border: 1px solid black;text-align: center;">
			    		<table width="100%" style="margin-top: 0px">
			    			<?php
			    			if($config == 0)
			    			{
			    				?>
			    				<tr style="height: 38px">
			    				<td>&nbsp;</td>
			    			</tr>
			    				<?php
			    			} 
			    			 ?>
			    			<tr style="height: 91px">
			    				<td style="border-top: 1px solid black">
			    					<a target="_blank" href="<?php echo site_url('report_controller/employee_performance_details/' . $row_employee['employee_id'] .'/'.$_POST['from_date']. '/' . $_POST['to_date']);?>">
			    					<?php
				                  $where_data = array('employee_id' => $row_employee['employee_id']);
				                  $employees = $this->db->get_where('employee', $where_data)->result_array();
				                  foreach($employees as $employee):
				                  	echo $employee['employee_name'];
				                  endforeach;
			                    ?>
			                    </a>
			    				</td>
			    			</tr>

			    		</table>
			    	</td>
			    	<td style="border: 1px solid black;text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="100px" cellspacing="0" cellpadding="10px">
			    			<?php 
			    			if($config == 0)
			    			{
			    				?>
			    			<tr>
			    				<th style="height: 38px">&nbsp;</th>
			    			</tr>
			    				<?php
			    			}
			    			 ?>
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
			    	<td width="100px" style="border: 1px solid black;text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="100px" cellspacing="0" cellpadding="10px">
			    			<?php 
			    			if($config == 0)
			    			{
			    			 ?>
			    			 <tr>
			    				<th style="height: 38px">No.of files</th>
			    			</tr>
			    			 <?php
			    			}
			    			?>
			    			<tr>
    							<td><?php echo $recive; ?></td>
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
			    	<td width="100px" style="border: 1px solid black;text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="100px" cellspacing="0" cellpadding="10px">
			    			<?php 
			    			if($config == 0) 
			    			{
			    			 ?>
			    			 <tr>
			    				<th style="height: 38px">Score</th>
			    			</tr>
			    			<?php
			    			}
			    			?>
			    			<tr>
    							<td><?php echo $recive*$r_per; ?></td>
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
			    	<td width="130px" style="text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="130px" style="margin-top: -36px" cellspacing="0" cellpadding="10px">
			    			<?php 
			    			if($config == 0)
			    			{?>
			    				<th style="padding: 10px">Total Score</th>
			    			</tr> 
			    			<?php   						
			    			}
			    			?>
			    		</table>
			    		<br>
    					<p style="text-align: center;"><?php echo round($perform, 2); ?></p>
			    	</td>
			    	
			    	<td width="120px" style="border: 1px solid black;text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="120px" style="margin-top: -47px">
			    		<?php 
			    		if($config == 0)
			    		{
			    		?>
			    		<tr>
			    				<th style="padding: 0px">No.of day delay > 10 mins</th>
			    			</tr>
			    		<?php
			    		}
			    		?>
			    		</table>
			    		<br>
			    		<?php if(isset($row_behavior['late_day'])){
			    			echo $row_behavior['late_day'];
			    		}else{
			    			echo "0";
			    		}
			    		?>
			    	</td>
			    	<td width="120px" style="border: 1px solid black;text-align: center;">
			    		<table border="1" bordercolor="#bdc3c7" width="120px" style="margin-top: -47px" cellspacing="0" cellpadding="10px">
			    			<?php 
			    		if($config == 0)
			    		{
			    		?>
			    		<tr>
			    				<th style="padding: 9px">Score</th>
			    			</tr>
			    		<?php
			    		}
			    		?>
			    		</table>
			    		<br>
			    		<?php echo round($punctuality, 2); ?>
			    	</td>
	
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;">
			    		<table width="100%" style="margin-top: 0px">
			    			<?php
			    			if($config == 0)
			    			{
			    				?>
			    				<tr style="height: 38px">
			    				<td>&nbsp;</td>
			    			</tr>
			    				<?php
			    			} 
			    			 ?>
			    			<tr style="height: 91px">
			    				<td style="border-top: 1px solid black">
			    					<?php echo $behavior; ?>
			    				</td>
			    			</tr>

			    		</table>
			    	</td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;">
			    		<table width="100%" style="margin-top: 0px">
			    			<?php
			    			if($config == 0)
			    			{
			    				?>
			    				<tr style="height: 38px">
			    				<td>&nbsp;</td>
			    			</tr>
			    				<?php
			    			} 
			    			 ?>
			    			<tr style="height: 91px">
			    				<td style="border-top: 1px solid black">
			    					<?php if($final_score){echo round($final_score, 2);}else{echo '0';} ?>
			    				</td>
			    			</tr>

			    		</table>
			    			
			    		</td>
			    </tr>



			<?php
			// TABLE CODE :: 30001 END TABLE

			$config = 1;

			}// WHITE END : CODE 2001








			}// :CODE :: 1000-100 IF - END 
			else
			{
				?>
				<div class="alert alert-success alert-dismissible fade in">
			      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <strong>Success!</strong> Data not found!
			    </div>
				<?php
			}// :CODE :: 1000-100 ELSE - END
			?>
		 <tbody>
		</table>
		<br>
		<br>
		<?php
		}// CODE : 10000 IF END
		else// ELSE START 10000
		{
		?>
		<div class="alert alert-success alert-dismissible fade in">
	      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <strong>Success!</strong> Data not found!
	    </div>
		<?php
		}// CODE : 10000 END ELSE
	 ?>
<!-- 	</tbody>
</table> -->
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
        //var url = '166.62.16.132/ivacOPS/index.php/report_controller/center_details_excel?center_id='+center_id+'&from_date='+from_date+'&to_date='+to_date;
        var url = 'http://localhost:8080/software/ivacOPS/index.php/report_controller/center_details_excel?center_id='+center_id+'&from_date='+from_date+'&to_date='+to_date;

        window.open(url);
    }
</script>
</html>
