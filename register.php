<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGU 3 - Local Product & Export Development | Official Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Segoe UI', Tahoma, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Government style header bar */
        .gov-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #003366;
            color: white;
            padding: 8px 20px;
            font-size: 12px;
            text-align: center;
            z-index: 100;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        /* Header */
        .header {
            background: #003366;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .logo {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: normal;
            letter-spacing: 1px;
        }

        .header h2 {
            font-size: 13px;
            font-weight: normal;
            margin-top: 3px;
            opacity: 0.9;
        }

        .republic {
            font-size: 10px;
            margin-top: 5px;
            border-top: 1px solid rgba(255,255,255,0.3);
            display: inline-block;
            padding-top: 5px;
        }

        /* Form Body - Landscape Layout */
        .form-body {
            padding: 25px 30px;
        }

        /* Two columns layout for most fields */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }

        /* Full width for single column items */
        .form-full {
            margin-bottom: 15px;
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 0;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .input-group label .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .input-group input, 
        .input-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 13px;
            font-family: inherit;
            transition: all 0.2s;
            background: white;
        }

        .input-group input:focus, 
        .input-group select:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 2px rgba(0,51,102,0.1);
        }

        /* Password hint */
        .password-hint {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        /* Terms and conditions */
        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0;
            font-size: 12px;
        }

        .terms input {
            width: 16px;
            height: 16px;
            margin-top: 2px;
            cursor: pointer;
        }

        .terms label {
            color: #555;
            line-height: 1.4;
            cursor: pointer;
        }

        .terms a {
            color: #003366;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .register-btn {
            width: 100%;
            background: #003366;
            color: white;
            border: none;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 3px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: inherit;
            margin-bottom: 12px;
        }

        .register-btn:hover {
            background: #002244;
        }

        .login-link {
            text-align: center;
            font-size: 12px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #dee2e6;
        }

        .login-link a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Message Box */
        .message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 3px;
            font-size: 12px;
            margin-bottom: 20px;
            display: none;
            border-left: 3px solid #dc3545;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 10px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
        }

        /* Responsive - becomes vertical on smaller screens */
        @media (max-width: 768px) {
            .container {
                max-width: 500px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .form-body {
                padding: 20px;
            }
            
            .header {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="gov-bar">
        REPUBLIC OF THE PHILIPPINES | Local Government Unit
    </div>

    <div class="container">
        <div class="header">
            <div class="logo">📝🏛️</div>
            <h1>LGU 3</h1>
            <h2>Local Product & Export Development</h2>
            <div class="republic">✧ OFFICIAL REGISTRATION ✧</div>
        </div>

        <div class="form-body">
            <div id="messageBox" class="message"></div>

            <form id="registerForm">
                <!-- Row 1: First Name and Last Name -->
                <div class="form-row">
                    <div class="input-group">
                        <label>FIRST NAME <span class="required">*</span></label>
                        <input type="text" id="firstName" placeholder="Enter first name">
                    </div>
                    <div class="input-group">
                        <label>LAST NAME <span class="required">*</span></label>
                        <input type="text" id="lastName" placeholder="Enter last name">
                    </div>
                </div>

                <!-- Row 2: Email and Contact Number -->
                <div class="form-row">
                    <div class="input-group">
                        <label>EMAIL ADDRESS <span class="required">*</span></label>
                        <input type="email" id="email" placeholder="Enter email address">
                    </div>
                    <div class="input-group">
                        <label>CONTACT NUMBER</label>
                        <input type="tel" id="contact" placeholder="e.g., 09123456789">
                    </div>
                </div>

                <!-- Row 3: Office/Agency and Username -->
                <div class="form-row">
                    <div class="input-group">
                        <label>OFFICE / AGENCY / BUSINESS</label>
                        <input type="text" id="organization" placeholder="Enter office, agency, or business name">
                    </div>
                    <div class="input-group">
                        <label>USERNAME <span class="required">*</span></label>
                        <input type="text" id="username" placeholder="Choose a username">
                    </div>
                </div>

                <!-- Row 4: Password and Confirm Password -->
                <div class="form-row">
                    <div class="input-group">
                        <label>PASSWORD <span class="required">*</span></label>
                        <input type="password" id="password" placeholder="Create a password">
                        <div class="password-hint">Minimum 6 characters</div>
                    </div>
                    <div class="input-group">
                        <label>CONFIRM PASSWORD <span class="required">*</span></label>
                        <input type="password" id="confirmPassword" placeholder="Confirm your password">
                    </div>
                </div>

                <!-- Terms and Conditions - Full Width -->
                <div class="form-full">
                    <div class="terms">
                        <input type="checkbox" id="termsCheck">
                        <label for="termsCheck">
                            I agree to the <a href="#" id="termsLink">Terms of Service</a> and <a href="#" id="privacyLink">Privacy Policy</a> of LGU 3
                        </label>
                    </div>
                </div>

                <button type="submit" class="register-btn">REGISTER ACCOUNT</button>

                <div class="login-link">
                    Already have an account? <a href="login.html">Sign in here</a>
                </div>
            </form>
        </div>

        <div class="footer">
            LGU 3 - Local Product & Export Development Office
        </div>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const firstName = document.getElementById('firstName');
        const lastName = document.getElementById('lastName');
        const email = document.getElementById('email');
        const contact = document.getElementById('contact');
        const organization = document.getElementById('organization');
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const termsCheck = document.getElementById('termsCheck');
        const messageBox = document.getElementById('messageBox');

        function showMessage(text, isError = true) {
            messageBox.textContent = text;
            messageBox.className = 'message';
            if (!isError) {
                messageBox.classList.add('success');
            }
            messageBox.style.display = 'block';
            
            setTimeout(() => {
                messageBox.style.display = 'none';
            }, 4000);
        }

        // Validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@([^\s@]+\.)+[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Validate Philippine mobile number (simple)
        function isValidContact(contact) {
            if (contact === '') return true; // optional field
            const phoneRegex = /^(09|\+639)\d{9}$/;
            return phoneRegex.test(contact.replace(/\s/g, ''));
        }

        // Check if username already exists
        function isUsernameTaken(newUsername) {
            const users = JSON.parse(localStorage.getItem('lgu3_users') || '[]');
            return users.some(user => user.username === newUsername);
        }

        // Check if email already exists
        function isEmailTaken(newEmail) {
            const users = JSON.parse(localStorage.getItem('lgu3_users') || '[]');
            return users.some(user => user.email === newEmail);
        }

        // Save new user
        function saveUser(userData) {
            const users = JSON.parse(localStorage.getItem('lgu3_users') || '[]');
            users.push(userData);
            localStorage.setItem('lgu3_users', JSON.stringify(users));
        }

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const firstNameVal = firstName.value.trim();
            const lastNameVal = lastName.value.trim();
            const emailVal = email.value.trim();
            const contactVal = contact.value.trim();
            const organizationVal = organization.value.trim();
            const usernameVal = username.value.trim();
            const passwordVal = password.value;
            const confirmPasswordVal = confirmPassword.value;
            
            // Validation
            if (firstNameVal === '') {
                showMessage('Please enter your first name');
                firstName.focus();
                return;
            }
            
            if (lastNameVal === '') {
                showMessage('Please enter your last name');
                lastName.focus();
                return;
            }
            
            if (emailVal === '') {
                showMessage('Please enter your email address');
                email.focus();
                return;
            }
            
            if (!isValidEmail(emailVal)) {
                showMessage('Please enter a valid email address (e.g., name@domain.com)');
                email.focus();
                return;
            }
            
            if (contactVal !== '' && !isValidContact(contactVal)) {
                showMessage('Please enter a valid contact number (e.g., 09123456789 or +639123456789)');
                contact.focus();
                return;
            }
            
            if (usernameVal === '') {
                showMessage('Please choose a username');
                username.focus();
                return;
            }
            
            if (usernameVal.length < 3) {
                showMessage('Username must be at least 3 characters');
                username.focus();
                return;
            }
            
            if (passwordVal === '') {
                showMessage('Please create a password');
                password.focus();
                return;
            }
            
            if (passwordVal.length < 6) {
                showMessage('Password must be at least 6 characters');
                password.focus();
                return;
            }
            
            if (confirmPasswordVal === '') {
                showMessage('Please confirm your password');
                confirmPassword.focus();
                return;
            }
            
            if (passwordVal !== confirmPasswordVal) {
                showMessage('Passwords do not match');
                confirmPassword.focus();
                return;
            }
            
            if (!termsCheck.checked) {
                showMessage('Please agree to the Terms of Service and Privacy Policy');
                return;
            }
            
            // Check if username already exists
            if (isUsernameTaken(usernameVal)) {
                showMessage('Username already exists. Please choose another username');
                username.focus();
                return;
            }
            
            // Check if email already exists
            if (isEmailTaken(emailVal)) {
                showMessage('Email address is already registered. Please use another email or login');
                email.focus();
                return;
            }
            
            // Create user object
            const newUser = {
                id: Date.now(),
                firstName: firstNameVal,
                lastName: lastNameVal,
                email: emailVal,
                contact: contactVal,
                organization: organizationVal,
                username: usernameVal,
                password: passwordVal,
                dateRegistered: new Date().toISOString(),
                accountType: 'user'
            };
            
            // Save to localStorage
            saveUser(newUser);
            
            // Show success message
            showMessage('Registration successful! You can now login with your credentials.', false);
            
            // Disable button and show processing
            const btn = document.querySelector('.register-btn');
            btn.disabled = true;
            btn.textContent = 'REGISTERING...';
            
            // Redirect to login after 2 seconds
            setTimeout(() => {
                alert('REGISTRATION SUCCESSFUL!\n\nWelcome to LGU 3 - Local Product & Export Development System.\nYou may now login using your username and password.');
                // Uncomment for actual redirect:
                // window.location.href = 'login.html';
                btn.disabled = false;
                btn.textContent = 'REGISTER ACCOUNT';
                form.reset();
                termsCheck.checked = false;
            }, 2000);
        });
        
        // Terms and Privacy links
        document.getElementById('termsLink').addEventListener('click', function(e) {
            e.preventDefault();
            showMessage('Terms of Service: By registering, you agree to comply with LGU 3 policies and data privacy regulations.', false);
        });
        
        document.getElementById('privacyLink').addEventListener('click', function(e) {
            e.preventDefault();
            showMessage('Privacy Policy: Your personal data is protected under the Data Privacy Act of 2012 (RA 10173).', false);
        });
        
        // Auto-suggest username based on name
        function suggestUsername() {
            const first = firstName.value.trim();
            const last = lastName.value.trim();
            if (first && last && username.value === '') {
                const suggested = (first + last).toLowerCase().replace(/\s/g, '');
                username.value = suggested;
            }
        }
        
        firstName.addEventListener('blur', suggestUsername);
        lastName.addEventListener('blur', suggestUsername);
        
        // Contact number formatting
        contact.addEventListener('input', function(e) {
            let val = e.target.value.replace(/\D/g, '');
            if (val.length > 11) val = val.slice(0, 11);
            e.target.value = val;
        });
    </script>
</body>
</html>