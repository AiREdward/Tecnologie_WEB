<?php
require_once 'utilities/global.php';
require_once 'utilities/UtilitiesRooms.php';

$layout = file_get_contents('templates/base_layout.html');

$page = str_replace('{language}', getLanguage(), $layout);
$page = str_replace('{title}', getTitle(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{menu}', getMenu(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{breadcrumb}', getBreadcrumb(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{lang_switch}', getLangSwitch(getNameOfTheFile(__FILE__)), $page);

$index_component = file_get_contents('templates/index.html');

$content = '';
$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

foreach($rooms as $room) {
    $room_component = $index_component;

    $room_component = str_replace('{room_id}', $room['ID'], $room_component);
    $room_component = str_replace('{room_difficulty}', $room['Difficolta'], $room_component);
    $room_component = str_replace('{room_minimum_players}', $room['Numero_Partecipanti_Minimo'], $room_component);
    $room_component = str_replace('{room_maximum_players}', $room['Numero_Partecipanti_Massimo'], $room_component);
    $room_component = str_replace('{room_duration}', $room['Durata'], $room_component);

    if(getLanguage() == 'it') {
        $room_component = str_replace('{room_name}', $room['Nome'], $room_component);
        $room_component = str_replace('{room_description}', $room['Descrizione'], $room_component);
    } else {
        $room_component = str_replace('{room_name}', $rooms_info_english[$room['ID'] - 1]['Nome'], $room_component);
        $room_component = str_replace('{room_description}', $rooms_info_english[$room["ID"] - 1]['Descrizione'], $room_component);
    }

    $content .= $room_component;
}

$page = str_replace('{content}', $content, $page);

$page = insertText($page);

echo $page;