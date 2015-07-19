<!DOCTYPE html>
<html>
<head>
    <!-- this is for session check & tab/page title -->
    <title>
        <?php 
        session_start();
        if(!isset($_SESSION[ 'name1'])) { 
            header( "Location: index.php");
        } 
        if ($_SESSION['access_level1']>2) {
          header( "Location: home.php");  
        }
        echo "Enter Member Details"; 
        ?>
    </title>
    <!-- This is for loading external scripts -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>


<body>
    <!-- Code for the header tabs with different access levels for different users -->
    <div class="container">
        <ul class="nav nav-tabs">
            <?php
            require_once ('db/db_config.php');

            $connection = mysqli_connect($dbhost, $dbusername, $dbpassword,$dbname) or die('Could not connect');

            date_default_timezone_set("Asia/Kolkata");
            $today = date("Y-m-d");

            $sql=mysqli_query($connection,"select count(*) as total from member_info where dob like '%$today%' ");
            $data=mysqli_fetch_assoc($sql);

            $birthday = $data['total'];
            if ($_SESSION['access_level1']<3) {
                print ('<li role="presentation" class="active"><a href="add_member.php">New Member</a></li>');    
            } 
            
            print ('<li role="presentation"><a href="home.php">Manage Members</a></li>');
            
            if ($_SESSION['access_level1']<2)
            {
                print('<li role="presentation" ><a href="manage_admin.php">Manage Admin</a></li>') ;
                print('<li role="presentation" ><a href="manage_package.php">Package & Offers</a></li>') ;
            }

            print ('<li role="presentation"><a href="birthday.php">Birthday <span class="badge">'.$birthday.'</span></a></li>');
            ?>
            <button class="btn btn-primary pull-right btn-sm" type="button" onclick="window.location='index.php';">Logout</button>
        </ul>
    </div>




<!-- HTML code for form -->
    <form role="form" id="new_member_form" name="new_member_form" class="form-horizontal" method="post" action="inserter.php" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_form" />
        <br>

        <div class="form-group">

            <label for="Name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-3">
                <input type="text" id="Name" name="Name" class="form-control" placeholder="Enter Name" required>
            </div>

            <label for="DOB" class="col-sm-1 control-label">DOB</label>
            <div class="col-sm-2">
                <input type="text" id="DOB" name="DOB" class="form-control" placeholder="Date Of Birth">
            </div>

            <label for="DOJ" class="col-sm-1 control-label">DOJ</label>
            <div class="col-sm-2">
                <input type="text" id="DOJ" name="DOJ" class="form-control" placeholder="Joining Date">
            </div>

        </div>

        <div class="form-group">
            <label for="Gender" class="col-sm-2 control-label">Gender</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" id="Gender" name="Gender" value="Male">Male</label>
                <label class="radio-inline">
                    <input type="radio" id="Gender" name="Gender" value="Female">Female</label>
                <!-- <label class="radio-inline">
                    <input type="radio" id="Gender" name="Gender" value="Transgender">Transgender</label> -->
            </div>
        </div>

        <div class="form-group">
            <label for="Marital_Status" class="col-sm-2 control-label">Marital_Status</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" id="Marital_Status" name="Marital_Status" value="Married">Married</label>
                <label class="radio-inline">
                    <input type="radio" id="Marital_Status" name="Marital_Status" value="Unmarried">Unmarried</label>
            </div>
        </div>

        <div class="form-group">
            <label for="Height" class="col-sm-2 control-label">Height</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="Height" name="Height" placeholder="In CM" max="999">
            </div>
            <label for="Weight" class="col-sm-1 control-label">Weight</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="Weight" name="Weight" placeholder="In KG" max="999">
            </div>
        </div>

        <div class="form-group">
            <label for="Occupation" class="col-sm-2 control-label">Occupation</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Occupation" name="Occupation" placeholder="Enter Occupation">
            </div>
        </div>

        <div class="form-group">
            <label for="Address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Address">
            </div>
        </div>

        <div class="form-group">
            <label for="Contact" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="Contact" name="Contact" placeholder="Enter Contact No." max="9999999999" required>
            </div>
        </div>

        <div class="form-group">
            <label for="Email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter Email id">
            </div>
        </div>

        <div class="form-group">
            <label for="Emergency_Contact" class="col-sm-2 control-label">Emergency_Contact</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="Emergency_Name" name="Emergency_Name" placeholder="Contact Name">
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="Emergency_Contact" name="Emergency_Contact" placeholder="Emergency_Contact No." max="9999999999">
            </div>
        </div>

        <div class="form-group">
            <label for="Form_No" class="col-sm-2 control-label">Form_No</label>
            <div class="col-sm-2">
                <input type="number" id="Form_No" class="form-control" name="Form_No" placeholder="Enter Form No.">
            </div>
        </div>

        <div class="form-group">
            <label for="filename" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-2">
                <input type="file"  name="fileToUpload" id="fileToUpload">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" id="btn-create" class="btn btn-primary">Create Member</button>
            </div>
        </div>
    </form>


<!-- Modal to Confirm the details entered by the user -->
    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <big><b>Are you sure you want to submit the following details?</b></big>

                    <!-- We display the details entered by the user here -->
                    <table class="table">
                                                <tr>
                            <th>Name:</th>
                            <td id="Name1"></td>
                        </tr>
                        <tr>
                            <th>DOB:</th>
                            <td id="DOB1"></td>
                        </tr>
                        <tr>
                            <th>DOJ:</th>
                            <td id="DOJ1"></td>
                        </tr>

                        <tr>
                            <th>Gender:</th>
                            <td id="Gender1"></td>
                        </tr>
                        <tr>
                            <th>Marital Status:</th>
                            <td id="Marital_Status1"></td>
                        </tr>
                        <tr>
                            <th>Height:</th>
                            <td id="Height1"></td>
                        </tr>
                        <tr>
                            <th>Weight:</th>
                            <td id="Weight1"></td>
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
                        <tr>
                            <th>Emergency_Contact:</th>
                            <td id="Emergency_Contact1"></td>
                        </tr>
                        <tr>
                            <th>Form_No:</th>
                            <td id="Form_No1"></td>
                        </tr>

                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="submit" name="submit" class="btn btn-success success">Submit</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
	

        $(function() {
            

            $('#DOB').datepicker();

            $('#DOJ').datepicker();

            $('#submit').click(function() {
                /* when the submit button in the modal is clicked, submit the form */
                $('#new_member_form').submit();
            });

            $('#btn-create').click(function() {
                /* When form is submitted,displays the entered values in the modal */
           
                $('#Name1').html($('#Name').val());
                $('#DOB1').html($('#DOB').val());
                $('#DOJ1').html($('#DOJ').val());
                $('#Gender1').html($("input[name=Gender]:checked").val());
                $('#Marital_Status1').html($("input[name=Marital_Status]:checked").val());
                $('#Height1').html($('#Height').val());
                $('#Weight1').html($('#Weight').val());
                $('#Occupation1').html($('#Occupation').val());
                $('#Address1').html($('#Address').val());
                $('#Contact1').html($('#Contact').val());
                $('#Email1').html($('#Email').val());
                $('#Emergency_Name1').html($('#Emergency_Name').val());
                $('#Emergency_Contact1').html($('#Emergency_Contact').val());
                $('#Form_No1').html($('#Form_No').val());
                $('#confirm-submit').modal('show');

            });
        });
    </script>

</body>

</html>