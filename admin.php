<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/UtilitiesRooms.php";

    $user = getLoggedUser();

    if($user == null){
        $_SESSION["next_page"] = "admin.php";
        header("Location: login.php");
        exit();
    } else $_SESSION["next_page"] = null;

    if(!checkIfUserIsAdmin($user)){
        header("Location: area_utente.php");
        exit();
    }

    $rooms = getRoomInfo();
    $rooms_info_english = getRoomInfoEnglish();
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("admin"); ?>

    <h2>Rooms:</h2>
    <ul>
        <?php
        if ($_SESSION["lang"] == "it") {
            // Italian Version
            foreach ($rooms as $room) {
                echo '<p><a href="amministrazione_stanza.php?room_id=' . $room["ID"] . '">' . $room["Nome"] . '</a></p>';
            }
        } else {
            // English Version
            foreach ($rooms as $room) {
                echo '<p><a href="amministrazione_stanza.php?room_id=' . $room["ID"] . '"> ' . $rooms_info_english[$room["ID"] - 1]["Nome"] . '</a></p>';
            }
        }
        ?>
    </ul>

    <a href="logout.php">logout</a>
</body>
</html>