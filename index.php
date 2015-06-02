<!DOCTYPE html>
<html>
<head>
  <!-- This is for loading external scripts -->
  <title>Tushar's Gym</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

 <script type="text/javascript">
 $(document).ready(function(){
  $("#login").click(function(){
    var username = $("#username").val();
    var password = $("#password").val();
    
    // Returns successful data submission message when the entered information is stored in database.
    var dataString = 'username='+ username + '&password='+ password ;
    if(username==''||password=='')
    {
      alert("Please Fill All Fields");
    }
    else
    {
        // AJAX Code To Submit Form.
        $.ajax({
            type: "POST",
            url: "login_check1.php",
            data: dataString,
            cache: false,
            success: function(result){
              if(result=='error'){
                alert('Invalid Credentials'); //this is the error you are looking for
                }else{
                  var details= 'home.php?'+result;
                   //window.location.href=details;
                   window.location.href='home.php';
                }
             
              }
              });
        }
        return false;
        });
        });
 </script>


</head>
<body>

<div class="row">
</div>
  <div id="myDiv" >
    <div class="container" >
      <div class="row">
        <div class="col-sm-3" >
         
           <br><br><br><br><br><br><br>  
          <a href="#" class="thumbnail">
          <img src="ic_launcher-web.png" alt="icon">
          </a></div>
          
          <div class="col-sm-1" >
          </div>
          
          <div class="col-sm-4" >
            <div class="page-header" >
              <br><br><br><br>
              <h1><b>Tushar's Gym<b><h1>
              </div>
              <br>
              <!--
              <form role="form"  action="login_check.php" method="POST"> -->
                <div class="form-group">
                  <label >USERNAME</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" >
                </div>
                <div class="form-group">
                  <label >PASSWORD</label>
                  <input type="password" class="form-control" id="password" name= "password"placeholder="Password" >
                </div>
                <button type="button" class="btn btn-primary" id="login" name="login">Login</button>
                
              <!--</form>-->
              
            </div>
            <div class="col-sm-4" ></div>
          </div>
        </div>
      </div>
    </body>
    </html>
        

