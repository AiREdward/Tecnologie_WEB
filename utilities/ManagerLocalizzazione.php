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
            require_once("localizzazioni/header_text.php");
            return getHeaderText($lang);
        case "login":
            require_once("localizzazioni/login_text.php");
            return getLoginText($lang);
        case "home":
            require_once("localizzazioni/home_text.php");
            return getHomeText($lang);
        case "rooms":
            require_once("localizzazioni/rooms_text.php");
            return getRoomsText($lang);
        case "errors":
            require_once("localizzazioni/error_text.php");
            return getErrorsText($lang);
        case "signup":
            require_once("localizzazioni/signup_text.php");
            return getSignupText($lang);
        case "area_utente":
            require_once("localizzazioni/area_utente_text.php");
            return getAreaUtenteText($lang);
        case "logout":
            require_once("localizzazioni/logout_text.php");
            return getLogoutText($lang);
        case "prenota":
            require_once("localizzazioni/prenota_text.php");
            return getPrenotaText($lang);
        case "modifica_prenotazione":
            require_once("localizzazioni/modifica_prenotazione_text.php");
            return getModificaPrenotazioneText($lang);
        case "crea_recensione":
            require_once("localizzazioni/crea_recensione_text.php");
            return getCreaRecensioneText($lang);
        case "modifica_recensione":
            require_once("localizzazioni/modifica_recensione_text.php");
            return getModificaRecensioneText($lang);
        case "amministrazione_stanza":
            require_once("localizzazioni/amministrazione_stanza_text.php");
            return getAmministrazioneStanzaText($lang);
        default:
            return null;
    }
}