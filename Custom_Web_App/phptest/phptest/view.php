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

$conn = new PDO($dsn,$username,$password,$options);

$sql = "SELECT product, price_each, quantity, totalPrice, date FROM Buy WHERE username = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["user"]]);
?>
<div class="tableView">
<table>
	<tr>
		<th>Product</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total Price</th>
		<th>Date Purchased</th>
		<th>Transaction ID</th>
		<th>Seller</th>
	</tr>
	
	<?php 
	while ($purchase = $statement->fetch()) { ?>
	<tr>
		<td><?php echo $purchase['product']?></td>
		<td><?php echo $purchase['price_each']?></td>
		<td><?php echo $purchase['quantity']?></td>
		<td><?php echo $purchase['totalPrice']?></td>
		<td><?php echo $purchase['date']?></td>
	<tr>
	<?php
	}
	?>
<?php 
$sql= "SELECT product, price_each, quantity, totalPrice, date,transID,usernameSeller FROM transaction WHERE usernameBuyer = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["user"]]);
while ($purchase = $statement->fetch()) { ?>
	<tr>
		<td><?php echo $purchase['product']?></td>
		<td><?php echo $purchase['price_each']?></td>
		<td><?php echo $purchase['quantity']?></td>
		<td><?php echo $purchase['totalPrice']?></td>
		<td><?php echo $purchase['date']?></td>
		<td><?php echo $purchase['transID']?></td>
		<td><?php echo $purchase["usernameSeller"]?></td>
	<tr>
	<?php
	}
	?>
</table>
</div>
</body>
</html>