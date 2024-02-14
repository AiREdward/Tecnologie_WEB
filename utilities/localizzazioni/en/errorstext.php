<?php
function GetErrorsText() : array {
    $errors=[];
    $errors["errore_connessione"] = "Connection error";
    $errors["utente_inesistente"] = "The user doesn't exist";
    $errors["password_errata"] = "Incorrect password";
    $errors["utente_invalido"] = "Invalid username format";
    $errors["username_gia_presente"] = "The username is taken";
    $errors["errore_registrazione_utente"] = "Error while creating account";
    return $errors;
}