<?php
require_once 'DBConnection.php';
require_once 'message_util.php';
require_once 'config/room_img_alt_config.php';

global $room_img_alt;

function getRoomInfo() {
    $conn = new Connection();

    if (!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return []; // Ritorna un array vuoto o gestisci diversamente il caso di errore
    } else {
        $rooms = $conn->getRooms();
        return $rooms ? $rooms : [];
    }
}

function getRoomInfoEnglish() {
    $conn = new Connection();

    if (!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return []; // Ritorna un array vuoto o gestisci diversamente il caso di errore
    } else {
        $rooms = $conn->getRoomsEnglish();
        return $rooms ? $rooms : [];
    }
}
/*
function getRoomInfo() {
    $conn = new Connection();

    if (!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getRooms();
}

function getRoomInfoEnglish() {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    }
    else return $conn->getRoomsEnglish();
}*/

function getRoomImageAlt($room_id, $lang): string {
    global $room_img_alt;

    return $room_img_alt[$room_id][$lang];
}

function bookRoom($date, $time_slot, $username, $id_room): void {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');

    $conn->createBooking($date, $time_slot, $username, $id_room);
}

function getPossibleSlots($id_room, $date): ?array {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    $day_of_week = date('N', strtotime($date)) - 1;

    $duration = $conn->getRoomDuration($id_room);
    $hours = $conn->getRoomHours($id_room, $day_of_week);

    $all_possible_slots = createPossibleSlots($hours, $duration);
    $booked_slots = $conn->getBookedSlots($date, $id_room);
    $possible_slots = [];

    // Delete of the slots that are older than one hour
    if (date('Y-m-d') == $date) {
        $current_time = date('H:i:s');
        $current_time = strtotime($current_time);
        $current_time = gmdate('H:i:s', $current_time);
        $current_time = strtotime($current_time);
        $current_time = strtotime($current_time) + 60 * 60;
        $current_time = gmdate('H:i:s', $current_time);
        $current_time = strtotime($current_time);

        $all_possible_slots = array_filter($all_possible_slots, function($slot) use ($current_time) {
            return strtotime($slot) > $current_time;
        });
    }

    foreach ($all_possible_slots as $slot) {
        $is_booked = false;

        foreach ($booked_slots as $booked_slot) {
            if ($slot == $booked_slot['Ora_Prenotazione']) {
                $is_booked = true;
            }
        }

        if(!$is_booked) {
            $possible_slots[] = $slot;
        }
    }

    return $possible_slots;
}

function createPossibleSlots($hours, $duration_in_minutes): array {
    $opening_hour_from_epoch = strtotime($hours['Ora_Apertura']);
    $closing_hour_from_epoch = strtotime($hours['Ora_Chiusura']);

    $duration_in_seconds = $duration_in_minutes * 60;

    $start_times = [];
    $start_times[] = gmdate('H:i:s', $opening_hour_from_epoch);
    while (strtotime($start_times[count($start_times) - 1]) + $duration_in_seconds < ($closing_hour_from_epoch - $duration_in_seconds)) {
        $start_times[] = gmdate('H:i:s', strtotime($start_times[count($start_times) - 1]) + $duration_in_seconds);
    }
    return $start_times;
}