<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/room_util.php';
require_once 'utilities/message_util.php';

if(isset($_GET["room"])) $_SESSION["id_room"] = $_GET["room"];

redirectIfUserNotLoggedIn(__FILE__);

$id_room = $_SESSION["id_room"];

if(isset($_POST["prenota"])) {
    $day = $_POST["day"];
    $slot = $_POST["rooms"];

    bookRoom($day, $slot, getLoggedUser(), $id_room);

    setInfoMessage('~room_booked~');
}

$page = initPage(__FILE__);

$book_component = file_get_contents('templates/booking.html');

$content = str_replace('{room_id}', $id_room, $book_component);
$content = str_replace('{today_date}', date('Y-m-d'), $content);
$content = str_replace('{max_date}', date('Y-m-d', strtotime("+1 month")), $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'slotSelector.js');

echo $page;