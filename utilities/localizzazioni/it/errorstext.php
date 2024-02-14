<?php
function GeterrorsText() : array {
    $errors=[];
    $errors["errore_connessione"] = "Errore di connessione";
    $errors["utente_inesistente"] = "L'utente non esiste";
    $errors["password_errata"] = "La password è errata";
    $errors["utente_invalido"] = "Formato utente non valido";
    $errors["username_gia_presente"] = "Utente già esistente";
    $errors["errore_registrazione_utente"] = "Errore registrazione utente";
    return $errors;
}