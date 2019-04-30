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

<h1>Item</h1>
<?php 
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
?>

<?php 
$url = htmlspecialchars($_SERVER['REQUEST_URI']);
$parts = Explode('=', $url);
$sellNo = $parts[count($parts)-1];

$sql = "SELECT salespic,product,price_each,quantity,date,username,description,sellNo FROM sell WHERE sellNo = ?";
$statement = $conn->prepare($sql);
$statement->execute([$sellNo]);

while($item = $statement->fetch()) {
	$productName = "%{$item["product"]}%";
?>
<form name="buyItem" method="post" action="buyConfirm.php">
<div class="product-container">
	<div class="item-holder">
		<table>
			<tr>
				<td><div class="item-holder-img"><img src="<?php echo $item["salespic"]?>"/></div></td>
			</tr>
		</table>
	</div>
	
	<div class="item-holder">	
		<table>
			<tr>
				<th class="item-holder-details"><?php echo $item["product"]?></th>
			</tr>
			
			<tr>
				<td class="item-holder-details">Price: <?php echo $item["price_each"]?></td>
			</tr>
			
			<tr>	
				<td><?php echo $item["quantity"]?></td>
			</tr>
			
			<tr>
				<td class="item-holder-details">Date posted: <?php echo $item["date"]?></td>
			</tr>
	
			<tr>
				<td>Description</td>
			</tr>
			
			<tr>
				<td><textarea rows="10" cols="60" name="description" readonly><?php echo $item["description"]?></textarea></td>
			</tr>
			
			<tr>
				<td>Posted by: <?php echo $item["username"]?></td>
			</tr>
			
			<tr>
				<td><label for="quantityCheck">Buy</label></td>
			</tr>
			
			<tr>
				<input type="checkbox" name="quantitycheck" id="quantityCheck"/>
				<td class="item-holder-details quantityCheck">Select Quantity: <input type="number" name="quantity" max="<?php echo $item["quantity"]?>" min="1" onkeydown="this.value = validateMax(<?php echo $item["quantity"]?>)" onkeyup="this.value = validateMax(<?php echo $item["quantity"]?>)"/></td>
			</tr>
						
			<tr>
				<td><input type="hidden" name="sellNo" value="<?php echo $item["sellNo"]?>"/></td>
			</tr>
			
			<tr>
				<td><input type="submit" name="submit-btn" value="Buy" class="item-submit"/></td>
			</tr>
			
		</table>
	</div>
</div>
</form>
<?php } 
function error_found(){
	  header("Location: marketplace.php");
}
set_error_handler('error_found');?>

<h2>Related products</h2>
<?php 
$sql = "SELECT sellNo,product,price_each,salespic FROM sell WHERE product LIKE ?";
$statement = $conn -> prepare($sql);
$statement->execute([$productName]);

while($related = $statement->fetch()) {
	$_SESSION["sellNo"] = $related["sellNo"]; 
?>
<div class="related-products">
	<a href="item.php?product=<?php echo $related["sellNo"]?>"><div class="related-products-image"><img src="<?php echo $related["salespic"]?>"/></div>
	<p><?php echo $related["product"]?></p>
	<?php echo $related["price_each"]?>
</div></a>
<?php } ?>
<script src="buyvalidate.js"></script>
</body>
</html>