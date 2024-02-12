<?php
function GetroomsText() : array {
    $rooms=[];
    $rooms["difficolta"]="difficulty";
    $rooms["pulsante_prenota"]="book now";
    $rooms["partecipanti"]="players";
    $rooms["durata"]="length";
    $rooms["room1_title"]="Magic Dungeon";
    $rooms["room2_title"]="Train Sabotage";
    $rooms["room3_title"]="Reactor Reboot";
    $rooms["room1_img_alt"]="a dungeon with cells and a magic altar in the middle";
    $rooms["room2_img_alt"]="carriage of an antique luxurious train";
    $rooms["room3_img_alt"]="reactor room of a futuristic ship";
    $rooms["room1_ambientazione"]="You have entered a dungeon in search of a powerful magical artifact, will you be able to avoid the traps and acquire it?";
    $rooms["room2_ambientazione"]="a simple train ride proved far more eventful after an accident, potentially a sabotage investigate the scene and try to repair the train";
    $rooms["room3_ambientazione"]="stranded in the emptiness of space with only emergency power you have to restart the main reactor as quickly as possible, there is a technical manual with procedures but the task is still not thrivial";
    return $rooms;
}
?>