<?php
require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";
require_once "utilities/ManagerLocalizzazione.php";
require_once "utilities/UserFunctions.php";

$user = getLoggedUser();

// TODO: send a message to login page that explains the user has to login to book a room
if($user == null) {
    $_SESSION["next_page"] = "crea_recensione.php";
    header("Location: login.php");
    exit();
} else {
    $_SESSION["next_page"] = null;
}

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

    createReviewForUser($user, $_SESSION["room_id_review"], $review, $_POST["rating"]);
    $_SESSION["room_id_review"] = null;
    header("Location: area_utente.php");
}

$crea_recensione_texts = getTexts("crea_recensione");
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("crea_recensione"); ?>
    <h2>Crea Recensione per Stanza n<?php echo $room_id ?></h2>

    <form id="form" action="crea_recensione.php" method="post">
        <label for="review-box">Scrivi la recensione</label>
        <input id="review-box" name="review-box" type="text" maxlength="1024"/>

        <label for="rating">Voto:</label>
        <input id="rating" name="rating" type="number" min="1" max="5" step="1" value="3"/>

        <button id="submit-button" name="crea_recensione" type="submit"><?php //echo $crea_recensione_text["pulsante_crea_recensione"] ?> Crea </button>
    </form>
</body>
</html>