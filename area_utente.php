<?php
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";

    global $patternUser, $patternPassword;

    $user = get_logged_user();

    if(!get_logged_user()){
        header("Location: login.php");
        exit();
    }

    $errors = null;

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);
        if(!checkInputCorrectness($username, $patternUser) || !checkInputCorrectness($password, $patternPassword)) {
            $errors="formato_invalido";
        }
        $errors = loginUser($username, $password);
        if($errors == null) {
            header("Location: area_utenti.php");
            exit();
        }
    }
    $roomstext=GetTesti("area_utente");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>

    <?php echo genera_header("area_utente"); ?>

    <div id="content">
        <span>Area Utente</span>
        <br>
        <span>Benvenuto <?php echo $user ?></span>
        <a href="logout.php">Logout</a>

    </div>
</body>
</html>