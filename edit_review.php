<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/review_util.php';
require_once 'utilities/input_util.php';
require_once 'utilities/message_util.php';

if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    $_SESSION['review_id_editing'] = $review_id;
} else {
    if($_SESSION['review_id_editing'] == null) {
        header('Location: 404.php');
        exit();
    } else {
        $review_id = $_SESSION['review_id_editing'];
    }
}

$review = getReviewById($review_id);

if(getLoggedUser() != $review['Username']) {
    header('Location: user_area.php');
    exit();
}

if(isset($_POST['modifica_recensione'])) {
    $text = checkIfReviewIsValid($_POST['review-box']);
    $rating = $_POST['rating'];

    if(!isErrorSet()) {
        editReview($review_id, $text, $rating);

        $_SESSION['review_id_editing'] = null;

        header('Location: user_area.php');
        exit();
    }
}

$page = initPage(__FILE__);

$edit_review_component = file_get_contents('templates/edit_review.html');

$content = str_replace('{review_id}', $review_id, $edit_review_component);
$content = str_replace('{review_text}', $review['Testo'], $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'editReview.js');

echo $page;