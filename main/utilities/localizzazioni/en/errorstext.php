<?php
function GetErrorsText() : array {
    $errors=[];
    $errors["errore_connessione"]="connection error";
    $errors["utente_inesistente"]="user does not exist";
    $errors["password_errata"]="incorrect password";
    //$errors["errore_connessione"]="Login";
    $errors["mail_username_duplicata"]="user already exists";
    $errors["errore_registrazione_utente"]="error while creating account";
    return $errors;
}
?>