<?php

require "config.php";
require "init.sql";

try {
	$conn = new PDO("mysql:host=$servername", $username, $password, $options);
	$sql = file_get_contents("init.sql");
	$conn->exec($sql);
	echo "Database created successfully<br>";
}	catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>
