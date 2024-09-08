<?php
require_once 'config/regex_config.php';
require_once 'config/pages_config.php';
require_once 'config/text_config.php';
require_once 'config/title_config.php';
require_once 'config/description_config.php';
require_once 'config/keywords_config.php';
require_once 'message_util.php';

global $navbar_pages, $access_keys, $page_hierarchy, $texts, $regex_username, $regex_username, $titles, $descriptions, $keywords;

function initialSetup(): void {
    $languages = ['it', 'en'];

    if (session_status() == PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['lang'])) {
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
    $page = str_replace('{description}', getDescription(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{keywords}', getKeywords(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{menu}', getMenu(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{breadcrumb}', getBreadcrumb(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{lang_switch}', getLangSwitch(getNameOfTheFile($file_path)), $page);
    $page = str_replace('{footer}', getFooter(), $page); 

    return $page;
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
    global $titles;

    if ($page_name != 'index') return $titles[$page_name] . ' | En?gma';
    else return 'En?gma';
}

function getDescription(string $page_name): string {
    global $descriptions;

    return $descriptions[$page_name];
}

function getKeywords(string $page_name): string {
    global $keywords;

    return $keywords[$page_name];
}

function getMenu(string $page_name): string {
    global $navbar_pages, $access_keys;

    $menu = '';

    foreach ($navbar_pages as $menu_entry) {
        if ($menu_entry != $page_name) {
            $page_path = $menu_entry . '.php';
            $key = $access_keys[$menu_entry];
            $menu .= '<li><a href="' . $page_path . '" accesskey="' . $key . '">~' . $menu_entry . '~</a></li>';
        } else {
            $menu .= '<li class="currentpage"><span aria-current="page">~' . $menu_entry . '~</span></li>';
        }
    }

    return $menu;
}

function getBreadcrumb(string $page_name): string {
    global $page_hierarchy;

    $breadcrumb = '<span id="current-page"> ~' . $page_name . '~</span>';
    $father = $page_hierarchy[$page_name];

    if($page_name == $page_hierarchy[$page_name]) $index_to_add = false;
    else $index_to_add = true;

    while(($father != $page_hierarchy[$father]) || $index_to_add) {
        $breadcrumb = ' <a href="' . $father . '.php">~' . $father . '~</a> <span aria-hidden=true></span>' . ' &gt;' . $breadcrumb;
        if($father == $page_hierarchy[$father]) $index_to_add = false;
        $father = $page_hierarchy[$father];
    }

    return $breadcrumb;
}

function getFooter(): string {
    $footer_template = file_get_contents('templates/footer.html');
    return insertText($footer_template); 
}

function getLangSwitch($page_name): string {
    return '<a href="' . $page_name . '.php?lang=' . getOppositeLanguage() . '" class="lang-switch">~lang_switch~</a>';
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

function finalizePage(string $page): string {
    $page = showErrorIfSet($page);
    $page = showInfoIfSet($page);
    return insertText($page);
}

initialSetup();