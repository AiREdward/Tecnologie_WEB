<?php
function GetLoginText(): array {
    $Login=[];
    $Login["prompt_registrarsi"]="Non hai un <span lang='en'>account</span>?";
    $Login["pulsante_registrazione"]="Registrati adesso";
    $Login["label_username"]="<span lang=en>Username</span>";
    $Login["label_password"]="<span lang=en>Password</span>";
    $Login["testo_pulsante"]="Sign in";
    return $Login;
}
?>