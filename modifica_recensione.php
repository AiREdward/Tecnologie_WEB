<?php
require_once 'utilities/global.php';
require_once "utilities/utilitiesReview.php";

// TODO: add a check to see if the user logged in is the same user that made the review

if(isset($_GET["review_id"])) {
    $review_id = $_GET["review_id"];
    $_SESSION["review_id_editing"] = $review_id;
} else {
    if(isset($_SESSION["review_id_editing"])) {
        $review_id = $_SESSION["review_id_editing"];
    } else {
        header("Location: 404.php");
        exit();
    }
}

$review = getReviewById($review_id);

if(isset($_POST["modifica_recensione"])) {
    $text = $_POST["review-box"];
    $rating = $_POST["rating"];

    editReview($review_id, $text, $rating);

    $_SESSION["review_id_editing"] = null;

    header("Location: area_utente.php");
}

$page = initPage(__FILE__);

$edit_review_component = file_get_contents('templates/modifica_recensione.html');

$content = str_replace('{review_id}', $review_id, $edit_review_component);
$content = str_replace('{review_text}', $review['Testo'], $content);

$page = str_replace('{content}', $content, $page);

$page = insertText($page);
$page = insertScript($page, 'deleteReview.js');

echo $page;