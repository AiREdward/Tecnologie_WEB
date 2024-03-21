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

function getTexts($blocco): ?array {
    $lang = $_SESSION["lang"];

    switch($blocco) {
        case "header":
            require_once("localizzazioni/headertext.php");
            return getHeaderText($lang);
        case "login":
            require_once("localizzazioni/logintext.php");
            return getLoginText($lang);
        case "home":
            require_once("localizzazioni/hometext.php");
            return getHomeText($lang);
        case "rooms":
            require_once("localizzazioni/roomstext.php");
            return getRoomsText($lang);
        case "errors":
            require_once("localizzazioni/errorstext.php");
            return getErrorsText($lang);
        case "signup":
            require_once("localizzazioni/signuptext.php");
            return getSignupText($lang);
        case "area_utente":
            require_once("localizzazioni/areautentetext.php");
            return getAreaUtenteText($lang);
        case "logout":
            require_once("localizzazioni/logouttext.php");
            return getLogoutText($lang);
        case "prenota":
            require_once("localizzazioni/prenotatext.php");
            return getPrenotaText($lang);
        case "modifica_prenotazione":
            require_once("localizzazioni/modificaprenotazionetext.php");
            return getModificaPrenotazioneText($lang);
        case "crea_recensione":
            require_once("localizzazioni/crea_recensione_text.php");
            return getCreaRecensioneText($lang);
        default:
            return null;
    }
}