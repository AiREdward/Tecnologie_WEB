<?php
function GetHeaderText(): array {
    $Header=[];
    $Header["skip"]="Salta al contenuto";
    $Header["breadcrumb"]="Ti trovi in:";
    $Header["home"]="<span lang=en>Home</span>";
    $Header["area_utente"]="Area Utente";
    $Header["lang_switch"]="Vai alla versione inglese";
    return $Header;
}
?>