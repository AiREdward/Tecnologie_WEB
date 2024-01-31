<?php 
require_once "utilities/DBConnection.php";
require_once "utilities/UserUtilities.php";
use DB\DBAccess;

function SlotDisponibili($stanza,$giorno){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $username=$connessione1->UserExists($email);
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
    if(!in_array($slot,SlotDisponibili($stanza,$giorno) )){
        return "slot_non_disponibile"
    }
    if(!$connessione1->InserisciPrenotazione($user,$stanza,$giorno,$slot)){
        
    }
    $connessione1->closeDBConnection();
    return "";
}
function RegistraPrenotazione($stanza,$giorno,$slot){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $loggeduser=get_logged_user();
    if(!in_array($slot,SlotDisponibili($stanza,$giorno) )){
        $connessione1->closeDBConnection();
        return "slot_non_disponibile"
    }
    if(!$connessione1->InserisciPrenotazione($loggeduser,$stanza,$giorno,$slot)){
        $connessione1->closeDBConnection();
        return "errore_prenotazione"
    }
    $connessione1->closeDBConnection();
    return "";
}
?>