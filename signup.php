<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/input_util.php';
require_once 'utilities/message_util.php';

function all_set(): bool {
    return (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['telefono']) && isset($_POST['email'] ) && isset($_POST['nascita']) && isset($_POST['username']) && isset($_POST['password']));
}

if(all_set()) {
    $name = checkIfNameIsValid($_POST['nome']);
    $surname = checkIfNameIsValid($_POST['cognome']);
    $date_of_birth = sanitizeInput($_POST['nascita']);

    $username = checkIfUsernameIsValid($_POST["username"]);
    $password = checkIfPasswordIsValid($_POST["password"]);
    $email = checkIfEmailIsValid($_POST["email"]);
    $phone_number = checkIfPhoneNumberIsValid($_POST["telefono"]);

    $password_confirmation = checkIfPasswordsAreTheSame($password, $_POST['conferma']);

    if(!isErrorSet()) {
        if(registerUser($username, $email, $password, $name, $surname, $phone_number, $date_of_birth)) {
            loginUser($username,$password);
            header("Location: user_area.php");
            exit();
        }
    }
}

$page = initPage(__FILE__);

$signup_component = file_get_contents('templates/signup.html');

$content = str_replace('{today_date}', date('Y-m-d'), $signup_component);

$page = str_replace('{content}', $content, $page);

$page = finalizePage($page);
$page = insertScript($page, 'signup.js');

echo $page;