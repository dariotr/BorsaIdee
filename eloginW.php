<?php
session_start();
$nl="<br/>";
include_once 'configurazioneDB.php';
$pass =$_POST['password']; 	$_SESSION['user']=$_POST['user']; 
$sql = "SELECT * FROM azienda where Nome='".$_SESSION['user']."'";
$result = $conn->query($sql);
$conn->close();
if($result->num_rows> 0)
// se la connessione va a buon fine, ho pi rows e quindi reinderizzo la pagina al Menu
header("location: Menu.php");
else 
// altrimenti un altra volta al login
header("location: loginW.php");
exit;
 ?>
