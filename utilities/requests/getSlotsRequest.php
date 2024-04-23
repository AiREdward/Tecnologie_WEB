<?php
require_once '../room_util.php';

// File used by slotSelector.js to get the available slots for a date and a room

$day = $_REQUEST['day'];
$id_room = $_REQUEST['id_room'];

$slots = getPossibleSlots($id_room, $day);

echo json_encode($slots);