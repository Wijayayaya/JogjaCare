<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Yogyakarta Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
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
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #1f2937;
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
            border-bottom: 2px solid #e5e7eb;
            background: transparent;
            font-size: 1.1rem;
            color: #374151;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-bottom-color: #8b5cf6;
        }

        .form-input::placeholder {
            color: #9ca3af;
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
            color: #6b7280;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 2rem;
        }

        .forgot-password a {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #8b5cf6;
        }

        .sign-in-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
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

        .sign-in-button:hover {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .sign-in-button:active {
            transform: scale(0.98);
        }

        .facebook-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%);
            color: #374151;
            border: 2px solid #e5e7eb;
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

        .facebook-button:hover {
            border-color: #3b82f6;
            color: #1d4ed8;
            transform: translateY(-1px);
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        }

        .facebook-icon {
            color: #3b82f6;
            font-size: 1.2rem;
        }

        /* Right Side - Image and Signup */
        .image-section {
            flex: 1;
            background: linear-gradient(45deg, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), 
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

        .signup-content h2 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .signup-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 3rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .signup-button {
            padding: 15px 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 2px solid transparent;
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

        .signup-button:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .error-message {
            color: #ef4444;
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
            background: linear-gradient(45deg, #f59e0b, #d97706);
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
            border: 2px solid rgba(245, 158, 11, 0.5);
            border-radius: 50%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            }

            .login-container {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }

            .form-section {
                padding: 40px 30px;
                background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
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

            .signup-content h2 {
                font-size: 2rem;
            }

            .signup-content p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            body {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            }

            .form-section {
                padding: 30px 20px;
                background: linear-gradient(135deg, #fef7ff 0%, #fae8ff 100%);
            }

            .image-section {
                padding: 30px 20px;
            }

            .welcome-title {
                font-size: 1.8rem;
            }

            .signup-content h2 {
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
            position: relative;
        }

        .image-section {
            animation: fadeInRight 0.8s ease-out;
        }

        /* Additional Yogyakarta themed elements */
        .jogja-accent {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 0.8rem;
            color: rgba(139, 92, 246, 0.6);
            font-weight: 300;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Login Form -->
        <div class="form-section">
            <div class="batik-pattern"></div>
            <h1 class="welcome-title">Welcome,</h1>
            <div class="jogja-accent">Portal Istimewa Yogyakarta</div>
            
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <!-- Email -->
                <div class="form-group">
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="Email" 
                           required 
                           autocomplete="email"
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
                               autocomplete="current-password">
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>

                <!-- Forgot Password -->
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>

                <!-- Sign In Button -->
                <button type="submit" class="sign-in-button" id="signInButton">
                    <span class="button-text">Sign In</span>
                    <div class="loading" id="loadingSpinner"></div>
                </button>

                <!-- Google Login -->
                <a href="{{ route('login.google') }}" class="facebook-button">
                    <i class="fab fa-google facebook-icon"></i>
                    Connect with Google
                </a>
            </form>
        </div>

        <!-- Right Side - Image and Signup -->
        <div class="image-section">
            <div class="signup-content">
                <h2>Don't Have an Account?</h2>
                <p>Join us and discover<br>new opportunities in Yogyakarta!</p>
                <a href="{{ route('register') }}" class="signup-button">Register Now</a>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const loginForm = document.getElementById('loginForm');
        const signInButton = document.getElementById('signInButton');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const buttonText = document.querySelector('.button-text');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        // Password visibility toggle
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        // Form validation
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePassword(password) {
            return password.length >= 6;
        }

        function showError(element, message) {
            element.textContent = message;
            element.classList.add('show');
        }

        function hideError(element) {
            element.classList.remove('show');
        }

        // Real-time validation
        emailInput.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && !validateEmail(email)) {
                showError(emailError, 'Please enter a valid email address');
            } else {
                hideError(emailError);
            }
        });

        passwordInput.addEventListener('blur', function() {
            const password = this.value;
            if (password && !validatePassword(password)) {
                showError(passwordError, 'Password must be at least 6 characters long');
            } else {
                hideError(passwordError);
            }
        });

        // Form submission
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate email
            const email = emailInput.value.trim();
            if (!email) {
                showError(emailError, 'Email address is required');
                isValid = false;
            } else if (!validateEmail(email)) {
                showError(emailError, 'Please enter a valid email address');
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
                showError(passwordError, 'Password must be at least 6 characters long');
                isValid = false;
            } else {
                hideError(passwordError);
            }

            if (!isValid) {
                e.preventDefault();
                return;
            }

            // Show loading state
            signInButton.disabled = true;
            buttonText.style.display = 'none';
            loadingSpinner.style.display = 'inline-block';
            
            // In a real application, form would be submitted here
            setTimeout(() => {
                signInButton.disabled = false;
                buttonText.style.display = 'inline';
                loadingSpinner.style.display = 'none';
            }, 2000);
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            emailInput.focus();
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
            'linear-gradient(135deg, #eff6ff 0%, #dbeafe 50%, #e0e7ff 100%)',
            'linear-gradient(135deg, #fdf2f8 0%, #fce7f3 50%, #f3e8ff 100%)',
            
        ];

        let colorIndex = 0;
        setInterval(() => {
            document.body.style.background = colors[colorIndex];
            colorIndex = (colorIndex + 1) % colors.length;
        }, 10000);
    </script>
</body>
</html>