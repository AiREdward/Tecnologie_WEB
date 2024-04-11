<?php
function getHeaderText($lang): array {
    return match ($lang) {
        "it" => [
            "skip" => "Salta al contenuto",
            "nav_toggle" => "apri/chiudi barra navigazione",
            "breadcrumb" => "Ti trovi in:",
            "login" => "<span lang=en>Login</span>",
            "logout" => "<span lang=en>Logout</span>",
            "home" => "<span lang=en>Home</span>",
            "area_utente" => "Area Utente",
            "admin" => "Amministrazione",
            "signup" => "Registra Account",
            "prenota" => "Prenota",
            "modifica_prenotazione" => "Modifica Prenotazione",
            "crea_recensione" => "Crea Recensione",
            "modifica_recensione" => "Modifica Recensione",
            "amministrazione_stanza" => "Amministrazione Stanza",
            "lang_switch" => "Vai alla versione inglese"
        ],
        "en" => [
            "skip" => "Skip to content",
            "nav_toggle" => "open/close navigation bar",
            "breadcrumb" => "You are in:",
            "login" => "Login",
            "logout" => "Logout",
            "home" => "Home",
            "area_utente" => "User Area",
            "admin" => "Administration",
            "signup" => "Sign Up",
            "prenota" => "Book",
            "modifica_prenotazione" => "Edit Booking",
            "crea_recensione" => "Create Review",
            "modifica_recensione" => "Modify Review",
            "amministrazione_stanza" => "Room Administration",
            "lang_switch" => "Go to Italian version"
        ],
        default => [],
    };
}