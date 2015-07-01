<?php
session_start();
$admin_id=$_GET['id'];

///echo $member_id;
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "tgym";

$connection = mysql_connect($dbhost, $dbusername, $dbpassword) or die('Could not connect');
$db = mysql_select_db($dbname);

$sql=mysql_query("select * from admin_credentials where admin_id = $admin_id ");
while($row=mysql_fetch_array($sql))
{	
		$name = $row['name'];
		$access_level = $row['access_level'];
		$username = $row['username'];
		$password = $row['password'];



//print"<big><b>Admin Details</b></big>";
//			print "<form role='form' id='new_admin_form' name='new_admin_form' class='form-horizontal' method='post' action='inserter3.php?action=update' enctype='multipart/form-data'>";
				


			
		print "<input type='hidden' id='admin_id' name='admin_id' value='$admin_id' /><br>";
				

				print "<div class='form-group'>
					<label for='Name' class='col-sm-2 control-label'>Name</label>
					<div class='col-sm-4'>
						<input type='text' id='name' name='name' class='form-control' placeholder='Enter Name'  readonly='readonly' value='$name'>
					</div>
				</div>
				<div class='form-group'>
					<label for='access_level' class='col-sm-2 control-label'>Access</label>
					<div class='col-sm-4'>
						<input type='number' id='access_level' class='form-control' name='access_level' placeholder='Set Access Level' max='9' value='$access_level'>
					</div>
				</div>

				<div class='form-group'>
					<label for='Username' class='col-sm-2 control-label'>Username</label>
					<div class='col-sm-4'>
						<input type='text' id='username' name='username' class='form-control' placeholder='Enter Username' readonly='readonly' value='$username'>
					</div>
				</div>



				<div class='form-group'>
					<label for='Password' class='col-sm-2 control-label'>Password</label>
					<div class='col-sm-4'>
						<input type='text' id='password' name='password' class='form-control' placeholder='Enter Password' value='$password'>
					</div>
				</div>";
	//			print"</form>";
	
}
	?>