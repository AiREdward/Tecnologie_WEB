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
