const username_input = document.getElementById('username');
const password_input = document.getElementById('password');
const submit_button = document.getElementById('login-button');

submit_button.disabled = true;

function checkIfFieldsAreValid() {
    return window.regex.username.test(username_input.value);
}

username_input.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});

password_input.addEventListener('input', function () {
    submit_button.disabled = !checkIfFieldsAreValid();
});