
function login() {
        let role = document.getElementById("role").value;
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
    
        // Validation: Ensure all fields are filled
        if (username === "" || password === "" || role === "") {
            alert("Please fill in all fields.");
            return;
        } else {
            // If everything is valid, submit the form
            document.getElementById("loginForm").submit();
        }
        window.location.href = "/index.html";
}
    

function register() {
    let role = document.getElementById("role").value;
    let name = document.getElementById("name").value;
    let address = document.getElementById("address").value;
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let email = document.getElementById("email").value;

    if (name === "" || address === "" || phone === "" || password === "" || confirmPassword === "") {
        alert("Please fill in all required fields.");
        return;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    else{
        // If everything is valid, submit the form
        document.getElementById("registerForm").submit();
    }
    window.location.href = "index.html"; // Redirect to login after registering
}

  
