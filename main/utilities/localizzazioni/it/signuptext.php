<?php
function GetSignupText() : array {
    $signup=[];
    $signup["prompt_login"]="hai gia un account?";
    $signup["pulsante_login"]="accedi qui";
    $signup["legend_anagrafica"]="Anagrafica";
    $signup["label_nome"]="Nome";
    $signup["label_cognome"]="Cognome";
    $signup["label_nascita"]="Data di nascita";
    $signup["legend_contatti"]="Contatti";
    $signup["label_telefono"]="Telefono";
    $signup["label_email"]="<span lang=en>Email</span>";
    $signup["legend_account"]="Info <span lang=en>Login</span>";
    $signup["label_username"]="<span lang=en>Username</span>";
    $signup["label_password"]="<span lang=en>Password</span>";
    $signup["label_conferma"]="Conferma <span lang=en>Password</span>";
    $signup["testo_pulsante"]="Registra";
    return $signup;
}
?>