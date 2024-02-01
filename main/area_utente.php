<?php
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    if(get_logged_user()==""){
        header("Location: login.php");
        exit();
    }
    $errors="";
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username=Clean($_POST["username"]);
        $password=Clean($_POST["password"]);
        if(!Check($username,$patternUser)||!Check($password,$patternPassword)){
            $errors="formato_invalido";
        }
        $errors=LoginUser($username,$password);
        if($errors==""){
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

    </div>
</body>
</html>