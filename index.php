<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGU 3 - Local Product & Export Development | Official Login</title>
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
            max-width: 400px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        /* Header */
        .header {
            background: #003366;
            color: white;
            padding: 25px 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .logo {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: normal;
            letter-spacing: 1px;
        }

        .header h2 {
            font-size: 14px;
            font-weight: normal;
            margin-top: 5px;
            opacity: 0.9;
        }

        .republic {
            font-size: 11px;
            margin-top: 8px;
            border-top: 1px solid rgba(255,255,255,0.3);
            display: inline-block;
            padding-top: 6px;
        }

        /* Form Body */
        .form-body {
            padding: 30px 25px 25px;
        }

        /* Input Groups - Simple Government Style */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }

        .input-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
            background: white;
        }

        .input-group input:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 2px rgba(0,51,102,0.1);
        }

        /* Options Row */
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .checkbox input {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot {
            color: #003366;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        /* Login Button - Simple Government Blue */
        .login-btn {
            width: 100%;
            background: #003366;
            color: white;
            border: none;
            padding: 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 3px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: inherit;
            margin-bottom: 15px;
        }

        .login-btn:hover {
            background: #002244;
        }

        /* Register Link Section */
        .register-link {
            text-align: center;
            margin: 15px 0 10px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
        }

        .register-link p {
            font-size: 13px;
            color: #555;
        }

        .register-link a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
            margin-left: 5px;
        }

        .register-link a:hover {
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

        /* Demo Info - Simple Box */
        .demo-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 12px;
            margin-top: 15px;
            border-radius: 3px;
            font-size: 12px;
            text-align: center;
        }

        .demo-box strong {
            color: #003366;
        }

        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 12px;
            text-align: center;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #dee2e6;
        }

        /* Simple responsive */
        @media (max-width: 480px) {
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
            <div class="logo">🏛️</div>
            <h1>LGU 3</h1>
            <h2>Local Product & Export Development</h2>
            <div class="republic">✧ OFFICIAL LOGIN PORTAL ✧</div>
        </div>

        <div class="form-body">
            <div id="messageBox" class="message"></div>

            <form id="loginForm">
                <div class="input-group">
                    <label>USERNAME / EMAIL</label>
                    <input type="text" id="username" placeholder="Enter username or email" autocomplete="off">
                </div>

                <div class="input-group">
                    <label>PASSWORD</label>
                    <input type="password" id="password" placeholder="Enter password">
                </div>

                <div class="options">
                    <label class="checkbox">
                        <input type="checkbox" id="remember"> Remember me
                    </label>
                    <a href="#" id="forgotBtn" class="forgot">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">SIGN IN</button>

                <!-- Register Link - Don't have an account -->
                <div class="register-link">
                    <p>Don't have an account? <a href="register.html" id="registerLink">Register here</a></p>
                </div>

                <div class="demo-box">
                    📋 <strong>Demo Access:</strong> username: <strong>lgu3</strong> | password: <strong>export2024</strong>
                </div>
            </form>
        </div>

        <div class="footer">
            LGU 3 - Local Product & Export Development Office
        </div>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const messageBox = document.getElementById('messageBox');
        const rememberCheck = document.getElementById('remember');
        const forgotBtn = document.getElementById('forgotBtn');
        const registerLink = document.getElementById('registerLink');

        function showMessage(text, isError = true) {
            messageBox.textContent = text;
            messageBox.className = 'message';
            if (!isError) {
                messageBox.classList.add('success');
            }
            messageBox.style.display = 'block';
            
            setTimeout(() => {
                messageBox.style.display = 'none';
            }, 3000);
        }

        // Load saved credentials
        function loadSaved() {
            const savedUser = localStorage.getItem('lgu3_user');
            const savedPass = localStorage.getItem('lgu3_pass');
            const savedFlag = localStorage.getItem('lgu3_remember');
            
            if (savedFlag === 'true' && savedUser) {
                usernameInput.value = savedUser;
                passwordInput.value = savedPass || '';
                rememberCheck.checked = true;
            }
        }

        // Save credentials
        function saveCredentials(username, password) {
            if (rememberCheck.checked) {
                localStorage.setItem('lgu3_user', username);
                localStorage.setItem('lgu3_pass', password);
                localStorage.setItem('lgu3_remember', 'true');
            } else {
                localStorage.removeItem('lgu3_user');
                localStorage.removeItem('lgu3_pass');
                localStorage.setItem('lgu3_remember', 'false');
            }
        }

        // Check if user exists in registered users
        function checkRegisteredUser(username, password) {
            // Get registered users from localStorage
            const users = JSON.parse(localStorage.getItem('lgu3_users') || '[]');
            
            // Check if username/email and password match any registered user
            const foundUser = users.find(user => 
                (user.username === username || user.email === username) && 
                user.password === password
            );
            
            return foundUser !== undefined;
        }

        // Handle login
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = usernameInput.value.trim();
            const password = passwordInput.value.trim();
            
            // Simple validation
            if (username === '') {
                showMessage('Please enter username');
                usernameInput.focus();
                return;
            }
            
            if (password === '') {
                showMessage('Please enter password');
                passwordInput.focus();
                return;
            }
            
            // Check demo credentials OR registered users
            const isDemoUser = (username === 'lgu3' && password === 'export2024') || 
                              (username === 'admin' && password === 'admin123');
            const isRegisteredUser = checkRegisteredUser(username, password);
            
            if (isDemoUser || isRegisteredUser) {
                saveCredentials(username, password);
                showMessage('Login successful! Redirecting...', false);
                
                const btn = document.querySelector('.login-btn');
                btn.disabled = true;
                btn.textContent = 'PROCESSING...';
                
                setTimeout(() => {
                    alert('WELCOME TO LGU 3 SYSTEM\n\nLocal Product & Export Development Portal');
                    // Uncomment for actual redirect:
                    // window.location.href = 'dashboard.html';
                    btn.disabled = false;
                    btn.textContent = 'SIGN IN';
                }, 1500);
            } else {
                showMessage('Invalid username or password. Please check your credentials or register if you don\'t have an account.');
                passwordInput.value = '';
                passwordInput.focus();
            }
        });
        
        // Forgot password
        forgotBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showMessage('Please contact LGU 3 IT Support or your local administrator', false);
        });
        
        // Register link - optional message (can be removed if register.html exists)
        registerLink.addEventListener('click', function(e) {
            // Optional: Add a message or just let the link work
            // This is just for demonstration - the link will go to register.html
            console.log('Redirecting to registration page');
        });
        
        // Load saved credentials on page load
        loadSaved();
    </script>
</body>
</html>