<?php
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    $roomstext=GetTesti("rooms");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>

    <?php echo genera_header("home"); ?>

    <div id="content">
        <section id="stanza1" class="home_room">
            <h2 class="titolostanza"><?php echo $roomstext["room1_title"]?></h2>            
            <dl class="recap">
                <dt><?php echo $roomstext["difficolta"]?></dt><dd>3</dd>
                <dt><?php echo $roomstext["partecipanti"]?></dt><dd>2-6</dd>
                <dt><?php echo $roomstext["durata"]?></dt><dd>55 min</dd>
            </dl>
            <img class="room_photo" src="./images/room1.webp" alt="<?php echo $roomstext["room1_img_alt"]?>">
            <p class="ambientazione"><?php echo $roomstext["room1_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $roomstext["pulsante_prenota"]?></a>
        </section>
        <section id="stanza2" class="home_room">
            <h2 class="titolostanza"><?php echo $roomstext["room2_title"]?></h2>            
            <dl class="recap">
                <dt><?php echo $roomstext["difficolta"]?></dt><dd>2</dd>
                <dt><?php echo $roomstext["partecipanti"]?></dt><dd>4-5</dd>
                <dt><?php echo $roomstext["durata"]?></dt><dd>45 min</dd>
            </dl>
            <img  class="room_photo" src="./images/room2.webp" alt="<?php echo $roomstext["room2_img_alt"]?>">
            <p class="ambientazione"><?php echo $roomstext["room2_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $roomstext["pulsante_prenota"]?></a>
        </section>
        <section id="stanza3" class="home_room">
            <h2 class="titolostanza"><?php echo $roomstext["room3_title"]?></h2>            
            <dl class="recap">
                <dt><?php echo $roomstext["difficolta"]?></dt><dd>1</dd>
                <dt><?php echo $roomstext["partecipanti"]?></dt><dd>3-4</dd>
                <dt><?php echo $roomstext["durata"]?></dt><dd>35 min</dd>
            </dl>
            <img class="room_photo" src="./images/room3.jpg" alt="<?php echo $roomstext["room3_img_alt"]?>">
            <p class="ambientazione"><?php echo $roomstext["room3_ambientazione"]?></p>
            <a class="prenotazione_rapida" href="prenota.php?room=1"><?php echo $roomstext["pulsante_prenota"]?></a>
        </section>
    </div>
</body>
</html>