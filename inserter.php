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

  $Name1  =$_POST['Name'];
  $DOB1   =$_POST['DOB'];
  $DOJ1   =$_POST['DOJ'];
  $Gender1=$_POST['Gender'];
  $Height1=$_POST['Height'];
  $Weight1=$_POST['Weight'];

  $Address1=$_POST['Address'];
  $Contact1=$_POST['Contact'];
  $Email1  =$_POST['Email'];
  $Form_No1=$_POST['Form_No'];

  $Occupation1       =$_POST['Occupation'];
  $Marital_Status1   =$_POST['Marital_Status'];
  $Emergency_Name1   =$_POST['Emergency_Name'];
  $Emergency_Contact1=$_POST['Emergency_Contact'];


  $dt = DateTime::createFromFormat('m/d/Y', $DOB1);
  $DOB1 = $dt->format('Y-m-d');

  $dt1 = DateTime::createFromFormat('m/d/Y', $DOJ1);
  $DOJ1 = $dt1->format('Y-m-d');


          /*  echo $Name1  ;
            echo $DOB1   ;
            echo $DOJ1   ;
            echo $Gender1;
            echo $Height1;
            echo $Weight1;
            
            echo $Address1;
            echo $Contact1;
            echo $Email1  ;
            echo $Form_No1;

            echo $Occupation1       ;
            echo $Marital_Status1   ;
            echo $Emergency_Name1   ;
            echo $Emergency_Contact1;
           */ 

            
//query to insert data into db
            $query = mysql_query("insert into member_info (name,dob,doj,gender,m_status,height,weight,occupation,address,contact,email,e_name,e_contact,form_no) values ('$Name1','$DOB1','$DOJ1','$Gender1','$Marital_Status1','$Height1','$Weight1','$Occupation1','$Address1','$Contact1','$Email1','$Emergency_Name1','$Emergency_Contact1','$Form_No1') ") or die(mysql_error());


//query to fetch UID to link with user image
            $sql=mysql_query("select * from member_info where name like '$Name1' and contact like '$Contact1'");
            while($row=mysql_fetch_array($sql))
            {
              $member_id=$row['member_id'];
          }






//code for image uploading to server        
          $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
          $target_dir = "images/";
          $target_file = $target_dir . basename($member_id.".".$ext);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);






// Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


$img = $_FILES["fileToUpload"]["tmp_name"];
$dst = $target_dir . $_FILES['photoimg']['name'];


$width = $check[0];
$height = $check[1];

switch ($check[2]) {
  case IMAGETYPE_GIF  : $src = imagecreatefromgif($img);  break;
  case IMAGETYPE_JPEG : $src = imagecreatefromjpeg($img); break;
  case IMAGETYPE_PNG  : $src = imagecreatefrompng($img);  break;
  default : die("Unknown filetype");
}

$tmp = imagecreatetruecolor($width, $height);
imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $width, $height);
imagejpeg($tmp, $dst.".jpg");

// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }


// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";


// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $member_id.".".$ext). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    header("Location: add_package.php?id=$member_id");
    ?>
</body>
</html>