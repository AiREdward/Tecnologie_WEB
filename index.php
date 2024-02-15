<?php
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    require_once "utilities/UtilitiesRooms.php";

    $rooms = getRoomInfo();
    $rooms_info_english = getRoomInfoEnglish();

    $rooms_text = getTexts("rooms");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>

    <?php echo genera_header("home"); ?>

    <div id="content">
        <?php
            if ($_SESSION["lang"] == "it") {
                // Italian Version
                foreach ($rooms as $room) {
                    echo '<section id="stanza' . $room["ID"] . '" class="home_room">
                    <h2 class="titolostanza">' . $room["Nome"] . '</h2>
                    <dl class="recap">
                        <dt>' . $rooms_text["difficolta"] . '</dt><dd>' . $room["Difficolta"] . '</dd>
                        <dt>' . $rooms_text["partecipanti"] . '</dt><dd>' . $room["Numero_Partecipanti_Minimo"] . '-' . $room["Numero_Partecipanti_Massimo"] . '</dd>
                        <dt>' . $rooms_text["durata"] . '</dt><dd>' . $room["Durata"] . ' min' . '</dd>
                    </dl>
                    <img class="room_photo" src="./images/room' . $room["ID"] . '.webp" alt="' . $rooms_text["room" . $room["ID"] . "_img_alt"] . '">
                    <p class="ambientazione">' . $room["Descrizione"] . '</p>
                    <a class="prenotazione_rapida" href="prenota.php?room=' . $room["ID"] . '">' . $rooms_text["pulsante_prenota"] . '</a>
                </section>
                ';
                }
            } else {
                // English Version
                foreach ($rooms as $room) {
                    echo '<section id="stanza' . $room["ID"] . '" class="home_room">
                    <h2 class="titolostanza">' . $rooms_info_english[$room["ID"] - 1]["Nome"] . '</h2>
                    <dl class="recap">
                        <dt>' . $rooms_text["difficolta"] . '</dt><dd>' . $room["Difficolta"] . '</dd>
                        <dt>' . $rooms_text["partecipanti"] . '</dt><dd>' . $room["Numero_Partecipanti_Minimo"] . '-' . $room["Numero_Partecipanti_Massimo"] . '</dd>
                        <dt>' . $rooms_text["durata"] . '</dt><dd>' . $room["Durata"] . ' min' . '</dd>
                    </dl>
                    <img class="room_photo" src="./images/room' . $room["ID"] . '.webp" alt="' . $rooms_text["room" . $room["ID"] . "_img_alt"] . '">
                    <p class="ambientazione">' . $rooms_info_english[$room["ID"] - 1]["Descrizione"] . '</p>
                    <a class="prenotazione_rapida" href="prenota.php?room=' . $room["ID"] . '">' . $rooms_text["pulsante_prenota"] . '</a>
                </section>
                ';
                }
            }
        ?>
    </div>
</body>
</html>