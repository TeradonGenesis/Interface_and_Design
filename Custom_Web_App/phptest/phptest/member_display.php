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
<h1>View VIP</h1>
<?php
require 'config.php';
try {
    $conn = new PDO($dsn, $username, $password,$options);
	$sql = "SELECT member_id, fname, lname FROM vip";
    $statement = $conn->prepare("SELECT member_id, fname, lname FROM vip"); 
    $statement->execute();

    // set the resulting array to associative
    $result = $statement->fetch(PDO::FETCH_ASSOC);?>
	<table>
		<tr>
			<th>ID</th>
			<th>First name</th>
			<th>Last name</th>
		</tr>
		<?php foreach ($conn->query($sql) as $user) {?>
		<tr>
			<td><?php echo $user['member_id'] . "\n";?></td>
			<td><?php echo $user['fname'] . "\n";?></td>
			<td><?php echo $user['lname'] . "\n";?></td>
		</tr>
<?php	} 

	}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>