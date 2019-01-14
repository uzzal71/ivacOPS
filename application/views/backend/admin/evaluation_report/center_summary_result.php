<?php

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
<h4 style="text-align: center; margin: 5px;">Center Summary Report</h4>
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
	<a style="float: right; margin: 5px;text-decoration: none;color: black"><?php echo $_POST['year_month'] ?></a>
</p>
<br>
<div style='margin: 0 auto; width: 1020px;'>

<?php 

	$center_id = $_POST['center_id'];
	$year_month = date('Y-m',strtotime($_POST['year_month']));
	$sl = 1;


	if($center_id != '' && $year_month != '')
	{

			?>
		<table style="width: 1020px; border: 1px solid black; border-collapse: collapse;">
		<thead>
		 <tr>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Serial</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Employee ID</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Employee name</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Performance Score</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Punctuality Score</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Employee Behavior Score</th>
			<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;">Final score</th>
		</tr>
		</thead>
		<?php

			$sql_employee = "SELECT DISTINCT `employee_id` FROM `employee` WHERE `center_id` = $_POST[center_id] ";
			$result_employee = mysqli_query($conn, $sql_employee);
			
			if(mysqli_num_rows($result_employee))
			{

			while($row_employee = mysqli_fetch_array($result_employee))
			{
			

			$sql_score = "SELECT * FROM `employee_score` WHERE `employee_id` = '$row_employee[employee_id]' AND  `center_id` = $_POST[center_id] AND DATE_FORMAT(CAST(`date` as DATE), '%Y-%m') = '$year_month' ";

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


				$sql_dehavior = "SELECT * FROM `behavior` WHERE `employee_id` = '$row_employee[employee_id]' AND `center_id` = $_POST[center_id] AND DATE_FORMAT(CAST(`date` as DATE), '%Y-%m') = '$year_month' ";

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
			}
			

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

			?>


				 <tr>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php echo $sl++; ?></td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;">
			    		<?php echo $row_employee['employee_id']; ?>
			    	</td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;">
			    	<?php
	                  $where_data = array('employee_id' => $row_employee['employee_id'], 'center_id' => $_POST['center_id'] );
	                  $employees = $this->db->get_where('employee', $where_data)->result_array();
	                  foreach($employees as $employee):
	                  	echo $employee['employee_name'];
	                  endforeach;
                    ?>
			    	</td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php echo round($perform, 2); ?></td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php echo round($punctuality, 2); ?></td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php echo $behavior; ?></td>
			    	<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;"><?php if($final_score){echo round($final_score, 2);}else{echo '0';} ?></td>
			    </tr>

			<?php


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
        var year_month='<?php echo $_POST['year_month']?>';
        var url = 'http://localhost:8080/software/ivacOPS/index.php/report_controller/center_summary_excel?center_id='+center_id+'&year_month='+year_month;

        window.open(url);
    }
</script>
</html>
