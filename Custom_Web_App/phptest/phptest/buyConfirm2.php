<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
?>
<title>Products</title>
</head>
<body>
<?php
navmember(); 
?>

<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header('Location: '. 'login.php');
}
?>
<?php 
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
	if($sales["quantity"] <= 0) {
		$sql = "DELETE FROM sell WHERE quantity <= 0";
		$statement2 = $conn->prepare($sql);
		$statement2->execute();
	}
unset($_SESSION["sellNo"]);
header('Location:'.'index.php');
?>
</body>
</html>