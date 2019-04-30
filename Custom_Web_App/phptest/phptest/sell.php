<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
?>
<title>Sell</title>
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

<h1>Put On Sale</h1>

<?php
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
?>


<?php
if(isset($_FILES["salespic"]['name'])) {
	$file_name = $_FILES["salespic"]['name'];
	$file_size = $_FILES["salespic"]['size'];
	$file_tmp = $_FILES["salespic"]['tmp_name'];
	$file_type = $_FILES["salespic"]['type'];
	
	if($file_name == "") {
		$file_name = "pic0.png";
	}
	move_uploaded_file($file_tmp,$file_name);
}
	
if(isset($_POST["submit-btn"])) {
	echo "Product added!";
	$product_name = $_POST["product-name"];
	$product_price = $_POST["product-price"];
	$product_quantity = $_POST["product-quantity"];
	$product_desc = $_POST["product-desc"];
	
	$sql = "INSERT INTO sell(username,product,description,price_each,quantity,salespic) VALUES(:username,:product,:description,:price_each,:quantity,:salespic)";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":username",$_SESSION["user"]);
	$statement->bindParam(":product",$product_name);
	$statement->bindParam(":description",$product_desc);
	$statement->bindParam(":price_each",$product_price);
	$statement->bindParam(":quantity",$product_quantity);
	$statement->bindParam(":salespic",$file_name);
	$statement->execute();
}

?>

<form name="formSell" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
	<img src="pic0.png"/>
	<p>Add sales picture</p>
	<input type="file" name="salespic" class="salesPic"/>
	
	<p><label for="product-name">Product</label></p>
	<input name="product-name" type="text" id="product-name" size="20"/>

	<p><label for="product-price">Price</label></p>
	<input name="product-price" type="number" id="product-price"/>

	<p><label for="product-quantity">Quantity</label></p>
	<input name="product-quantity" type="number" id="product-quantity"/>

	<p><label for="product-desc">Description</label></p>
	<textarea id="product-desc" rows="20" cols="80" name="product-desc"></textarea>
	
	<p><input type="submit" name="submit-btn" value="Put on sale"/></p>
</form>
</body>
</html>