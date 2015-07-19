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


    $package_name = $_POST['package_name'];
    $amount = $_POST['amount'];
    $duration = $_POST['duration'];
    $s_date = $_POST['s_date'];

    $dt1 = DateTime::createFromFormat('m/d/Y', $s_date);
    $s_date = $dt1->format('Y-m-d');


    if ($duration<12 && $package_name=='B_') {
      $package_name=$package_name.'MONTH_'.$duration;
      $duration= $duration*30;
    } elseif ($duration>12 && $package_name=='B_') {
      $t=($duration/12);

      $package_name=$package_name.'YEAR_'.$t;
      $duration= $t*365;
    } 
    else{
      $package_name=$package_name.$duration;      
      $duration= $duration*30;
    }
    
    mysqli_query($connection,"insert into packages (p_name,p_amount,p_duration,p_wef,p_status) values('$package_name','$amount','$duration','$s_date','ACTIVE')") or die(mysqli_error());
  
  
  header("Location:manage_package.php");
?>
</body>
</html>