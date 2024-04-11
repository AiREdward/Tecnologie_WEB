<?php
require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";
require_once "utilities/ManagerLocalizzazione.php";
require_once "utilities/UserFunctions.php";
require_once "utilities/UtilitiesPrenotazione.php";

$user = getLoggedUser();

// TODO: send a message to login page that explains the user has to login to view a room ad admin
if($user == null) {
    $_SESSION["next_page"] = "amministrazione_stanza.php";
    header("Location: login.php");
    exit();
} else {
    $_SESSION["next_page"] = null;
}

if(!checkIfUserIsAdmin($user)){
    header("Location: index.php");
    exit();
}

if(isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];
    $_SESSION["room_id_admin_view"] = $room_id;
} else {
    if($_SESSION["room_id_admin_view"] == null) {
        header("Location: 404.php");
        exit();
    }
}

$bookings = getNextRoomBookings($room_id);

$amministrazione_stanza_texts = getTexts("amministrazione_stanza");
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
<?php echo genera_header("amministrazione_stanza"); ?>
<h2>Stanza num: <?php echo $room_id ?></h2>

<h3>Lista delle prenotazioni future:</h3>
<ul>
    <?php
        foreach ($bookings as $booking) {
            echo "<li> Prenotazione numero: " . $booking["ID"] . " | Data: " . $booking["Data_Prenotazione"] . " | Orario: " . $booking["Ora_Prenotazione"] . " | Utente: " . $booking["Username"] . "</li>";
        }
    ?>
</ul>

</body>
</html>