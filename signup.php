<?php
    require_once "utilities/HeadPagina.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";

    $errors="";
    if(all_set()){
        $nome=Clean($_POST["nome"]);
        $cognome=Clean($_POST["cognome"]);
        $telefono=Clean($_POST["telefono"]);
        $email=Clean($_POST["email"]);
        $nascita=Clean($_POST["nascita"]);
        $username=Clean($_POST["username"]);
        $password=Clean($_POST["password"]);
        if(empty($_POST["telefono"]) || preg_match($patternTelefono, $_POST["telefono"]))
        {
            if(empty($_POST["email"]) || filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            {
                if(preg_match($patternPassword, $_POST["password"]))
                {
                    $errors=RegisterUser($username,$email,$password,$nome,$cognome,$telefono,$nascita);
                }else{
                    $errors="password_invalida";
                    //echo'la password non è valida, deve avere almeno 1 carattere maiuscolo, 1 minuscolo, un numero, un simbolo ed almeno 8 caratteri';
                }
            }
            else{
                $errors="email_invalida";
            }
        }
        else{
            $errors="telefono_invalido";
        }
        $errors=LoginUser($username,$password);
        if($errors==""){
            header("Location: area_utenti.php");
            exit();
        }
    }
    function all_set():bool{                                     //controlla che tutti i dati obbligatori siano stati inseriti
        if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["telefono"]) && isset($_POST["email"] ) && isset($_POST["nascita"]) && isset($_POST["username"]) && isset($_POST["password"])){
            return true;
        }else{
            return false;
        }
    }
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
<?php
	echo genera_header("signup");
?>

<div id="content">
    <?php
    if($errors!=""){
        $errortext=GetTesti("error");
        echo "<p class='errormesage'>". $errortext[$errors]."</p>";
    }
    $signuptext=GetTesti("signup");
    ?>
    <p><?php echo $signuptext["prompt_login"]?><a href='login.php'><?php echo $signuptext["pulsante_login"]?></a>


    <form id="form" class="largeform" action="/enigma/php/signup.php" method="post">
        <fieldset>
            <legend><?php echo $signuptext["legend_anagrafica"]?></legend>
            <label for="nome"><?php echo $signuptext["label_nome"]?></label>
            <input id="nome" name="nome" type="text" />
            <label for="cognome"><?php echo $signuptext["label_cognome"]?></label>
            <input id="cognome" name="cognome" type="text" />
            <label for="nascita"><?php echo $signuptext["label_nascita"]?></label>
            <input id="nascita" name="nascita" type="date" min="1924-01-01" max="2023-12-31"/>
        </fieldset>
        <fieldset>
            <legend><?php echo $signuptext["legend_contatti"]?></legend>
            <label for="telefono"><?php echo $signuptext["label_telefono"]?></label>
            <input id="telefono" name="telefono" type="text"/>
            <label for="email" lang="en"><?php echo $signuptext["label_email"]?></label>
            <input id="email" name="email" type="email" />
        </fieldset>
        <fieldset>
            <legend><?php echo $signuptext["legend_account"]?></legend>
            <label for="username" lang="en"><?php echo $signuptext["label_username"]?></label>
            <input id="username" name="username" type="text" />
            <label for="password" lang="en"><?php echo $signuptext["label_password"]?></label>
            <input id="password" name="password" type="password" />
            <label for="conferma"><?php echo $signuptext["label_conferma"]?></label>
            <input id="conferma" name="conferma" type="password" />
            <input type="submit" value="<?php echo $signuptext["testo_pulsante"]?>">
        </fieldset>
</div>
</body>