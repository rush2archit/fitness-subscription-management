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
			require_once ('db/db_config.php');

			date_default_timezone_set("Asia/Kolkata");
			$today = date("Y-m-d");

			$sql=mysqli_query($connection,"select count(*) as total from member_info where dob like '%$today%' ");
			$data=mysqli_fetch_assoc($sql);
			$birthday = $data['total'];

			if ($_SESSION['access_level1']==1)
			{
				print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
				print('<li role="presentation" ><a href="manage_package.php">Package & Offers</a></li>') ;
			}

			print ('<li role="presentation" class="active"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
			?>
			<button class="btn btn-primary pull-right btn-sm"  type="button" onclick="window.location='index.php';">Logout</button>
		</ul>
	</div>
	<div class = "container" >
		<div class="col-sm-2 control-label">
		</div>
		<div class="col-sm-8 control-label">
			<table name="table" id="table" class ="table" >
			</br>
			<tr><th>IMAGE</th><th>NAME</th><th>CONTACT</th><!-- <th>DETAILS</th> --><th>SEND MAIL</th></tr>

			<?php


			$sql=mysqli_query($connection,"select * from member_info where dob like '%$today%'  ");
			while($row=mysqli_fetch_array($sql))
			{	
				$member_id=$row['member_id'];
				$name=$row['name'];
				$contact=$row['contact'];
				$form_no=$row['form_no'];
				$image=$row['image_ext'];


				print "<tr><td>";
				print "<img src='images/$image'  alt='icon' style='width:70px;height:70px;'>";
				print "</td> <td> <input id='modal_display' type='button' data-toggle='modal' class='btn btn-link btn-xs' value='$name' data-target='#modal_details' name='$member_id'>";
				print "</td> <td>";
				echo $contact; 
				print "</td> <td>";
				/*print "<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('sendsms.php?phone=$contact&msg=$name','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">SEND</button>";*/
				print " <input id='modal_bday' type='button' data-toggle='modal' class='btn btn-danger btn-xs' value='SEND' data-target='#modal_birthday' name='$member_id'>";
				print "</td></tr>";
			
			}
			?>
		</table>
	</div>
</div>

<div class="modal fade" id="modal_details" name="modal_details"tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-body">
			<big><b>Customer Details</b></big>
			<table class="table" id="table_update">
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="modal_birthday" name="modal_birthday"tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">

		<div class="modal-body" >
		<big><b>Greetings</b></big>
			<form role="form" id="mail_form" name="mail_form" class="form-horizontal" method="post" action="mail.php?" enctype="multipart/form-data">
				


			</form>
		
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<a  id="submit" name="submit" class="btn btn-success success">Submit</a>
		</div>
	</div>
</div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>


var buttons = document.getElementsByTagName("input");
var buttonsCount = buttons.length;
for (var i = 0; i < buttonsCount; i += 1) {
	buttons[i].onclick = function(e) {
        //alert(this.name);
        dataString='id='+ this.name;
        if (this.id == 'modal_bday')
        {

        $.ajax
        ({
        	type: 'GET',
        	url: 'modal3.php',
        	data: dataString,
        	cache: false,
        	success: function(html)
        	{
        		$("#mail_form").html(html);

        	} 
        });


        }
else
{
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
}
        

    };
}

$('#submit').click(function(){
     $('#mail_form').submit();
	});	


</script>


</body>

</html>
















