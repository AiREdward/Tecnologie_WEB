<?php
function GeterrorsText() : array {
    $errors=[];
    $errors["errore_connessione"]="Errore connessione";
    $errors["utente_inesistente"]="Utente inesistente";
    $errors["password_errata"]="Password errata";
    $errors["utente_invalido"]="Formato utente non valido";
    $errors["mail_username_duplicata"]="Utente già esistente";
    $errors["errore_registrazione_utente"]="Errore registrazione utente";
    return $errors;
}
?>