<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/config.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";

    global $patternUser, $patternPassword;

    if(get_logged_user()){
        header("Location: area_utente.php");
        exit();
    }

    $errors = null;

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);

        if(!checkInputCorrectness($username, $patternUser) || !checkInputCorrectness($password, $patternPassword)){
            $errors = "formato_invalido";
        }

        $errors = loginUser($username,$password);

        if($errors == null){
            header("Location: area_utenti.php");
            exit();
        }
    }

    $login_text = GetTesti("login");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("login"); ?>

    <div id="content">
        <?php
        if($errors != null){
            $errorstext=GetTesti("errors");
            echo "<p class='errormesage'>". $errorstext[$errors]."</p>";
        }
        ?>

        <p><?php echo $login_text["prompt_registrarsi"]?> <a href='signup.php'><?php echo $login_text["pulsante_registrazione"]?></a></p>

        <form id="form" action="login.php" method="post">
            <label for="username"><?php echo $login_text["label_username"]?></label>
            <input id="username" name="username" type="text" />
            <label for="password"><?php echo $login_text["label_password"]?></label>
            <input id="password" name="password" type="password" />
            <input type="submit" value="<?php echo $login_text["testo_pulsante"]?>" />
        </form>
    </div>
</body>