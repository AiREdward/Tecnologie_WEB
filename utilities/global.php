<?php
require_once 'config.php';

global $navbar_pages, $access_keys, $page_hierarchy, $texts, $regex_username, $regex_username;

function initialSetup(): void {
    $languages = ['it', 'en'];

    if (session_status() == PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION["lang"])) {
        $_SESSION['lang'] = 'it';
    }

    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
        if (in_array($lang, $languages)) {
            $_SESSION['lang'] = $lang;
        }
    }
}

function initPage(string $file_path): string {
    $layout = file_get_contents('templates/base_layout.html');

    $page = str_replace('{language}', getLanguage(), $layout);
    $page = str_replace('{title}', getTitle(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{menu}', getMenu(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{breadcrumb}', getBreadcrumb(getNameOfTheFile($file_path)), $page);
    return str_replace('{lang_switch}', getLangSwitch(getNameOfTheFile($file_path)), $page);
}

function getLanguage(): string {
    return $_SESSION['lang'];
}

function getOppositeLanguage(): string {
    if($_SESSION['lang'] == 'it') return 'en';
    else return 'it';
}

function getNameOfTheFile(string $file_path): string {
    return str_replace('.php', '', basename($file_path));
}

function getTitle(string $page_name): string {
    if ($page_name != 'index') return $page_name . ' | En?gma';
    else return 'En?gma';
}

function getMenu(string $page_name): string {
    global $navbar_pages, $access_keys;

    $menu = '';

    foreach($navbar_pages as $menu_entry) {
        if ($menu_entry != $page_name) {
            $page_path = $menu_entry . '.php';
            $key = $access_keys[$menu_entry];
            $menu = $menu . '<li><a href="' . $page_path . '" accesskey="' . $key . '">~' . $menu_entry . '~</a></li>';

        } else {
            $menu = $menu . '<li class="currentpage">~' . $menu_entry . '~</li>';
        }
    }

    return $menu;
}

function getBreadcrumb(string $page_name): string {
    global $page_hierarchy;

    $breadcrumb = '<span id="current_page"> ~' . $page_name . '~</span>';
    $father = $page_hierarchy[$page_name];

    if($father == $page_hierarchy[$father]) $index_to_add = false;
    else $index_to_add = true;

    while(($father != $page_hierarchy[$father]) || $index_to_add) {
        $breadcrumb = '<a href="' . $father . '.php"> ~' . $father . '~</a> <span aria-hidden=true></span>' . ' &gt;' . $breadcrumb;
        if($father == $page_hierarchy[$father]) $index_to_add = false;
        $father = $page_hierarchy[$father];
    }

    return $breadcrumb;
}

function getLangSwitch($page_name): string {
    return '<a href="' . $page_name . '.php?lang=' . getOppositeLanguage() . '" class="langswitch">~lang_switch~</a>';
}

function insertText($page) {
    global $texts;

    $texts_in_selected_language = $texts[getLanguage()];

    foreach(array_keys($texts_in_selected_language) as $text_key) {
        $page = str_replace('~' . $text_key . '~', $texts_in_selected_language[$text_key], $page);
    }

    return $page;
}

function insertScript(string $page, string $script_name): string {
    return str_replace('default.js', $script_name, $page);
}

initialSetup();