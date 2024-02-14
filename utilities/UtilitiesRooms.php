<?php

require_once "DBConnectionTest.php";

use Test\Connection;

function getRoomInfo() {
    $conn = new Connection();

    return $conn->getRooms();
}

function getRoomInfoEnglish() {
    $conn = new Connection();

    return $conn->getRoomsEnglish();
}

function getPossibleSlots($id_room, $date): array {
    $conn = new Connection();

    $day_of_week = date('N', strtotime($date)) - 1;

    $duration = $conn->getRoomDuration($id_room);
    $hours = $conn->getRoomHours($id_room, $day_of_week);

    $all_day_slots = createPossibleSlots($hours, $duration);
    $booked_slots = $conn->getBookedSlots($date, $id_room);
    $possible_slots = [];

    foreach ($all_day_slots as $slot) {
        $is_booked = false;

        foreach ($booked_slots as $booked_slot) {
            if ($slot == $booked_slot["Ora_Prenotazione"]) {
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
    $opening_hour = date("H:i", strtotime($hours["Ora_Apertura"]));
    $closing_hour = date("H:i", strtotime($hours["Ora_Chiusura"]));

    $opening_hour_from_epoch = strtotime($opening_hour);
    $closing_hour_from_epoch = strtotime($closing_hour);

    $duration_in_seconds = $duration_in_minutes * 60;

    $start_times = [];
    $start_times[] = gmdate("H:i:s", $opening_hour_from_epoch);
    while (strtotime($start_times[count($start_times) - 1]) + $duration_in_seconds < $closing_hour_from_epoch) {
        $start_times[] = gmdate("H:i:s", strtotime($start_times[count($start_times) - 1]) + $duration_in_seconds);
    }
    return $start_times;
}