//signup validation

function check_info() {

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var passwordcheck = document.getElementById("passwordcheck").value;

    var email = document.getElementById("txtEmail");
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    let errorSpan = document.querySelector('.error');

    if (username === "" || password === "" || passwordcheck === "" || email === "") {
        errorSpan.innerHTML = 'Please complete all fields';
        return false;
    }

    if (!filter.test(email.value)) {
        errorSpan.innerHTML = 'Please enter a valid email address';
        email.focus;
        return false;
    }

    if (username != "") {

        if (username.length < 3) {
            errorSpan.innerHTML = 'Username must be at least 3 characters';
            return false;
        }
    }

    if (password !== passwordcheck) {
        errorSpan.innerHTML = 'Passwords do not match';
        return false;
    }

    if (password != "" && passwordcheck == passwordcheck) {

        if (password.length < 6) {
            errorSpan.innerHTML = 'Password must contain at least six characters!';
            return false;
        }
    }

    if (password === username) {
        errorSpan.innerHTML = 'Username and password must not match';
        return false;
    }

    re = /[0-9]/;
    if (!re.test(password)) {
        errorSpan.innerHTML = 'Password must contain at least one number';
        return false;
    }

    re = /[A-Z]/;
    if (!re.test(password)) {
        errorSpan.innerHTML = 'Password must contain at least one uppercase letter';
        return false;
    }
    return true;
}