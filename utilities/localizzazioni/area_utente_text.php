<?php
function getAreaUtenteText($lang): array {
    return match($lang) {
        "it" => [
            "in_as" => "Attualmente loggati come: ",
            "riepilogo_prenotazioni" => "Prenotazioni",
            "modifica_prenotazione" => "Modifica",
            "modifica_recensione" => "Modifica recensione",
            "elimina_recensione" => "Elimina recensione",
            "logout" => "<span lang=en>Logout</span>"
        ],
        "en" => [
            "in_as" => "Currently logged in as: ",
            "riepilogo_prenotazioni" => "Bookings",
            "modifica_prenotazione" => "Modify",
            "modifica_recensione" => "Modify review",
            "elimina_recensione" => "Delete review",
            "logout" => "Logout"
        ],
        default => []
    };
}