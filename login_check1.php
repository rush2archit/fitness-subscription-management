<?php

session_start();


require_once ('db/db_config.php');


$username=$_POST['username'];
$password=$_POST['password'];

$numberofrows=0;
/*using prepared statements to prevent sql injection*/
$db = new mysqli($dbhost, $dbusername, $dbpassword,$dbname);
$stmt = $db->prepare(" select admin_id,name,access_level,count(*) from admin_credentials where username = ? AND password = ?");
$stmt->bind_param('ss',$username ,$password );
$stmt->execute();




      /* Bind results */
      $stmt -> bind_result($ID,$name,$access_level,$count);

      /* Fetch the value */
      $stmt -> fetch();
  

//fetch admin id from db 

	 $_SESSION['ID1'] = stripslashes(htmlspecialchars($ID));
	 $_SESSION['name1'] = stripslashes(htmlspecialchars($name));
	 $_SESSION['access_level1'] = stripslashes(htmlspecialchars($access_level));

	
$stmt->close();
if($count>0){
	/*echo "id=".$ID."&name=".$name."&access_level=".$access_level;*/
echo json_encode(array('success' => 'true'));
}
else {
	/*returning the data back to the calling ajax function in index.php*/

echo json_encode(array('success' => 'error'));
}


?>
	