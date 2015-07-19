<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
		session_start();
		if(!isset($_SESSION['name1']))
		{
			header("Location: index.php");
		}
		if ($_SESSION['access_level1']>2) {
          header( "Location: home.php");  
        }
		echo "Edit Member Details";
		?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<body>
	<!-- HTML code for form -->
	<?php
	$member_id=$_GET['member_id'];
	require_once('db/db_config.php');

	$sql=mysqli_query($connection,"select * from member_info where member_id = $member_id ");
while($row=mysqli_fetch_array($sql))
{

	$name 	 =$row['name'];
	$dob	 =$row['dob'];
	$doj 	 =$row['doj'];
	$gender  =$row['gender'];
	$m_status=$row['m_status'];
	$height  =$row['height'];
	$weight  =$row['weight'];
	$occupation =$row['occupation'];
	$address =$row['address'];
	$contact =$row['contact'];
	$email   =$row['email'];
	$e_name  =$row['e_name'];
	$e_contact =$row['e_contact'];
	$form_no = $row['form_no'];
		

	print"<form role='form' id='new_member_form' name='new_member_form' class='form-horizontal' method='post' action='update.php?member_id=$member_id' enctype='multipart/form-data'>
		<input type='hidden' name='action' value='add_form' />
		<br>

		<div class='form-group'>

			<label for='Name' class='col-sm-2 control-label'>Name</label>
			<div class='col-sm-3'>
				<input type='text' id='Name' name='Name' class='form-control' placeholder='Enter Name' readonly='readonly' value='$name'>
			</div>

			<label for='DOB' class='col-sm-1 control-label'>DOB</label>
			<div class='col-sm-2'>
				<input type='text' id='DOB' name='DOB' class='form-control' placeholder='Date Of Birth' readonly='readonly' value='$dob'>
			</div>

			<label for='DOJ' class='col-sm-1 control-label'>DOJ</label>
			<div class='col-sm-2'>
				<input type='text' id='DOJ' name='DOJ' class='form-control' placeholder='Joining Date' readonly='readonly' value='$doj'>
			</div>

		</div>


         		<div class='form-group'>
        			<label for='Height' class='col-sm-2 control-label'>Height</label>
        			<div class='col-sm-1'>
        				<input type='number' class='form-control' id='Height' name='Height' placeholder='In CM' max='999' value='$height'>
        			</div>
        			<label for='Weight' class='col-sm-1 control-label'>Weight</label>
        			<div class='col-sm-1'>
        				<input type='number' class='form-control' id='Weight' name='Weight' placeholder='In KG' max='999' value='$weight'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<label for='Occupation' class='col-sm-2 control-label'>Occupation</label>
        			<div class='col-sm-4'>
        				<input type='text' class='form-control' id='Occupation' name='Occupation' placeholder='Enter Occupation' value='$occupation'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<label for='Address' class='col-sm-2 control-label'>Address</label>
        			<div class='col-sm-4'>
        				<input type='text' class='form-control' id='Address' name='Address' placeholder='Enter Address' value='$address'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<label for='Contact' class='col-sm-2 control-label'>Contact</label>
        			<div class='col-sm-4'>
        				<input type='number' class='form-control' id='Contact' name='Contact' placeholder='Enter Contact No.' max='9999999999' required value='$contact'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<label for='Email' class='col-sm-2 control-label'>Email</label>
        			<div class='col-sm-4'>
        				<input type='email' class='form-control' id='Email' name='Email' placeholder='Enter Email id' value='$email'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<label for='Emergency_Contact' class='col-sm-2 control-label'>Emergency_Contact</label>
        			<div class='col-sm-2'>
        				<input type='text' class='form-control' id='Emergency_Name' name='Emergency_Name' placeholder='Contact Name' value='$e_name'>
        			</div>
        			<div class='col-sm-2'>
        				<input type='number' class='form-control' id='Emergency_Contact' name='Emergency_Contact' placeholder='Emergency_Contact No.' max='9999999999' value='$e_contact'>
        			</div>
        		</div>

   
        		<div class='form-group'>
        			<label for='filename' class='col-sm-2 control-label'>Image</label>
        			<div class='col-sm-2'>
        				<input type='file'  name='fileToUpload' id='fileToUpload'>
        			</div>
        		</div>

        		<div class='form-group'>
        			<div class='col-sm-offset-2 col-sm-10'>
        				<button type='button' id='update' name='update' class='btn btn-primary'>Update Details</button>
        			</div>
        		</div>
        	</form>";
        }
        	?>
        	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
	

        $(function() {
            
            $('#update').click(function() {
                /* when the submit button in the modal is clicked, submit the form */
                $('#new_member_form').submit();
            });

            
        });
    </script>
</body>
<HTML>