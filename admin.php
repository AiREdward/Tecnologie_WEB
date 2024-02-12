<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("login"); ?>
</body>
</html>
