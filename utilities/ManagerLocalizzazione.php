<?php
$lingue=["it","en"];

function initial_setup()
if(!isset($_SESSION)){
	session_start();
	$_SESSION["lang"]="it";
}
if(isset($_GET["lang"])){
	$lang=$_GET["lang"];
	if(in_array($lang, $lingue)){
        $_SESSION["lang"]=$lang;
    }
}

function GetTesti($blocco){
    $lang=$_SESSION["lang"];
    if(!in_array($lang, $lingue)){
        $_SESSION["lang"]="en";
        $lang="en";
    }
    if($blocco="header"){
        require("localizzazioni/".$lang."/headertext.php");
        return GetHeaderText();
    }
    if($blocco="login"){
        require("localizzazioni/".$lang."/logintext.php");
        return GetLoginText();
    }
}
?>