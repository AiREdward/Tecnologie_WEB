<?php
function getPrenotaText($lang): array {
    return match($lang) {
        "it" => [
            "label_giorno" => "Selezione del giorno",
            "label_slot" => "Selezione dello slot",
            "testo_pulsante" => "Conferma"
        ],
        "en" => [
            "label_giorno" => "Select the day",
            "label_slot" => "Select the slot",
            "testo_pulsante" => "Confirm"
        ],
        default => []
    };
}