<?php
session_start();
$user = $_POST['username'];
$pword = $_POST['pass'];

include("config.php");

$sql = "SELECT * FROM users WHERE userID='$user'AND password='$pword' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
    while($row = $result->fetch_assoc()) {
    	$_SESSION['user'] = $user;
    	echo '<script type="text/javascript">
		alert("Login successful.");
	    window.location.href = "users.php"
	    </script>';
   	}
}

else {
    echo '<script type="text/javascript">
    alert("Failed to login, please try again.");
    window.location.href = "index.html"
    </script>';
}
$conn->close();

?>