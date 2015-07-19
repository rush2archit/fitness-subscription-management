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
    ?>
  </title>
</head>
<body>


  <!-- File does the insertion 2 times: at creation of customer,at upgrading package individually  -->
  <?php
require_once('db/db_config.php');

if (empty($_GET['redirect'])) {
    $redirect = "NULL";
} else {
    $redirect = $_GET['redirect'];
    
}

if (empty($_POST['pending_amount'])) {
    $pending_amount = $package = "NULL";
} else {
    $pending_amount = $_POST['pending_amount'];
    $package        = $_GET['package'];
}



if (empty($_POST['b_package'])) {
    $b_package1 = $b_amount1 = $b_date1 = "NULL";
} else {
    $b_package1 = $_POST['b_package'];
    $b_amount1  = $_POST['b_amount'];
    $b_date1    = $_POST['b_date'];
}

if (empty($_POST['t_package'])) {
    $t_package1 = $t_amount1 = $t_date1 = "NULL";
} else {
    $t_package1 = $_POST['t_package'];
    $t_amount1  = $_POST['t_amount'];
    $t_date1    = $_POST['t_date'];
}

if (empty($_POST['d_package'])) {
    $d_package1 = $d_amount1 = $d_date1 = "NULL";
} else {
    $d_package1 = $_POST['d_package'];
    $d_amount1  = $_POST['d_amount'];
    $d_date1    = $_POST['d_date'];
}

$id = $_GET['member_id'];



// query to insert data into db
if ($b_package1 != "NULL") {
    
    // query to fetch no. of days to insert end date in tables
    $sql = mysqli_query($connection, "select * from packages where package_id = '$b_package1' ");
    while ($row = mysqli_fetch_array($sql)) {
        $b_duration = $row['p_duration'];
        echo "<br>" . $b_duration . "<br>";
    }
    
    $dt      = DateTime::createFromFormat('m/d/Y', $b_date1);
    $b_date1 = $dt->format('Y-m-d');
    
    $query = mysqli_query($connection, "insert into basic_package (member_id,package_id,start_date,end_date,paid) values('$id','$b_package1','$b_date1',DATE_ADD('$b_date1',INTERVAL $b_duration DAY),'$b_amount1')") or die(mysqli_error());
    
}


if ($t_package1 != "NULL") {
    
    // query to fetch no. of days to insert end date in tables
    $sql1 = mysqli_query($connection, "select * from packages where package_id = '$t_package1' ");
    while ($row1 = mysqli_fetch_array($sql1)) {
        $t_duration = $row1['p_duration'];
    }
    
    $dt1     = DateTime::createFromFormat('m/d/Y', $t_date1);
    $t_date1 = $dt1->format('Y-m-d');
    
    $query1 = mysqli_query($connection, "insert into training_package (member_id,package_id,start_date,end_date,paid) values('$id','$t_package1','$t_date1',DATE_ADD('$t_date1',INTERVAL $t_duration DAY),'$t_amount1')") or die(mysqli_error());
}


if ($d_package1 != "NULL") {
    // query to fetch no. of days to insert end date in tables
    $sql2 = mysqli_query($connection, "select * from packages where package_id = '$d_package1' ");
    while ($row2 = mysqli_fetch_array($sql2)) {
        $d_duration = $row2['p_duration'];
    }
    
    
    $dt2     = DateTime::createFromFormat('m/d/Y', $d_date1);
    $d_date1 = $dt2->format('Y-m-d');
    
    $query2 = mysqli_query($connection, "insert into diet_package (member_id,package_id,start_date,end_date,paid) values('$id','$d_package1','$d_date1',DATE_ADD('$d_date1',INTERVAL $d_duration DAY),'$d_amount1')") or die(mysqli_error());
}


/*Code to update amount deposited by a customer*/
if ($package != "NULL") {
     switch ($package) {
        case "basic":
            mysqli_query($connection, "UPDATE basic_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
            break;

        case "training":
            mysqli_query($connection, "UPDATE training_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
            break;

        case "diet":
            mysqli_query($connection, "UPDATE diet_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
            break;

        default:
            echo "inside swithc default";
            break;
    }
}
if ($redirect=='no') {
    echo  "<script type='text/javascript'>";
    echo "window.opener.location.reload();";
echo "window.close();";
echo "</script>";
} else {
    header("Location: home.php");
}


?>
</body>
</html>