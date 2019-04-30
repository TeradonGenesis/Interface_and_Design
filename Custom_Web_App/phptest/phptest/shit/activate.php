<?php
require('config.php');
$conn = new PDO($dsn,$username,$password,$options);

//collect values from the url
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
if(isnumeric($memberID) && !empty($active)) {
	$sql = "UPDATE members SET active = 'Yes' WHERE memberID LIKE ? AND active LIKE ?";
	$statement = $conn->prepare($sql);
	$statement->execute[$memberID,$active]);
}

//if row was updated redirect the user
if ($statement->rowCount() == 1) {
	//redirect to login page
	header("Location: login.php?action=active");
	exit;
}
?>
	
	
