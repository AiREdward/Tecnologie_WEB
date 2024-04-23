<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';
require_once 'utilities/input_util.php';

redirectIfUserAlreadyLoggedIn();

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = checkIfUsernameIsValid($_POST['username']);
    $password = checkIfPasswordIsValid($_POST['password']);

    loginUser($username, $password);

    redirectIfUserAlreadyLoggedIn();
}

$page = initPage(__FILE__);

$login_component = file_get_contents("templates/login.html");

$page = str_replace('{content}', $login_component, $page);

$page = finalizePage($page);

echo $page;