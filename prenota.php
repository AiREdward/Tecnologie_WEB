<?php

    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/ManagerLocalizzazione.php";
    require_once "utilities/UtilitiesRooms.php";
    require_once "utilities/UserFunctions.php";

    if(isset($_GET["room"])) $_SESSION["id_room"] = $_GET["room"];

    $user = getLoggedUser();

    if($user == null) {
        $_SESSION["next_page"] = "prenota.php";
        header("Location: login.php");
        exit();
    }

    $id_room = $_SESSION["id_room"];
    $slots = getPossibleSlots($id_room, date('Y-m-d'));

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
    <!-- TODO: Selezionatore della data -->
    <label for="day-selector">Selezione del giorno</label>
    <input id="day-selector" name="day" type="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime("+1 month")); ?>"/>
    <!-- TODO: Selezionatore dello slot -->
    <select name="rooms" id="rooms">
        <option value="">Selezione dello slot</option>
        <?php
            foreach ($slots as $slot) {
                echo '<option value="' . $slot . '">' . $slot . '</option>';
            }
        ?>
    </select>
    <!-- TODO: Pulsante di conferma -->
    <button id="prenota" name="prenota" type="submit"><?php //echo $prenota_text["pulsante_prenota"] ?> Prenota </button>
</body>
</html>
