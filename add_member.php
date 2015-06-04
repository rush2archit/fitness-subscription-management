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
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	</head>


	<body>
		<div class="container" >
			<ul class="nav nav-tabs">
				<li role="presentation" class="active"><a href="add_member.php">New Member</a></li>
				<li role="presentation" ><a href="home.php">Manage Members</a></li>
				<?php
				if ($_SESSION['access_level1']==1)
					print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
				?>
				<button class="btn btn-primary pull-right btn-sm"  type="button" onclick="window.location='logout.php';">Logout</button>
			</ul>
		</div>
	
	<form role="form" id="new_member_form" class="form-horizontal" method="post"  action="inserter.php" onsubmit="return validateForm();">
			<input type="hidden" name="action" value="add_form" /> 
		<br>

		<div class="form-group">

				<label for="Name" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-3">
				<input type="text" id="Name" name="Name" class="form-control" placeholder="Enter Name">
			</div>

				<label for="DOB" class="col-sm-1 control-label">DOB</label>
			<div class="col-sm-2">
				<input type="text" id="DOB" name="DOB" class="form-control" placeholder="Date Of Birth">		
			</div>

				<label for="DOJ" class="col-sm-1 control-label">DOJ</label>
			<div class="col-sm-2">
				<input type="text" id="DOJ" name="DOJ" class="form-control"placeholder="Joining Date">		
			</div>

		</div>
		
		<div class="form-group">
			<label for="Gender" class="col-sm-2 control-label">Gender</label>
			<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="optradio">Male</label>
				<label class="radio-inline"><input type="radio" name="optradio">Female</label>
				<label class="radio-inline"><input type="radio" name="optradio">Transgender</label>
			</div>
		</div>

		<div class="form-group">
			<label for="Marital_Status" class="col-sm-2 control-label">Marital_Status</label>
			<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="optradio">Married</label>
				<label class="radio-inline"><input type="radio" name="optradio">Unmarried</label>
			</div>
		</div>

		<div class="form-group">
			<label for="Height" class="col-sm-2 control-label">Height</label>
			<div class="col-sm-1">
				<input type="number" id="Height" class="form-control" name="Height" placeholder="In CM" max="999">
			</div>
			<label for="Weight" class="col-sm-1 control-label">Weight</label>
			<div class="col-sm-1">
				<input type="number" id="Weight" class="form-control" name="Weight" placeholder="In KG" max="999">
			</div>
		</div>

		<div class="form-group">
			<label for="Occupation" class="col-sm-2 control-label">Occupation</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="Occupation" placeholder="Enter Occupation">
			</div>
		</div>

		<div class="form-group">
			<label for="Address" class="col-sm-2 control-label">Address</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="Address" placeholder="Enter Address">
			</div>
		</div>

		<div class="form-group">
			<label for="Contact" class="col-sm-2 control-label">Contact</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="Contact" placeholder="Enter Contact No." max="9999999999">
			</div>
		</div>

		<div class="form-group">
			<label for="Email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-4">
				<input type="email" class="form-control" name="Email" placeholder="Enter Email id">
			</div>
		</div>

		<div class="form-group">
			<label for="Emergency_Contact" class="col-sm-2 control-label">Emergency_Contact</label>
			<div class="col-sm-2">
				<input type="text" class="form-control" name="Emergency_Name" placeholder="Contact Name">
			</div>
			<div class="col-sm-2">
				<input type="number" class="form-control" name="Emergency_Contact" placeholder="Emergency_Contact No." max="9999999999">
			</div>

		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="btn-create" class="btn btn-primary">Create Member</button>
			</div>
		</div>
	</form>

	<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Confirm Submit
				</div>
				<div class="modal-body">
					Are you sure you want to submit the following details?

					<!-- We display the details entered by the user here -->
					<table class="table">
						<tr>
							<th>Last Name</th>
							<td id="lname" ></td>
						</tr>
						<tr>
							<th>First Name</th>
							<td id="fname" ></td>
						</tr>
					</table>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a href="#" id="submit" class="btn btn-success success">Submit</a>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
	<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script> -->
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<script>
	$(function() {
		$( "#datepicker" ).datepicker();

		$('#DOB').datepicker();

		$('#submit').click(function(){
			/* when the submit button in the modal is clicked, submit the form */
			alert('submitting');
			$('#new_member_form').submit();
		});

		$('#btn-create').click(function() {
			/* when the button in the form, display the entered values in the modal */
			

			$('#lname').html($('#Name').val());
			$('#fname').html($('#Height').val());
			$('#confirm-submit').modal('show');

		});
	});
	</script>

	</body>
	</html>