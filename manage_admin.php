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
					print('<li role="presentation" class="active"><a href="manage_admin.php">Manage Admin</a></li>') ;
					print('<li role="presentation" ><a href="manage_package.php">Package & Offers</a></li>') ;
				}

			print ('<li role="presentation"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
			?>
			<button class="btn btn-primary pull-right btn-sm" id="logout" name="logout" type="button" onclick="window.location='index.php';"
			>Logout</button>
		</ul>
	</div>


	<div class="container" >
		<form role="form" id="new_member_form" name="new_member_form" class="form-horizontal" method="post" action="inserter3.php?action=new" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add_form" />
			<br>

			<div class="form-group">
				<label for="Name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-2">
					<input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required>
				</div>
				<label for="Username" class="col-sm-2 control-label">Username</label>
				<div class="col-sm-2">
					<input type="text" id="username" name="username" class="form-control" placeholder="Enter Username">
				</div>
			</div>


			<div class="form-group">
				<label for="access_level" class="col-sm-2 control-label">Access_level</label>
				<div class="col-sm-2">
					<input type="number" id="access_level" class="form-control" name="access_level" placeholder="Set Access Level" max="9">
				</div>
				<label for="Password" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-2">
					<input type="text" id="password" name="password" class="form-control" placeholder="Enter Password">
				</div>
			</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" id="btn-submit" class="btn btn-primary">SUBMIT</button>
						</div>
					</div>
		</form>
	</div>

<div class = "container" >

	<table name="admin_table" id="admin_table" class ="table sortable">
	</br>
	<tr><th>#</th><th>NAME</th><th>ACCESS_LEVEL</th></tr>

	<?php
	$sql=mysql_query("select * from admin_credentials ");
	while($row=mysql_fetch_array($sql))
	{	
		$admin_id = $row['admin_id'];
		$name = $row['name'];
		$access_level = $row['access_level'];

		print "<tr><td>";
		echo $admin_id;
		print "</td> <td>";
		 print "<input  type='button' id='modal_display' data-toggle='modal'
		class='btn btn-danger btn-xs'	data-target='#modal_details' name='$admin_id' value='$name'>";
		print "</td> <td>";
		echo $access_level; 
		print "</td> </tr>";
	}
	?>

</table>

</div>


<div class="modal fade" id="modal_details" name="modal_details"tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-body" >
			<big><b>Admin Details</b></big>
			<form role="form" id="new_admin_form" name="new_admin_form" class="form-horizontal" method="post" action="inserter3.php?action=update" enctype="multipart/form-data">
				


			</form>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<a  id="submit" name="submit" class="btn btn-success success">Submit</a>
		</div>
	</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="sorttable.js"></script>


<script>

var buttons = document.getElementsByTagName("input");
var buttonsCount = buttons.length;
for (var i = 0; i < buttonsCount; i += 1) {
	buttons[i].onclick = function(e) {
        //alert(this.name);
        dataString='id='+ this.name;
        $.ajax
        ({
        	type: 'GET',
        	url: 'modal2.php',
        	data: dataString,
        	cache: false,
        	success: function(html)
        	{
        		$("#new_admin_form").html(html);

        	} 
        });

    };
}

$('#submit').click(function(){
     $('#new_admin_form').submit();
	});	


</script>
</body>
</html>