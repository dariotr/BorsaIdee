<?php
session_start();
if( !isset($_SESSION['user']) )
	header("Location: loginW.php");
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
include_once 'configurazioneDB.php';
$sql = "SELECT * FROM azienda where Nome='".$_SESSION['user']."'";
$result = $conn->query($sql);
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
        <li class="active"><a href="Menu.php">Home</a></li>
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

<?php 
if( isset($_GET['modifica']) )
{
	echo "<p id='box_modifica'>";
	switch ($_GET['modifica'])
	{
	case 1:
		echo "<div class='alert alert-warning'>
    <strong>Success!</strong> Aggiornamento non riuscito!
  </div>";
		break;
		
	case 2:
		echo "<div class='alert alert-success'>
    <strong>Success!</strong> Aggiornamento riuscito!
  </div>";
		break;
		}
}
?>
  </div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Logo <img src="immagini\nala.jpg" width="150" height="80"> </h2>
     <div class="container"> 
     		<a href="modificaW.php" class="btn btn-info" role="button">Modifica</a>
     		</div>
    </div>
    <br>
    <div class="col-sm-9">
      <div class="well">
        <h4>La nostra azienda</h4>
        <p>La nostra azienda informazioni su di essa, fondazione, campo di sviluppo, obiettivi. Insomma una breve descrizione </p>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <h4>Users</h4>
            <p> Utente fondatore <br/> Utente coparticpanete <br/> Utente attivo</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Sito:</h4>
            <p style="text-align:right"><?php echo $dati[sito_web]?> </p> 
            <h4> Telefono:</h4>
            <p style="text-align:right"><?php echo $dati[telefono]?></p>
            <h4> Email</h4>
            <p>  <p style="text-align:right"><?php echo $dati[mail]?></p> </p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Campo di interesse</h4>
            <p><?php echo $dati[Categoria]?></p> 
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-sm-5">
          <div class="well">
          <h4> Paese </h4>
            <p><?php echo $dati[paese]?></p> 
            <h4>Citta</h4>
            <p><?php echo $dati[citta]?></p> 
            <h4>Sede</h4>
            <p>Via Nuova Agnano? Da gggiungere al db</p>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="well">
          <h4> Idee</h4>
            <p>GreenCity</p> 
            <p>LoveAffair</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="well">
            <p>Text</p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Iva</h4> 
            <p><?php echo $dati[Partita_iva]?></p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>