<?php
function GetHeaderText() : array {
    $Header=[];
    $Header["skip"]="skip to content";
    $Header["breadcrumb"]="You are in:";
    $Header["home"]="Home";
    $Header["nav_toggle"]="toggle navbar";
    $Header["login"]="Login";
    $Header["area_utente"]="User Area";
    $Header["signup"]="Register Account";
    $Header["lang_switch"]="Go to the italian version";
    return $Header;
}
?>