<?php
function GetroomsText() : array {
    $rooms=[];
    $rooms["difficolta"]="difficulty";
    $rooms["pulsante_prenota"]="book now";
    $rooms["partecipanti"]="players";
    $rooms["durata"]="lenght";
    $rooms["room1_title"]="Magic Doungeon";
    $rooms["room2_title"]="Train Sabotage";
    $rooms["room3_title"]="Reactor Reboot";
    $rooms["room1_img_alt"]="a doungeon with cells and a magic altar in the middle";
    $rooms["room2_img_alt"]="carriage of an antique luxurious train";
    $rooms["room3_img_alt"]="reactor room of a futuristic ship";
    $rooms["room1_ambientazione"]="you have entered a doungeon in search of a powerful magical artifact, will you be able to avoid the traps and acuire it?";
    $rooms["room2_ambientazione"]="a simple train ride proved far more eventful afer an accident, potemtially a sabotage investigate the scene and try to repair the train";
    $rooms["room3_ambientazione"]="stranded in the emptiness of space with only emergency power you have to restart the main reactor as quickly as possible, there is a technical manual with procedures but the task is still not thrivial";
    return $rooms;
}
?>