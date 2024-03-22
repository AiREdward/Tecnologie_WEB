<?php
require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";
require_once "utilities/ManagerLocalizzazione.php";
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

$mod_rev_texts = getTexts("modifica_recensione");
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("modifica_recensione"); ?>

    <h2>Modifica recensione #<span id="review-id"><?php echo $review_id ?></span></h2>

    <form id="form" action="crea_recensione.php" method="post">
        <label for="review-box">Modifica la recensione</label>
        <input id="review-box" name="review-box" type="text" maxlength="1024" value="<?php echo $review['Testo']; ?>"/>

        <label for="rating">Voto:</label>
        <input id="rating" name="rating" type="number" min="1" max="5" step="1" value="3"/>

        <button id="submit-button" name="modifica_recensione" type="submit"><?php //echo $mod_rev_text["pulsante_modifica_recensione"] ?> Modifica </button>
    </form>

    <button id="delete-button" name="delete" type="submit"><?php //echo $mod_rev_text["pulsante_elimina_recensione"] ?> Elimina </button>

    <script type="text/javascript" src="js/deleteReview.js"></script>
</body>
</html>
