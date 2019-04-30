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

<section class="productGroup">
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="first1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
	
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="second1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
	
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="third1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
	
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="fourth1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
	
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="fifth1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
	
	<div class="batch1">
		<img src="images/product_test.jpg" alt="productlogo"/></a>
		<p><a href="buyform.php"><button type="button" class="btn-product"  id="sixth1" onclick="product1(this.id)">Buy</button></a></p>
	</div>
</section>

<script src="buyform.js" type="text/javascript"></script>
</body>
<footer>
</footer>
</html>