<?php
function getSignupText($lang): array {
    return match($lang) {
        "it" => [
            "prompt_login" => "hai gia un account?",
            "pulsante_login" => "accedi qui",
            "legend_anagrafica" => "Anagrafica",
            "label_nome" => "Nome",
            "label_cognome" => "Cognome",
            "label_nascita" => "Data di nascita",
            "legend_contatti" => "Contatti",
            "label_telefono" => "Telefono",
            "label_email" => "<span lang=en>Email</span>",
            "legend_account" => "Info <span lang=en>Login</span>",
            "label_username" => "<span lang=en>Username</span>",
            "label_password" => "<span lang=en>Password</span>",
            "label_conferma" => "Conferma <span lang=en>Password</span>",
            "testo_pulsante" => "Registra"
        ],
        "en" => [
            "prompt_login" => "Already have an account?",
            "pulsante_login" => "Login here",
            "legend_anagrafica" => "Registry Info",
            "label_nome" => "First name",
            "label_cognome" => "Last name",
            "label_nascita" => "Date of Birth",
            "legend_contatti" => "Contacts",
            "label_telefono" => "Phone Number",
            "label_email" => "Email",
            "legend_account" => "Login Info",
            "label_username" => "Username",
            "label_password" => "Password",
            "label_conferma" => "Confirm Password",
            "testo_pulsante" => "Sign Up"
        ],
        default => [],
    };
}