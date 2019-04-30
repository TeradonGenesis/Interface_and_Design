<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
	navmember();
?>
<title>Home</title>
</head>
<body>
<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header('Location: '. 'login.php');
}
?>

<h1>HOME</h1>
<?php
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);

if(isset($_SESSION["login"])) {
$sql = "SELECT money from members WHERE username=?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["user"]]);
$money = $statement->fetch();

echo "<h2>You have RM".$money["money"].".</h2>";
}
?>
</body>
<footer>
</footer>
</html>