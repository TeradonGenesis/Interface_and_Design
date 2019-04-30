<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
?>
<title>Project Buy</title>
</head>
<body>
<?php
nav(); 
?>
 <?php
require('config.php'); 
$conn = new PDO($dsn, $username, $password,$options);
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php');}
?>

<h1>Member only page</h1>
<p><a href='logout.php'>Logout</a></p>
</body>
</html>