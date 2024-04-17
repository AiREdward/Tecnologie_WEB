<?php
require_once 'utilities/global.php';
require_once "utilities/UserFunctions.php";
require_once "utilities/UtilitiesRooms.php";

// TODO: the require_once

$user = getLoggedUser();

if($user == null){
    $_SESSION["next_page"] = "admin.php";
    header("Location: login.php");
    exit();
} else $_SESSION["next_page"] = null;

if(!checkIfUserIsAdmin($user)){
    header("Location: area_utente.php");
    exit();
}

$page = initPage(__FILE__);

$admin_component = file_get_contents('templates/admin.html');

$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

$rooms_to_show = '';

if (getLanguage() == 'it') {
    foreach ($rooms as $room) {
        $rooms_to_show .= '<p><a href="amministrazione_stanza.php?room_id=' . $room["ID"] . '">' . $room["Nome"] . '</a></p>';
    }
} else {
    foreach ($rooms as $room) {
        $rooms_to_show .= '<p><a href="amministrazione_stanza.php?room_id=' . $room["ID"] . '"> ' . $rooms_info_english[$room["ID"] - 1]["Nome"] . '</a></p>';
    }
}

$content = str_replace('{rooms}', $rooms_to_show, $admin_component);

$page = str_replace('{content}', $content, $page);

$page = insertText($page);

echo $page;