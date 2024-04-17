<?php
require_once 'utilities/global.php';
require_once "utilities/config.php";
require_once "utilities/UserFunctions.php";
require_once "utilities/InputCleaner.php";

global $regex_username, $regex_password, $regex_phone_number;

$errors = null;

// Controlla che tutti i dati obbligatori siano stati inseriti
function all_set() : bool {
    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["telefono"]) && isset($_POST["email"] ) && isset($_POST["nascita"]) && isset($_POST["username"]) && isset($_POST["password"]))
        return true;
    else
        return false;
}

if(all_set()) {
    $nome = sanitizeInput($_POST["nome"]);
    $cognome = sanitizeInput($_POST["cognome"]);
    $telefono = sanitizeInput($_POST["telefono"]);
    $email = sanitizeInput($_POST["email"]);
    $nascita = sanitizeInput($_POST["nascita"]);
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    if(checkInputCorrectness($_POST["username"], $regex_username)) {
        if(checkInputCorrectness($_POST["telefono"], $regex_phone_number)) {
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                if(checkInputCorrectness($_POST["password"], $regex_password)) {
                    $errors = registerUser($username, $email, $password, $nome, $cognome, $telefono, $nascita);
                } else {
                    $errors="password_invalida";
                    //echo 'la password non è valida, deve avere almeno 1 carattere maiuscolo, 1 minuscolo, un numero, un simbolo ed almeno 8 caratteri';
                }
            }
            else {
                $errors="email_invalida";
            }
        }
        else {
            $errors="telefono_invalido";
        }
    }
    else{
        $errors="utente_invalido";
    }

    if($errors == null) {
        $errors = logUser($username,$password);
    }

    if($errors == null) {
        header("Location: area_utente.php");
        exit();
    }
}

$page = initPage(__FILE__);

$signup_component = file_get_contents('templates/signup.html');

$content = str_replace('{today_date}', date('Y-m-d'), $signup_component);

$page = str_replace('{content}', $content, $page);

$page = insertText($page);

echo $page;