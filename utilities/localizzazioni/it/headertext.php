<?php
function GetHeaderText(): array {
    $Header=[];
    $Header["skip"]="Salta al contenuto";
    $Header["nav_toggle"]="apri/chiudi barra navigazione";
    $Header["breadcrumb"]="Ti trovi in:";
    $Header["login"]="<span lang=en>Login</span>";
    $Header["logout"]="<span lang=en>Logout</span>";
    $Header["home"]="<span lang=en>Home</span>";
    $Header["area_utente"]="Area Utente";
    $Header["signup"]="Registra Account";
    $Header["lang_switch"]="Vai alla versione inglese";
    return $Header;
}
?>