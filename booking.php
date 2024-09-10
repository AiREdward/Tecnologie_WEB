<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/room_util.php';
require_once 'utilities/message_util.php';

if(isset($_GET["room"])) $_SESSION["id_room"] = $_GET["room"];

redirectIfUserNotLoggedIn(__FILE__);

$room_id = $_SESSION["id_room"];

if(isset($_POST["prenota"])) {
    $day = $_POST["day"];
    $slot = $_POST["rooms"];

    bookRoom($day, $slot, getLoggedUser(), $room_id);

    setInfoMessage('~room_booked~');
}

$page = initPage(__FILE__);

$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

$booking_component = file_get_contents('templates/booking.html');

if(getLanguage() == 'it') {
    $content = str_replace('{room_name}', $rooms[$room_id -1]["Nome"], $booking_component);
} else{
    $content = str_replace('{room_name}', $rooms_info_english[$room_id - 1]["Nome"], $booking_component);
}

$content = str_replace('{today_date}', date('Y-m-d'), $content);
$content = str_replace('{max_date}', date('Y-m-d', strtotime("+1 month")), $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'slotSelector.js');

echo $page;