// Login Page Specific JS
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

    // Form Submission
    const loginForm = document.querySelector('.login-form');
    if(loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your login logic here
            console.log('Form submitted');
        });
    }

    // Input Animation on Focus
    const inputs = document.querySelectorAll('.input-group input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
});