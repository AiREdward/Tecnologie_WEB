<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/config.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";
    if(get_logged_user()!=""){
        header("Location: area_utenti.php");
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

    $logintext=GetTesti("login");
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
        if($errors!=""){
            $errorstext=GetTesti("errors");
            echo "<p class='errormesage'>". $errorstext[$errors]."</p>";
        }
        ?>

        <p><?php echo $logintext["prompt_registrarsi"]?> <a href='signup.php'><?php echo $logintext["pulsante_registrazione"]?></a></p>

        <form id="form" action="login.php" method="post">
            <label for="username"><?php echo $logintext["label_username"]?></label>
            <input id="username" name="username" type="text" />
            <label for="password"><?php echo $logintext["label_password"]?></label>
            <input id="password" name="password" type="password" />
            <input type="submit" value="<?php echo $logintext["testo_pulsante"]?>" />
        </form>
    </div>
</body>