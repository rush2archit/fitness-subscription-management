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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


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
					print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
				
				print ('<li role="presentation" class="active"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
				?>
				<button class="btn btn-primary pull-right btn-sm"  type="button" onclick="window.location='logout.php';">Logout</button>
			</ul>
		</div>
		<div class = "container" >
			<div class="col-sm-2 control-label">
			</div>
			<div class="col-sm-8 control-label">
		<table name="table" id="table" class ="table" >
		</br>
				<tr><th>IMAGE</th><th>NAME</th><th>CONTACT</th><th>DETAILS</th></tr>

				<?php


				$sql=mysql_query("select * from member_info where dob like '%$today%'  ");
				while($row=mysql_fetch_array($sql))
				{	
					$member_id=$row['member_id'];
					$name=$row['name'];
					$contact=$row['contact'];
					$form_no=$row['form_no'];
					$image=$member_id."jpg";


					print "<tr><td>";
					print "<img src='images/1.jpg'  alt='icon' style='width:70px;height:70px;'>";
					print "</td> <td>";
					echo $name; 
					print "</td> <td>";
					echo $contact; 
					
					print "</td> <td> <input id=$member_id type='button' class='btn btn-danger btn-xs'name='DETAILS' value='DETAILS' onclick=\"window.location='delete.php?member_id=$member_id';\">";
					print "</td> </tr>";
				}
?>
			</table>
		</div>
			</div>



</body>

</html>