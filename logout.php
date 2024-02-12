<?php

    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";

    logout();

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("logout"); ?>

    <div id="content">
        <p><?php echo getTexts("logout")["logout_success"] ?></p>
        <a href="login.php"><?php echo getTexts("logout")["login_link"] ?></a>
    </div>
</body>
</html>