<?php
require_once 'utilities/global.php';
require_once 'utilities/booking_util.php';

if(isset($_GET["id"])) {
    $booking_id = $_GET["id"];
    $_SESSION["booking_id_editing"] = $booking_id;
} else {
    if(isset($_SESSION["booking_id_editing"])) {
        $booking_id = $_SESSION["booking_id_editing"];
        $booking_info = getBookingInfo($booking_id);
        if(!$booking_info) {
            header("Location: user_area.php");
            exit();
        }
    } else {
        header("Location: 404.php");
        exit();
    }
}

$booking_info = getBookingInfo($booking_id);

if(isset($_POST["prenota"])) {
    $day = $_POST["day"];
    $slot = $_POST["slot"];

    editBooking($day, $slot, $booking_id);

    $_SESSION["booking_id_editing"] = null;

    header("Location: user_area.php");
}

$page = initPage(__FILE__);

$edit_booking_component = file_get_contents('templates/edit_booking.html');

$content = str_replace('{booking_id}', $booking_id, $edit_booking_component);

$content = str_replace('{booking_info_date}', $booking_info["Data_Prenotazione"], $content);
$content = str_replace('{booking_info_time}', substr($booking_info["Ora_Prenotazione"], 0, 5), $content);
$content = str_replace('{booking_info_username}', $booking_info["Username"], $content);
$content = str_replace('{booking_info_room_id}', $booking_info["ID_Room"], $content);

$content = str_replace('{today_date}', date('Y-m-d'), $content);
$content = str_replace('{max_date}', date('Y-m-d', strtotime("+1 month")), $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'bookingEdit.js');

echo $page;