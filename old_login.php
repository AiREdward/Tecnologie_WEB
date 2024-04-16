<?php
require_once "utilities/HeadPagina.php";
require_once "utilities/HeaderPagina.php";
require_once "utilities/config.php";
require_once "utilities/UserFunctions.php";
require_once "utilities/InputCleaner.php";

global $regex_username, $regex_password;

$user = getLoggedUser();

if($user){
    if($_SESSION["next_page"] == "area_utente.php") {
        if(checkIfUserIsAdmin($user)) header("Location: admin.php");
        else header("Location: area_utente.php");
    } else {
        header("Location: " . $_SESSION["next_page"]);
    }
    exit();
}

$errors = null;

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    if(!checkInputCorrectness($username, $regex_username) || !checkInputCorrectness($password, $regex_password)) {
        $errors = "formato_invalido";
    }

    $errors = logUser($username,$password);

    if($errors == null){
        if($_SESSION["next_page"] == "area_utente.php") {
            if(checkIfUserIsAdmin($user)) header("Location: admin.php");
            else header("Location: area_utente.php");
        } else {
            header("Location: " . $_SESSION["next_page"]);
        }
        exit();
    }
}

$login_text = getTexts("login");
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
            $errors_text = getTexts("errors");
            echo "<p class='errormessage'>". $errors_text[$errors]."</p>";
        }
        ?>

        <p><?php echo $login_text["prompt_registrarsi"]?> <a href='signup.php'><?php echo $login_text["pulsante_registrazione"]?></a></p>

        <form id="form" action="old_login.php" method="post">
            <label for="username"><?php echo $login_text["label_username"]?></label>
            <input id="username" name="username" type="text" />
            <label for="password"><?php echo $login_text["label_password"]?></label>
            <input id="password" name="password" type="password" />
            <input type="submit" value="<?php echo $login_text["testo_pulsante"]?>" />
        </form>
    </div>
</body>
