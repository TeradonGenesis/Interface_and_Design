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
<h1>Search VIP</h1>
<form name="formSearch" method="post" action="member_search.php">
	<input type="text" name="searchvip"/>
	<input type="submit" name="submit-btn"/>
</form>
</body>
<?php 
require 'config.php';

$conn = new PDO($dsn,$username,$password,$options);

if (isset($_POST["submit-btn"])) {
	$search = "%{$_POST['searchvip']}%";
	/*$search = $_POST["searchvip"];*/
	$sql = "SELECT member_id, fname, lname, gender, email, phone FROM vip WHERE fname LIKE ? OR lname LIKE ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$search,$search]);
	?>
	<table>
	<tr>
		<th>ID</th>
		<th>First name</th>
		<th>Last name</th>
		<th>Gender</th>
		<th>E-Mail</th>
		<th>Phone</th>
	</tr>
	<?php 
	while ($user = $statement->fetch()) {?>
	<tr>
		<td><?php echo $user['member_id']?></td>  
		<td><?php echo $user['fname']?></td>
		<td><?php echo $user['lname'] ?></td>
		<td><?php echo $user['gender']?></td>
		<td><?php echo $user['email']?></td>
		<td><?php echo $user['phone']?></td>
	</tr>
	<?php 
	}
}
?>
	</table>
</html>