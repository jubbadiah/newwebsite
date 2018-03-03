//login validation

function check_info() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    let errorSpan = document.querySelector('.error');

    if (username === "" || password === "") {
        errorSpan.innerHTML = 'Please complete all fields';
        return false;
    }
    else {
        return true;
    }
}