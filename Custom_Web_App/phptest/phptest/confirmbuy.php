<?php 
$fname = $_POST["fname"];
$product = $_POST["product-selected"];
$price = $_POST["product-price"];
$quantity = $_POST["product-quantity"];
$total = $price * $quantity;
?>

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


<form name="confirmForm" action="buysuccess.php" method="post">
	<table>
		<tr>
			<th><label for="name">Name:</label></th>
			<td><?php echo "$fname" ?></td>
		</tr>
		
		<tr>
			<th>Product Selected:</th>
			<td><?php echo "$product" ?></td>
		</tr>
		
		<tr>
			<th>Price:</th>
			<td><?php echo "$price" ?></td>
		</tr>
		
		<tr>
			<th>Quantity:</th>
			<td><?php echo "$quantity" ?></td>
		</tr>
		
		<tr>
			<th>Total Price:</th>
			<td><?php echo "$total" ?></td>
		</tr>
	</table>
	
	<input type="hidden" name="name" value="<?php echo $_POST['fname']; ?>">
	<input type="hidden" name="product" value="<?php echo $_POST['product-selected']; ?>">
	<input type="hidden" name="price" value="<?php echo $_POST['product-price']; ?>">
	<input type="hidden" name="quantity" value="<?php echo $_POST['product-quantity']; ?>">
	<input type="hidden" name="total" value="<?php echo $total ?>">
	
	<input name="confirm-btn" type="submit" value="Confirm"/>
	<input name="cancel-btn " type="reset" value="Cancel"/>
</form>

<script src="buyform.js" type="text/javascript"></script>
</body>
<footer>
</footer>
</html>