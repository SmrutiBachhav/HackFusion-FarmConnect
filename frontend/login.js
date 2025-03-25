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
    // window.location.href = "index.html";
}

document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');
    
    if(togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function(e) {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    }

    // Form Submission with Validation
    const loginForm = document.querySelector('.login-form');
    if(loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            if(username.trim() === '' || password.trim() === '') {
                showError('Please fill in all fields');
                return;
            }
            
            // Add actual authentication logic here
            console.log('Login submitted:', { 
                userType: document.getElementById('user-type').value,
                username,
                password 
            });
        });
    }

    // Input Hover Effects
    const inputs = document.querySelectorAll('.input-group');
    inputs.forEach(input => {
        input.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

function showError(message) {
    // Remove existing errors
    const existingError = document.querySelector('.error-message');
    if(existingError) existingError.remove();

    // Create new error element
    const errorEl = document.createElement('div');
    errorEl.className = 'error-message';
    errorEl.textContent = message;
    
    // Insert error message
    const form = document.querySelector('.login-form');
    form.insertBefore(errorEl, form.firstChild);
    
    // Auto-remove after 3 seconds
    setTimeout(() => errorEl.remove(), 3000);
}