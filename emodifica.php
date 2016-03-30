<?php
session_start();

$categoria = $_REQUEST["categoria"];
$paese = $_REQUEST["paese"];
$iva = $_REQUEST["iva"];
$sito = $_REQUEST['sito'];
$citta = $_REQUEST["citta"];
$mail = $_REQUEST["mail"];
$telefono = $_REQUEST["telefono"];

include_once 'configurazioneDB.php';
/*  una funzione che racchiude tutti i controlli da fare sul campo email*/
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
/* controllo che nel campo telefono ci siano solo numeri*/
if (!is_numeric($telefono)) {
header("location: modificaW.php?errore=1");
exit;
} 
/* richiamo la funzione per controllare la mail*/
if(!chkEmail($mail)) {
header("location: modificaW.php?errore=2");
exit;
}
/* racchiudo nella variabile comando, l istruzione sql per il database, in questo caso sarˆ un aggiornamento*/
$comando="update azienda set Categoria='$categoria',Partita_iva='$iva',sito_web='$sito', ".
		"paese='$paese',citta='$citta',mail='$mail',telefono='$telefono' ".
		"where nome='$_SESSION[user]'";
/*eseguo l 'istruzione sql, se mi ridˆ falso do l'errore modifica 1 altirmenti 2*/
if(!$conn->query($comando) ){
	header("location: Menu.php?modifica=1");
	}
	else {
	header("location: Menu.php?modifica=2");
	}
	$conn->close();
?>
