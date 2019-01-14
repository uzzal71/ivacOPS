<?php
    $file="yearly_balance_sheet_excel_" .date('F Y i:s').".xls";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
	include APPPATH.'views/backend/admin/'.'manual_db_connect.php'; 
?>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th colspan="4">
			<span style="font-weight: bold; font-size: 18px">Ceter Performace</span><br />
			<span style="font-weight: bold; font-size: 15px">YEARLY BALANCE SHEET</span><br />
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
			<span style="font-weight: bold; font-size: 15px">Year: <?php echo $_GET['year'].' ' ?></span><br />
		</th>
	</tr>
	 <tr>
		<th>Month</th>
		<th>Income Amount(Monthly) TK</th>
		<th>Month</th>
		<th>Expense Amount(Monthly) TK</th>
	</tr>

		<?php
		$year = $_GET['year'];
		$center_id = $_GET['center_id'];
		if(isset($year) AND isset($center_id)){
		$sub_total_income = 0;
		$sub_total_expense = 0;
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
				<td><?php echo $month_name; ?></td>
				<?php
				} 
				 ?>
				<td><?php if(isset($actual_amount)):echo number_format(round((float)$actual_amount,2),2); endif; ?></td>
			<?php
			// ------------
		}
		$sub_total_income = $sub_total_income + $actual_amount;
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
	}//Loop end
	}
	else{
		echo "<h2>Data Not Found!</h2>";
	}

 
		 ?>

	<tr>
		<th>Sub Total Income</th>
		<th><?php if(isset($sub_total_income)):echo number_format(round((float)$sub_total_income,2),2); endif; ?> TK</th>
		<th>Sub Total Expense</th>
		<th><?php if(isset($sub_total_expense)):echo number_format(round((float)$sub_total_expense,2),2); endif; ?> TK</th>
	</tr>
</table>


<table>
 <tr>
	<th>Balance</th>
	<th>
		<?php
		if(isset($sub_total_income) AND isset($sub_total_expense)):
			$total =  $sub_total_income - $sub_total_expense;
			echo number_format(round((float)$total,2),2);
		endif;
		?>
		TK			
	</th>
</tr>
</table>

