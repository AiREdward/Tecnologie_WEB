<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/config.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";

    $errors = null;
    global $patternUser, $patternPassword, $patternTelefono;

    // Controlla che tutti i dati obbligatori siano stati inseriti
    function all_set() : bool {
        if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["telefono"]) && isset($_POST["email"] ) && isset($_POST["nascita"]) && isset($_POST["username"]) && isset($_POST["password"]))
            return true;
        else
            return false;
    }

    if(all_set()) {
        $nome = sanitizeInput($_POST["nome"]);
        $cognome = sanitizeInput($_POST["cognome"]);
        $telefono = sanitizeInput($_POST["telefono"]);
        $email = sanitizeInput($_POST["email"]);
        $nascita = sanitizeInput($_POST["nascita"]);
        $username = sanitizeInput($_POST["username"]);
        $password = sanitizeInput($_POST["password"]);

        if(checkInputCorrectness($_POST["username"], $patternUser)) {
            if(checkInputCorrectness($_POST["telefono"], $patternTelefono)) {
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    if(checkInputCorrectness($_POST["password"], $patternPassword)) {
                        $errors = registerUser($username, $email, $password, $nome, $cognome, $telefono, $nascita);
                    } else {
                        $errors="password_invalida";
                        //echo 'la password non è valida, deve avere almeno 1 carattere maiuscolo, 1 minuscolo, un numero, un simbolo ed almeno 8 caratteri';
                    }
                }
                else {
                    $errors="email_invalida";
                }
            }
            else {
                $errors="telefono_invalido";
            }
        }
        else{
            $errors="utente_invalido";
        }

        if($errors == null) {
            $errors = logUser($username,$password);
        }

        if($errors == null) {
            header("Location: area_utente.php");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("signup"); ?>

    <div id="content">
        <?php
            if($errors != null){
                $errortext = getTexts("errors");
                echo "<p class='errormessage'>". $errortext[$errors]."</p>";
            }

            $signuptext=getTexts("signup");
        ?>

        <p><?php echo $signuptext["prompt_login"]?><a href='login.php'><?php echo $signuptext["pulsante_login"]?></a>

        <form id="form" class="largeform" action="signup.php" method="post">
            <fieldset>
                <legend><?php echo $signuptext["legend_anagrafica"]?></legend>
                <label for="nome"><?php echo $signuptext["label_nome"]?></label>
                <input id="nome" name="nome" type="text" required/>
                <label for="cognome"><?php echo $signuptext["label_cognome"]?></label>
                <input id="cognome" name="cognome" type="text" required/>
                <label for="nascita"><?php echo $signuptext["label_nascita"]?></label>
                <input id="nascita" name="nascita" type="date" min="1924-01-01" max="<?php echo date('Y-m-d'); ?>" required/>
            </fieldset>
            <fieldset>
                <legend><?php echo $signuptext["legend_contatti"]?></legend>
                <label for="telefono"><?php echo $signuptext["label_telefono"]?></label>
                <input id="telefono" name="telefono" type="text"/>
                <label for="email" lang="en"><?php echo $signuptext["label_email"]?></label>
                <input id="email" name="email" type="email" required/>
            </fieldset>
            <fieldset>
                <legend><?php echo $signuptext["legend_account"]?></legend>
                <label for="username" lang="en"><?php echo $signuptext["label_username"]?></label>
                <input id="username" name="username" type="text" required/>
                <label for="password" lang="en"><?php echo $signuptext["label_password"]?></label>
                <input id="password" name="password" type="password" required/>
                <label for="conferma"><?php echo $signuptext["label_conferma"]?></label>
                <input id="conferma" name="conferma" type="password" />
                <input type="submit" value="<?php echo $signuptext["testo_pulsante"]?>" required/>
            </fieldset>
    </div>
</body>
</html>