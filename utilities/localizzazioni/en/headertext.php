<?php
function GetHeaderText() : array {
    $header = [];
    $header["skip"] = "Skip to content";
    $header["breadcrumb"]="You are in:";
    $header["home"] = "Home";
    $header["nav_toggle"] = "toggle navbar";
    $header["login"] = "Login";
    $header["logout"] = "Logout";
    $header["area_utente"] = "User Area";
    $header["signup"] = "Register Account";
    $header["prenota"] = "Booking";
    $header["lang_switch"] = "Go to the italian version";

    return $header;
}