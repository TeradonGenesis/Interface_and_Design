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

<h1>Forums </h1>
<?php 
require 'config.php';
$conn = new PDO($dsn,$username,$password,$options);
?>


<form name="formForum" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="formForum">
<?php 
		
if (isset($_POST["delete-go"])) {
	$postID = $_POST["postID"];
	$reason = $_POST["delete-reason"];
	$postDelete = "<p>This post has been deleted by a moderator.</p><p>Reason: ".$reason."</p>";
	$sql = "UPDATE forum SET post = '" . $postDelete . "'WHERE postID = '$postID' ";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}
if(isset($_POST["submit-btn"])) {
	$sql = "INSERT INTO forum (memberID,name,post) VALUES (:memberID,:name,:post)";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":memberID",$_SESSION["ID"]);
	$statement->bindParam(":name",$_SESSION["user"]);
	$statement->bindParam(":post",$_POST["forumPost"]);
	$statement->execute();
}

$sql = "SELECT moderator from members WHERE username=?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION["user"]]);
$moderator = $statement->fetch();

$sql = "SELECT memberID,postID,name,post,date FROM forum";
$statement = $conn->prepare($sql);
$statement->execute();

?>
	<table class="forumTable">
	<?php while($posts = $statement->fetch()) {?>
		<tr>
			<td><a href="profile.php?id=<?php echo $posts["memberID"]?>"><?php echo $posts["name"]?></a></td>
			<td class="comment"><?php echo $posts["post"]?></td>
			<td><?php echo $posts["date"];?></td>
			<?php if ($moderator[0] > 0) {?>
				<td>
					<?php echo "<form action='forum.php' method='post' name='deleteForm' class='deleteForm'>
					<label for='delete-check".$posts["postID"]."'>Delete</label>
					<input type='checkbox' name='delete-check' value='delete' class='delete-check' id='delete-check".$posts["postID"]."'/>
					<input type='text' name='delete-reason' placeholder='Reason' class='delete-reason'/>
					<input type='submit' name='delete-go' class='delete-go' value='Delete'/>
					<input type='hidden' name='postID' value='".$posts["postID"]."'/>
					</form>";
					}
				?></td>
		</tr>
	<?php } ?>
	</table>
	
	<div class="forumPost"><textarea name="forumPost" cols="100" rows="20"></textarea></div>
	<div class="submit-btn"><input name="submit-btn" type="submit"/></div>
</form>
</body>
</html>