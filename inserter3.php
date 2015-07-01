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

    $action = $_GET['action'];

    $name = $_POST['name'];
    $access_level = $_POST['access_level'];
    $username = $_POST['username'];
    $password = $_POST['password'];


  if (empty($_POST['admin_id'])) {
    $admin_id="NULL";
  } else {
    $admin_id = $_POST['admin_id'];
  }
  
  
  switch ($action) {
    case "new":
    mysql_query("insert into admin_credentials (name,username,password,access_level) values('$name','$username','$password','$access_level')") or die(mysql_error());
    break;

    case "update":
    mysql_query("UPDATE admin_credentials SET password = '$password' , access_level = $access_level where admin_id = $admin_id ");
    break;

    default:
    echo "inside swithc default";
    break;
  }






  header("Location:manage_admin.php");
?>
</body>
</html>