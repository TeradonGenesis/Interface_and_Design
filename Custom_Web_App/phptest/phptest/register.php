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
<?php 
session_start();
if(!isset($_SESSION["nameError"])) {
	$_SESSION["nameError"] = "";
	$_SESSION["mailError"] = "";
	$_SESSION["confirmError"] = "";
	$_SESSION["passError"] = "";
}
?>
<form name="formReg" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="formReg" novalidate>
<table>
	<tr>
		<th><label for="username">Username:</label></th>
		<td><input type="text" name="username" id="username"/></td>
		<td><span class="error"><?php echo $_SESSION["nameError"];?></span></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['username']; } ?>"/></td>
	</tr>
	
	<tr>
		<th><label for="email">E-Mail:</label></th>
		<td><input type="email" name="email" id="email"/></td>
		<td><span class="error"><?php echo $_SESSION["mailError"];?></span></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['email']; } ?>"/></td>
	<tr>
	
	<tr>
		<th><label for="password">Password:</label></th>
		<td><input type="password" name="password" id="password"/></td>
		<td><span class="error"><?php echo $_SESSION["passError"];?></span></td>
	</tr>
	
	<tr> 
		<th><label for="passwordConfirm">Confirm Password:</label></th>
		<td><input type="password" name="passwordConfirm" id="passwordConfirm"/></td>
		<td><span class="error"><?php echo $_SESSION["confirmError"];?></span></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type="submit" name="register" value="Register"/></td>
		<td><input type="reset" name="reset" value="Reset"/></td>
	</tr>
</table>
<p>If you have an account, <a href="login.php">login here</a>.</p>
</form>
<?php
require ('config.php');
$conn = new PDO($dsn, $username, $password, $options);
if(isset($_POST["register"])) {
	$value = false;
	$validate = validate($value);
	
	if ($validate == false) {
		header('Location:'.'register.php');
		exit();
	}
	
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = md5($_POST["password"]);
	
	$validate2 = validate2($conn,$username,$email);
	if ($validate2 == false) {
		header('Location:'.'register.php');
		exit();
	}
	
	$sql = "INSERT INTO members (username, password, email) VALUES (:username, :password, :email)";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":username",$username);
	$statement->bindParam(":password",$password);
	$statement->bindParam(":email",$email);
	$statement->execute();
	
	$sql = "INSERT INTO profile (username) VALUES (:username)";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":username",$username);
	$statement->execute();
}

function validate($value) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$passwordConfirm = $_POST["passwordConfirm"];
	$available = true;
	
	$patternSpecial = '/^[a-zA-Z0-9]{5,}$/';
	
	if ($username == "") {
		$_SESSION["nameError"] =  "Username must be filled out" ;
        $username = false;
	}
	
	else if (!preg_match($patternSpecial,$username)) {
		$_SESSION["nameError"] = "Username cannot consist of special characters";
		$username = false;
	}
		
	if ($password == "") {
		$_SESSION["passError"] = "Password must be filled out";
        $password = false;
	}
	
	if (strlen($password) < 5) {
		$_SESSION["passError"] =  "Password must be at least 5 characters long";
		$password = false;
	}
	
	if ($email == "") {
		$_SESSION["mailError"] = "Please enter email";
        $email = false;
	}
	
	else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$_SESSION["mailError"] = "Please fill in valid email";
		$email = false;
	}
	
	if ($passwordConfirm != $password) {
		$_SESSION["confirmError"] = "Passwords to do not match";
		$passwordConfirm = false;
	}
	
	if(($username && $password && $email && $passwordConfirm) == false) {
		return false;
	}

	else {
		return true;
	}
}

function validate2($conn,$username,$email) {
	$sql = "SELECT username FROM members WHERE username = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$username]);
	$userAvai = $statement->rowCount();
	if ($userAvai > 0) {
		$_SESSION["nameError"] = "Username already taken.";
		$username = false;
	}
	
	$sql = "SELECT email FROM members WHERE email = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$email]);
	$emailAvai = $statement->rowCount();
	if ($emailAvai > 0) {
		$_SESSION["mailError"] = "Email is already taken";
		$email = false;
	}
	
	if(($username && $email) == false) {
		return false;
	}
	
	else {
		return true;
	}
}
	
session_destroy();
?>
<script src="memValidate.js" type="text/javascript"></script>
</body>
</html>