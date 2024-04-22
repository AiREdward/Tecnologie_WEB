<?php

// Functions for the error div

function showErrorIfSet(string $page): string {
    if(isErrorSet()) {
        $error_message = $_SESSION['error_message'];
        clearErrorMessage();
        return displayError($page, $error_message);
    } else return $page;
}

function isErrorSet(): bool {
    return isset($_SESSION['error_message']);
}

function setErrorMessage(string $error_message): void {
    $_SESSION['error_message'] = $error_message;
}

function clearErrorMessage(): void {
    $_SESSION['error_message'] = null;
}

function displayError(string $page, string $error_message): string {
    $page = str_replace('hidden-error', '', $page);
    return str_replace('{error_message}', $error_message, $page);
}

// Functions for the info div

function showInfoIfSet(string $page): string {
    if(isInfoSet()) {
        $info_message = $_SESSION['info_message'];
        clearInfoMessage();
        return displayInfo($page, $info_message);
    } else return $page;
}

function isInfoSet(): bool {
    return isset($_SESSION['info_message']);
}

function setInfoMessage(string $info_message): void {
    $_SESSION['info_message'] = $info_message;
}

function clearInfoMessage(): void {
    $_SESSION['info_message'] = null;
}

function displayInfo(string $page, string $info_message): string {
    $page = str_replace('hidden-info', '', $page);
    return str_replace('{info_message}', $info_message, $page);
}