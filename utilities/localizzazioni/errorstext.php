<?php
function getErrorsText($lang): array {
    return match ($lang) {
        "it" => [
            "errore_connessione" => "Errore di connessione",
            "utente_inesistente" => "L'utente non esiste",
            "password_errata" => "La password è errata",
            "utente_invalido" => "Formato utente non valido",
            "username_gia_presente" => "Utente già esistente",
            "errore_registrazione_utente" => "Errore registrazione utente"
        ],
        "en" => [
            "errore_connessione" => "Connection error",
            "utente_inesistente" => "The user doesn't exist",
            "password_errata" => "Incorrect password",
            "utente_invalido" => "Invalid username format",
            "username_gia_presente" => "The username is taken",
            "errore_registrazione_utente" => "Error while creating account"
        ],
        default => [],
    };
}