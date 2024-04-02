<?php
function getRoomsText($lang): array {
    return match ($lang) {
        "it" => [
            "difficolta" => "Difficoltà",
            "pulsante_prenota" => "Prenota Ora",
            "partecipanti" => "Giocatori",
            "durata" => "Durata",
            "room1_title" => "Cripta Arcana",
            "room2_title" => "Sabotaggio sul treno",
            "room3_title" => "Riavvio del reattore",
            "room1_img_alt" => "cripta sotteranea con un altare al centro",
            "room2_img_alt" => "interno di un lussuoso treno d'epoca",
            "room3_img_alt" => "reattore principale di un astronave futuristica",
            "room1_ambientazione" => "esplora una cripta alla ricerca di un potente artefatto, sarai ingrado di evitare le trappole e ottenerlo?",
            "room2_ambientazione" => "un semplice viaggio in treno si dimostra di gran lunga piu movimentato dopo un incidente, c'è il sospetto di un sabotaggio investiga la scena e tenta di riparare il treno",
            "room3_ambientazione" => "bloccati nello spazio con solo l'energia di emergenza è necessario rimettere in modo il reattore quanto prima possibile, esiste un manuale technico con le procedure richieste ma la situazione è tuttaltro che risolta"
        ],
        "en" => [
            "difficolta" => "Difficulty",
            "pulsante_prenota" => "Book Now",
            "partecipanti" => "Players",
            "durata" => "Length",
            "room1_title" => "Magic Dungeon",
            "room2_title" => "Train Sabotage",
            "room3_title" => "Reactor Reboot",
            "room1_img_alt" => "a dungeon with cells and a magic altar in the middle",
            "room2_img_alt" => "carriage of an antique luxurious train",
            "room3_img_alt" => "reactor room of a futuristic ship",
            "room1_ambientazione" => "You have entered a dungeon in search of a powerful magical artifact, will you be able to avoid the traps and acquire it?",
            "room2_ambientazione" => "a simple train ride proved far more eventful after an accident, potentially a sabotage investigate the scene and try to repair the train",
            "room3_ambientazione" => "stranded in the emptiness of space with only emergency power you have to restart the main reactor as quickly as possible, there is a technical manual with procedures but the task is still not thrivial"
        ],
        default => [],
    };
}