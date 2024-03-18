<?php
require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";
require_once "utilities/ManagerLocalizzazione.php";
require_once "utilities/UtilitiesPrenotazione.php";

if(isset($_GET["id"])) {
    $booking_id = $_GET["id"];
    $_SESSION["booking_id_editing"] = $booking_id;
} else {
    if(isset($_SESSION["booking_id_editing"])) {
        $booking_id = $_SESSION["booking_id_editing"];
    } else {
        header("Location: 404.php");
        exit();
    }
}

$booking_info = getBookingInfo($booking_id);

if(isset($_POST["prenota"])) {
    $day = $_POST["day"];
    $slot = $_POST["slot"];

    editBooking($day, $slot, $booking_id);

    $_SESSION["booking_id_editing"] = null;

    header("Location: area_utente.php");
}

$mod_pren_texts = getTexts("modifica_prenotazione");
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("modifica_prenotazione"); ?>
    <h2>Modifica prenotazione ID #<?php echo $booking_id ?></h2>
    <h3>Prenotazione:</h3>
    <div>
        <span id="booking-date"><?php echo $booking_info["Data_Prenotazione"] ?></span><span> - </span>
        <span id="booking-time"><?php echo $booking_info["Ora_Prenotazione"] ?></span><span> by </span>
        <span id="booking-user"><?php echo $booking_info["Username"] ?></span><span> at Room </span>
        <span id="booking-room"><?php echo $booking_info["ID_Room"] ?></span>
    </div>
    <form id="form" action="modifica_prenotazione.php" method="post">
        <h4>Modifica:</h4>

        <label for="day-selector">Selezione del giorno</label>
        <input id="day-selector" name="day" type="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime("+1 month")); ?>"/>

        <label for="slot-selector">Selezione dello slot</label>
        <select name="slot" id="slot-selector"></select>

        <button id="submit-button" name="prenota" type="submit"><?php //echo $prenota_text["pulsante_prenota"] ?> Modifica </button>
    </form>

    <button id="delete-button" name="delete" type="submit"><?php //echo $prenota_text["pulsante_elimina"] ?> Elimina </button>

    <script type="text/javascript" src="js/bookingEdit.js"></script>
</body>
</html>