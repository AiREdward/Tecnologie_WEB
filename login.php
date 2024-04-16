<?php
require_once 'utilities/global.php';
require_once 'utilities/UserFunctions.php';

// TODO: move all of this code

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
            header("Location: " . $_SESSION["next_page"]);
        }
        exit();
    }
}

$layout = file_get_contents("templates/base_layout.html");

$page = str_replace('{language}', getLanguage(), $layout);
$page = str_replace('{title}', getTitle(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{menu}', getMenu(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{breadcrumb}', getBreadcrumb(getNameOfTheFile(__FILE__)), $page);
$page = str_replace('{lang_switch}', getLangSwitch(getNameOfTheFile(__FILE__)), $page);

$login_component = file_get_contents("templates/login.html");

$page = str_replace('{content}', $login_component, $page);

$page = insertText($page);



echo $page;