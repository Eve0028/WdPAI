const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email) {
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function passwordStrength(password) {
    let tips = "";

    // Check password length
    if (password.length < 8) {
        tips += "Make the password longer (min 8 characters). ";
    } else if (password.length > 72) {
        tips += "Make the password shorter. ";
    }

    // Check for mixed case
    if (!(password.match(/[a-z]/) && password.match(/[A-Z]/))) {
        tips += "Use both lowercase and uppercase letters. ";
    }

    // Check for numbers
    if (!password.match(/\d/)) {
        tips += "Include at least one number. ";
    }

    // Check for special characters
    if (!password.match(/[^a-zA-Z\d]/)) {
        tips += "Include at least one special character. ";
    }

    return tips;
}

function markValidation(element, condition, message) {
    if (!condition) {
        element.classList.add('no-valid');
        element.parentElement.querySelector('.invalid-message').innerHTML = message;
    } else {
        element.classList.remove('no-valid');
        element.parentElement.querySelector('.invalid-message').innerHTML = "";
    }
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value), "Invalid email");
        },
        1000
    );
}

function validatePasswordRepeat() {
    setTimeout(function () {
            const passRepeatCondition = arePasswordsSame(
                passwordInput.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, passRepeatCondition, "Invalid password repeat");
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const messagePasswordStrong = passwordStrength(passwordInput.value);
            markValidation(passwordInput, !messagePasswordStrong, messagePasswordStrong);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePasswordRepeat);
passwordInput.addEventListener('keyup', validatePassword);