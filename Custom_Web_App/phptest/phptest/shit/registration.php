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
<form name="formReg" method="post" action="" class="formReg">
<table>
	<tr>
		<th><label for="username">Username:</label></th>
		<td><input type="text" name="username" id="username"/></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['username']; } ?>"/></td>
	</tr>
	
	<tr>
		<th><label for="email">E-Mail:</label></th>
		<td><input type="email" name="email" id="email"/></td>
	</tr>
	
	<tr>
		<td><input type="hidden" value="<?php if(isset($error)){ echo $_POST['email']; } ?>"/></td>
	<tr>
	
	<tr>
		<th><label for="password">Password:</label></th>
		<td><input type="password" name="password" id="password"/></td>
	</tr>
	
	<tr> 
		<th><label for="passwordConfirm">Confirm Password:</label></th>
		<td><input type="password" name="passwordConfirm" id="passwordConfirm"/></td>
	</tr>
	
	<tr>
		<td></td>
		<td><input type="submit" name="register" value="Register"/></td>
		<td><input type="reset" name="reset" value="Reset"/></td>
	</tr>
</table>
</form>
<?php
require ('config.php');
$conn = new PDO($dsn,$username,$password,$options);

define('DIR','http://domain.com/');
define('SITEEMAIL','noreply@domain.com');

include("user.php");

$user = new User($conn);

if($user->is_logged_in() ){ header('Location: index.php'); } 

if(isset($error)){
  foreach($error as $error){
    echo '<p class="bg-danger">'.$error.'</p>';
  }
}

if(isset($_GET['action']) && $_GET['action'] == 'joined'){
  echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
}

if(isset($_POST['register'])){
	if (strlen($_POST["username"]) < 3) {
		$error[] = "Username is too short";
	} else {
		$sql = "SELECT username FROM members where username LIKE ?";
		$statement = $conn->prepare($sql);
		$statement->execute([$_POST["username"]]);
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}
	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$error[] = 'Please enter a valid email address';
	} else {
		$sql = "SELECT email FROM members WHERE email LIKE ?";
		$statement = $conn->prepare($sql);
		$statement->execute([$_POST["email"]]);
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}     
	}

	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activation code
		$activasion = md5(uniqid(rand(),true));
	}
	
	$newMember = array(
		"username"  => $_POST['username'],
		"password"     => $_POST['password'],
		"email"     => $_POST['email'],
		"active"		=> $activasion
	);

	$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"members",
			implode(", ", array_keys($newMember)),
			":" . implode(", :", array_keys($newMember))
	);
	
	$statement = $conn->prepare($sql);
	$statement->execute($newMember);
	$id = $conn->lastInsertId('memberID');
	
	//mail activasion
	$to = $_POST["email"];
	$subject = "Registration Confirmed!";
	$body = "<p>Thank you for registering at demo site.</p><p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p><p>Regards Site Admin</p>";
	
	$mail = new Mail();
	$mail->setFrom(SITEEMAIL);
	$mail->addAddress($to);
	$mail->subject($subject);
	$mail->body($body);
	$mail->send();
	header('Location: index.php?action=joined');
	exit;
}
?>
</body>
</html>