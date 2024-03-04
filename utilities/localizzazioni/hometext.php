<?php

// File creato per la sua presenza in ManagerLocalizzazione.php
// Nessun altro file fa riferimento a questo attualmente
// I campi dell'array restituito in questa funzione sono completamente generati a caso

function getHomeText($lang): array {
    return match ($lang) {
        "it" => [
            "titolo" => "Benvenuto",
            "testo" => "Benvenuto nella pagina principale del nostro sito. Da qui potrai prenotare una stanza, visualizzare le tue prenotazioni e modificarle.",
            "prenota" => "Prenota",
            "modifica" => "Modifica prenotazione",
            "visualizza" => "Visualizza prenotazioni"
        ],
        "en" => [
            "titolo" => "Welcome",
            "testo" => "Welcome to the main page of our website. From here you can book a room, view your bookings and modify them.",
            "prenota" => "Book",
            "modifica" => "Modify booking",
            "visualizza" => "View bookings"
        ],
        default => [],
    };
}