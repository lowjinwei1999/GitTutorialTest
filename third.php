<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register yo acc bro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	
	<div id="outmostcontainer">
		<div id="outercontainer">
			<div id="formcontainer">
				<div class="image-container">
					<img src="bg-01.jpg">
					<div class="after">
						<span>
								REGISTER
						</span>
					</div>
				</div>
				
				<form method="POST">
					<div validate-input m-b-26" data-validate="Username is required" id="username">
						<span id="usernametext">Username</span>
						<input type="text" name="username" placeholder="Enter username" id="username-input" required>
						<span></span>
					</div>

					<div data-validate = "Password is required">
						<span id="passwordtext">Password</span>
						<input type="password" name="pass" placeholder="Enter password" id="password-input" required>
						<span></span>
					</div>

					<div data-validate = "First name is required">
						<span id="fnametxt">First Name</span>
						<input type="text" name="firstName" placeholder="Eg: Lil" id="fname-input" required>
						<span></span>
					</div>

					<div data-validate = "Last name is required">
						<span id="lnametxt">Last Name</span>
						<input type="text" name="lastName" placeholder="Eg: Pump" id="lname-input" required>
						<span></span>
					</div>

					<div>
						<button id="reg-button">
							Register
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>
</html>

<style type="text/css">
	body{
		margin: 0;
	}

	form{
		font-family: arial;
		margin: 5% 10% 5% 10%;
		position: absolute;
	}

	#outercontainer{
		width: 100%;
		height: 700px;
		margin: 4% 0 4% 0;
		background-color: silver;
	}

	#formcontainer{
		width: 600px;
		height: 500px;
		background-color: #efefef;
		border: solid 0px;
		border-radius: 10px;
		position: absolute;
		margin: 7% 30% 7% 30%;
	}

	#header{
		width: 100%;
		height: 160px;
		color: white;
		text-align: center;
		line-height: 160px;
		font-family: arial;
		font-style: bold;
		font-size: 40px;
		border-top: solid 0px;
		border-bottom: none;
		border-radius: 10px;
	}

	#usernametext,#passwordtext,#fnametxt,#lnametxt{
		display: inline-block;
		width: 100px;
		font-size: 15px;
	}

	#username-input,#password-input,#fname-input,#lname-input{
		display: inline-block;
		width: 350px;
		height: 40px;
		border: none;
		border-bottom: solid 2px;
		background-color: #efefef;
		border-color: #666666;
	}

	#password-input,#fname-input,#lname-input{
		margin-top: 2%;
	}

	

	#reg-button{
		padding: 10px 40px 10px 40px;
		border-radius: 20px;
		border: solid 0px;
		color: white;
		background-color: #0ab226;
		margin-top: 8%;
		margin-left: 22%;
	}
	img{
		border-top: solid 0px;
		border-bottom: none;
		border-radius: 10px;
		width: 100%;
	}

	.image-container {
		position: relative;
	    width: 100%;
	    height: 160px;
	}

	.image-container .after {
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    display: block;
	    background: rgba(56, 73, 99, 0.7);
	    color: white;
		text-align: center;
		line-height: 160px;
		font-family: arial;
		font-style: bold;
		font-size: 40px;
		border-top: solid 0px;
		border-bottom: none;
		border-radius: 10px;
	}
</style>


<?php
	session_start();

	$user = $_POST['username'];
	$pword = $_POST['pass'];
	$first = $_POST['firstName'];
	$last = $_POST['lastName'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "newdemo";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO users (firstname, lastname, userID, password)
	VALUES ('$first', '$last', '$user', '$pword');";

	if ($conn->multi_query($sql) === TRUE) {
	    echo '<script type="text/javascript">
	    alert("Account registered successfully.");
	    window.location.href = "index.html"
	    </script>';
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>