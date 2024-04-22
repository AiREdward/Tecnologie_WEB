<?php
require_once 'DBConnection.php';
require_once 'message_util.php';

function checkIfUserIsAdmin($username): bool {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~'); // TODO: change to the message or page 500

    $isAdmin = $conn->isUserAdmin($username);
    $conn->closeConnection();

    return $isAdmin;
}

function getPossibleRoomsForReview($username): array {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');

    $rooms = $conn->getPossibleRoomsForReview($username);
    $conn->closeConnection();

    $rooms_reduced = array();

    foreach($rooms as $room) {
        if(!in_array($room['ID_Room'], $rooms_reduced)) $rooms_reduced[] = $room['ID_Room'];
    }

    return $rooms_reduced;
}

function getUserReviews($username): array {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');

    $reviews = $conn->getUserReviews($username);
    $conn->closeConnection();

    return $reviews;
}

function getRoomsForNewReview($username): array {
    $rooms = getPossibleRoomsForReview($username);
    $reviews = getUserReviews($username);

    $rooms_reviewed = array();

    foreach($reviews as $review) {
        if(in_array($review['ID_Room'], $rooms)) {
            $rooms_reviewed[] = $review['ID_Room'];
        }
    }

    return array_diff($rooms, $rooms_reviewed);
}

function createReviewForUser($username, $room_id, $review, $rating): void {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');

    $conn->createReview($username, $room_id, $review, $rating);
    $conn->closeConnection();
}