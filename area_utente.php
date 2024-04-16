<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";
    require_once "utilities/UtilitiesPrenotazione.php";

    global $regex_username, $regex_password;

    $user = getLoggedUser();

    if($user == null){
        $_SESSION["next_page"] = "area_utente.php";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION["next_page"] = null;
    }

    if(checkIfUserIsAdmin($user)){
        header("Location: admin.php");
        exit();
    }

    $errors = null;

    $next_bookings = getNextBookingsByUser($user);
    $past_bookings = getPastBookingsByUser($user);

    $area_utente_text = getTexts("area_utente");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("area_utente"); ?>

    <div id="content">
        <p><?php echo $area_utente_text["in_as"] . getLoggedUser()?></p>
        <h2><?php // echo $area_utente_text["riepilogo_prenotazioni"]?>Prossime Prenotazioni</h2>
        <ul class="prenotazioni_utente">
            <?php 
                /*
                foreach($prenotazioni as $prenotazione) {
                    echo "<li class='singola_prenotazione'>".$prenotazione["data_"]."  ".$prenotazione["orario"];
                    if(strtotime($prenotazione["data_"])>strtotime('now')) {
                        echo "<a class='link_modifica' href='modifica_prenotazione.php?id=".$prenotazione["id_prenotazione"]."' >".$area_utente_text["modifica_prenotazioe"]."</a>";
                    }
                    echo "</li>";
                }
                */

                if ($next_bookings == null) {
                    echo "Non hai prenotazioni future.";
                } else {
                    foreach ($next_bookings as $booking) {
                        echo "<li class='singola_prenotazione'>" . $booking["Data_Prenotazione"] . "  " . $booking["Ora_Prenotazione"] . " [Room: " . $booking["ID_Room"] . "] ";
                        echo "<a class='link_modifica' href='modifica_prenotazione.php?id=" . getBookingId($booking["Data_Prenotazione"], $booking["Ora_Prenotazione"], $user, $booking["ID_Room"]) . "' >" . $area_utente_text["modifica_prenotazione"] . "</a>";
                        echo "</li>";
                    }
                }
            ?>
        </ul>
        <h2><?php // echo $area_utente_text["riepilogo_prenotazioni"]?>Prenotazioni Passate</h2>
        <ul class="prenotazioni_utente">
            <?php
                if($past_bookings == null) {
                    echo "Non hai prenotazioni passate.";
                } else {
                    foreach ($past_bookings as $booking) {
                        echo "<li class='singola_prenotazione'>" . $booking["Data_Prenotazione"] . "  " . $booking["Ora_Prenotazione"] . " [Room: " . $booking["ID_Room"] . "]" . "</li>";
                    }
                }
            ?>
        </ul>

        <h2><?php // echo $area_utente_text["recensioni"] ?>Scrivi una recensione:</h2>
        <ul class="">
            <?php
                $rooms_for_review = getRoomsForNewReview($user);

                $area_utente_text["crea_recensione"] = "Crea recensione";

                if($rooms_for_review == null) {
                    echo "Non hai stanze da recensire.";
                } else {
                    foreach ($rooms_for_review as $re) {
                        echo "<li>";
                        echo "<a class='link_modifica' href='crea_recensione.php?room_id=" . $re . "' >" . $area_utente_text["crea_recensione"] . " per Room " . $re . "</a>";
                        echo "</li>";
                    }
                }
            ?>
        </ul>

        <h2><?php // echo $area_utente_text["visualizza_recensioni"] ?>Recensioni scritte:</h2>
        <ul class="">
            <?php
                $reviews = getUserReviews($user);

                if($reviews == null) {
                    echo "Non hai recensioni scritte.";
                } else {
                    foreach ($reviews as $re) {
                        echo "<li>";
                        echo "Room " . $re["ID_Room"] . " - Valutazione: " . $re["Voto"] . " - Testo: " . $re["Testo"];
                        echo "<br>";
                        echo " <a class='link_modifica' href='modifica_recensione.php?review_id=" . $re["ID"] . "' >" . $area_utente_text["modifica_recensione"] . "</a> ";
                        echo "</li>";
                    }
                }
            ?>
        </ul>

        <a href="logout.php"><?php echo $area_utente_text["logout"]?></a>
    </div>
</body>
</html>