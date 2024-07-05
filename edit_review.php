<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/review_util.php';

if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    $_SESSION['review_id_editing'] = $review_id;
} else {
    if(isset($_SESSION['review_id_editing'])) {
        $review_id = $_SESSION['review_id_editing'];
    } else {
        header('Location: 404.php');
        exit();
    }
}

$review = getReviewById($review_id);

if(getLoggedUser() != $review['Username']) {
    header('Location: user_area.php');
    exit();
}

if(isset($_POST['modifica_recensione'])) {
    $text = $_POST['review-box'];
    $rating = $_POST['rating'];

    editReview($review_id, $text, $rating);

    $_SESSION['review_id_editing'] = null;

    header('Location: user_area.php');
    exit();
}

$page = initPage(__FILE__);

$edit_review_component = file_get_contents('templates/edit_review.html');

$content = str_replace('{review_id}', $review_id, $edit_review_component);
$content = str_replace('{review_text}', $review['Testo'], $content);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'deleteReview.js');

echo $page;