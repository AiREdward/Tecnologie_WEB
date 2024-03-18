<?php
    require_once "UtilitiesPrenotazione.php";

    // File usato da bookingEdit.js per eliminare una prenotazione

    $day = $_REQUEST["day"];
    $slot = $_REQUEST["slot"];
    $user = $_REQUEST["user"];
    $id_room = $_REQUEST["room"];

    deleteBookingWithInfo($day, $slot, $id_room, $user);

    $_SESSION["booking_id_editing"] = null;