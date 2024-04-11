<?php
require_once "DBConnection.php";

function getNextBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getNextBookingsByUser($user);
}

function getNextRoomBookings($room_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    } else {
        return $conn->getRoomBookingsFromID($room_id);
    }
}

function getPastBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getPastBookingsByUser($user);
}

function getBookingId($date, $time, $user, $room_id){
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getBookingId($date, $time, $user, $room_id);
}

function getBookingInfo($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->getBookingInfo($booking_id);
}

function editBooking($date, $time_slot, $booking_id): void {
    $conn = new Connection();

    $conn->editBooking($booking_id, $date, $time_slot);

    $conn->closeConnection();
}

function deleteBooking($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        return null;
    }

    return $conn->deleteBooking($booking_id);
}

function deleteBookingWithInfo($date, $time_slot, $room_id, $username): void {
    $conn = new Connection();

    $conn->deleteBooking($conn->getBookingId($date, $time_slot, $username, $room_id));

    $conn->closeConnection();
}