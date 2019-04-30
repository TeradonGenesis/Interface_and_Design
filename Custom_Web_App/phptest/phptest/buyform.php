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

<form name="formBuy" action="confirmbuy.php" method="post" onsubmit ="return validateForm()">
	<table>
		<tr>
			<th><label for="name">Name:</label></th>
			<td><input name="fname" type="text" id="name" size="20"/></td>
		</tr>
		
		<tr>
			<th>Product Selected:</th>
			<td><input name="product-selected" readOnly="true"/></td>
		</tr>
		
		<tr>
			<th>Price:</th>
			<td><input name="product-price" readOnly="true"/></td>
		</tr>
		
		<tr>
			<th>Quantity:</th>
			<td><input name="product-quantity" type="number" min="1" max="5"/></td>
		</tr>
	</table>
	
	<input name="submit-btn" type="submit"/>
	<input name="reset-btn " type="reset"/>
</form>
	
<script src="buyform.js" type="text/javascript"></script>
<script src="buyvalidate.js" type="text/javascript"></script>
</body>
<footer>
</footer>
</html>