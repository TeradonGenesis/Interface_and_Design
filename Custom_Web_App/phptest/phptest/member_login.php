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
<h1>Member Login</h1>
<form name="formLogin" method="post" action="member_login.php">
	<p><label for="memberId">ID: </label><input type="text" name="memId" id="memberId"/></p>
	<p><label for="lastname">Last Name: </label><input type="text" name="lname" id="lastname"/></p>
	<input type="submit" name="submit-btn"/>
</form>
</body>
<?php 
require 'config.php';

$conn = new PDO($dsn,$username,$password,$options);

if (isset($_POST["submit-btn"])) {
	$memId = "%{$_POST["memId"]}%";
	$lname = "%{$_POST["lname"]}%";

	$sql = "SELECT member_id,fname, lname, email FROM vip WHERE member_id LIKE ? and lname LIKE ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$memId,$lname]);
	?>
	<table>
	<tr>
		<th>ID</th>
		<th>First name</th>
		<th>Last name</th>
		<th>E-Mail</th>
	</tr>
	<?php 
	while ($user = $statement->fetch(PDO::FETCH_ASSOC)) {?>
	<tr>
		<td><?php echo $user['member_id']?></td>  
		<td><?php echo $user['fname']?></td>
		<td><?php echo $user['lname'] ?></td>
		<td><?php echo $user['email']?></td>
	</tr>
	<?php 
	}
}
?>
	</table>
</html>