<?php
session_start();
$member_id=$_GET['id'];

require_once ('db/db_config.php');

$sql=mysqli_query($connection,"select * from member_info where member_id = $member_id ");
/*echo "select * from member_info where member_id = $member_id ";*/
while($row=mysqli_fetch_array($sql))
{	

	$Name1  =$row['name'];
	$DOB1   =$row['dob'];
	$DOJ1   =$row['doj'];
	$Gender1=$row['gender'];
	$Height1=$row['height'];
	$Weight1=$row['weight'];

	$Address1=$row['address'];
	$Contact1=$row['contact'];
	$Email1  =$row['email'];
	$Form_No1=$row['form_no'];

	$Occupation1       =$row['occupation'];
	$Marital_Status1   =$row['m_status'];
	$Emergency_Name1   =$row['e_name'];
	$Emergency_Contact1=$row['e_contact'];
	$image_ext		   =$row['image_ext'];

	print "<table class='table'>";
	print "<img src='images/$image_ext'  alt='icon' style='width:150px;height:150px;'>";
	print "<tr><th>Name:</th><td id='Name1'>$Name1 - $Contact1</td></tr>";
	print "<tr><th>DOB:</th><td id='DOB1'>$DOB1</td><th>Height:</th><td id='Height1'>$Height1</td></tr>";
	print "<tr><th>DOJ:</th><td id='DOJ1'>$DOJ1</td><th>Weight:</th><td id='Weight1'>$Weight1</td></tr>";
	print "<tr><th>Gender:</th><td id='Gender1'>$Gender1</td><th>Marital Status:</th>
	<td id='Marital_Status1'>$Marital_Status1</td></tr>";
	
	print "<tr><th>Occupation:</th><td id='Occupation1'>$Occupation1</td></tr><tr><th>Address:</th>
	<td id='Address1'>$Address1</td></tr><tr><th>Email:</th><td id='Email1'>$Email1</td></tr><tr>
	<th>Emergency_Name:</th><td id='Emergency_Name1'>$Emergency_Name1 -- $Emergency_Contact1</td></tr><tr>
	<th>Form_No:</th><td id='Form_No1'>$Form_No1</td></tr>";
	
}
	?>