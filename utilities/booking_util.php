<?php
require_once 'DBConnection.php';
require_once 'message_util.php';

function getNextBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getNextBookingsByUser($user);
}

function getNextRoomBookings($room_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getRoomBookingsFromID($room_id);
}

function getPastBookingsByUser($user) {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getPastBookingsByUser($user);
}

function getBookingId($date, $time, $user, $room_id){
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getBookingId($date, $time, $user, $room_id);
}

function getBookingInfo($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->getBookingInfo($booking_id);
}

function editBooking($date, $time_slot, $booking_id): void {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
    } else {
        $conn->editBooking($booking_id, $date, $time_slot);
        $conn->closeConnection();
    }
}

function deleteBooking($booking_id) {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else return $conn->deleteBooking($booking_id);
}

function deleteBookingWithInfo($date, $time_slot, $room_id, $username): void {
    $conn = new Connection();

    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
    } else {
        $conn->deleteBooking($conn->getBookingId($date, $time_slot, $username, $room_id));
        $conn->closeConnection();
    }
}