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
<h1>Add VIP</h1>
<form name="formAddVip" method="post" onsubmit ="return validateVIP()" action="member_add_form.php" novalidate>
	<table>
		<tr>
			<th><label for="fname">First Name:</label></th>
			<td><input name="fname" type="text" id="fname" size="20"/></td>
		</tr>

		<tr>
			<th><label for="lname">Last Name:</label></th>
			<td><input name="lname" type="text" id="lname" size="20"/></td>
		</tr>
		
		<tr>
			<th>Gender:</th>
			<td><label for="male">Male</label>
				<input name="gender" type="radio" id="male" value="M" checked />
				<label for="female">Female</label>
				<input name="gender" type="radio" id="female" value="F"/></td>
		</tr>
		
		<tr>
			<th><label for="email">E-Mail:</label></th>
			<td><input type="email" name="vipmail" id="email"/></td>
		</tr>
		
		<tr>
			<th><label for="phoneno">Phone:</label></th>
			<td><input name="phone" type="text" id="phoneno" maxlength="10"/></td>
		</tr>
	</table>
	
	<input name="submit-btn" type="submit"/>
	<input name="reset-btn " type="reset"/>
</form>
<?php
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);

if (isset($_POST["submit-btn"])) {
$new_vip = array(
	"fname" => $_POST['fname'],
	"lname"  => $_POST['lname'],
	"gender"     => $_POST['gender'],
	"email"     => $_POST['vipmail'],
	"phone"		=> $_POST['phone']
);

$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"vip",
		implode(", ", array_keys($new_vip)),
		":" . implode(", :", array_keys($new_vip))
);
$statement = $conn->prepare($sql);
$statement->execute($new_vip);
}

?>
<script src="buyvalidate.js" type="text/javascript"></script>
</body>
</html>