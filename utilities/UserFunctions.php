<?php 
require_once "utilities/DBConnectionTest.php";

use Test\Connection;

function getLoggedUser() {
    return $_SESSION["user"] ?? null;
}

function logUser($email, $password): ?string {
    $conn = new Connection();

    if(!$conn->connect()) return "errore_connessione";


    $username = $conn->checkIfUserExists($email);

    if(!$username){
        $conn->closeConnection();
        return "utente_inesistente";
    }

    if(!$conn->checkLogin($username, $password)) {
        $conn->closeConnection();
        return "password_errata";
    }

    $_SESSION["user"] = $username;

    $conn->closeConnection();

    return null;
}

function logout(): void {
    $_SESSION["user"] = null;
}

function registerUser($username, $email, $password, $nome, $cognome, $telefono, $nascita): ?string {
    $conn = new Connection();
    if(!$conn->connect()) return "errore_connessione";

    if($conn->checkIfUserExists($username)) {
        $conn->closeConnection();
        return "username_gia_presente";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if(!$conn->registerNewUser($username, $email, $password, $nome, $cognome, $telefono, $nascita)) {
        $conn->closeConnection();
        return "errore_registrazione_utente";
    }

    $conn->closeConnection();
    return null;
}

function checkIfUserIsAdmin($username): bool {
    $conn = new Connection();
    if(!$conn->connect()) return "errore_connessione";

    $isAdmin = $conn->isUserAdmin($username);
    $conn->closeConnection();

    return $isAdmin ;
}

function getPossibleRoomsForReview($username): array {
    $conn = new Connection();

    $rooms = $conn->getPossibleRoomsForReview($username);
    $conn->closeConnection();

    $rooms_reduced = array();

    foreach($rooms as $room) {
        if(!in_array($room["ID_Room"], $rooms_reduced)) $rooms_reduced[] = $room["ID_Room"];
    }

    return $rooms_reduced;
}

function getUserReviews($username) {
    $conn = new Connection();
    if(!$conn->connect()) return "errore_connessione";

    $reviews = $conn->getUserReviews($username);
    $conn->closeConnection();

    return $reviews;
}

function getRoomsForNewReview($username): array {
    $rooms = getPossibleRoomsForReview($username);
    $reviews = getUserReviews($username);

    $rooms_reviewed = array();

    foreach($reviews as $review) {
        if(in_array($review["ID_Room"], $rooms)) {
            $rooms_reviewed[] = $review["ID_Room"];
        }
    }

    return array_diff($rooms, $rooms_reviewed);
}

function createReviewForUser($username, $room_id, $review, $rating): void {
    $conn = new Connection();

    $conn->createReview($username, $room_id, $review, $rating);

    $conn->closeConnection();
}