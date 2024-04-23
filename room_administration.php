<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/booking_util.php';

redirectIfUserNotLoggedIn(__FILE__);
redirectUserIfNotAdmin();

if(isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];
    $_SESSION["room_id_admin_view"] = $room_id;
} else {
    if($_SESSION["room_id_admin_view"] == null) {
        header("Location: 404.php");
        exit();
    }
}

$page = initPage(__FILE__);

$admin_room_component = file_get_contents('templates/room_administration.html');

$bookings = getNextRoomBookings($room_id);

$content = str_replace('{room_number}', $room_id, $admin_room_component);

$bookings_to_show = '';

foreach ($bookings as $booking) {
    $bookings_to_show .= "<li> Prenotazione numero: " . $booking["ID"] . " | Data: " . $booking["Data_Prenotazione"] . " | Orario: " . $booking["Ora_Prenotazione"] . " | Utente: " . $booking["Username"] . "</li>";
}

$content = str_replace('{booking_list}', $bookings_to_show, $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);

echo $page;