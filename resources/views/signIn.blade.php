<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/stylessignIn.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 0;
            max-width: 400px;
            width: 90%;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .modal-overlay.show .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            padding: 24px 24px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .modal-icon.success {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .modal-icon.error {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .modal-body {
            padding: 16px 24px 24px;
        }

        .modal-message {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin: 0 0 20px 0;
        }

        .modal-footer {
            padding: 0 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-button {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            min-width: 80px;
        }

        .modal-button.primary {
            background-color: #3b82f6;
            color: white;
        }

        .modal-button.primary:hover {
            background-color: #2563eb;
        }

        .modal-button.secondary {
            background-color: #f3f4f6;
            color: #374151;
        }

        .modal-button.secondary:hover {
            background-color: #e5e7eb;
        }

        /* Animation for success checkmark */
        .success-checkmark {
            animation: checkmark 0.6s ease-in-out;
        }

        @keyframes checkmark {
            0% { transform: scale(0) rotate(45deg); }
            50% { transform: scale(1.2) rotate(45deg); }
            100% { transform: scale(1) rotate(45deg); }
        }

        /* Animation for error X */
        .error-x {
            animation: errorShake 0.5s ease-in-out;
        }

        @keyframes errorShake {
            0%, 20%, 40%, 60%, 80% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        }
    </style>
</head>

<body>

    <div class="parent">
        <div class="circle-bg-wrapper">
            <div class="circle-bg"></div>
            <img src="{{ asset('img/cat.png') }}" class="cat" alt="Cat" />
            <img src="{{ asset('img/dog.png') }}" class="dog" alt="Dog" />
            <div class="title-wrapper">
                <div class="title" id="formTitle">Sign Up</div>
            </div>
        </div>
        <div class="login" id="authFormContainer">
            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success"
                    style="color: green; margin-bottom: 1rem; padding: 10px; border: 1px solid green; border-radius: 4px; background-color: #f0fff0;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if($errors->any())
                <div class="alert alert-danger"
                    style="color: red; margin-bottom: 1rem; padding: 10px; border: 1px solid red; border-radius: 4px; background-color: #fff0f0;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="authForm" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="input-group" id="firstNameGroup">
                    <input type="text" name="firstName" id="firstName" placeholder="First Name"
                        value="" autocomplete="given-name">
                    <span id="firstNameError" class="error-message"></span>
                </div>

                <div class="input-group" id="lastNameGroup">
                    <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                        value="" autocomplete="family-name">
                    <span id="lastNameError" class="error-message"></span>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="Email" value="" required 
                           autocomplete="email">
                    <span id="emailError" class="error-message"></span>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required 
                           autocomplete="new-password" value="">
                    <span id="passwordError" class="error-message"></span>
                </div>

                <button type="submit" id="submitButton">
                    <span class="button-text">Sign Up</span>
                    <div class="spinner"></div>
                </button>

                <div class="auth-toggle-section">
                    <div id="forgotPasswordLinkContainer" class="hidden">
                        <p>Forgot your password?</p>
                    </div>
                    <div>
                        <p>Already have an account? <a href="#" id="toggleAuthMode">Sign In</a></p>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <!-- Modal HTML -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <div id="modalIcon" class="modal-icon">
                    <span id="modalIconSymbol">✓</span>
                </div>
                <h3 id="modalTitle" class="modal-title">Success</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage" class="modal-message">Operation completed successfully.</p>
            </div>
            <div class="modal-footer">
                <button id="modalSecondaryButton" class="modal-button secondary" style="display: none;">Cancel</button>
                <button id="modalPrimaryButton" class="modal-button primary">OK</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Clear all form inputs on page load to prevent auto-fill issues
            document.getElementById('firstName').value = '';
            document.getElementById('lastName').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            
            const authFormContainer = document.getElementById('authFormContainer');
            const authForm = document.getElementById('authForm');
            const formTitle = document.getElementById('formTitle');
            const firstNameGroup = document.getElementById('firstNameGroup');
            const lastNameGroup = document.getElementById('lastNameGroup');
            const firstNameInput = document.getElementById('firstName');
            const lastNameInput = document.getElementById('lastName');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const firstNameError = document.getElementById('firstNameError');
            const lastNameError = document.getElementById('lastNameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const submitButton = document.getElementById('submitButton');
            const buttonText = submitButton.querySelector('.button-text');
            const spinner = submitButton.querySelector('.spinner');
            const toggleAuthModeLink = document.getElementById('toggleAuthMode');
            const forgotPasswordLinkContainer = document.getElementById('forgotPasswordLinkContainer');

            // Modal elements
            const modalOverlay = document.getElementById('modalOverlay');
            const modalIcon = document.getElementById('modalIcon');
            const modalIconSymbol = document.getElementById('modalIconSymbol');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalPrimaryButton = document.getElementById('modalPrimaryButton');
            const modalSecondaryButton = document.getElementById('modalSecondaryButton');

            let isLoginMode = false;

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const nameRegex = /^[A-Za-z]{2,50}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;

            // Modal functions
            function showModal(type, title, message, primaryText = 'OK', secondaryText = null, onPrimary = null, onSecondary = null) {
                // Set modal type
                modalIcon.className = `modal-icon ${type}`;
                
                if (type === 'success') {
                    modalIconSymbol.textContent = '✓';
                    modalIconSymbol.className = 'success-checkmark';
                } else if (type === 'error') {
                    modalIconSymbol.textContent = '✕';
                    modalIconSymbol.className = 'error-x';
                }

                // Set content
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                modalPrimaryButton.textContent = primaryText;

                // Handle secondary button
                if (secondaryText) {
                    modalSecondaryButton.textContent = secondaryText;
                    modalSecondaryButton.style.display = 'block';
                } else {
                    modalSecondaryButton.style.display = 'none';
                }

                // Set up event listeners
                modalPrimaryButton.onclick = () => {
                    hideModal();
                    if (onPrimary) onPrimary();
                };

                modalSecondaryButton.onclick = () => {
                    hideModal();
                    if (onSecondary) onSecondary();
                };

                // Close modal when clicking overlay
                modalOverlay.onclick = (e) => {
                    if (e.target === modalOverlay) {
                        hideModal();
                    }
                };

                // Show modal
                modalOverlay.classList.add('show');
                
                // Focus primary button for accessibility
                setTimeout(() => modalPrimaryButton.focus(), 300);
            }

            function hideModal() {
                modalOverlay.classList.remove('show');
            }

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modalOverlay.classList.contains('show')) {
                    hideModal();
                }
            });

            function validateInput(inputElement, errorElement, regex, errorMessage, required = true) {
                const value = inputElement.value.trim();
                let isValid = true;

                if (required && value === '') {
                    errorElement.textContent = 'This field is required.';
                    inputElement.classList.add('border-red-500');
                    isValid = false;
                } else if (value !== '' && !regex.test(value)) {
                    errorElement.textContent = errorMessage;
                    inputElement.classList.add('border-red-500');
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                    inputElement.classList.remove('border-red-500');
                }
                return isValid;
            }

            function validateFirstName() {
                return validateInput(firstNameInput, firstNameError, nameRegex, 'First Name must be 2-50 letters.', !isLoginMode);
            }

            function validateLastName() {
                return validateInput(lastNameInput, lastNameError, nameRegex, 'Last Name must be 2-50 letters.', !isLoginMode);
            }

            function validateEmail() {
                return validateInput(emailInput, emailError, emailRegex, 'Please enter a valid email address.');
            }

            function validatePassword() {
                if (isLoginMode) {
                    // For login, just check if password is not empty
                    return validateInput(passwordInput, passwordError, /.+/, 'Password is required.');
                } else {
                    // For signup, use strong password validation
                    return validateInput(passwordInput, passwordError, passwordRegex,
                        'Password must be at least 8 chars, incl. uppercase, lowercase, number, and special char.'
                    );
                }
            }

            firstNameInput.addEventListener('input', validateFirstName);
            lastNameInput.addEventListener('input', validateLastName);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);

            function toggleAuthMode() {
                isLoginMode = !isLoginMode;

                if (isLoginMode) {
                    // Switch to Sign In mode
                    authFormContainer.classList.add('login-mode');
                    formTitle.textContent = 'Sign In';
                    buttonText.textContent = 'Sign In';
                    toggleAuthModeLink.textContent = 'Sign Up';
                    toggleAuthModeLink.parentNode.firstChild.textContent = 'Don\'t have an account? ';
                    forgotPasswordLinkContainer.classList.remove('hidden');
                    firstNameGroup.style.display = 'none';
                    lastNameGroup.style.display = 'none';

                    // Change form action for sign in
                    authForm.action = "{{ route('signIn') }}";
                    
                    // Change autocomplete for login
                    passwordInput.setAttribute('autocomplete', 'current-password');
                } else {
                    // Switch to Sign Up mode
                    authFormContainer.classList.remove('login-mode');
                    formTitle.textContent = 'Sign Up';
                    buttonText.textContent = 'Sign Up';
                    toggleAuthModeLink.textContent = 'Sign In';
                    toggleAuthModeLink.parentNode.firstChild.textContent = 'Already have an account? ';
                    forgotPasswordLinkContainer.classList.add('hidden');
                    firstNameGroup.style.display = 'block';
                    lastNameGroup.style.display = 'block';

                    // Change form action for sign up
                    authForm.action = "{{ route('users.store') }}";
                    
                    // Change autocomplete for signup
                    passwordInput.setAttribute('autocomplete', 'new-password');
                }

                // Clear all error messages and styles
                [firstNameError, lastNameError, emailError, passwordError].forEach(el => el.textContent = '');
                [firstNameInput, lastNameInput, emailInput, passwordInput].forEach(el => el.classList.remove('border-red-500'));
                
                // Clear form inputs when switching modes
                firstNameInput.value = '';
                lastNameInput.value = '';
                emailInput.value = '';
                passwordInput.value = '';
            }

            toggleAuthModeLink.addEventListener('click', (event) => {
                event.preventDefault();
                toggleAuthMode();
            });

            authForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                let isValidForm = true;

                // Validate based on current mode
                if (!isLoginMode) {
                    isValidForm = validateFirstName() && validateLastName();
                }
                isValidForm = validateEmail() && validatePassword() && isValidForm;

                if (!isValidForm) {
                    return;
                }

                submitButton.disabled = true;
                buttonText.classList.add('hidden');
                spinner.classList.add('active');

                try {
                    if (!isLoginMode) {
                        // Sign Up - use regular form submission to handle Laravel validation properly
                        const formData = new FormData(authForm);
                        formData.set('name', firstNameInput.value.trim() + ' ' + lastNameInput.value.trim());

                        const response = await fetch("{{ route('users.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        if (response.ok) {
                            const data = await response.json();
                            showModal(
                                'success',
                                'Account Created Successfully!',
                                'Your account has been created. Please sign in with your credentials.',
                                'Continue',
                                null,
                                () => toggleAuthMode() // Switch to login mode
                            );
                        } else {
                            const errorData = await response.json();
                            if (errorData.errors) {
                                // Display validation errors
                                Object.keys(errorData.errors).forEach(field => {
                                    const errorElement = document.getElementById(field + 'Error');
                                    if (errorElement) {
                                        errorElement.textContent = errorData.errors[field][0];
                                    }
                                });
                                showModal(
                                    'error',
                                    'Registration Failed',
                                    'Please check the form for errors and try again.',
                                    'OK'
                                );
                            } else {
                                showModal(
                                    'error',
                                    'Registration Failed',
                                    errorData.message || 'Sign up failed. Please try again.',
                                    'OK'
                                );
                            }
                        }
                    } else {
                        // Sign In
                        const formData = new FormData();
                        formData.append('_token', csrfToken);
                        formData.append('email', emailInput.value.trim());
                        formData.append('password', passwordInput.value.trim());

                        const response = await fetch("{{ route('signIn') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        if (response.ok) {
                            const data = await response.json();
                            if (data.token) {
                                // Save token if provided
                                localStorage.setItem('authToken', data.token);
                            }
                            
                            showModal(
                                'success',
                                'Welcome Back!',
                                'You have been successfully signed in. Redirecting to your dashboard...',
                                'Continue',
                                null,
                                () => window.location.href = "{{ route('home') }}"
                            );
                        } else {
                            const errorData = await response.json();
                            showModal(
                                'error',
                                'Sign In Failed',
                                errorData.message || 'Login failed. Please check your credentials and try again.',
                                'Try Again'
                            );
                        }
                    }

                } catch (error) {
                    console.error('Error:', error);
                    showModal(
                        'error',
                        'Connection Error',
                        'An unexpected error occurred. Please check your internet connection and try again.',
                        'Retry'
                    );
                } finally {
                    submitButton.disabled = false;
                    buttonText.classList.remove('hidden');
                    spinner.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>