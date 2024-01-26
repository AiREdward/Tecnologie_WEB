<?php
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
        if(empty($_POST["telefono"]) || preg_match('/^[0-9]{10}$/', $_POST["telefono"]))
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
        if($_POST["nome"] && $_POST["cognome"] && ($_POST["telefono"] || $_POST["email"] ) && $_POST["nascita"] && $_POST["username"] && $_POST["password"] && $_POST["conferma"]){
            return true;
        }else{
            return false;
        }
    }

    $signuptext=GetTesti("signup");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <title></title>
    <meta charset="utf-8"/>
    <meta name="keywords" content="TODO"/>

    <meta name="description" content="TODO" />
    
	<meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/style.css"/> 
    <link rel="stylesheet" href="css/print.css" media="print" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
</head>
<body>
<?php
	echo genera_header("login");
?>

<div id="content">
    <?php
    if($errors!=""){
        $errortext=GetTesti("error");
        echo "<p class='errormesage'>". $errortext[$errors]."</p>";
    }
    ?>


    <p><?php echo $logintext["prompt_registrarsi"]?> <a href='signup.php'><?php echo $logintext["pulsante_registrazione"]?></a></p>

    <form id="form" action="login.php" method="post">
        <label for="username"><?php echo $logintext["label_username"]?></label>
        <input id="username" name="username" type="text" />  
        <label for="password"><?php echo $logintext["password"]?></label>
        <input id="password" name="password" type="password" />
        <input type="submit" value="Accedi"><?php echo $logintext["testo_pulsante"]?></input>
    </form>

    <p><?php echo $logintext["prompt_registrarsi"]?><a href='login.php'><?php echo $logintext["pulsante_registrazione"]?></a>


    <form id="form" action="/enigma/php/sign_in.php" method="post">
        <fieldset>
            <label for="nome">Nome</label>
            <input id="nome" name="nome" type="text" />
            <label for="cognome">Cognome</label>
            <input id="cognome" name="cognome" type="text" />
            <label for="username" lang="en">Username</label>
            <input id="username" name="username" type="text" />
            <label for="telefono">Telefono</label>
            <span><input id="telefono" name="telefono" type="text"/>
            <label for="nascita">Data di Nascita</label>
            <span><input id="nascita" name="nascita" type="date" min="1924-01-01" max="2023-12-31"/>
            <label for="email" lang="en">Email</label>
            <span><input id="email" name="email" type="email" />
            <label for="password" lang="en">Password</label>
            <span><input id="password" name="password" type="password" />
            <label for="conferma">Conferma Password</label>
            <input id="conferma" name="conferma" type="password" />
            <input type="submit" value="Registrati">
        </fieldset>
</div>
</body>