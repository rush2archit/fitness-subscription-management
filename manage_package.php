<html>
<head>

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
	<div class="container" >
		<ul class="nav nav-tabs">
			<li role="presentation" ><a href="add_member.php">New Member</a></li>
			<li role="presentation" ><a href="home.php">Manage Members</a></li>
			<?php
			$dbhost = "localhost";
			$dbusername = "root";
			$dbpassword = "";
			$dbname = "tgym";

			$connection = mysql_connect($dbhost, $dbusername, $dbpassword) or die('Could not connect');
			$db = mysql_select_db($dbname);

			date_default_timezone_set("Asia/Kolkata");
			$today = date("Y-m-d");

			$sql=mysql_query("select count(*) as total from member_info where dob like '%$today%' ");
			$data=mysql_fetch_assoc($sql);
			$birthday = $data['total'];

			if ($_SESSION['access_level1']==1)
			{
				print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
				print('<li role="presentation" class="active"><a href="manage_package.php">Package & Offers</a></li>') ;
			}

			print ('<li role="presentation"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
			?>
			<button class="btn btn-primary pull-right btn-sm" id="logout" name="logout" type="button" onclick="window.location='index.php';"
			>Logout</button>
		</ul>
	</div>


	<div class="container" >
		<form role="form" id="new_package_form" name="new_package_form" class="form-horizontal" method="post" action="inserter4.php?action=new" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add_form" />
			<br>

			<div class="form-group">
				<label for="Package_Name" class="col-sm-2 control-label">Package</label>
				<div class="col-sm-2">
					<select name="package_name" id="package_name" class="form-control" data-style="btn-primary">
						<option selected="selected" value="NULL">--Select Package--</option>
						<option value="B_">Basic</option>
						<option value="PRIME_MONTH_">Prime</option>
						<option value="S_PRIME_MONTH_">Super Prime</option>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label for="amount" class="col-sm-2 control-label">Amount</label>
				<div class="col-sm-2">
					<input type="number" id="amount" class="form-control" name="amount" placeholder="Enter Amount" max="999999">
				</div>
				<label for="duration" class="col-sm-2 control-label">Duration</label>
				<div class="col-sm-2">
					<input type="number" id="duration" class="form-control" name="duration" placeholder="Enter Duration" max="999">
				</div>
			</div>
			<div class="form-group">
				<label for="s_date" class="col-sm-2 control-label">Date Effective</label>
				<div class="col-sm-2">
					<input type="text" id="s_date" name="s_date" class="form-control" placeholder="Start Date">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" id="btn-submit" class="btn btn-primary">Create Package</button>
				</div>
			</div>
		</form>
	</div>

	<div class="container" >

		<table name="admin_table" id="admin_table" class ="table sortable" style="font-size: 14px;">
		
		<tr><th>#</th><th>PACKAGE</th><th>AMOUNT</th><th>DURATION</th><th>EFFECTIVE SINCE</th><th>STATUS</th></tr>

		<?php
		$sql=mysql_query("select * from packages order by p_status,package_id");
		while($row=mysql_fetch_array($sql))
		{	
			$package_id = $row['package_id'];
			$p_name = $row['p_name'];
			$p_amount = $row['p_amount'];
			$p_duration = $row['p_duration'];
			$p_wef = $row['p_wef'];
			$p_status = $row['p_status'];

			print "<tr><td>";
			echo $package_id;
			print "</td> <td>";
			echo $p_name; 
			print "</td> <td>";
			echo $p_amount; 
			print "</td> <td>";
			echo $p_duration; 
			print "</td> <td>";
			echo $p_wef; 
			print "</td> <td> <input  type='button' onclick='statusChange(this)' id='b_status' class='btn btn-danger btn-xs' name='$package_id' value='$p_status'>";
			print "</td> </tr>";
		}
		?>

		</table>

	</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="sorttable.js"></script>

<script>

function statusChange(e) {
	dataString='id='+ e.name+'&&status='+e.value;
    $.ajax
    ({
    	type: 'GET',
    	url: 'status.php',
    	data: dataString,
    	cache: false,
    	success: function(html)
    	{
    		$("#admin_table").html(html);

    	} 
    });
}

// var buttons = document.getElementsByTagName("input");
// var buttonsCount = buttons.length;
// for (var i = 0; i < buttonsCount; i += 1) {
// 	buttons[i].onclick = function(e) {
//         //alert(this.name);
//         dataString='id='+ this.name+'&&status='+this.value;
//         $.ajax
//         ({
//         	type: 'GET',
//         	url: 'status.php',
//         	data: dataString,
//         	cache: false,
//         	success: function(html)
//         	{
//         		$("#admin_table").html(html);

//         	} 
//         });

//     };
// }

$('#submit').click(function(){
	$('#new_package_form').submit();
});	

//$('#s_date').datepicker();

$(function() {
			$('#s_date').datepicker();

		});

</script>
</body>
</html>