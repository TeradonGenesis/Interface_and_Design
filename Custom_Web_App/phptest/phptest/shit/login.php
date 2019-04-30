<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
?>
<title>Register</title>
</head>
<body>
<?php
navmember(); 
?>
<form name="formLogin" method="post" action="" class="formReg">
<table>
	<tr>
		<th><label for="username">Username:</label></th>
		<td><input type="text" name="username" id="username"/></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['username']; } ?>"/></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['email']; } ?>"/></td>
	<tr>
	
	<tr>
		<th><label for="password">Password:</label></th>
		<td><input type="password" name="password" id="password"/></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type="submit" name="login" value="login"/></td>
	</tr>
</table>
</form>
<?php 
require('config.php');
$conn = new PDO($dsn,$username,$password,$options);

if(isset($_GET["action"])) {
	switch($_GET["action"]) {
        case 'active':
            echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
            break;
        case 'reset':
            echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
            break;
        case 'resetAccount':
            echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
            break;
    }
}

public function login($username,$password) {
	$row = $this->get_user_hash($username);
	
	if($this->password_verify($password,$row["password"]) == 1) {
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $_ROW["username"];
		$_SESSION["memberID"] = $_ROW["memberID"];
		return true;
	}
}

if(isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if ($user->login($username,$password) {
		header("Location: index.php");
		exit;
	}
} else {
	$error[] = 'Wrong username or password or your account has not been activated.';
}

</body>
</html>