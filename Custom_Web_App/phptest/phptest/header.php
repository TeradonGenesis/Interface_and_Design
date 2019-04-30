<?php 
function nav() {
	echo '<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="products.php">Products</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="vip.php">VIP</a></li>
		<li><a href="register.php">Register</a></li>
	</ul>
</nav>';
}

function head() {
	echo '<meta charset="UTF-8"/>
	<meta name="author" content="Marc Chai"/>
	<link rel="stylesheet" href="styles.css"/>';
}

function navmember() {
	echo '<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="marketplace.php">Marketplace</a></li>
			<li class="dropdown">
				<a href="#">Options</a>
				<ul class="dropdown-content">
					<li><a href="account.php">Account</a></li>
					<li><a href="sell.php">Sell Your Items</a></li>
					<li><a href="view.php">View Purchases</a></li>
					<li><a href="login.php">Logout</a></li>
				</ul>
			</li>
			<li><a href="forum.php">Forums</a></li>
		</ul>
	</nav>';
}
?>