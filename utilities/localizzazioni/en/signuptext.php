<?php
function GetSignupText() : array {
    $signup=[];
    $signup["prompt_login"] = "Already have an account?";
    $signup["pulsante_login"] = "Login here";
    $signup["legend_anagrafica"] = "Registry Info";
    $signup["label_nome"] = "First name";
    $signup["label_cognome"] = "Last name";
    $signup["label_nascita"] = "Date of Birth";
    $signup["legend_contatti"] = "Contacts";
    $signup["label_telefono"] = "Phone Number";
    $signup["label_email"] = "Email";
    $signup["legend_account"] = "Login Info";
    $signup["label_username"] = "Username";
    $signup["label_password"] = "Password";
    $signup["label_conferma"] = "Confirm Password";
    $signup["testo_pulsante"] = "Sign up";
    return $signup;
}