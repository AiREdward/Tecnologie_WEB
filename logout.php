<?php
require_once 'utilities/global.php';
require_once 'utilities/access_util.php';

logout();

$page = initPage(__FILE__);

$logout_component = file_get_contents('templates/logout.html');

$page = str_replace('{content}', $logout_component, $page);

$page = finalizePage($page);

echo $page;