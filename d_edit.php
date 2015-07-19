<!DOCTYPE html>
<html>
<head>
	<!-- This is for loading external scripts -->
	<title>
		<?php
		session_start();
		if(!isset($_SESSION['name1']))
		{
			header("Location: index.php");
		}
		echo "Welcome ".$_SESSION['name1'];
		?>
	</title>


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>


<body>
	<div class = "container" >
		<table name="table" id="table" class ="table">
		</br>
		<tr><th>#</th><th>PACKAGE</th><th>START_DATE</th><th>END_DATE</th><th>DAYS_REMAINING</th>
			<th>AMOUNT</th><th>PAID</th><th>REMAINING</th></tr>

			<?php 
			require_once ('db/db_config.php');

			date_default_timezone_set("Asia/Kolkata");
			$today = date_create(date("Y-m-d"));

			$member_id=$_GET['member_id'];

			$sql=mysqli_query($connection,"SELECT *,DATEDIFF(d.end_date,current_date) as days_left FROM diet_package d join packages p on d.package_id=p.package_id where d.member_id=$member_id order by d.end_date");
			$i=1;
			while($row=mysqli_fetch_array($sql))
			{	
				$p_name=$row['p_name'];
				$p_duration=$row['p_duration'];
				$start_date=$row['start_date'];
				$end_date=$row['end_date'];
				$p_amount=$row['p_amount'];
				$paid=$row['paid'];
				$days_left=$row['days_left'];	
				if ($days_left<0) {
					$days_left=0;
				}


				$amount_left=$p_amount-$paid;
				echo "<tr><td>$i</td>";
				$i++;
				echo "<td>$p_name</td>";
				echo "<td>$start_date</td>";
				echo "<td>$end_date</td>";
				echo "<td>$days_left</td>";

				echo "<td>$p_amount</td>";
				echo "<td>$paid</td>";
				echo "<td>$amount_left</td>";
				echo "<td></td>";

			}
			?>

		</table>
		<form class="form-horizontal" method="post" id="package_form" 
		action="inserter2.php?member_id=<?php echo $_GET['member_id'];?>&package=diet&redirect=no">
		<br>
		<br>
		<br>

		<div class="form-group">
	
				<label for="b_package" class="col-sm-2 control-label">Add amount</label>
				<div class="col-sm-2">
					<input type="number" class="form-control" name="pending_amount" placeholder="Add Amount" >
				</div>
			</div>
			<br>

			<div class="form-group">
				<label for="b_package" class="col-sm-2 control-label">Diet Package</label>
				<div class="col-sm-2">
					<select name="d_package" id="d_package" class="form-control" data-style="btn-primary">
						<option selected="selected" value="NULL">--Select Package--</option>
						<?php

						$sql1=mysqli_query($connection,"select * from packages where p_name like 'D_%'");
						while($row1=mysqli_fetch_array($sql1))
						{
							$package_id=$row1['package_id'];
							$p_name=$row1['p_name'];
							$p_amount=$row1['p_amount'];
							//$p_duration=$row1['p_duration'];
							//$p_wef=$row1['p_wef'];
							$p_status=$row1['p_status'];

							if ($p_status=='ACTIVE')
							{
								print "<option value='$package_id'>$p_name   [$p_amount]</option>";
							}
						}

						?>
					</select>
				</div>
				<div class="col-sm-2">
					<input type="number" class="form-control" name="d_amount" placeholder="Amount Paid" >
				</div>
				<div class="col-sm-2">
					<input type="text" id="d_date" name="d_date" class="form-control" placeholder="Start Date">
				</div>
				
			</div>
			<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" id="btn-submit" class="btn btn-primary">UPDATE</button>
						</div>
					</div>

	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script>
		$(function() {


			$('#d_date').datepicker();

		});
		</script>
	</body>
	</html>