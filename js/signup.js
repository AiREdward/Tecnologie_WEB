const name_field = document.getElementById('nome');
const surname_field = document.getElementById('cognome');
const phone_number_field = document.getElementById('telefono');
const email_field = document.getElementById('email');
const username_field = document.getElementById('username');
const password_field = document.getElementById('password');
const confirm_password_field = document.getElementById('conferma');
const submit_button = document.getElementById('signup-button')

submit_button.disabled = true;

function showErrorMessageForField(field, errorId, message) {
    const errorElement = document.getElementById(errorId);
    const otherErrorElements = document.querySelectorAll('.error-message');

    otherErrorElements.forEach(el => {
        if (el !== errorElement) {
            el.style.visibility = 'hidden';
            el.textContent = ''; 
        }
    });

    if (message) {
        errorElement.textContent = message;
        errorElement.style.visibility = 'visible';
    } else {
        errorElement.style.visibility = 'hidden';
        errorElement.textContent = ''; 
    }
}

function checkIfNameIsValid() {
    let name = name_field.value.trim();
    if (/[0-9]/.test(name) || name.length == 0) {
        showErrorMessageForField(name_field, 'nome-error', 'Il nome non può contenere numeri e non può essere vuoto.');
        return false;
    } else {
        showErrorMessageForField(name_field, 'nome-error', ''); 
        return true;
    }
}

function checkIfSurnameIsValid() {
    let surname = surname_field.value.trim();

    if (/[0-9]/.test(surname) || surname.length == 0) {
        showErrorMessageForField(surname_field, 'cognome-error', 'Il cognome non può contenere numeri e non può essere vuoto.');
        return false;
    } else {
        showErrorMessageForField(surname_field, 'cognome-error', '');
        return true;
    }
}

function checkIfPhoneNumberIsValid() {
    if (!window.regex.phone_number.test(phone_number_field.value)) {
        showErrorMessageForField(phone_number_field, 'telefono-error', 'Il numero di telefono non è valido.');
        return false;
    } else {
        showErrorMessageForField(phone_number_field, 'telefono-error', '');
        return true;
    }
}

function checkIfEmailIsValid() {
    if (!window.regex.email.test(email_field.value)) {
        showErrorMessageForField(email_field, 'email-error', 'L\'email non è valida.');
        return false;
    } else {
        showErrorMessageForField(email_field, 'email-error', '');
        return true;
    }
}

function checkIfUsernameIsValid() {
    if (!window.regex.username.test(username_field.value)) {
        showErrorMessageForField(username_field, 'username-error', 'Il nome utente non è valido.');
        return false;
    } else {
        showErrorMessageForField(username_field, 'username-error', '');
        return true;
    }
}

function checkIfPasswordIsValid() {
    if (!window.regex.password.test(password_field.value)) {
        showErrorMessageForField(password_field, 'password-error', 'min 8 caratteri, 1 maiuscola, 1 minuscola, 1 carattere speciale');
        return false;
    } else {
        showErrorMessageForField(password_field, 'password-error', '');
        return true;
    }
}

function checkIfConfirmPasswordIsTheSame() {
    if (confirm_password_field.value.length > 0) {
        if (password_field.value !== confirm_password_field.value) {
            showErrorMessageForField(confirm_password_field, 'conferma-error', 'Le password non coincidono.');
            return false;
        } else {
            showErrorMessageForField(confirm_password_field, 'conferma-error', '');
            return true;
        }
    } else {
        showErrorMessageForField(confirm_password_field, 'conferma-error', '');
        return true;
    }
}

function checkIfFieldsAreValid() {
    let isValid = true;

    if (!checkIfNameIsValid()) isValid = false;
    if (!checkIfSurnameIsValid()) isValid = false;
    if (!checkIfPhoneNumberIsValid()) isValid = false;
    if (!checkIfEmailIsValid()) isValid = false;
    if (!checkIfUsernameIsValid()) isValid = false;
    if (!checkIfPasswordIsValid()) isValid = false;

    if (password_field.value.length > 0 && !checkIfConfirmPasswordIsTheSame()) {
        isValid = false;
    }

    submit_button.disabled = !isValid;

    return isValid;
}

name_field.addEventListener('input', checkIfFieldsAreValid);
name_field.addEventListener('focus', checkIfNameIsValid);
//name_field.addEventListener('blur', checkIfFieldsAreValid);

surname_field.addEventListener('input', checkIfFieldsAreValid);
surname_field.addEventListener('focus', checkIfSurnameIsValid);
//surname_field.addEventListener('blur', checkIfFieldsAreValid);

phone_number_field.addEventListener('input', checkIfFieldsAreValid);
phone_number_field.addEventListener('focus', checkIfPhoneNumberIsValid);
//phone_number_field.addEventListener('blur', checkIfFieldsAreValid);

email_field.addEventListener('input', checkIfFieldsAreValid);
email_field.addEventListener('focus', checkIfEmailIsValid);
//email_field.addEventListener('blur', checkIfFieldsAreValid);

username_field.addEventListener('input', checkIfFieldsAreValid);
username_field.addEventListener('focus', checkIfUsernameIsValid);
//username_field.addEventListener('blur', checkIfFieldsAreValid);

password_field.addEventListener('input', checkIfFieldsAreValid);
password_field.addEventListener('focus', checkIfPasswordIsValid);
//password_field.addEventListener('blur', checkIfFieldsAreValid);

confirm_password_field.addEventListener('input', checkIfFieldsAreValid);
confirm_password_field.addEventListener('focus', checkIfConfirmPasswordIsTheSame);
//confirm_password_field.addEventListener('blur', checkIfFieldsAreValid);