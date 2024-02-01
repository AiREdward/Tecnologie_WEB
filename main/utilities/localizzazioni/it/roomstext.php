<?php
function GetroomsText() : array {
    $rooms=[];
    $rooms["difficolta"]="difficoltà";
    $rooms["pulsante_prenota"]="prenota ora";
    $rooms["partecipanti"]="giocatori";
    $rooms["durata"]="durata";
    $rooms["room1_title"]="Cripta Arcana";
    $rooms["room2_title"]="Sabotaggio sul treno";
    $rooms["room3_title"]="Riavvio del reattore";
    $rooms["room1_img_alt"]="cripta sotteranea con un altare al centro";
    $rooms["room2_img_alt"]="interno di un lussuoso treno d'epoca";
    $rooms["room3_img_alt"]="reattore principale di un astronave futuristica";
    $rooms["room1_ambientazione"]="esplora una cripta alla ricerca di un potente artefatto, sarai ingrado di evitare le trappole e ottenerlo?";
    $rooms["room2_ambientazione"]="un semplice viaggio in treno si dimostra di gran lunga piu movimentato dopo un incidente, c'è il sospetto di un sabotaggio investiga la scena e tenta di riparare il treno";
    $rooms["room3_ambientazione"]="bloccati nello spazio con solo l'energia di emergenza è necesario rimettere in modo il reattore quanto prima possibile, esiste un manuale technico con le procedure richieste ma la situazione è tuttaltro che risolta";
    return $rooms;
}
?>