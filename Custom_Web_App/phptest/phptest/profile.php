<!DOCTYPe html>

<html lang="en">
<?php
include"header.php"; 
?>

<head>
<?php
	head(); 
?>
<title>Products</title>
</head>
<body>
<?php
navmember(); 
?>

<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header('Location: '. 'login.php');
}
?>

<h1>Account Info </h1>
<?php 
require 'config.php';

$conn = new PDO($dsn, $username, $password, $options);
?>

<?php 
$url = htmlspecialchars($_SERVER['REQUEST_URI']);
$parts = Explode('=', $url);
$id = $parts[count($parts)-1];
$sql = "SELECT name,email,phone,age,interest,about,country,avatar FROM profile where memberID = ?";
$statement = $conn->prepare($sql);
$statement->execute([$id]);
$_SESSION["profile"] = $statement->fetch();
echo $id;

$sql = "SELECT moderator from members WHERE username=?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["user"]]);
$moderator = $statement->fetch();
$makemod = 1;
$dltmod = 0;

if ($moderator[0]==2) {
	if($id!=1) {
		if(isset($_POST["btn-makemod"])) {
			$sql = "UPDATE members SET moderator=:moderator WHERE memberID=:memberID";
			$statement=$conn->prepare($sql);
			$statement->bindParam(":moderator",$makemod);
			$statement->bindParam(":memberID",$id);
			$statement->execute();
		}

		if(isset($_POST["btn-dltmod"])) {
			$sql = "UPDATE members SET moderator=:moderator WHERE memberID=:memberID";
			$statement=$conn->prepare($sql);
			$statement->bindParam(":moderator",$dltmod);
			$statement->bindParam(":memberID",$id);
			$statement->execute();
		}
	}
}
?>
<div class="formAccount">
<div class="details">
	<div class="profile-pic">
		<?php if($_SESSION["profile"]["avatar"] == "") {?>
			<img src="pic2.png"/>
		<?php } else echo "<img src='".$_SESSION["profile"]["avatar"]."'/>";?>
	</div>
</div>

<div class="details">
	<table>
		<tr>
			<th>Nickname</th>
			<td><?php echo $_SESSION["profile"]['name'] ?></td>
			<?php if ($moderator[0]==2) {
					if($id!=1) {
						?>
				<td>
					<form name="formEditMod" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'])?>">
						<input type="submit" name="btn-makemod" value="Make Moderator"/>
						<input type="submit" name="btn-dltmod" value="Remove Moderator"/>
					</form>
				</td>
			<?php }
			}			?>
		</tr>
		
		<tr>
			<th>Age</th>
			<td><?php echo $_SESSION["profile"]['age'] ?></td>
		</tr>
		
		<tr>
			<th>Interests</th>
			<td><?php echo $_SESSION["profile"]['interest'] ?></td>
		</tr>
		
		<tr>
			<th>Email</th>
			<td><?php echo $_SESSION["profile"]['email'] ?></td>
		</tr>

		<tr>
			<th>Phone</td>
			<td><?php echo $_SESSION["profile"]['phone']?></td>
		</tr>

		<tr>
			<th>Country</th>
			<td><?php echo $_SESSION["profile"]['country'] ?></td>
		</tr>
	</table>
</div>

<div class="details2">
	<table>
		<tr>
			<th>About Myself</th>
		</tr>
		
		<tr>	
			<td><?php echo $_SESSION["profile"]['about'] ?></td>
		</tr>
	</table>
</div>
</div>

<?php 

?>

</form>
</body>
</html>