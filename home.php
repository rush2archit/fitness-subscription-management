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
				<li role="presentation" class="active"><a href="home.php">Manage Members</a></li>
				<?php
					if ($_SESSION['access_level1']==1)
						print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
				?>
				<button class="btn btn-primary pull-right btn-sm"  type="button" onclick="window.location='logout.php';">Logout</button>
			</ul>
		</div>

</body>

</html>