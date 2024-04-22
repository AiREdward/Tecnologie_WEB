<?php
require_once '../booking_util.php';

// File used by bookingEdit.js for deleting a booking

$day = $_REQUEST['day'];
$slot = $_REQUEST['slot'];
$user = $_REQUEST['user'];
$id_room = $_REQUEST['room'];

deleteBookingWithInfo($day, $slot, $id_room, $user);

$_SESSION['booking_id_editing'] = null;