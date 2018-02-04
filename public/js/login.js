//login validation

function check_info() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (username === "" || password === "") {
        alert('Please complete all fields')
        return false;
    }
    else {
        return true;
    }
}