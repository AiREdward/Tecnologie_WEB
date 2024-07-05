<?php
require_once 'message_util.php';
require_once 'config/password_bypass_config.php';

global $bypass_passwords;

function sanitizeInput(string $input): string {
    // trim() removes blank spaces at the start and at the end of the string
    // htmlentities() converts special character in HTML entities
    return htmlentities(trim($input));
}

function checkInputCorrectness(string $input, string $regex): bool {
    return preg_match($regex, $input);
}

function checkIfUsernameIsValid(string $username): string {
    require_once('config/regex_config.php');
    global $regex_username;

    if(!checkInputCorrectness(sanitizeInput($username), $regex_username)) setErrorMessage('~username_not_valid~');

    return sanitizeInput($username);
}

function checkIfPasswordIsValid(string $password): string {
    require_once('config/regex_config.php');
    global $regex_password;

    if(!isPasswordBypass($password) && !checkInputCorrectness(sanitizeInput($password), $regex_password)) setErrorMessage('~password_not_valid~');

    return sanitizeInput($password);
}

function isPasswordBypass(string $password): bool {
    global $bypass_passwords;

    return in_array(sanitizeInput($password), $bypass_passwords);
}

function checkIfEmailIsValid(string $email): string {
    if(!filter_var(sanitizeInput($email), FILTER_VALIDATE_EMAIL)) setErrorMessage('~email_not_valid~');
    return sanitizeInput($email);
}

function checkIfPhoneNumberIsValid(string $phone_number): string {
    require_once('config/regex_config.php');
    global $regex_phone_number;

    if(!checkInputCorrectness(sanitizeInput($phone_number), $regex_phone_number)) setErrorMessage('~phone_number_not_valid~');
    return sanitizeInput($phone_number);
}