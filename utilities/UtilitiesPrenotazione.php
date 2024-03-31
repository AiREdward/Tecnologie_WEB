<?php
require_once "DBConnection.php";

function SlotDisponibili($stanza,$giorno): string {
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
    if(!in_array($slot, SlotDisponibili($stanza,$giorno) )){
        return "slot_non_disponibile";
    }
    if(!$connessione1->InserisciPrenotazione($user,$stanza,$giorno,$slot)){
        
    }
    $connessione1->closeDBConnection();
    return "";
}

function GetOrarioPrenotazione($slot){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $out=$connessione1->GetOrario($slot);
    $connessione1->closeDBConnection();
    return $out;
}

function GetPrenotazioniUtente(&$out){
    $connessione1 = new Connection();
    $connOK = $connessione1->apriConnessione();
    if(!$connOK) {
        return "errore_connessione";
    }
    $loggeduser=getLoggedUser();
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

function getNextBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getNextBookingsByUser($user);
}

function getPastBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getPastBookingsByUser($user);
}

function getBookingId($date, $time, $user, $room_id){
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getBookingId($date, $time, $user, $room_id);
}

function getBookingInfo($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getBookingInfo($booking_id);
}

function editBooking($date, $time_slot, $booking_id): void {
    $conn = new Connection();

    $conn->editBooking($booking_id, $date, $time_slot);

    $conn->closeConnection();
}

function deleteBooking($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->deleteBooking($booking_id);
}

function deleteBookingWithInfo($date, $time_slot, $room_id, $username): void {
    $conn = new Connection();

    $conn->deleteBooking($conn->getBookingId($date, $time_slot, $username, $room_id));

    $conn->closeConnection();
}