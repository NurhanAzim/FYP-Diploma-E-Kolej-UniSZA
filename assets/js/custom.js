function showError(input, message) {
    // get the parent element of the input
    var parent = input.parentElement;

    // check if an error message already exists
    var error = parent.querySelector(".error");
    if (error) {
        // remove the existing error message
        parent.removeChild(error);
    }

    // create a new element to hold the error message
    error = document.createElement("div");
    error.className = "error";
    error.innerHTML = message;

    // add the error message to the parent element
    parent.appendChild(error);
}

function validateForm(inputs) {
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        if (input.name == "email") {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@putra\.unisza\.edu\.my$/;

            if (input.value.length == 0) {
                showError(input, "Sila masukkan e-mel anda");
                input.focus();
                return false;
            } else if (!regex.test(input.value)) {
                showError(input, "Sila masukkan e-mel putra sahaja");
                input.focus();
                return false;
            }
        } else if (input.name == "username") {
            if (input.value.length == 0) {
                showError(input, "Sila masukkan nama penuh anda");
                input.focus();
                return false;
            }
        } else if (input.name == "password") {
            if (input.value.length < 8) {
                showError(input, "Sila masukkan kata laluan sekurang-kurangnya 8 patah perkataan");
                input.focus();
                return false;
            }
        } else if (input.name == "cpassword") {
            if (input.value.length == 0) {
                showError(input, "Sila masukkan kata laluan sekali lagi");
                input.focus();
                return false;
            } else if (input.value != form.elements.password.value) {
                showError(input, "Kata laluan tidak sama");
                input.focus();
                return false;
            }
        } else if (input.name == "program") {
            if (input.value.length == 0) {
                showError(input, "Sila masukkan program pengajian");
                input.focus();
                return false;
            }
        } else if (input.name == "year") {
            if (input.value.length == 0) {
                showError(input, "Sila masukkan tahun pengajian");
                input.focus();
                return false;
            }
        }
    }
    return true;
}

var form = document.getElementById("profile-form");
form.addEventListener("submit", function (event) {
    event.preventDefault;
    var inputs = form.elements;
    if (validateForm(inputs)) {
        var formData = new FormData(form);
        fetch(form.action, {method: 'POST', body: formData})
        .then(response => {
            if (response.ok) {
                alert("Registration successful");
            } else {
                alert("Registration failed");
            }
        })
        .catch(error => {
            alert(error);
        });
    }
});



