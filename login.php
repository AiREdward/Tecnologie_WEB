<?php
require_once 'utilities/global.php';

login();

$page = initPage(__FILE__);

$login_component = file_get_contents("templates/login.html");

$page = str_replace('{content}', $login_component, $page);

$page = insertText($page);

echo $page;