<?php
session_start();
$member_id=$_GET['id'];

require_once ('db/db_config.php');

$sql=mysqli_query($connection,"select * from member_info where member_id = $member_id ");
while($row=mysqli_fetch_array($sql))
{	
		$name = $row['name'];
		$email = $row['email'];
		$message = "Dear ".$name."\n\nWish u a very happy birthday \n\nRegards \nTushar's gym and family";




			
		print "<input type='hidden' id='member_id' name='member_id' value='$member_id' /><br>";
				

				print "<div class='form-group'>
					<label for='Name' class='col-sm-2 control-label'>Name</label>
					<div class='col-sm-6'>
						<input type='text' id='name' name='name' class='form-control' placeholder='Enter Name'  readonly='readonly' value='$name'>
					</div>
				</div>
				

				<div class='form-group'>
					<label for='email' class='col-sm-2 control-label'>Email</label>
					<div class='col-sm-6'>
						<input type='text' id='email' name='email' class='form-control' placeholder='Enter email'  value='$email'>
					</div>
				</div>



				<div class='form-group'>
					<label for='message' class='col-sm-2 control-label'>Message</label>
					<div class='col-sm-8'>
						<textarea name='message' id='message'  class='form-control' rows='8' >$message</textarea>
						
					</div>
				</div>";
	//			print"</form>";
	
}
	?>