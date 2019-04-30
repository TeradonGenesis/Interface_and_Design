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
<form name="formLogin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="formLogin" novalidate>
<table>
	<tr>
		<th><label for="username">Username:</label></th>
		<td><input type="text" name="username" id="username"/></td>
	</tr>
	
	<tr>
		<th><label for="password">Password:</label></th>
		<td><input type="password" name="password" id="password"/></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type="submit" name="login" value="Login"/></td>
	</tr>
</table>
<p>If you don't have an account, <a href="register.php">register here</a>.</p>
</form>
<?php 
require ('config.php');
$conn = new PDO($dsn, $username, $password, $options);

session_start();
if (isset($_SESSION["login"])) {
	$_SESSION["login"] = false;
	session_destroy();
}
	
if (isset($_POST["login"])) {
	$cfmUser = $_POST["username"];
	$cfmPass = md5($_POST["password"]);

	$sql = "SELECT username,password,memberID FROM members WHERE username = ? AND password = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$cfmUser,$cfmPass]);
	$memberID = $statement->fetch();
	$_SESSION["ID"] = $memberID["memberID"];

    if ($statement->rowCount() > 0) {
		$_SESSION["login"] = true;
		$_SESSION["user"] = $_POST["username"];
		header('Location:'.'index.php');
	}
	
	else {
		echo "Username/Password do not match";
	}
}
?>


</body>
</html>