<?php 
require('config.php');
$conn = new PDO($dsn,$username,$password,$options);
//logout
$user->logout(); 
//logged in return to index page
header('Location: registration.php');
exit;
?>