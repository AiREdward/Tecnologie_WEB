<?php
function GetHeaderText(): array {
    $Header=[];
    $Header["skip"]="salta al contenuto";
    $Header["breadcrumb"]="Ti trovi in:";
    $Header["home"]="<span lang=en>home</span>";
    $Header["area_utente"]="area utente";
    $Header["lang_switch"]="vai alla versione inglese";
    return $Header;
}
?>