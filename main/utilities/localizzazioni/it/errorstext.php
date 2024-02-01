<?php
function GeterrorsText() : array {
    $errors=[];
    $errors["errore_connessione"]="errore connessione";
    $errors["utente_inesistente"]="utente inesistente";
    $errors["password_errata"]="password errata";
    //$errors["errore_connessione"]="Login";
    $errors["mail_username_duplicata"]="Utenre gia esistente";
    $errors["errore_registrazione_utente"]="errore registrazione utente";
    return $errors;
}
?>