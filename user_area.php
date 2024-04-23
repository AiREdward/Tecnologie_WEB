<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/user_util.php';
require_once 'utilities/booking_util.php';

redirectIfUserNotLoggedIn(__FILE__);
redirectUserIfAdmin();

$page = initPage(__FILE__);

$user = getLoggedUser();

$user_area_component = file_get_contents('templates/user_area.html');

$content = '';

$content = str_replace('{logged_user}', $user, $user_area_component);

$next_bookings = getNextBookingsByUser($user);
$next_bookings_to_show = '';

if ($next_bookings == null) $next_bookings_to_show = '<p>~no_next_bookings~</p>';
else {
    foreach ($next_bookings as $booking) {
        $next_bookings_to_show .= "<li class='singola_prenotazione'>" . $booking["Data_Prenotazione"] . "  " . $booking["Ora_Prenotazione"] . " [~room~: " . $booking["ID_Room"] . "] ";
        $next_bookings_to_show .= "<a class='link_modifica' href='edit_booking.php?id=" . getBookingId($booking["Data_Prenotazione"], $booking["Ora_Prenotazione"], $user, $booking["ID_Room"]) . "' >~edit~</a>";
        $next_bookings_to_show .= "</li>";
    }
}

$past_bookings = getPastBookingsByUser($user);
$past_bookings_to_show = '';

if($past_bookings == null) $past_bookings_to_show = '<p>~no_past_bookings~</p>';
else {
    foreach ($past_bookings as $booking) {
        $past_bookings_to_show .= "<li class='singola_prenotazione'>" . $booking["Data_Prenotazione"] . "  " . $booking["Ora_Prenotazione"] . " [~room~: " . $booking["ID_Room"] . "]" . "</li>";
    }
}
$rooms_for_review = getRoomsForNewReview($user);
$available_reviews_to_show = '';

if($rooms_for_review == null) $available_reviews_to_show = '<p>~no_available_review~</p>';
else {
    foreach ($rooms_for_review as $re) {
        $available_reviews_to_show .= "<li>";
        $available_reviews_to_show .= "<a class='link_modifica' href='create_review.php?room_id=" . $re . "' >~create_review_for~ " . $re . "</a>";
        $available_reviews_to_show .= "</li>";
    }
}

$reviews = getUserReviews($user);
$written_reviews_to_show = '';

if($reviews == null) $written_reviews_to_show = '<p>~no_written_review~</p>';
else {
    foreach ($reviews as $re) {
        $written_reviews_to_show .= "<li>";
        $written_reviews_to_show .= "~room~ " . $re["ID_Room"] . " - ~score~: " . $re["Voto"] . " - ~text~: " . $re["Testo"];
        $written_reviews_to_show .= "<br>";
        $written_reviews_to_show .= " <a class='link_modifica' href='edit_review.php?review_id=" . $re["ID"] . "' >~edit_a_review~</a> ";
        $written_reviews_to_show .= "</li>";
    }
}

$content = str_replace('{next_bookings}', $next_bookings_to_show, $content);
$content = str_replace('{past_bookings}', $past_bookings_to_show, $content);
$content = str_replace('{available_reviews}', $available_reviews_to_show, $content);
$content = str_replace('{written_reviews}', $written_reviews_to_show, $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);

echo $page;