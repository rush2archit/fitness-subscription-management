<?php
	session_start();
	$connection = mysql_connect("localhost", "root", ""); // Establishing Connection with Server..
	$db = mysql_select_db("tgym", $connection); // Selecting Database
	//Fetching Values from URL
	$username=$_POST['username'];
	$password=$_POST['password'];

	
	//Insert query
	$sql=mysql_query("select * from admin_credentials where username like '$username' AND password like '$password'");
				while($row=mysql_fetch_array($sql))
				{
					$ID=$row['admin_id'];
					$name=$row['name'];
					$access_level=$row['access_level'];
					$_SESSION['ID1'] = stripslashes(htmlspecialchars($ID));
					$_SESSION['name1'] = stripslashes(htmlspecialchars($name));
					$_SESSION['access_level1'] = stripslashes(htmlspecialchars($access_level));
	
				}
	if(mysql_num_rows($sql)>0){
		echo "id=".$ID."&name=".$name."&access_level=".$access_level;
	}
	else {
		echo "error";
	}

	mysql_close($connection); // Connection Closed
	?>