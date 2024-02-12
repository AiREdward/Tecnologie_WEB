<?php
function GetSignupText() : array {
    $signup=[];
    $signup["prompt_login"]="already have an account?";
    $signup["pulsante_login"]="login here";
    $signup["legend_anagrafica"]="Registry Info";
    $signup["label_nome"]="First name";
    $signup["label_cognome"]="Last name";
    $signup["label_nascita"]="First name";
    $signup["legend_contatti"]="Contacts";
    $signup["label_telefono"]="phone number";
    $signup["label_email"]="email";
    $signup["legend_account"]="Login Info";
    $signup["label_username"]="Username";
    $signup["label_password"]="Password";
    $signup["label_conferma"]="Confirm Password";
    $signup["testo_pulsante"]="Sing up";
    return $signup;
}
?>