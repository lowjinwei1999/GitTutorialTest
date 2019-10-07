<?php
	session_start();

	include("config.php");

	$sql = "SELECT userID,password FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	if ($user==$row["userID"] && $pword==$row["password"]) {
	    		echo '<script type="text/javascript">
			    alert("Login successful.");
			    </script>';
	    	}
	    	else{
	    		echo '<script type="text/javascript">
			    alert("Failed to login, please try again.");
				window.location.href = "index.html"
			    </script>';
	    	}
	    	break;
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