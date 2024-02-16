<?php
$languages = ["it","en"];

function initial_setup() : void {
    global $languages;

    if (session_status() == PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION["lang"])) {
        $_SESSION["lang"] = "it";
    }

    if (isset($_GET["lang"])) {
        $lang = $_GET["lang"];
        if (in_array($lang, $languages)) {
            $_SESSION["lang"] = $lang;
        }
    }
}

function getTexts($blocco) {
    $lang = $_SESSION["lang"];

    switch($blocco) {
        case "header":
            require_once("localizzazioni/".$lang."/headertext.php");
            return GetHeaderText();
        case "login":
            require_once("localizzazioni/".$lang."/logintext.php");
            return GetLoginText();
        case "home":
            require_once("localizzazioni/".$lang."/hometext.php");
            return GetHomeText();
        case "rooms":
            require_once("localizzazioni/".$lang."/roomstext.php");
            return GetroomsText();
        case "errors":
            require_once("localizzazioni/".$lang."/errorstext.php");
            return GetErrorsText();
        case "signup":
            require_once("localizzazioni/".$lang."/signuptext.php");
            return GetSignupText();
        case "area_utente":
            require_once("localizzazioni/".$lang."/areautentetext.php");
            return GetAreaUtenteText();
        case "logout":
            require_once("localizzazioni/".$lang."/logouttext.php");
            return GetLogoutText();
        case "prenota":
            require_once("localizzazioni/".$lang."/prenotatext.php");
            return GetPrenotaText();
        case "modifica_prenotazione":
            require_once("localizzazioni/".$lang."/modificaprenotazionetext.php");
            return GetModificaPrenotazioneText();
        default:
            return null;
    }
}