<?php
$lingue=["it","en"];

function initial_setup() {
    global $lingue;

    if (!isset($_SESSION)) {
        session_start();
        $_SESSION["lang"] = "it";
    }

    if (isset($_GET["lang"])) {
        $lang = $_GET["lang"];
        if (in_array($lang, $lingue)) {
            $_SESSION["lang"] = $lang;
        }
    }
}

function GetTesti($blocco){
    global $lingue;

    $lang=$_SESSION["lang"];

    if(!in_array($lang, $lingue)){
        $_SESSION["lang"]="en";
        $lang="en";
    }
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
        case "signup":
            require_once("localizzazioni/".$lang."/areautentetext.php");
            return GetAreaUtenteText();
        default:
            return null;
    }
}
?>