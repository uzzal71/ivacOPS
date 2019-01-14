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
<h4 style="text-align: center; margin: 5px;">ASSET REPORT</h4>
<br>
<!-- Table div start -->
<div style='margin: 0 auto; width: 1020px;'>
	<p style="display: inline;">
	<a style="text-align: left;text-decoration: none;color: black">Center Name: 
	<?php foreach($centers as $center_row){echo $center_row->center_name;}?></span>
	</a>
	<a style="float: right; margin: 5px;text-decoration: none;color: black">Year: <?php if(isset($_POST['year'])){echo $_POST['year'];}; ?></a>
</p>

<table style="width: 1020px; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Purchase Date</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Asset Name</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Asset Type</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Purchase Value</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Quantity</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Amount(TK)</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Depreciation Rate(%)</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;">Present Value(TK)</th>
	</tr>
	</thead>
	<tbody>
		<?php

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
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row_asset['date']; ?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row_asset['asset_name']; ?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php
			if($row_asset['asset_id'] == 1) {echo "Written Down";}
			else{echo "Straight Line";}
			?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo number_format(round((float)$row_asset['purchase_value'],2),2); ?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row_asset['quantity']; ?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo number_format(round((float)$row_asset['asset_amount'],2),2); ?></td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php echo $row_asset['depreciation_rate']; ?>%</td>
			<td style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:center;"><?php if(isset($present_value)){echo number_format(round((float)$present_value,2),2);} ?></td>
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
	
	</tbody>
</table>

<div style="width: 1020px;margin-top: 10px">
	<div style="width: 300px;float: right;">
<table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
	<thead>
	 <tr>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;">Total Amount</th>
		<th style="border: 1px solid black; border-collapse: collapse;padding: 2px;text-align:right;"><?php if(isset($total_preset_value)){echo number_format(round((float)$total_preset_value,2),2);} ?>TK</th>
	</tr>
	</thead>
</table>
</div>
</div>

</div>
<!-- Table div end -->

</div>
</body>

<script>	
//  ======  ######  For Export Excel ######  ======
function exportExcel() {
	var center_id='<?php echo $_POST['center_id']?>';
        var year='<?php echo $_POST['year']?>';
        var url = 'http://166.62.16.132/ivacOPS/index.php/center_report_controller/asset_sheet_excel?center_id='+center_id+'&year='+year;
        //var url = 'http://192.168.1.53:8080/software/ivacOPS/index.php/center_report_controller/asset_sheet_excel?center_id='+center_id+'&year='+year;

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
