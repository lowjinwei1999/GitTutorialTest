<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
        function deleteConfirm(){
            return confirm("Do you want to delete the selected users?");
        }
    </script>

    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<?php
session_start();
if (isset($_GET['user'])) {
    if ($_GET['user']=="logout") {
        session_destroy();
        echo '<script type="text/javascript">
        alert("Logout successfully.");
        window.location.href = "index.html"
        </script>';
    }
}

if($_SESSION['user']==""){
    echo '<script type="text/javascript">
    window.location.href = "index.html";
    </script>';
}

echo "Welcome! ".$_SESSION['user'];

include("config.php");

if (isset($_POST['id'])){
    $id=$_POST['id'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $password=$_POST['password'];
    $race=$_POST["race"];

    if (isset($_POST["nationality"])) {
        $nationality=$_POST["nationality"];
    }
    else if (empty($_POST["nationality"])) {
        $nationality="Non-Malaysian";        
    }
    $sql="INSERT INTO users VALUES ('$id','$password','$firstName','$lastName','$race','nationality')";

    $result = $conn->query($sql);
}

if(isset($_POST['edit'])){
$userID=$_POST['id'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$password=$_POST['password'];
$race=$_POST["race"];
    if (isset($_POST["nationality"])) {
        $nationality=$_POST["nationality"];
    }
    else if (empty($_POST["nationality"])) {
        $nationality="Non-Malaysian";        
    }

include("upload.php");

$sql="UPDATE users SET firstName='$firstName',lastName='$lastName',password='$password',race='$race', nationality='$nationality' where userID='$userID'"; // update SQL
$result = $conn->query($sql);
}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from users where userID='$id'";
    $result = $conn->query($sql);
}

//Delete multiple item
if(empty($_REQUEST['item'])){
    //No item seleceted
}
else{
    foreach ($_REQUEST['item'] as $deleteName) {
        $sql="DELETE FROM users WHERE userID='$deleteName'";
        $result = $conn->query($sql);
    }
}

$sql = "SELECT userID,firstName,lastName,race,nationality FROM users";
$sql2 = "SELECT a.ID, a.Description, a.OrderDate, a.CustomerID, b.firstName, b.lastName FROM ProductOrder AS a LEFT JOIN users AS b ON a.CustomerID = b.userID";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

if(isset($_POST['search'])){
    $search=$_POST['search'];
    $sql="SELECT userID,firstName,lastName,race,nationality FROM users WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%' OR userID LIKE '%$search%'";
    $result = $conn->query($sql);
}
?>

<form method="post" action="users.php">
    <input type="text" name="search" placeholder="Search">
    <input type="submit" name="searchbtn" value="Search">
</form><br>

<?php
if ($result->num_rows > 0) {
    echo "<form name='userform' method='post' action='users.php'><table>
    <tr><th></th><th>Image</th><th>ID</th><th>First Name</th><th>Last Name</th><th>Race</th><th>Nationality</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td><input type='checkbox' name='item[]' value='".$row["userID"]."'></td>
            <td><img src='uploads/".$row["userID"].".jpg' height=100 width=100></td>
            <td>" . $row["userID"]. "</td>
            <td>" . $row["firstName"]. "</td>
            <td>" . $row["lastName"]."</td>
            <td>" . $row["race"]."</td><td>" . $row["nationality"]."</td>
            <td><a href='users.php?id=".$row["userID"]."'>Delete</a>"."</td>
            <td><a href='insertUsers.php?edit=".$row["userID"]."'>Edit</a>"."</td>
        </tr>";
    }
    echo "</table><br><input type=\"submit\" onclick=\"return deleteConfirm()\" value=\"Delete\"></form><br>";
} else {
    echo "0 results <br>";
}

if ($result2->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Description</th><th>Order Date</th><th>Customer ID</th><th>First Name</th><th>Last Name</th></tr>";
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Description"]. "</td><td>" . $row["OrderDate"]."</td><td>" . $row["CustomerID"]. "</td><td>" . $row["firstName"]. "</td><td>" . $row["lastName"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<button name="logout" onclick="window.location.href='users.php?user=logout'" style="margin-top: 20px;">
    Logout
</button>

</body>
</html>
