<?php 
require_once "utilities/DBConnection.php";
require_once "utilities/UserFunctions.php";
//use DB\DBAccess;

function SlotDisponibili($stanza,$giorno,&$out){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $out=CheckSlotDisponibili($stanza,$giorno);
    $connessione1->closeDBConnection();
    return "";
}

function RegistraPrenotazione($user,$stanza,$giorno,$slot){
    if(!$connOK) {
        return "errore_connessione";
    }
    if(!in_array($slot,SlotDisponibili($stanza,$giorno) )){
        return "slot_non_disponibile";
    }
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connessione1->InserisciPrenotazione($user,$stanza,$giorno,$slot)){
        return "errore";
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
function ModificaPrenotazione($id,$stanza,$giorno,$slot){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();

    if(!$connOK) {
        return "errore_connessione";
    }
    $slots=null;
    SlotDisponibili($stanza,$giorno,$slots)
    if(!in_array($slot,$slots)){
        return "slot_non_disponibile";
    }
    if($_SESSION["admin"]){
        $connessione1->UpdatePrenotazioneAdmin($giorno,$slot,$stanza,$id);
    }
    else {
        $connessione1->UpdatePrenotazioneUtente(get_logged_user(),$giorno,$slot,$stanza,$id);
    }
    $connessione1->closeDBConnection();
    return "";
}
function GetPrenotazioni(&$out){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $out=$connessione1->GetTuttePrenotazioni();
    $connessione1->closeDBConnection();
    return "";
}
?>