<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/ManagerLocalizzazione.php";
    require_once "utilities/UtilitiesRooms.php";
    require_once "utilities/UserFunctions.php";

    if(isset($_GET["room"])) $_SESSION["id_room"] = $_GET["room"];

    $user = getLoggedUser();

    // TODO: send a message to login page that explains the user has to login to book a room
    if($user == null) {
        $_SESSION["next_page"] = "prenota.php";
        header("Location: login.php");
        exit();
    }

    $id_room = $_SESSION["id_room"];

    if(isset($_POST["prenota"])) {
        $day = $_POST["day"];
        $slot = $_POST["rooms"];

        bookRoom($day, $slot, $user, $id_room);
    }

    $prenota_text = getTexts("prenota");
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php
        echo genera_header("prenota");
    ?>
    <h2>Prenotazione Room: </h2>
    <h2 id="room-id"><?php echo $id_room ?></h2>

    <form id="form" action="prenota.php" method="post">
        <label for="day-selector">Selezione del giorno</label>
        <input id="day-selector" name="day" type="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime("+1 month")); ?>"/>

        <label for="slot-selector">Selezione dello slot</label>
        <select name="rooms" id="slot-selector">
            <option value="">Selezione dello slot</option>
        </select>

        <button id="submit-button" name="prenota" type="submit"><?php //echo $prenota_text["pulsante_prenota"] ?> Prenota </button>
    </form>

    <script type="text/javascript" src="js/slotSelector.js"></script>
</body>
</html>
