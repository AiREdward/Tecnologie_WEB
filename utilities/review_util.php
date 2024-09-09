<?php
require_once 'DBConnection.php';
require_once 'message_util.php';

function getReviewById($id) {
    $conn = new Connection();
    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
        return null;
    } else {
        $review = $conn->getReviewById($id);
        $conn->closeConnection();

        return $review;
    }
}

function editReview($id, $text, $rating): void {
    $conn = new Connection();
    if(!$conn->connect()) {
        setErrorMessage('~connection_error~');
    } else {
        $conn->editReview($id, $text, $rating);
        $conn->closeConnection();
    }
}

function deleteReview($id): void {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');
    else {
        $conn->deleteReview($id);
        $conn->closeConnection();
    }
}