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
$nl="<br/>";
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
$result = $conn->query($sql);
$comando= "select * from azienda where Nome='$_SESSION[user]' ";
$result = $conn->query($comando);
$dati = $result->fetch_assoc();
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

    <br>
    <div class="col-sm-offset-2 col-sm-8">
      <div class="well well-lg">
        <h4>Modifica i tuoi dati</h4>
      	 <form  method="post" name="registra" action="registraModificaW.php" id="registra">
	<table width="300" >
			<tr>
				<td> Categoria </td> <td> <input type="text" id="categoria" name="categoria" value='<?php echo $dati["Categoria"]; ?>' > </td>
			</tr>
			<tr>
				<td> Paese</td> <td> <input type="text" id="paese" name="paese" value='<?php echo $dati["paese"]; ?>'> </td>
			</tr>			
			<tr>
				<td> Iva</td> <td> <input type="text" id="iva" name="iva" value='<?php echo $dati["Partita_iva"]; ?>'> </td>
			</tr>
			<tr>
				<td> Sito</td> <td><input type="text" id="sito" name="sito" value='<?php echo $dati["sito_web"]; ?>' > </td>
			</tr>
			<tr>
				<td> Citta</td> <td><input type="text" id="citta" name="citta" value='<?php echo $dati["citta"]; ?>' > </td>
			</tr>
			<tr>
				<td> Mail</td> <td><input type="text" id="mail" name="mail" value='<?php echo $dati["mail"]; ?>' > </td>
			</tr>
			<tr>
				<td> Telefono</td> <td><input type="text" id="telefono" name="telefono"  value='<?php echo $dati["telefono"]; ?>' > </td>
			</tr>
	     	<tr>
			<td height="100"><input id="aggiorna" value="AGGIORNA" type="submit" name="aggiorna"></td>
	    	</tr>
	</table>
</form>
    
<?php 
if( isset($_GET['errore']) )
{
	echo "<p id='box_errore'"."style='background-color: black; color: white; font-weight: bold;'>";
	switch ($_GET['errore'])
	{
	case 1:
		echo "Numero di telefono non valido";
		break;
		
	case 2:
		echo "Mail non valida";
		break;
		}
}
?> 
<br/> <p style="text-align: right"><a href='bootstrapNoMenu.php'><button> Indietro </button></a></p>
  </div>
</div>

</body>
</html>

</body>
</html>

