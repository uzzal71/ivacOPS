<?php
 //require 'connection.php'
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
	<table border="1" style="width: 1020px;padding: 10px;text-align: center;">
		<thead>
		 <tr>
		<th style="border-bottom: 1px solid white">Serial</th>
		<th width="" style="border-bottom: 1px solid white">Employee Name</th>
		<th colspan="4" width="30%">Performance Score(Max Score - 80)</th>
		<th colspan="2" width="30%">Punchuality Score(Max 10)</th>
		<th width="10%" style="border-bottom: 1px solid white">Customer Behaviour Score(Max 10)</th>
		<th width="10%" style="border-bottom: 1px solid white">Final Score of The Staff(Max Score - 100</th>
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
			{		


			$sql_score = "SELECT * FROM `employee_score` WHERE `employee_id` = '$row_employee[employee_id]' AND  `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
			$result_score = mysqli_query($conn, $sql_score);

			if(mysqli_num_rows($result_score) > 0)
			{
				$receive=0;$delivery=0;$scanning=0;$backend=0;
				while($row_score = mysqli_fetch_array($result_score))
				{
					$receive = $receive + $row_score['receive'];
					$delivery = $delivery + $row_score['delivery'];
					$scanning = $scanning + $row_score['scanning'];
					$backend = $backend + $row_score['backend'];
				}

				$perform = ((($receive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;

				$sql_dehavior = "SELECT * FROM `behavior` WHERE `employee_id` = '$row_employee[employee_id]' AND `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
				$result_behabiour = mysqli_query($conn, $sql_dehavior);
				if(mysqli_num_rows($result_behabiour) > 0)
				{
					$row_behavior = mysqli_fetch_array($result_behabiour);
					$punctuality = (($row_behavior['working_day'] - $row_behavior['late_day'])*10) / $row_behavior['working_day'];
				}
				else
				{
					$punctuality = 0;
				}

			}
			else
			{
				$receive=0;$delivery=0;$scanning=0;$backend=0;

				$perform = ((($receive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000;
				$sql_dehavior = "SELECT * FROM `behavior` WHERE `employee_id` = '$row_employee[employee_id]' AND  `center_id` = $center_id AND `date` BETWEEN '$from_date' AND '$to_date' ";
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
			if(isset($row_behavior['behavior']))
			{
				$behavior = $row_behavior['behavior'];
			}
			else{
				$behavior = 0;
			}

			$final_score = $perform + $punctuality + $behavior;

			?>
				<?php
				if($config == 0) 
				{
				?>
				<tr>
					<td></td>
					<th></th>
					<th style="font-size: 11px">Type</th>
					<th style="font-size: 11px">No.of files</th>
					<th style="font-size: 11px">Score</th>
					<th width="10%" style="font-size: 11px">Total</th>
					<th width="15%" style="font-size: 11px">No.of day delay > 10 mins</th>
					<th width="15%" style="font-size: 11px">Score</th>
					<th></th>
					<th></th>
				</tr>
				<?php
				} 
				 ?>
				<tr>
					<td rowspan="4"><?php echo $sl++;?></td>
					<th rowspan="4">
					<!-- Employee Name -->
					<a target="_blank" style="color:#000;" href="<?php echo site_url('report_controller/employee_performance_details/' . $row_employee['employee_id'] .'/'.$_POST['from_date']. '/' . $_POST['to_date']);?>">
    					<?php
	                  $where_data = array('employee_id' => $row_employee['employee_id']);
	                  $employees = $this->db->get_where('employee', $where_data)->result_array();
	                  foreach($employees as $employee):
	                  	echo $employee['employee_name'];
	                  endforeach;
                    ?>
                    </a>
					<!-- Employee Name -->
					</th>
					<th>Receive</th>
					<td><?php echo $receive; ?></td>
					<td><?php echo $receive*$r_per; ?></td>
					<td rowspan="4">
						<?php echo round(((($receive*$r_per) + ($delivery*$d_per) + ($scanning*$s_per) + ($backend*$b_per))*80)/15000, 2); ?>
					</td>
					<td rowspan="4">
					<!-- Late Day -->
					<?php if(isset($row_behavior['late_day'])){
		    			echo $row_behavior['late_day'];
		    		}else{
		    			echo "0";
		    		}
		    		?>
					<!-- Late Day -->
					</td>
					<td rowspan="4"><?php echo round($punctuality, 2); ?></td>
					<th rowspan="4">
					<!-- Behavior Score -->
					<?php echo $behavior; ?>
					<!-- Behavior Score -->
					</th>
					<th rowspan="4">
					<!-- Final Score -->
					<?php if($final_score){echo round($final_score, 2);}else{echo '0';} ?>
					<!-- Final Score -->
					</th>
				</tr>
				<tr>
					<th>Delivery</th>
					<td><?php echo $delivery; ?></td>
					<td><?php echo $delivery*$d_per; ?></td>

				</tr>
				<tr>
					<th>Backend</th>
					<td><?php echo $backend; ?></td>
					<td><?php echo $backend*$b_per; ?></td>

				</tr>
				<tr>
					<th>Scanning</th>
					<td><?php echo $scanning; ?></td>
					<td><?php echo $scanning*$s_per; ?></td>
				</tr>

			<?php

			$config = 1;

			}

			} 
			else
			{
				?>
				<div class="alert alert-success alert-dismissible fade in">
			      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			      <strong>Success!</strong> Data not found!
			    </div>
				<?php
			}
			?>
		 <tbody>
		</table>
		<br>
		<br>
		<?php
		}
		else
		{
		?>
		<div class="alert alert-success alert-dismissible fade in">
	      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <strong>Success!</strong> Data not found!
	    </div>
		<?php
		}
	 ?>
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
        var url = 'http://166.62.16.132/ivacOPS/index.php/report_controller/center_details_excel?center_id='+center_id+'&from_date='+from_date+'&to_date='+to_date;
        //var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/report_controller/center_details_excel?center_id='+center_id+'&from_date='+from_date+'&to_date='+to_date;

        window.open(url);
    }
</script>
</html>

<style type="text/css">
	table tr th{
		text-align: center;
	}
</style>
