<?php
    require_once "UtilitiesRooms.php";

    // File usato da slotSelector.js per ottenere gli slot disponibili per una data e una stanza

    $day = $_REQUEST["day"];
    $id_room = $_REQUEST["id_room"];

    $slots = getPossibleSlots($id_room, $day);

    echo json_encode($slots);
