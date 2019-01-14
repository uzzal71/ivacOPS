<?php
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
<h4 style="text-align: center; margin: 5px;">YEARLY BALANCE SHEET</h4>
<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black">Center Name: 
	<?php foreach($centers as $center_row){echo $center_row->center_name;}?></span>
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black">
		<?php if(isset($_POST['year'])){echo $_POST['year'];} ?>
			
		</a>
</p>
<br>
<br>
<!-- Table div start -->
<div style='margin: 0 auto; width: 1020px;'>
<div style="width: 500px;float: left;">
<table style="width: 500px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Month</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Income Amount(Monthly) TK</th>
	</tr>
	</thead>
	<tbody>
		<?php
		if(isset($year) AND isset($center_id)){
		$sub_total_income = 0;
		for ($m=1; $m<=12; $m++) {
	     $month = date('m', mktime(0,0,0,$m));
	     $month_name = date('F', mktime(0,0,0,$m));
	     $year_month =  $year.'-'.$month;
	     $sql_income = "SELECT * FROM `tbl_daily_income_log` WHERE `center_id` = $center_id AND DATE_FORMAT(`date`, '%Y-%m') = '$year_month' ";
	     $result_income = mysqli_query($conn, $sql_income);
		$count = 0;
		$actual_amount = 0;
		if(mysqli_num_rows($result_income) > 0)
		{
			while($row_income = mysqli_fetch_array($result_income))
			{
				$count++;;
				$actual_amount = $actual_amount + $row_income['actual_amount'];
			}
			// -----------------
			?>
			<tr>
				<?php
				if($count>1) {
				?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php echo $month_name; ?></td>
				<?php
				} 
				 ?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?></td>
			</tr>
			<?php
			// ------------
		}
		$sub_total_income = $sub_total_income + $actual_amount;
		}
	}
	else{
		echo "<h2>Data Not Found!</h2>";
	}

 
		 ?>
	</tbody>
	<tfoot>
		<tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Sub Total Income</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($sub_total_income)):echo number_format(round((float)$sub_total_income,2),2); endif; ?> TK</th>
		</tr>
	</tfoot>
</table>
</div>
<div style="width: 500px;float: right;">
<table style="width: 500px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Month</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Expense Amount(Monthly) TK</th>
	</tr>
	</thead>
	<tbody>
		<?php
		if(isset($year) AND isset($center_id)){
		$sub_total_expense = 0;
		for ($m=1; $m<=12; $m++) {
	     $month = date('m', mktime(0,0,0,$m));
	     $month_name = date('F', mktime(0,0,0,$m));
	     $year_month =  $year.'-'.$month;
	     $sql_expense = "SELECT * FROM `tbl_daily_expense_log` WHERE `center_id` = $center_id AND DATE_FORMAT(`date`, '%Y-%m') = '$year_month' ";
	     $result_expense = mysqli_query($conn, $sql_expense);
		$count = 0;
		$actual_amount = 0;
		if(mysqli_num_rows($result_expense) > 0)
		{
			while($row_expense = mysqli_fetch_array($result_expense))
			{
				$count++;;
				$actual_amount = $actual_amount + $row_expense['actual_amount'];
			}
			// -----------------
			?>
			<tr>
				<?php
				if($count>1) {
				?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:left;"><?php echo $month_name; ?></td>
				<?php
				} 
				 ?>
				<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?></td>
			</tr>
			<?php
			// ------------
		}
		$sub_total_expense = $sub_total_expense + $actual_amount;
		}
	}
	else{
		echo "<h2>Data Not Found!</h2>";
	}

 
		 ?>
	</tbody>
	<tfoot>
		<tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Sub Total Expense</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($sub_total_expense)):echo number_format(round((float)$sub_total_expense,2),2); endif; ?> TK</th>
		</tr>
	</tfoot>
</table>
</div>
</div>
<!-- Table div end -->
<div style="width: 1020px;float: right;">
<div style="width: 300px;float: right;margin-top: 15px;">
<table style="width: 300px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;" width="40%">Balance</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;" width="60%">
			<?php
			if(isset($sub_total_income) AND isset($sub_total_expense)):
				$total =  $sub_total_income - $sub_total_expense;
				echo number_format(round((float)$total,2),2);
			endif;
			?>
			TK			
		</th>
	</tr>
	</thead>
</table>
</div>
</div



</body>

<script>
//  ======  ######  For Export Excel ######  ======
function exportExcel() {
	var center_id='<?php echo $_POST['center_id']?>';
        var year='<?php echo $_POST['year']?>';
        var url = 'http://166.62.16.132/ivacOPS/index.php/center_report_controller/income_report_details_excel?center_id='+center_id+'&year='+year;
       // var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/center_report_controller/yearly_balance_sheet_excel?center_id='+center_id+'&year='+year;

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
