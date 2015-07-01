<html>
<head>
  <title>
    <?php
    session_start();
    if(!isset($_SESSION['name1']))
    {
      header("Location: index.php");
    }
    ?>
  </title>
</head>
<body>

  <?php
  $dbhost = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "tgym";

  $connection = mysql_connect($dbhost, $dbusername, $dbpassword) or die('Could not connect');
  $db = mysql_select_db($dbname);

  if (empty($_POST['pending_amount'])) {
    $pending_amount=$package="NULL";
  } else {
    $pending_amount = $_POST['pending_amount'];
  $package = $_GET['package'];
  
  }
  
  
  
  if (empty($_POST['b_package'])) {
    $b_package1=$b_amount1=$b_date1="NULL";
  }
  else {
    $b_package1 = $_POST['b_package'];
    $b_amount1 = $_POST['b_amount'];
    $b_date1 = $_POST['b_date'];

   // echo $b_package1.$b_date1.$b_amount1;
  }
  
  if (empty($_POST['t_package'])) {
    $t_package1=$t_amount1=$t_date1="NULL";
  }
  else {
    $t_package1 = $_POST['t_package'];
    $t_amount1 = $_POST['t_amount'];
    $t_date1 = $_POST['t_date'];
  }
  

  if (empty($_POST['d_package'])) {
    $d_package1=$d_amount1=$d_date1="NULL";
  }
  else {
   $d_package1 = $_POST['d_package'];
   $d_amount1 = $_POST['d_amount'];
   $d_date1 = $_POST['d_date'];
 }

 $id = $_GET['member_id'];
// echo "id=".$id."<br>";

//echo "<br>".$b_package1."<br>";


// query to fetch no. of days to insert end date in tables
$sql = mysql_query("select * from packages where package_id = '$b_package1' ");
//echo "select * from packages where package_id = '$b_package1' ";
while ($row = mysql_fetch_array($sql))
{
  $b_duration = $row['p_duration'];
  echo "<br>".$b_duration."<br>";
}

$sql1 = mysql_query("select * from packages where package_id = '$t_package1' ");
while ($row1 = mysql_fetch_array($sql1))
{
  $t_duration = $row1['p_duration'];
}

$sql2 = mysql_query("select * from packages where package_id = '$d_package1' ");
while ($row2 = mysql_fetch_array($sql2))
{
  $d_duration = $row2['p_duration'];
}


// query to insert data into db
if ($b_package1 != "NULL")
{
  $dt = DateTime::createFromFormat('m/d/Y', $b_date1);
  $b_date1 = $dt->format('Y-m-d');

  $query = mysql_query("insert into basic_package (member_id,package_id,start_date,end_date,paid) values('$id','$b_package1','$b_date1',DATE_ADD('$b_date1',INTERVAL $b_duration DAY),'$b_amount1')") or die(mysql_error());
  
}


if ($t_package1 != "NULL")
{
  $dt1 = DateTime::createFromFormat('m/d/Y', $t_date1);
  $t_date1 = $dt1->format('Y-m-d');

  $query1 = mysql_query("insert into training_package (member_id,package_id,start_date,end_date,paid) values('$id','$t_package1','$t_date1',DATE_ADD('$t_date1',INTERVAL $t_duration DAY),'$t_amount1')") or die(mysql_error());
}


if ($d_package1 != "NULL")
{
  $dt2 = DateTime::createFromFormat('m/d/Y', $d_date1);
  $d_date1 = $dt2->format('Y-m-d');

  $query2 = mysql_query("insert into diet_package (member_id,package_id,start_date,end_date,paid) values('$id','$d_package1','$d_date1',DATE_ADD('$d_date1',INTERVAL $d_duration DAY),'$d_amount1')") or die(mysql_error());
}

if ($package != "NULL")
{
  echo "inside if";
  switch ($package) {
    case "basic":
    mysql_query("UPDATE basic_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
    echo "UPDATE basic_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date";
    echo "inside swithc basic";

    break;
    case "training":
    mysql_query("UPDATE training_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
    echo "inside swithc training";
    
    break;
    case "diet":
    mysql_query("UPDATE diet_package SET paid = paid+$pending_amount where member_id = $id and current_date between start_date and end_date");
    echo "inside swithc diet";
    
    break;
    default:
    echo "inside swithc default";
    break;
  }
}





//            header("Location: add_package.php?id=$member_id");*/
?>
</body>
</html>