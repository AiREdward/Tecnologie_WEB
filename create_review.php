<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/user_util.php';
require_once 'utilities/room_util.php';
require_once 'utilities/input_util.php';
require_once 'utilities/message_util.php';

redirectIfUserNotLoggedIn(__FILE__);

if(isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
    $_SESSION['room_id_review'] = $room_id;
} else {
    if($_SESSION['room_id_review'] == null) {
        header('Location: 404.php');
        exit();
    } else {
        $room_id = $_SESSION['room_id_review'];
    }
}

if(isset($_POST['crea_recensione'])) {
    $review = checkIfReviewIsValid($_POST['review-box']);

    if(!isErrorSet()) {
        createReviewForUser(getLoggedUser(), $_SESSION['room_id_review'], $review, $_POST['rating']);
        $_SESSION['room_id_review'] = null;
        header('Location: user_area.php');
        exit();
    }
}

$page = initPage(__FILE__);

$rooms = getRoomInfo();
$rooms_info_english = getRoomInfoEnglish();

$create_review_component = file_get_contents('templates/create_review.html');

if(getLanguage() == 'it') {
    $content = str_replace('{room_name}', $rooms[$room_id -1]["Nome"], $create_review_component);
} else{
    $content = str_replace('{room_name}', $rooms_info_english[$room_id - 1]["Nome"], $create_review_component);
}

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'createReview.js');

echo $page;