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
session_start();

if (isset($_POST["confirm-btn"])) {
	require "config.php";

	try {
		$connection = new PDO($dsn, $username, $password,$options);
		// insert new user code will go here

	} catch(Exception $error) {
		echo $error->getMessage();
		echo '</br><a href="index.php">Back to homepage></a>';
	}
	
}


$userdata = array (
	$username = $_SESSION["user"],
	$product = $_POST["product"],
	$price = $_POST["price"],
	$quantity = $_POST["quantity"],
	$total = $_POST["total"]
);

	
/*$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"Buy",
		implode(", ", array_keys($userdata)),
		":" . implode(", :", array_keys($userdata))
);

$statement = $connection->prepare($sql);
$statement->execute($userdata);*/

$user = "INSERT INTO Buy (username, product, price_each, quantity, totalPrice) VALUES('$username','$product','$price','$quantity','$total')";
$connection->exec($user);
?>

<html>
<body>
<h1>Buy Successful</h1>
<p><a href="index.php">Back to homepage</a></p>
</body>
</html>
