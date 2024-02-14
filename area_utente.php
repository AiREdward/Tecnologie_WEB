<?php
    require_once "utilities/UserFunctions.php";
    require_once "utilities/InputCleaner.php";
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    require_once "utilities/HeaderPagina.php";

    global $patternUser, $patternPassword;

    $user = getLoggedUser();

    if(!getLoggedUser()){
        header("Location: login.php");
        exit();
    }

    if(checkIfUserIsAdmin($user)){
        header("Location: admin.php");
        exit();
    }

    $errors = null;

    $area_utente_text = getTexts("area_utente");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
    <?php echo genera_header("area_utente"); ?>

    <div id="content">
        <p><?php echo $area_utente_text["in_as"] . getLoggedUser()?></p>
        <a href="logout.php"><?php echo $area_utente_text["logout"]?></a>
        <?php
            $prenotazioni = '';
            // if(GetPrenotazioniUtente(&$prenotazioni)=""){}
        ?>
        <h2><?php echo $area_utente_text["riepilogo_prenotazioni"]?></h2>
        <ul class="prenotazioni_utente">
            <?php 
                /*
                foreach($prenotazioni as $prenotazione) {
                    echo "<li class='singola_prenotazione'>".$prenotazione["data_"]."  ".$prenotazione["orario"];
                    if(strtotime($prenotazione["data_"])>strtotime('now')) {
                        echo "<a class='link_modifica' href='modifica_prenotazione.php?id=".$prenotazione["id_prenotazione"]."' >".$area_utente_text["modifica_prenotazioe"]."</a>";
                    }
                    echo "</li>";
                }
                */
            ?>
        <ul>
    </div>
</body>
</html>