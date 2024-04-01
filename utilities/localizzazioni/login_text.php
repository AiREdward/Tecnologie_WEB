<?php
function getLoginText($lang) : array {
    return match ($lang) {
        "it" => [
            "prompt_registrarsi" => "Non hai un <span lang='en'>account</span>?",
            "pulsante_registrazione" => "Registrati adesso",
            "label_username" => "<span lang=en>Username</span>",
            "label_password" => "<span lang=en>Password</span>",
            "testo_pulsante" => "Accedi"
        ],
        "en" => [
            "prompt_registrarsi" => "Don't have an account?",
            "pulsante_registrazione" => "Register now",
            "label_username" => "Username",
            "label_password" => "Password",
            "testo_pulsante" => "Sign in"
        ],
        default => [],
    };
}
