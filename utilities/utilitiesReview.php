<?php
require_once "DBConnection.php";

function getReviewById($id) {
    $conn = new Connection();
    if(!$conn->connect()) return null;

    $review = $conn->getReviewById($id);

    $conn->closeConnection();

    return $review;
}

function editReview($id, $text, $rating) {
    $conn = new Connection();
    if(!$conn->connect()) return null;

    $conn->editReview($id, $text, $rating);

    $conn->closeConnection();
}

function deleteReview($id) {
    $conn = new Connection();
    if(!$conn->connect()) return null;

    $conn->deleteReview($id);

    $conn->closeConnection();
}
