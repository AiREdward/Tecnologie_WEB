const name_field = document.getElementById('nome');
const surname_field = document.getElementById('cognome');
const phone_number_field = document.getElementById('telefono');
const email_field = document.getElementById('email');
const username_field = document.getElementById('username');
const  password_field = document.getElementById('password');
const confirm_password_field = document.getElementById('signup-button');

submit_button.disabled = true;

function checkIfNameIsValid() {
    let name = name_field.value.trim();
    return !(/[0-9]/.test(name)) && name.length > 0;
}

function checkIfSurnameIsValid() {
    let surname = surname_field.value.trim();
    return !(/[0-9]/.test(surname)) && surname.length > 0;
}

function checkIfPhoneNumberIsValid() {
    return window.regex.phone_number.test(phone_number_field.value);
}

function checkIfEmailIsValid() {
    return window.regex.email.test(email_field.value);
}

function checkIfUsernameIsValid() {
    return window.regex.username.test(username_field.value);
}

function checkIfPasswordIsValid() {
    return window.regex.password.test(password_field.value);
}

function checkIfConfirmPasswordIsTheSame() {
    return password_field.value === confirm_password_field.value;
}

function checkIfFieldsAreValid() {
    return (checkIfNameIsValid() && checkIfSurnameIsValid() && checkIfPhoneNumberIsValid() && checkIfEmailIsValid() && checkIfUsernameIsValid() && checkIfPasswordIsValid() && checkIfConfirmPasswordIsTheSame());
}

name_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

surname_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

phone_number_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

username_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

password_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

confirm_password_field.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});