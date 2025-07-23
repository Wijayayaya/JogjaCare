<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Yogyakarta Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            min-height: 600px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        /* Left Side - Form */
        .form-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            position: relative;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #333;
            margin-bottom: 3rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 20px 0;
            border: none;
            border-bottom: 2px solid #e0e0e0;
            background: transparent;
            font-size: 1.1rem;
            color: #333;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-bottom-color: #10b981;
        }

        .form-input::placeholder {
            color: #999;
            font-weight: 300;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .password-hint {
            margin-top: 5px;
            font-size: 0.8rem;
            color: #666;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            gap: 12px;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            accent-color: #10b981;
            cursor: pointer;
            margin-top: 2px;
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: #666;
            cursor: pointer;
            line-height: 1.4;
        }

        .checkbox-label a {
            color: #10b981;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .checkbox-label a:hover {
            color: #059669;
        }

        .register-button {
            width: 100%;
            padding: 18px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .register-button:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .register-button:active {
            transform: scale(0.98);
        }

        .google-button {
            width: 100%;
            padding: 18px;
            background: white;
            color: #666;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .google-button:hover {
            border-color: #10b981;
            color: #10b981;
            transform: translateY(-1px);
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        /* Right Side - Image and Login */
        .image-section {
            flex: 1;
            background: linear-gradient(45deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 60px 40px;
        }

        .login-content h2 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 1rem;
        }

        .login-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        .login-button {
            padding: 15px 40px;
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-block;
        }

        .login-button:hover {
            background: white;
            color: #333;
            transform: translateY(-2px);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
        }

        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Yogyakarta themed decorative elements */
        .batik-pattern {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #10b981, #059669);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .batik-pattern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border: 2px solid rgba(16, 185, 129, 0.5);
            border-radius: 50%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .jogja-accent {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 0.8rem;
            color: rgba(16, 185, 129, 0.6);
            font-weight: 300;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            }

            .register-container {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }

            .form-section {
                padding: 40px 30px;
            }

            .image-section {
                min-height: 300px;
                padding: 40px 30px;
                background: linear-gradient(45deg, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), 
                            url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80') center/cover;
            }

            .welcome-title {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .login-content h2 {
                font-size: 2rem;
            }

            .login-content p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            body {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            }

            .form-section {
                padding: 30px 20px;
            }

            .image-section {
                padding: 30px 20px;
            }

            .welcome-title {
                font-size: 1.8rem;
            }

            .login-content h2 {
                font-size: 1.8rem;
            }
        }

        /* Animation */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-section {
            animation: fadeInLeft 0.8s ease-out;
        }

        .image-section {
            animation: fadeInRight 0.8s ease-out;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Side - Register Form -->
        <div class="form-section">
            <div class="batik-pattern"></div>
            <div class="jogja-accent">Portal Istimewa Yogyakarta</div>
            
            <h1 class="welcome-title">Create New Account,</h1>
            
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <!-- Name -->
                <div class="form-group">
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input" 
                           placeholder="Full Name" 
                           required 
                           autofocus 
                           autocomplete="name"
                           value="{{ old('name') }}">
                    <div class="error-message" id="nameError"></div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="Email Address" 
                           required 
                           autocomplete="username"
                           value="{{ old('email') }}">
                    <div class="error-message" id="emailError"></div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="password-wrapper">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input" 
                               placeholder="Password" 
                               required 
                               autocomplete="new-password">
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                    <p class="password-hint">Minimum 8 characters with letters and numbers</p>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="password-wrapper">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input" 
                               placeholder="Confirm Password" 
                               required 
                               autocomplete="new-password">
                        <button type="button" class="password-toggle" id="confirmPasswordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>

                <!-- Terms and Conditions -->
                <div class="checkbox-wrapper">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           class="checkbox" 
                           required>
                    <label for="terms" class="checkbox-label">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="register-button" id="registerButton">
                    <span class="button-text">Register Now</span>
                    <div class="loading" id="loadingSpinner"></div>
                </button>

                <!-- Google Login -->
                <a href="{{ route('login.google') }}" class="google-button">
                    <svg class="google-icon" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Connect with Google
                </a>
            </form>
        </div>

        <!-- Right Side - Image and Login -->
        <div class="image-section">
            <div class="login-content">
                <h2>Already Have an Account?</h2>
                <p>Sign in to your account and<br>continue your journey with us!</p>
                <a href="{{ route('login') }}" class="login-button">Sign In Now</a>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const registerForm = document.getElementById('registerForm');
        const registerButton = document.getElementById('registerButton');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const buttonText = document.querySelector('.button-text');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const passwordToggle = document.getElementById('passwordToggle');
        const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
        const termsCheckbox = document.getElementById('terms');

        // Error elements
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        // Password visibility toggles
        function setupPasswordToggle(toggle, input) {
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        setupPasswordToggle(passwordToggle, passwordInput);
        setupPasswordToggle(confirmPasswordToggle, confirmPasswordInput);

        // Validation functions
        function validateName(name) {
            return name.trim().length >= 2;
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePassword(password) {
            return password.length >= 8 && /[A-Za-z]/.test(password) && /[0-9]/.test(password);
        }

        function validatePasswordConfirmation(password, confirmation) {
            return password === confirmation;
        }

        function showError(element, message) {
            element.textContent = message;
            element.classList.add('show');
        }

        function hideError(element) {
            element.classList.remove('show');
        }

        // Real-time validation
        nameInput.addEventListener('blur', function() {
            const name = this.value.trim();
            if (name && !validateName(name)) {
                showError(nameError, 'Name must be at least 2 characters');
            } else {
                hideError(nameError);
            }
        });

        emailInput.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && !validateEmail(email)) {
                showError(emailError, 'Invalid email format');
            } else {
                hideError(emailError);
            }
        });

        passwordInput.addEventListener('blur', function() {
            const password = this.value;
            if (password && !validatePassword(password)) {
                showError(passwordError, 'Password must be at least 8 characters with letters and numbers');
            } else {
                hideError(passwordError);
            }
        });

        confirmPasswordInput.addEventListener('blur', function() {
            const password = passwordInput.value;
            const confirmation = this.value;
            if (confirmation && !validatePasswordConfirmation(password, confirmation)) {
                showError(confirmPasswordError, 'Passwords do not match');
            } else {
                hideError(confirmPasswordError);
            }
        });

        // Form submission
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate name
            const name = nameInput.value.trim();
            if (!name) {
                showError(nameError, 'Name is required');
                isValid = false;
            } else if (!validateName(name)) {
                showError(nameError, 'Name must be at least 2 characters');
                isValid = false;
            } else {
                hideError(nameError);
            }

            // Validate email
            const email = emailInput.value.trim();
            if (!email) {
                showError(emailError, 'Email is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError(emailError, 'Invalid email format');
                isValid = false;
            } else {
                hideError(emailError);
            }

            // Validate password
            const password = passwordInput.value;
            if (!password) {
                showError(passwordError, 'Password is required');
                isValid = false;
            } else if (!validatePassword(password)) {
                showError(passwordError, 'Password must be at least 8 characters with letters and numbers');
                isValid = false;
            } else {
                hideError(passwordError);
            }

            // Validate password confirmation
            const confirmation = confirmPasswordInput.value;
            if (!confirmation) {
                showError(confirmPasswordError, 'Password confirmation is required');
                isValid = false;
            } else if (!validatePasswordConfirmation(password, confirmation)) {
                showError(confirmPasswordError, 'Passwords do not match');
                isValid = false;
            } else {
                hideError(confirmPasswordError);
            }

            // Validate terms
            if (!termsCheckbox.checked) {
                alert('You must agree to the terms and conditions');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Show loading state
            registerButton.disabled = true;
            buttonText.style.display = 'none';
            loadingSpinner.style.display = 'inline-block';
            
            // In a real application, form would be submitted here
            setTimeout(() => {
                registerButton.disabled = false;
                buttonText.style.display = 'inline';
                loadingSpinner.style.display = 'none';
            }, 2000);
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            nameInput.focus();
        });

        // Enhanced input animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'translateY(0)';
            });
        });

        // Dynamic background color change
        const colors = [
            'linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%)'
        ];

        let colorIndex = 0;
        setInterval(() => {
            document.body.style.background = colors[colorIndex];
            colorIndex = (colorIndex + 1) % colors.length;
        }, 10000);
    </script>
</body>
</html>