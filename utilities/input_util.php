<?php
require_once 'config/password_bypass_config.php';
require_once 'message_util.php';

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

    $sanitized_username = sanitizeInput($username);

    if(!checkInputCorrectness($sanitized_username, $regex_username)) setErrorMessage('~username_not_valid~');

    return $sanitized_username;
}

function checkIfPasswordIsValid(string $password): string {
    require_once('config/regex_config.php');
    global $regex_password;

    $sanitized_password = sanitizeInput($password);

    if(!isPasswordBypass($password) && !checkInputCorrectness($sanitized_password, $regex_password)) setErrorMessage('~password_not_valid~');

    return $sanitized_password;
}

function isPasswordBypass(string $password): bool {
    global $bypass_passwords;

    return in_array(sanitizeInput($password), $bypass_passwords);
}

function checkIfEmailIsValid(string $email): string {
    $sanitized_email = sanitizeInput($email);

    if(!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) setErrorMessage('~email_not_valid~');
    return $sanitized_email;
}

function checkIfPhoneNumberIsValid(string $phone_number): string {
    require_once('config/regex_config.php');
    global $regex_phone_number;

    $sanitized_phone_number = sanitizeInput($phone_number);

    if(!checkInputCorrectness($sanitized_phone_number, $regex_phone_number)) setErrorMessage('~phone_number_not_valid~');
    return $sanitized_phone_number;
}

function checkIfReviewIsValid(string $review): string {
    $sanitized_review = sanitizeInput($review);

    if(!$sanitized_review) setErrorMessage('~review_not_valid~');
    return $sanitized_review;
}

function checkIfNameIsValid(string $name): string {
    $sanitized_name = sanitizeInput($name);

    // ctype_alpha() checks if there are no numbers inside the string
    if(!ctype_alpha($sanitized_name)) setErrorMessage('~name_not_valid~');
    return $sanitized_name;
}

function checkIfPasswordsAreTheSame(string $password, string $password_confirm): string {
    if(!($password == $password_confirm)) setErrorMessage('~passwords_not_the_same~');
    return $password_confirm;
}