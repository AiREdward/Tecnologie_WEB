<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/room_util.php';

redirectIfUserNotLoggedIn(__FILE__);
redirectUserIfNotAdmin();

$page = initPage(__FILE__);

$admin_component = file_get_contents('templates/admin.html');

$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

$rooms_to_show = '';

if (getLanguage() == 'it') {
    foreach ($rooms as $room) {
        $rooms_to_show .= '<li><a href="room_administration.php?room_id=' . $room["ID"] . '">' . $room["Nome"] . '</a></li>';
    }
} else {
    foreach ($rooms as $room) {
        $rooms_to_show .= '<li><a href="room_administration.php?room_id=' . $room["ID"] . '"> ' . $rooms_info_english[$room["ID"] - 1]["Nome"] . '</a></li>';
    }
}

$content = str_replace('{rooms}', $rooms_to_show, $admin_component);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);

echo $page;