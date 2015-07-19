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
	<script src="sorttable.js"></script>
	

</head>
<body>

	<div class="container" >
		<ul class="nav nav-tabs">
			<?php
			require_once('db/db_config.php');

			date_default_timezone_set("Asia/Kolkata");
			$today = date("Y-m-d");

			$sql      = mysqli_query($connection, "select count(*) as total from member_info where dob like '%$today%' ");
			$data     = mysqli_fetch_assoc($sql);
			$birthday = $data['total'];

			if ($_SESSION['access_level1'] < 3) {
				print('<li role="presentation"><a href="add_member.php">New Member</a></li>');
			}

			print('<li role="presentation" class="active"><a href="home.php">Manage Members</a></li>');

			if ($_SESSION['access_level1'] == 1) {
				print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>');
				print('<li role="presentation" ><a href="manage_package.php">Package & Offers</a></li>');
			}


			print('<li role="presentation"><a href="birthday.php">Birthday <span class="badge">' . $birthday . '</span></a></li>');
			?>
			<button class="btn btn-primary pull-right btn-sm" id="logout" name="logout" type="button" onclick="window.location='index.php';">Logout</button>
		</ul>
	</div>

	<div class = "container" >

		<div class="form-group">
		</br>

		<div class="col-sm-3">
			<input type="text" class="form-control" id="search" name="search" placeholder="Enter search">

		</div>
		<input class="btn btn-danger" id="due" name="due" type="button" value="Due Member's">
	</div>

</br>
<table name="table" id="table" class ="table sortable" >

</br>

<tr><th>NAME</th><th>CONTACT</th><th>FORM_NO</th>
	<th>BASIC</th><th>TRAINING</th><th>DIET</th><th>DETAILS</th></tr>

	<?php
	$color="#F9D1CA";

	$sql=mysqli_query($connection,"select * from member_info ");
	while($row=mysqli_fetch_array($sql))
	{	
		$member_id=$row['member_id'];
		$name=$row['name'];
		$contact=$row['contact'];
		$form_no=$row['form_no'];
		$image=$member_id."jpg";

		print "<tr><td>";
		print "<input  type='button' id='modal_display' data-toggle='modal'
		class='btn btn-link btn-xs'	data-target='#modal_details' name='$member_id' value='$name'>";
		print "</td> <td>";
		echo $contact; 
		print "</td> <td>";
		echo $form_no; 

		$sql1=mysqli_query($connection,"SELECT p.p_amount-b.paid,DATEDIFF(b.end_date,current_date) FROM packages p join basic_package b on p.package_id=b.package_id WHERE b.member_id=$member_id and current_date between b.start_date and b.end_date");
		if (mysqli_num_rows($sql1))
		{ 
			while ($row1=mysqli_fetch_array($sql1)) {
				$b_amt_left=$row1[0];
				$b_left=$row1[1];

				if ($_SESSION['access_level1']>2) {
					if ($b_amt_left>0) {
						print "</td> <td bgcolor='$color'>";
						print "$b_left";
					} else{
						print "</td> <td>";
						print "$b_left";
					}
				} else {


					if ($b_amt_left>0) {
						print "</td> <td bgcolor='$color'>";
						print "<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('b_edit.php?member_id=$member_id','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$b_left</button>";
					} else{
						print "</td> <td>";
						print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('b_edit.php?member_id=$member_id','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$b_left</button>";
					}
				}
			}
		}
		else
			{	$b_left=0;
				print "</td> <td>";

				if ($_SESSION['access_level1']>2) {
					print "$b_left";
				} else {
					


					print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('b_edit.php?member_id=$member_id','popUpWindow$member_id','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$b_left</button>";
				}
			}


			$sql2=mysqli_query($connection,"
				SELECT p.p_amount-t.paid,DATEDIFF(t.end_date,current_date) FROM packages p join training_package t on p.package_id=t.package_id WHERE t.member_id=$member_id and current_date between t.start_date and t.end_date");
			if (mysqli_num_rows($sql2))
			{ 
				while ($row2=mysqli_fetch_array($sql2)) {
					$t_amt_left=$row2[0];
					$t_left=$row2[1];
					if ($_SESSION['access_level1']>2) {
						if ($t_amt_left>0) {
							print "</td> <td bgcolor='$color'>";
							print "$t_left";
						} else {
							print "</td> <td>";
							print "$t_left";
						}
					} else {
						if ($t_amt_left>0) {
							print "</td> <td bgcolor='$color'>";
							print "<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('t_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$t_left</button>";
						} else {
							print "</td> <td>";
							print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('t_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$t_left</button>";
						}
					}
				}
			}
			else{
				$t_left=0;
				print "</td> <td>";
				if ($_SESSION['access_level1']>2) {
					print "$t_left";
				} else {
					


					print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('t_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$t_left</button>";
				}
			}


			$sql3=mysqli_query($connection,"SELECT p.p_amount-d.paid,DATEDIFF(d.end_date,current_date) FROM packages p join diet_package d on p.package_id=d.package_id WHERE d.member_id=$member_id and current_date between d.start_date and d.end_date");
			if (mysqli_num_rows($sql3))
			{ 
				while ($row3=mysqli_fetch_array($sql3)) {
					$d_amt_left=$row3[0];
					$d_left=$row3[1];
					if ($_SESSION['access_level1']>2) {
						if ($d_amt_left) {
							print "</td> <td bgcolor='$color'>";
							print "$d_left";
						} else {
							print "</td> <td>";
							print "$d_left";
						}
						
					} else {
						
						
						
						if ($d_amt_left) {
							print "</td> <td bgcolor='$color'>";
							print "<button class='btn btn-danger btn-xs' type='button' onclick=\"window.open('d_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$d_left</button>";
						} else {
							print "</td> <td>";
							print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('d_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$d_left</button>";
						}
					}
				}
			}
			else{
				$t_left=0;
				print "</td> <td>";
				if ($_SESSION['access_level1']>2) {
					print "$t_left";	
				} else {
					print "<button class='btn btn-primary btn-xs' type='button' onclick=\"window.open('d_edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">$t_left</button>";	
				}
			}
			print "</td> <td>";
			print " <button id=$member_id type='button' class='btn btn-info btn-xs' name='EDIT'  onclick=\"window.open('edit.php?member_id=$member_id','popUpWindow','resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');\">EDIT</button>";

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
for (var i = 0; i < buttonsCount; i += 1) {
	buttons[i].onclick = function(e) {
        //alert(this.name);
        dataString='id='+ this.name;
        if (this.id=='due') {
        	$.ajax
        	({
        		type: 'GET',
        		url: 'due.php',
        		data: dataString,
        		cache: false,
        		success: function(html)
        		{
        			$("#table").html(html);

        		} 
        	});
        } else if (this.id=='modal_display'){
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
        

    };
}

$(document).ready(function(){
	$("input").change(function(){
		var search=document.getElementById('search').value;
		var dataString1 = 'search='+search;
		$.ajax
		({
			type: 'GET',
			url: 'ajax_filter.php',
			data: dataString1,
			cache: false,
			success: function(html)
			{
				$("#table").html(html);

			} 
		});

	});
});

$(function() {
	$('#modal_display').click(function() {

		$('#modal_details').modal('show');

	});
});



</script>



</body>

</html>