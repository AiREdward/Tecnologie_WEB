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
            "signup" => "Registra Account",
            "prenota" => "Prenota",
            "modifica_prenotazione" => "Modifica Prenotazione",
            "crea_recensione" => "Crea Recensione",
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
            "signup" => "Sign Up",
            "prenota" => "Book",
            "modifica_prenotazione" => "Edit Booking",
            "crea_recensione" => "Create Review",
            "lang_switch" => "Go to Italian version"
        ],
        default => [],
    };
}