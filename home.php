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
			<li role="presentation" class="active"><a href="home.php">Manage Members</a></li>
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

			print ('<li role="presentation"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
			?>
			<button class="btn btn-primary pull-right btn-sm" id="logout" name="logout" type="button" 
			>Logout</button>
		</ul>
	</div>

	<div class = "container" >
		<table name="table" id="table" class ="table">
		</br>

		<tr><th>IMAGE</th><th>NAME</th><th>CONTACT</th><th>FORM_NO</th>
			<th>BASIC</th><th>TRAINING</th><th>DIET</th><th>DETAILS</th></tr>

			<?php

//onclick="window.location='logout.php';"
			$sql=mysql_query("select * from member_info ");
			while($row=mysql_fetch_array($sql))
			{	
				$member_id=$row['member_id'];
				$name=$row['name'];
				$contact=$row['contact'];
				$form_no=$row['form_no'];
				$image=$member_id."jpg";

				if ($member_id==1||$member_id==5)
				{
					$color="#F9D1CA";
				}
				else
				{
					$color="#FFFFFF";
				}
				
				
				print "<tr bgcolor='$color'><td>";
					//print "<img src='images/1.jpg'  alt='icon' style='width:70px;height:70px;'>";
					//print "</td> <td>";

				print "</td> <td> <input  type='button' id='modal_display' data-toggle='modal'
				class='btn btn-danger btn-xs'	data-target='#modal_details' name='$member_id' value='$name'>";
					//echo $name; 
				print "</td> <td>";
				echo $contact; 
				print "</td> <td>";
				echo $form_no; 
				$sql1=mysql_query("SELECT p.p_amount-b.paid,b.end_date-current_date FROM packages p join basic_package b on p.package_id=b.package_id WHERE b.member_id=$member_id and current_date between b.start_date and b.end_date");
				if (mysql_num_rows($sql1))
				{ 
					while ($row1=mysql_fetch_array($sql1)) {
						$b_amt_left=$row1[0];
						$b_left=$row1[1];

						print "</td> <td><button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('b_edit.php?member_id=$member_id','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">BASIC<span class='badge'>$b_left</span><span class='badge'>$b_amt_left</span></button>";
					}
				}
				else
				{
					print "</td> <td><button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('b_edit.php?member_id=$member_id','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">BASIC<span class='badge'>--</span><span class='badge'>--</span></button>";
				}



				$sql2=mysql_query("
					SELECT p.p_amount-t.paid,t.end_date-current_date FROM packages p join training_package t on p.package_id=t.package_id WHERE t.member_id=$member_id and current_date between t.start_date and t.end_date");
				if (mysql_num_rows($sql2))
				{ 
					while ($row2=mysql_fetch_array($sql2)) {
						$t_amt_left=$row2[0];
						$t_left=$row2[1];

						print "</td> <td>
						<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('t_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">TRAINING <span class='badge'>$t_left
						</span><span class='badge'>$t_amt_left</span></button>";}}
						else{
							print "</td> <td><button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('t_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">
							TRAINING <span class='badge'>--</span><span class='badge'>--</span></button>";
						}

						$sql3=mysql_query("SELECT p.p_amount-d.paid,d.end_date-current_date FROM packages p join training_package d on p.package_id=d.package_id WHERE d.member_id=$member_id and current_date between d.start_date and d.end_date");



						if (mysql_num_rows($sql3))
						{ 
							while ($row3=mysql_fetch_array($sql3)) {
								$d_amt_left=$row3[0];
								$d_left=$row3[1];
								print "</td> <td>
								<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('d_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">DIET
								<span class='badge'>$d_left</span>
								<span class='badge'>$d_amt_left</span></button>";
							}}
							else{
								print "</td> <td>
								<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('d_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">DIET <span class='badge'>
								--</span><span class='badge'>--</span></button>";	
							}

							print "</td> <td> <input id=$member_id type='button' class='btn btn-info btn-xs' name='EDIT' value='Edit' onclick=\"window.open('edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">";

							print "</td> </tr>";
						}
						?>

					</table>

				</div>


				<div class="modal fade" id="modal_details" name="modal_details"tabindex="-1" role="dialog" 
				aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<big><b>Customer Details</b></big>

							<!-- We display the details entered by the user here -->
							<table class="table" id=table_update>
								<tr>
									<th>Name:</th>
									<td id="Name1"></td>
								</tr>
								<tr>
									<th>DOB:</th>
									<td id="DOB1"></td>

									<th>Height:</th>
									<td id="Height1"></td>

								</tr>
								<tr>
									<th>DOJ:</th>
									<td id="DOJ1"></td>

									<th>Weight:</th>
									<td id="Weight1"></td>
								</tr>
								<tr>
									<th>Gender:</th>
									<td id="Gender1"></td>

									<th>Marital Status:</th>
									<td id="Marital_Status1"></td>
								</tr>

								<tr>
									<th>Occupation:</th>
									<td id="Occupation1"></td>
								</tr>
								<tr>
									<th>Address:</th>
									<td id="Address1"></td>
								</tr>
								<tr>
									<th>Contact:</th>
									<td id="Contact1"></td>
								</tr>
								<tr>
									<th>Email:</th>
									<td id="Email1"></td>
								</tr>
								<tr>
									<th>Emergency_Name:</th>
									<td id="Emergency_Name1"></td>
								</tr>
					<!--<tr>
						<th>Emergency_Contact:</th>
						<td id="Emergency_Contact1"></td>
					</tr>-->
					<tr>
						<th>Form_No:</th>
						<td id="Form_No1"></td>
					</tr>

				</table>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>


var buttons = document.getElementsByTagName("input");
var buttonsCount = buttons.length;
for (var i = 0; i <= buttonsCount; i += 1) {
	buttons[i].onclick = function(e) {
        //alert(this.name);
        dataString='id='+ this.name;
        $.ajax
        ({
        	type: 'GET',
        	url: 'modal.php',
        	data: dataString,
        	cache: false,
        	success: function(html)
        	{
        		$("#table_update").html(html);

        	} 
        });

    };
}

$(function() {
	$('#modal_display').click(function() {


		/* when the button in the form, display the entered values in the modal */
		
		//var id1 = $(this).attr('name');

		//$('#Occupation1').html(id1);
		$('#modal_details').modal('show');

	});
});



</script>



</body>

</html>