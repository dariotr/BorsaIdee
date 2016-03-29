<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 100%}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
<?php
$categoria = $_REQUEST["categoria"];
$paese = $_REQUEST["paese"];
$iva = $_REQUEST["iva"];
$sito = $_REQUEST['sito'];
$citta = $_REQUEST["citta"];
$mail = $_REQUEST["mail"];
$telefono = $_REQUEST["telefono"];


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BI";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
function chkEmail($email)
{
	// elimino spazi, "a capo" e altro alle estremitˆ della stringa
	$email = trim($email);

	// se la stringa  vuota sicuramente non  una mail
	if(!$email) {
		return false;
	}

	// controllo che ci sia una sola @ nella stringa
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return false;
	}

	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return false;
	}

	// la stringa rispetta il formato classico di una mail?
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return false;
	}

	return true;
} 

$comando="update azienda set Categoria='$categoria',Partita_iva='$iva',sito_web='$sito', ".
		"paese='$paese',citta='$citta',mail='$mail',telefono='$telefono' ".
		"where nome='$_SESSION[user]'";


?>
<!-- sono classi predefinite, inverse vuol dire sfondo scuro
	quella di default  chiara -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
  <!-- questo  l header contiene gli elementi che devono essere visibili anche quando la barra  minimizzata per i display di piccole dimensioni -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        <span class="icon-bar"></span>   
        <!-- Ciascuno di questi disegna una lineetta sul pulsante quando si minimizza la pagina -->                     
      </button>
      <a class="navbar-brand">Borsa delle Idee</a>
    </div>
 <!--  elementi della barra -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="bootstrapNoMenu.php">Home</a></li>
        <li><a href="#">About</a></li>
         <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Idee <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Crea</a></li>
          <li><a href="#">Cerca</a></li>
        </ul>
      </li>
        <li><a href="#">Contatti</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
  	<div class="col-sm-offset-2 col-sm-8">
      <div class="well">
       
	
<?php 
if (!is_numeric($telefono)) {
echo "<h3>Errore!</h3><br>Deve inserire un numero valido<br>
La preghiamo di tornare  <a href='modificaW.php?errore=1'>indietro </a> e correggere. Grazie";
exit;
} 
if(!chkEmail($mail)) {
echo "<h3>Errore!</h3><br>Deve inserire una mail valida<br>
La preghiamo di tornare  <a href='modificaW.php?errore=2'>indietro </a> e correggere. Grazie";
exit;
}

if(!$conn->query($comando) ){
	echo "Errore aggiornamento";
	echo "<br/> <a href='modificaW.php'> Indietro </a>";
	}
	else {
	echo "<h4 style='text-align: center'>Aggiornamento effettuato! <h4>";
	}
	$conn->close();
?>

	</div
	</div>
</div>
</body>
</html>
