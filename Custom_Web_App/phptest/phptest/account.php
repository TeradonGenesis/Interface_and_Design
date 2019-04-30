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

$countries = array("","Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>
<form name="formAccount" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="formAccount" enctype="multipart/form-data">
<?php 
if(isset($_POST["submit-btn"])) {
	echo "<p>Info Updated!</p>";
}

if(isset($_POST["submit-btn"])) {
	$sql = "UPDATE profile SET name=:name, age=:age, interest=:interest, email=:email, phone=:phone, about=:about, country=:country WHERE username=:username";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":name",$_POST["profile-name"]);
	$statement->bindParam(":email",$_POST["profile-email"]);
	$statement->bindParam(":phone",$_POST["profile-number"]);
	$statement->bindParam(":age",$_POST["profile-age"]);
	$statement->bindParam(":interest",$_POST["profile-interest"]);
	$statement->bindParam(":about",$_POST["profile-about"]);
	$statement->bindParam(":country",$_POST["profile-country"]);
	$statement->bindParam(":username",$_SESSION["user"]);
	$statement->execute();
}

if(isset($_FILES["profile-avatar"])) {
	$userProfile = $_SESSION["user"];
	$sql = "SELECT avatar FROM profile where username = ?";
	$statement = $conn->prepare($sql);
	$statement->execute([$_SESSION["user"]]);
	$_SESSION["avatar"] = $statement->fetch();

	$filename = $_SESSION["avatar"]["avatar"];
	
	echo "cibai";
	$folder="phptest/";
	$errors= array();
	$file_name = $_FILES["profile-avatar"]['name'];
	$file_size = $_FILES["profile-avatar"]['size'];
	$file_tmp = $_FILES["profile-avatar"]['tmp_name'];
	$file_type = $_FILES["profile-avatar"]['type'];
	
	
	if(isset($_POST["avatarRemove"])) {
		$file_name="pic2.png";
	}

	if($file_size > 2097152) {
	 $errors[]='File size must be excately 2 MB';
	}

	if(empty($errors)==true) {
	 move_uploaded_file($file_tmp,$file_name);
	 echo "Success";
	}else{
	 print_r($errors);
	}
	if($file_name == "") {
		$file_name = $_SESSION["profile"]["avatar"];
	}

	$sql = "UPDATE profile SET avatar=:avatar WHERE username=:username";
	$statement = $conn->prepare($sql);
	$statement->bindParam(":avatar",$file_name);
	$statement->bindParam(":username",$_SESSION["user"]);
	$statement->execute();
}

$userProfile = $_SESSION["user"];
$sql = "SELECT name,email,phone,age,interest,about,country,avatar FROM profile where username = ?";
$statement = $conn->prepare($sql);
$statement->execute([$userProfile]);
$_SESSION["profile"] = $statement->fetch();
?>
<div class="details">
	<div class="profile-pic">	
		<?php if($_SESSION["profile"]["avatar"] == "") {?>
			<img src="pic2.png"/>
		<?php } ?>
		<?php echo "<img src='".$_SESSION["profile"]["avatar"]."'/>";?>
		<p><label for="avatarChange" class="avatarChange">Change your profile picture</label></p>
		<input type="checkbox" id="avatarChange"/> 
		<input type="submit" name="avatarRemove" class="avatarRemove" value="Remove your profile picture" />
		<input type="file" name="profile-avatar" class="avatar"/> 
	</div>
</div>

<div class="details">
	<p><label for="profile-name">Nickname</label></p>
	<input name="profile-name" type="text" id="profile-name" size="20" value="<?php echo $_SESSION["profile"]['name'] ?>" />
	
	<p><label for="profile-age">Age</label></p>
	<input name="profile-age" type="number" id="profile-age" value="<?php echo $_SESSION["profile"]['age'] ?>"/>
	
	<p><label for="profile-interest">Interests</label></p>
	<input name="profile-interest" type="text" id="profile-interest" size="50" value="<?php echo $_SESSION["profile"]['interest'] ?>"/>
	
	<p><label for="profile-email">Email</label></p>
	<input name="profile-email" type="email" id="profile-email" value="<?php echo $_SESSION["profile"]['email'] ?>" />
	
	<p><label for="profile-number">Phone</label></p>
	<input name="profile-number" type="number" id="profile-number" value="<?php echo $_SESSION["profile"]['phone']?>" />
	
	<p>Country</p>
	<select name="profile-country">
		<?php foreach ($countries as $key) {?>
			<option value="<?php echo $key ?>" <?php if($key==$_SESSION["profile"]["country"]) {echo "selected";}?>><?php echo $key?></option>
		<?php } ?>
	</select>
</div>

<div class="details2">
	<p><label for="profile-about">About Yourself</label></p>
	<textarea name="profile-about" id="profile-about" cols="100" rows="20"/><?php echo $_SESSION["profile"]['about'] ?></textarea>
</div>
<input name="submit-btn" type="submit"/>
</form>

<?php 

?>

</form>
</body>
</html>

	