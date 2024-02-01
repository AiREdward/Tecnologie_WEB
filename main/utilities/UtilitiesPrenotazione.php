<?php 
require_once "utilities/DBConnection.php";
require_once "utilities/UserFunctions.php";
use DB\DBAccess;

function CheckUtente($username,$password){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $username=$connessione1->UserExists($username);
    if(!$username){
        $connessione1->closeDBConnection();
        return "utente_inesistente";
    }
    if(!$connessione1->CheckLogin($username,$password)){
        $connessione1->closeDBConnection();
        return "password_errata";
    }
    $_SESSION["user"]=$username;
    $_SESSION["admin"]=$connessione1->CheckUserPriviledge($username)=="ADMIN";
    $connessione1->closeDBConnection();
    return "";
}

function RegistraPrenotazione($user,$stanza,$giorno,$slot){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    if(!$connessione1->InserisciPrenotazione($user,$stanza,$giorno,$slot)){
        return "prenotazione fallita";
    }
    $connessione1->closeDBConnection();
    return "";
}

function GetPrenotazioniUtente(&$out){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $loggeduser=get_logged_user();
    $out=$connessione1->GetPrenotazioniUtente($loggeduser);
    $connessione1->closeDBConnection();
    return "";
}
function GetPrenotazioni(&$out){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $out=$connessione1->GetTuttePrenotazioni($loggeduser);
    $connessione1->closeDBConnection();
    return "";
}
?>