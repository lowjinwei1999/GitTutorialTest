<!DOCTYPE html>
<?php
include("config.php");

$userID="";
$firstName="";
$lastName="";
$password="";
$race="";
$nationality="";

if(isset($_GET['edit'])){
	$userID=$_GET['edit'];

	$sql = "SELECT userID,firstName,lastName,password,race,nationality FROM users where userID='$userID'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
		$userID=$row["userID"];
		$firstName=$row['firstName'];
		$lastName=$row["lastName"];
		$password=$row["password"];
		$race=$row["race"];
		$nationality=$row["nationality"];

		}
	}
}
?>

<html>
<head>

<style>
table, th, td {
	border: 1px solid black;
}
</style>
</head>
<body>

<?php echo "<img src='uploads/".$userID.".jpg' height=100 width=100>" ?><br>
<form name="form1" method="post" action="users.php" enctype="multipart/form-data">
	<input type="file" name="file"><br>
	<input name="id" type="text" placeholder="User ID" value="<?php echo $userID; ?>"/><br/>
	<input name="firstName" type="text" placeholder="First Name" value="<?php echo $firstName; ?>"/><br/>
	<input name="lastName" type="text" placeholder="Last Name" value="<?php echo $lastName; ?>"/><br/>
	<input name="password" type="password" placeholder="Password" value="<?php echo $password; ?>"/><br/>
	<select name="race">
		<option value="">Select your race</option>
		<option value="Malay" <?php if($race=='Malay'){echo "selected";}?> >Malay</option>
		<option value="Chinese" <?php if($race=='Chinese'){echo "selected";}?> >Chinese</option>
		<option value="Indian" <?php if($race=='Indian'){echo "selected";}?> >Indian</option>
		<option value="Others" <?php if($race=='Others'){echo "selected";}?> >Others</option>
	</select><br><br>
	<input type="checkbox" name="nationality" value="Malaysian" <?php if($nationality=='Malaysian'){echo "checked";}?> >Malaysian<br>
	<br>
	<input name="submit" type="submit" value="submit">
	<input type="submit" name="edit" value="edit">
</form>
</body>
</html>