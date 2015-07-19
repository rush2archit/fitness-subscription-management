<html>
<head>

	<title>
		<?php
		session_start();
		if(!isset($_SESSION['name1'])) {
			header("Location: index.php");
		}
		if ($_SESSION['access_level1']>2) {
			header( "Location: home.php");  
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
	<div class="container">
	</div>
	<form class="form-horizontal" method="post" id="package_form" action="inserter2.php?member_id=<?php echo $_GET['id'];?>">
	<br>
	<br>
	<br>
<!-- Basic package details -->
	<div class="form-group">
		<label for="b_package" class="col-sm-2 control-label">Basic Package</label>
		<div class="col-sm-3">
			<select name="b_package" id="b_package" class="form-control" data-style="btn-primary">
				<option selected="selected" value="NULL">--Select Package--</option>
				<?php
				require_once('db/db_config.php');

				date_default_timezone_set("Asia/Kolkata");
				$member_id = $_GET['id'];

				$sql1 = mysqli_query($connection, "select * from packages where p_name like 'B_%'");
				while ($row1 = mysqli_fetch_array($sql1)) {
					$package_id = $row1['package_id'];
					$p_name     = $row1['p_name'];
					$p_amount   = $row1['p_amount'];
					$p_duration = $row1['p_duration'];
					$p_wef      = $row1['p_wef'];
					$p_status   = $row1['p_status'];

					if ($p_status == 'ACTIVE') {
						print "<option value='$package_id'>$p_name   [$p_amount]</option>";
					}
				}

				?>
			</select>
		</div>
		<div class="col-sm-2">
			<input type="number" class="form-control" name="b_amount" placeholder="Amount Paid" >
		</div>
		<div class="col-sm-2">
			<input type="text" id="b_date" name="b_date" class="form-control" placeholder="Start Date">
		</div>
	</div>


<!-- Training package details -->
	<div class="form-group">
		<label for="t_package" class="col-sm-2 control-label">Training Package</label>
		<div class="col-sm-3">
			<select name="t_package" id="t_package" class="form-control" data-style="btn-primary">
				<option selected="selected" value="NULL">--Select Package--</option>
				<?php

				$sql2 = mysqli_query($connection, "select * from packages where p_name like '%PRIME_%'");
				while ($row2 = mysqli_fetch_array($sql2)) {
					$package_id1 = $row2['package_id'];
					$p_name1     = $row2['p_name'];
					$p_amount1   = $row2['p_amount'];
					$p_duration1 = $row2['p_duration'];
					$p_wef1      = $row2['p_wef'];
					$p_status1   = $row2['p_status'];

					if ($p_status1 == 'ACTIVE') {
						print "<option value='$package_id1'>$p_name1   [$p_amount1]</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="col-sm-2">
			<input type="number" class="form-control" name="t_amount" placeholder="Amount Paid" >
		</div>
		<div class="col-sm-2">
			<input type="text" id="t_date" name="t_date" class="form-control" placeholder="Start Date">
		</div>
	</div>


<!-- Diet package details -->
	<div class="form-group">
		<label for="d_package" class="col-sm-2 control-label">Diet Package</label>
		<div class="col-sm-3">
			<select name="d_package" id="d_package" class="form-control" data-style="btn-primary">
				<option selected="selected" value="NULL">--Select Package--</option>
				<?php

				$sql2 = mysqli_query($connection, "select * from packages where p_name like 'D_%'");
				while ($row2 = mysqli_fetch_array($sql2)) {
					$package_id2 = $row2['package_id'];
					$p_name2     = $row2['p_name'];
					$p_amount2   = $row2['p_amount'];
					$p_duration2 = $row2['p_duration'];
					$p_wef2      = $row2['p_wef'];
					$p_status2   = $row2['p_status'];

					if ($p_status2 == 'ACTIVE') {
						print "<option value='$package_id2'>$p_name2   [$p_amount2]</option>";
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
			<button type="submit" id="btn-submit" class="btn btn-primary">SUBMIT</button>
		</div>
	</div>
	</form>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<script>
	$(function() {
		$('#b_date').datepicker();

		$('#t_date').datepicker();

		$('#d_date').datepicker();
	});
	</script>
</body>
</html>