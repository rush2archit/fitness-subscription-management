<html>
<head>
  <title>
    <?php
    session_start();
    if(!isset($_SESSION['name1']))
    {
      header("Location: index.php");
    }
    if ($_SESSION['access_level1']>1) {
          header( "Location: home.php");  
        }
    ?>
  </title>
</head>
<body>

  <?php
  require_once ('db/db_config.php');

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
    mysqli_query($connection,"insert into admin_credentials (name,username,password,access_level) values('$name','$username','$password','$access_level')") or die(mysqli_error());
    break;

    case "update":
    mysqli_query($connection,"UPDATE admin_credentials SET password = '$password' , access_level = $access_level where admin_id = $admin_id ");
    break;

    default:
    echo "inside swithc default";
    break;
  }






  header("Location:manage_admin.php");
?>
</body>
</html>