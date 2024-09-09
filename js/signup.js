const name_field = document.getElementById('nome');
const surname_field = document.getElementById('cognome');
const phone_number_field = document.getElementById('telefono');
const email_field = document.getElementById('email');
const username_field = document.getElementById('username');
const password_field = document.getElementById('password');
const confirm_password_field = document.getElementById('conferma');
const submit_button = document.getElementById('signup-button')

submit_button.disabled = true;

function showErrorMessageForField(error_id) {
    const error_element = document.getElementById(error_id);

    error_element.classList.remove('hidden');
}

function resetErrorMessageForField(error_id) {
    const error_element = document.getElementById(error_id);

    error_element.classList.add('hidden');
}

function checkIfNameIsValid() {
    let name = name_field.value.trim();

    if (/[0-9]/.test(name)) {
        showErrorMessageForField('nome-error'); // 'Il nome non può contenere numeri e non può essere vuoto.'
        return false;
    } else {
        resetErrorMessageForField('nome-error');
        return true;
    }
}

function checkIfSurnameIsValid() {
    let surname = surname_field.value.trim();

    if (/[0-9]/.test(surname)) {
        showErrorMessageForField('cognome-error'); // 'Il cognome non può contenere numeri e non può essere vuoto.'
        return false;
    } else {
        resetErrorMessageForField('cognome-error');
        return true;
    }
}

function checkIfPhoneNumberIsValid() {
    if (!window.regex.phone_number.test(phone_number_field.value)) {
        showErrorMessageForField('telefono-error'); // 'Il numero di telefono non è valido.'
        return false;
    } else {
        resetErrorMessageForField('telefono-error');
        return true;
    }
}

function checkIfEmailIsValid() {
    if (!window.regex.email.test(email_field.value)) {
        showErrorMessageForField('email-error'); // 'L\'email non è valida.'
        return false;
    } else {
        resetErrorMessageForField('email-error');
        return true;
    }
}

function checkIfUsernameIsValid() {
    if (!window.regex.username.test(username_field.value)) {
        showErrorMessageForField('username-error'); // 'Il nome utente non è valido.'
        return false;
    } else {
        resetErrorMessageForField('username-error');
        return true;
    }
}

function checkIfPasswordIsValid() {
    if (!window.regex.password.test(password_field.value)) {
        showErrorMessageForField('password-error'); // 'min 8 caratteri, 1 maiuscola, 1 minuscola, 1 carattere speciale'
        return false;
    } else {
        resetErrorMessageForField('password-error');
        return true;
    }
}

function checkIfConfirmPasswordIsTheSame() {
    if (confirm_password_field.value.length > 0) {
        if (password_field.value !== confirm_password_field.value) {
            showErrorMessageForField('conferma-error'); // 'Le password non coincidono.'
            return false;
        } else {
            resetErrorMessageForField('conferma-error');
            return true;
        }
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

name_field.addEventListener('blur', checkIfNameIsValid);
surname_field.addEventListener('blur', checkIfSurnameIsValid);
phone_number_field.addEventListener('blur', checkIfPhoneNumberIsValid);
email_field.addEventListener('blur', checkIfEmailIsValid);
username_field.addEventListener('blur', checkIfUsernameIsValid);
password_field.addEventListener('blur', checkIfPasswordIsValid);

confirm_password_field.addEventListener('input', checkIfFieldsAreValid);
confirm_password_field.addEventListener('blur', checkIfConfirmPasswordIsTheSame);