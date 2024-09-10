<?php
require_once 'utilities/global.php';
require_once 'utilities/room_util.php';

$page = initPage(__FILE__);

$index_component = file_get_contents('templates/index.html');

$content = '';
$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

$difficulty_tr = ['~diff_easy~', '~diff_medium~', '~diff_hard~'];

foreach($rooms as $room) {
    $room_component = $index_component;

    $room_component = str_replace('{room_id}', $room['ID'], $room_component);
    $room_component = str_replace('{room_difficulty}', $difficulty_tr[$room['Difficolta'] - 1], $room_component);
    $room_component = str_replace('{room_minimum_players}', $room['Numero_Partecipanti_Minimo'], $room_component);
    $room_component = str_replace('{room_maximum_players}', $room['Numero_Partecipanti_Massimo'], $room_component);
    $room_component = str_replace('{room_duration}', $room['Durata'], $room_component);

    if(getLanguage() == 'it') {
        $room_component = str_replace('{room_name}', $room['Nome'], $room_component);
        $room_component = str_replace('{room_description}', $room['Descrizione'], $room_component);
        $room_component = str_replace('{room_alt}', getRoomImageAlt($room['ID'], 'it'), $room_component);
    } else {
        $room_component = str_replace('{room_name}', $rooms_info_english[$room['ID'] - 1]['Nome'], $room_component);
        $room_component = str_replace('{room_description}', $rooms_info_english[$room["ID"] - 1]['Descrizione'], $room_component);
        $room_component = str_replace('{room_alt}', getRoomImageAlt($room['ID'], 'en'), $room_component);
    }

    $content .= $room_component;
}
$content .="<p> siamo anche disponibili per attività di team building, per ulteriori informazioni contattateci via telefono o mail</p>"

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);

echo $page;