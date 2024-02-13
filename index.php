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

    <!-- Deprecated code
    <div id="content">
        <section id="stanza1" class="home_room">
            <h2 class="titolostanza"><?php echo $rooms_text["room1_title"]?></h2>
            <dl class="recap">
                <dt><?php echo $rooms_text["difficolta"]?></dt><dd>3</dd>
                <dt><?php echo $rooms_text["partecipanti"]?></dt><dd>2-6</dd>
                <dt><?php echo $rooms_text["durata"]?></dt><dd>55 min</dd>
            </dl>
            <img class="room_photo" src="./images/room1.webp" alt="<?php echo $rooms_text["room1_img_alt"]?>">
            <p class="ambientazione"><?php echo $rooms_text["room1_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $rooms_text["pulsante_prenota"]?></a>
        </section>
        <section id="stanza2" class="home_room">
            <h2 class="titolostanza"><?php echo $rooms_text["room2_title"]?></h2>
            <dl class="recap">
                <dt><?php echo $rooms_text["difficolta"]?></dt><dd>2</dd>
                <dt><?php echo $rooms_text["partecipanti"]?></dt><dd>4-5</dd>
                <dt><?php echo $rooms_text["durata"]?></dt><dd>45 min</dd>
            </dl>
            <img  class="room_photo" src="./images/room2.webp" alt="<?php echo $rooms_text["room2_img_alt"]?>">
            <p class="ambientazione"><?php echo $rooms_text["room2_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $rooms_text["pulsante_prenota"]?></a>
        </section>
        <section id="stanza3" class="home_room">
            <h2 class="titolostanza"><?php echo $rooms_text["room3_title"]?></h2>
            <dl class="recap">
                <dt><?php echo $rooms_text["difficolta"]?></dt><dd>1</dd>
                <dt><?php echo $rooms_text["partecipanti"]?></dt><dd>3-4</dd>
                <dt><?php echo $rooms_text["durata"]?></dt><dd>35 min</dd>
            </dl>
            <img class="room_photo" src="./images/room3.jpg" alt="<?php echo $rooms_text["room3_img_alt"]?>">
            <p class="ambientazione"><?php echo $rooms_text["room3_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $rooms_text["pulsante_prenota"]?></a>
        </section>
    </div>
    -->
</body>
</html>