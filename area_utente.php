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

    if(isset($_GET["action"]) && $_GET["action"]=="logout") {
        logout();
        header("Location: login.php");
    }
    $areautentetext=GetTesti("area_utente");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>

    <?php echo genera_header("area_utente"); ?>

    <div id="content">
        <p><?php echo $areautentetext["in_as"]." ".get_logged_user()?></p>
        <a href="area_utente.php?action=logout"><?php echo $areautentetext["logout"]?></a>

    </div>
</body>
</html>