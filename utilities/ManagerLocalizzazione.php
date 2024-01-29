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
        default:
            return null;
    }
}
?>