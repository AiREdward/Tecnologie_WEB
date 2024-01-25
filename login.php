<?php
    require_once "utilities/config.php";
    require_once "utilities/HeaderPagina.php";
    require_once "utilities/UserFunctions.php";
    require_once "utilities/ImputCleaner.php";
    if(get_logged_user()!=""){
        header("Location: area_utenti.php");
        exit();
    }
    $errors="";
    if(isset($_POST["username"])&&isset()$_POST["password"]){
        $username=Clean($_POST["username"])
        $password=Clean($_POST["password"])
        if(!Check($username,$patternUser)||!Check($password,$patternPassword)){
            $errors="formato_invalido"
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
        echo "<p class='errormesage'>". $errortext[$errors]."</p>"
    }
    ?>


    <p><?php echo $logintext["prompt_registrarsi"]?> <a href='signin.php'><?php echo $logintext["pulsante_registrazione"]?></a></p>

    <form id="form" action="login.php" method="post">
        <label for="username"><?php echo $logintext["label_username"]?></label>
        <input id="username" name="username" type="text" />  
        <label for="password"><?php echo $logintext["password"]?></label>
        <input id="password" name="password" type="password" />
        <input type="submit" value="Accedi"><?php echo $logintext["testo_pulsante"]?></input>
    </form>

</div>
</body>