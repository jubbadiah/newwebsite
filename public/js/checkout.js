function validate() {

    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var delAddress = document.getElementById("delAddress").value
    var tCity = document.getElementById("tCity").value
    var sCounty = document.getElementById("sCounty").value
    var postCode = document.getElementById("postCode").value
    var country = document.getElementById("country").value
    var phone = document.getElementById("phone").value

    if (firstName === "" || lastName === "" || delAddress === "" || tCity === "" || sCounty === "" || postCode === "" || country === "" || phone === "") {
        let errorSpan = document.querySelector('.error');
        errorSpan.innerHTML = 'Please complete all fields';
        return false;
    }
}