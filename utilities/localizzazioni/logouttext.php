<?php
function getLogoutText($lang): array {
    return match($lang) {
        "it" => [
            "logout_success" => "Logout effettuato con successo",
            "login_link" => "Clicca qui per effettuare il login"
        ],
        "en" => [
            "logout_success" => "Logout done successfully",
            "login_link" => "Click here to login"
        ],
        default => []
    };
}