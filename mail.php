<?php
echo $email = $_POST['email'];
echo $message = $_POST['message'];

mail($email, "Greetings", $message);
?>