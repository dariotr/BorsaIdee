<?php
session_start();
$nl="<br/>";
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BI";
$pass =$_POST['password']; 	$_SESSION['user']=$_POST['user']; 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM azienda where Nome='".$_SESSION['user']."'";
$result = $conn->query($sql);
$conn->close();
if($result->num_rows> 0)
header("location: bootstrapNoMenu.php");
else 
header("location: loginW.php");
exit;
 ?>
