<?php

require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";

if(isset($_GET["id"])) {
    $booking_id = $_GET["id"];
} else {
    header("Location: 404.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("modifica_prenotazione"); ?>
    <h2>Modifica prenotazione #<?php echo $booking_id ?></h2>
    <p>
    </p>
    <form>
    </form>
</body>
</html>