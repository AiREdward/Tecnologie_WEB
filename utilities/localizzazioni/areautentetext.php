<?php
function getAreaUtenteText($lang): array {
    return match($lang) {
        "it" => [
            "in_as" => "Attualmente loggati come: ",
            "riepilogo_prenotazioni" => "Prenotazioni",
            "modifica_prenotazione" => "Modifica",
            "logout" => "<span lang=en>Logout</span>"
        ],
        "en" => [
            "in_as" => "Currently logged in as: ",
            "riepilogo_prenotazioni" => "Bookings",
            "modifica_prenotazione" => "Modify",
            "logout" => "Logout"
        ],
        default => []
    };
}