<?php
function GetHeaderText(): array {
    $header = [];
    $header["skip"] = "Salta al contenuto";
    $header["nav_toggle"] = "apri/chiudi barra navigazione";
    $header["breadcrumb"] = "Ti trovi in:";
    $header["login"] = "<span lang=en>Login</span>";
    $header["logout"] = "<span lang=en>Logout</span>";
    $header["home"] = "<span lang=en>Home</span>";
    $header["area_utente"] = "Area Utente";
    $header["signup"] = "Registra Account";
    $header["prenota"] = "Prenota";
    $header["modifica_prenotazione"] = "Modifica Prenotazione";
    $header["lang_switch"] = "Vai alla versione inglese";

    return $header;
}