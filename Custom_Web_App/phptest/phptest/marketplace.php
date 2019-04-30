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

<h1>Marketplace</h1>
<?php 
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
?>

<?php 
$sql = "SELECT salespic,product,price_each,quantity,date,sellNo FROM sell";
$statement = $conn->prepare($sql);
$statement->execute();

while($sales = $statement->fetch()) {
?>
<div class="product-container">
	<div class="product-holder">
		<table>
			<tr>
				<td><div class="product-holder-img"><img src="<?php echo $sales['salespic']?>"/></div></td>
			</tr>
		</table>
	</div>

	<div class="product-holder">
		<table>
			<tr>
				<th class="product-holder-details"><?php echo $sales["product"]?></th>
			</tr>
			
			<tr>
				<td class="product-holder-details">Price: <?php echo $sales["price_each"]?></td>
			</tr>
			
			<tr>	
				<td class="product-holder-details">Quantity: <?php echo $sales["quantity"]?></td>
			</tr>
			
			<tr>
				<td class="product-holder-details">Date posted: <?php echo $sales["date"]?></td>
			</tr>
			
			<tr>
				<td class="product-holder-details"><a href="item.php?product=<?php echo $sales['sellNo']?>">See more information</a></td>
			</tr>
		</table>
	</div>
</div>
<?php } ?>
</body>
</html>

			
