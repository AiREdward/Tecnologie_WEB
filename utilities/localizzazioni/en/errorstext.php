<?php
function GetErrorsText() : array {
    $errors=[];
    $errors["errore_connessione"]="connection error";
    $errors["utente_inesistente"]="user does not exist";
    $errors["password_errata"]="incorrect password";
    $errors["utente_invalido"]="invalid username format";
    $errors["mail_username_duplicata"]="user already exists";
    $errors["errore_registrazione_utente"]="error while creating account";
    return $errors;
}
?>