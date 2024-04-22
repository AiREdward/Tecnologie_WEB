<?php
require_once 'utilities/global.php';
require_once "utilities/UtilitiesRooms.php";
require_once "utilities/UserFunctions.php";

if(isset($_GET["room"])) $_SESSION["id_room"] = $_GET["room"];

$user = getLoggedUser();

// TODO: send a message to login page that explains the user has to login to book a room
if($user == null) {
    $_SESSION["next_page"] = "prenota.php";
    header("Location: login.php");
    exit();
} else $_SESSION["next_page"] = null;

$id_room = $_SESSION["id_room"];

if(isset($_POST["prenota"])) {
    $day = $_POST["day"];
    $slot = $_POST["rooms"];

    bookRoom($day, $slot, $user, $id_room);

    // TODO: send a message to the user that the room has been booked
}

$page = initPage(__FILE__);

$book_component = file_get_contents('templates/prenota.html');

$content = str_replace('{room_id}', $id_room, $book_component);
$content = str_replace('{today_date}', date('Y-m-d'), $content);
$content = str_replace('{max_date}', date('Y-m-d', strtotime("+1 month")), $content);

$page = str_replace('{content}', $content, $page);

$page = insertText($page);
$page = insertScript($page, 'slotSelector.js');

echo $page;