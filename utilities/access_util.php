<?php
require_once 'user_util.php';
require_once 'message_util.php';

function loginUser($email, $password): void {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');

    $username = $conn->checkIfUserExists($email);

    if(!$username) setErrorMessage('~nonexistent_user~');
    else {
        if (!$conn->checkLogin($username, $password)) setErrorMessage('~incorrect_password~');
    }

    if(!isErrorSet()) $_SESSION['user'] = $username;

    $conn->closeConnection();
}

function registerUser($username, $email, $password, $name, $surname, $phone_number, $birth_date): void {
    $conn = new Connection();
    if(!$conn->connect()) setErrorMessage('~connection_error~');
    else {
        if($conn->checkIfUserExists($username)) setErrorMessage('~username_already_present~');
        else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            if(!$conn->registerNewUser($username, $email, $password, $name, $surname, $phone_number, $birth_date)) setErrorMessage('~signup_error~');
        }

        $conn->closeConnection();
    }
}

function logout(): void {
    $_SESSION['user'] = null;
}

function getLoggedUser() {
    return $_SESSION['user'] ?? null;
}

function redirectIfUserAlreadyLoggedIn(): void {
    if(getLoggedUser()) {
        if(isset($_SESSION['next_page'])) header('Location: ' . $_SESSION['next_page']);
        else header('Location: area_utente.php');
        exit();
    }
}

function redirectIfUserNotLoggedIn(string $page_name): void {
    if(getLoggedUser() == null) {
        $_SESSION['next_page'] = basename($page_name);
        header('Location: login.php');
        exit();
    } else $_SESSION['next_page'] = null;
}

function redirectUserIfAdmin(): void {
    if(checkIfUserIsAdmin(getLoggedUser())) {
        header('Location: admin.php');
        exit();
    }
}

function redirectUserIfNotAdmin(): void {
    if(!checkIfUserIsAdmin(getLoggedUser())) {
        header('Location: area_utente.php');
        exit();
    }
}