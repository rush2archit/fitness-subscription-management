<?php
session_start();
$package_id=$_GET['id'];
$p_status=$_GET['status'];

require_once('db/db_config.php');

if ($p_status=='ACTIVE') {
	$p_status='DEACTIVE';
} else {
	$p_status='ACTIVE';
}

mysql_query("update packages set p_status = '$p_status' where package_id=$package_id") or die('error');
print "<tr><th>#</th><th>PACKAGE</th><th>AMOUNT</th><th>DURATION</th><th>EFFECTIVE SINCE</th><th>STATUS</th></tr>";
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
			print "</td> <td> ";
			print "<input  type='button' id='b_status' onclick='statusChange(this)' class='btn btn-danger btn-xs' name='$package_id' value='$p_status'>";
			print "</td> </tr>";
		
}
?>