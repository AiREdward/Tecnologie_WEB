<?php
require_once 'utilities/global.php';
require_once 'utilities/UserFunctions.php';
require_once 'utilities/InputCleaner.php';
require_once 'utilities/config.php';

global $regex_username, $regex_password;

$user = getLoggedUser();

if($user){
    if($_SESSION["next_page"] == "area_utente.php") {
        if(checkIfUserIsAdmin($user)) header("Location: admin.php");
        else header("Location: area_utente.php");
    } else {
        header("Location: " . $_SESSION["next_page"]);
    }
    exit();
}

$errors = null;

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    if(!checkInputCorrectness($username, $regex_username) || !checkInputCorrectness($password, $regex_password)) {
        $errors = "formato_invalido";
    }

    $errors = logUser($username,$password);

    if($errors == null){
        if($_SESSION["next_page"] == "area_utente.php") {
            if(checkIfUserIsAdmin($user)) header("Location: admin.php");
            else header("Location: area_utente.php");
        } else {
            if($_SESSION['next_page'] != null) header("Location: " . $_SESSION["next_page"]);
            else header('Location: area_utente.php');
        }
        exit();
    }
}

$page = initPage(__FILE__);

$login_component = file_get_contents("templates/login.html");

$page = str_replace('{content}', $login_component, $page);

$page = insertText($page);

echo $page;