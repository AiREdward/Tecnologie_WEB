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
            $rooms = getRoomInfo();
            foreach($rooms as $room){
                echo "<li><a href='room.php?id=" . $room["ID"] . "'>" . $room["Nome"] . "</a></li>";
            }
        ?>
    </ul>

    <!-- just for testing purposes -->
    <h2>Opening Hours:</h2>

    <a href="logout.php">logout</a>
</body>
</html>
