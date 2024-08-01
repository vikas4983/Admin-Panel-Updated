document.addEventListener("DOMContentLoaded", function () {
    var adminForm = document.getElementById("adminForm");
    var password = document.getElementById("password");
    var cpassword = document.getElementById("cpassword");
    var errorMessage = document.getElementById("password-error-message");
    // var errorMessage = document.getElementById("error-message");

    function checkPasswords(e) {
        if (password.value !== cpassword.value) {
            e.preventDefault(); // Prevent the form submission
            errorMessage.style.display = "block";
            //alert("Confirmation Passwords do not match!");
        } else {
            errorMessage.style.display = "none";
        }
    }

    function PasswordsNull(e) {
        if (password.value && cpassword.value === null) {
            e.preventDefault(); // Prevent the form submission

            // errorMessage.style.display = "block";
            // alert("Passwords do not match!");
        }
    }
    adminForm.addEventListener("submit", checkPasswords, PasswordsNull);
});
