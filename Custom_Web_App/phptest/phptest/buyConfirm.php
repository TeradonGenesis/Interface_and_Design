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

<h1>Confirm Buy</h1>
<?php 
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
?>

<?php 
if(!isset($_SESSION["sellNo"])) {
	header('Location:'.'index.php');
}

if(isset($_POST["confirm-btn"])) {
	$_SESSION["buy"] = true;
	
	$sql = "SELECT money FROM members WHERE username = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$_SESSION["user"]]);
	$money = $statement->fetch();
	
	if($money["money"] < $_POST["total"]) {
		unset($_SESSION["buy"]);
	}

	
	if(isset($_SESSION["buy"])) {
		$sql="INSERT into transaction (memberID,sellNo,usernameBuyer, usernameSeller, product, price_each, quantity, totalPrice) VALUES (:memberID,:sellNo,:usernameBuyer, :usernameSeller, :product, :price_each, :quantity, :totalPrice)";
		$statement = $conn->prepare($sql);
		$statement->bindParam(":memberID",$_SESSION["ID"]);
		$statement->bindParam(":sellNo",$_SESSION["sellNo"]);
		$statement->bindParam(":usernameBuyer",$_SESSION["user"]);
		$statement->bindParam(":usernameSeller",$_POST["usernameSeller"]);
		$statement->bindParam(":product",$_POST["product"]);
		$statement->bindParam(":price_each",$_POST["price_each"]);
		$statement->bindParam(":quantity",$_POST["quantity"]);
		$statement->bindParam(":totalPrice",$_POST["total"]);
		$statement->execute();
		
		$moneyLeft = $money["money"] - $_POST["total"];
		$sql = "UPDATE members SET money = :money WHERE username = :username";
		$statement = $conn->prepare($sql);
		$statement->bindParam(":money",$moneyLeft);
		$statement->bindParam(":username",$_SESSION["user"]);
		$statement->execute();
		
		$sql = "SELECT money FROM members WHERE username = ?";
		$statement = $conn->prepare($sql);
		$statement->execute([$_POST["usernameSeller"]]);
		$money = $statement->fetch();
		
		$moneyGain = $money["money"] + $_POST["total"];
		$sql = "UPDATE members SET money = :money WHERE username = :username";
		$statement = $conn->prepare($sql);
		$statement->bindParam(":money",$moneyGain);
		$statement->bindParam(":username",$_POST["usernameSeller"]);
		$statement->execute();
		
		$sql = "SELECT quantity FROM sell WHERE sellNo = ?";
		$statement = $conn->prepare($sql);
		$statement->execute([$_SESSION["sellNo"]]);
		$quantity = $statement->fetch();
		
		$quantityLeft = $quantity["quantity"] - $_POST["quantity"];
		$sql = "UPDATE sell SET quantity = :quantity WHERE sellNo = :sellNo";
		$statement = $conn->prepare($sql);
		$statement->bindParam(":quantity",$quantityLeft);
		$statement->bindParam(":sellNo",$_SESSION["sellNo"]);
		$statement->execute();
		
		echo "<script>alert('Purchase successful')</script>";
		
	}
		
	else {
		echo "<script>alert('You do not have enough money for this product')</script>";
	}
echo "<script>window.location = 'buyConfirm2.php';</script>";
}

else {
$quantity = $_POST["quantity"];
$_SESSION["sellNo"] = $_POST["sellNo"];

$sql = "SELECT salespic,product,price_each,date,username,description FROM sell WHERE sellNo = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["sellNo"]]);

while($item = $statement->fetch()) {
	$total = $item["price_each"] * $quantity;
?>

<form name="confirmForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return moneyValidate()" >
	<table>
		<tr>
			<th><label for="name">Seller name:</label></th>
			<td><input type="text" name="usernameSeller" value="<?php echo $item["username"] ?>" readonly /></td>
		</tr>
		
		<tr>
			<th>Product Selected:</th>
			<td><input type="text" name="product" value="<?php echo $item["product"] ?>" readonly /></td>
		</tr>
		
		<tr>
			<th>Price:</th>
			<td><input type="text" name="price_each" value="<?php echo $item["price_each"]?>" readonly /></td>
		</tr>
		
		<tr>
			<th>Quantity:</th>
			<td><input type="text" name="quantity" value="<?php echo $quantity ?>" readonly /></td>
		</tr>
		
		<tr>
			<th>Total Price:</th>
			<td><input type="text" name="total" value="<?php echo $total ?>" readonly /></td>
		</tr>
	</table>

	<input name="confirm-btn" type="submit" value="Confirm"/>
	<input name="cancel-btn " type="reset" value="Cancel"/>
</form>
<?php } }?>
</body>
</html>