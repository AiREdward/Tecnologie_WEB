<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/user_util.php';

// TODO: send a message to login page that explains the user has to login to book a room
redirectIfUserNotLoggedIn(__FILE__);

if(isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];
    $_SESSION["room_id_review"] = $room_id;
} else {
    if($_SESSION["room_id_review"] == null) {
        header("Location: 404.php");
        exit();
    }
}

if(isset($_POST["crea_recensione"])) {
    $review = $_POST["review-box"];

    createReviewForUser(getLoggedUser(), $_SESSION["room_id_review"], $review, $_POST["rating"]);
    $_SESSION["room_id_review"] = null;
    header("Location: area_utente.php");
}

$page = initPage(__FILE__);

$create_review_component = file_get_contents('templates/crea_recensione.html');

$content = str_replace('{room_id}', $room_id, $create_review_component);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);

echo $page;