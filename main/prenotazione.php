<?php
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    require_once "utilities/DBConnection.php";
    require_once "utilities/UtilitiesPrenotazione.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $slot = $_POST['slot'];
    $giorno = date('Y. m. d'); 
    $out=GetOrarioPrenotazione($slot);
    $row = $out->fetch_assoc();
    $orario = $row['orario'];
    $room = $_POST['room'];

    //CheckUtente($username,$password);
    //$query1='UPDATE SlotPrenotabili SET disponibilita = '0'  where id="$slot"'; da fare
   
    RegistraPrenotazione($giorno,$orario,$username,$room);
   
?>

