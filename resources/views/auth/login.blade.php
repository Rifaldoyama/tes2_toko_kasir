<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Toko - Login & Register</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #10b981;
            --secondary-hover: #0d9463;
            --danger: #dc2626;
            --danger-hover: #b91c1c;
            --success: #16a34a;
            --success-hover: #15803d;
            --warning: #d97706;
            --warning-hover: #b45309;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-700: #374151;
            --gray-900: #111827;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            color: var(--gray-900);
        }
        
        .cashier-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
        }
        
        .receipt-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 1200px;
            overflow: hidden;
            position: relative;
            border-left: 4px solid var(--secondary);
        }
        
        .receipt-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
            z-index: 0;
        }
        
        .form-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .form-wrapper {
            display: flex;
            width: 200%;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .login-form, .register-form {
            width: 50%;
            padding: 2rem;
            box-sizing: border-box;
        }
        
        .slide-to-register {
            transform: translateX(-50%);
        }
        
        .hero-section {
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 0 1rem;
        }
        
        .hero-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .hero-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .hero-title span:first-child {
            color: var(--primary);
        }
        
        .hero-title span:last-child {
            color: var(--secondary);
        }
        
        .hero-subtitle {
            font-size: 0.875rem;
            color: var(--gray-700);
        }
        
        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--gray-900);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .form-full-width {
            grid-column: span 2;
        }
        
        .input-group {
            margin-bottom: 0.75rem;
        }
        
        .input-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.375rem;
            color: var(--gray-700);
        }
        
        .input-field {
            width: 100%;
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            transition: all 0.2s;
            background-color: white;
        }
        
        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        
        .input-field.error {
            border-color: var(--danger);
        }
        
        .input-field.error:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
        }
        
        .input-hint {
            font-size: 0.75rem;
            color: var(--gray-700);
            margin-top: 0.25rem;
        }
        
        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: var(--gray-600);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: var(--secondary-hover);
        }
        
        .btn-full {
            width: 100%;
        }
        
        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }
        
        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0.75rem 0;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
        }
        
        .remember-me label {
            font-size: 0.8125rem;
            color: var(--gray-700);
        }
        
        .forgot-password {
            font-size: 0.8125rem;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.8125rem;
            color: var(--gray-700);
        }
        
        .form-link {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }
        
        .form-link:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
        }
        
        .alert-danger {
            background-color: rgba(220, 38, 38, 0.1);
            border-left: 4px solid var(--danger);
            color: var(--danger);
        }
        
        .alert-success {
            background-color: rgba(16, 163, 74, 0.1);
            border-left: 4px solid var(--success);
            color: var(--success);
        }
        
        .alert-icon {
            margin-right: 0.5rem;
            flex-shrink: 0;
        }
        
        .alert-content {
            flex: 1;
        }
        
        .alert-list {
            margin: 0.25rem 0 0 0;
            padding-left: 1.25rem;
        }
        
        .copyright {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.75rem;
            color: var(--gray-700);
            padding: 0 1rem 1rem;
        }
        
        /* Animations */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }
        
        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .receipt-card {
                max-width: 900px;
            }
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-full-width {
                grid-column: span 1;
            }
            
            .login-form, .register-form {
                padding: 1.5rem;
            }
            
            .hero-icon {
                width: 70px;
                height: 70px;
            }
            
            .hero-title {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .cashier-container {
                padding: 0.5rem;
            }
            
            .login-form, .register-form {
                padding: 1rem;
            }
            
            .form-title {
                font-size: 1.25rem;
                margin-bottom: 1rem;
            }
            
            .hero-icon {
                width: 60px;
                height: 60px;
            }
            
            .hero-title {
                font-size: 1.25rem;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="cashier-container">
    <div class="receipt-card animate__animated animate__fadeIn">
        <div class="hero-section">
            <div class="hero-icon floating">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M8 12h.01M12 12h.01M16 12h.01M6 16h.01M10 16h.01M14 16h.01M18 16h.01"></path>
                </svg>
            </div>
            
            <h1 class="hero-title">
                <span>Kasir</span>
                <span>Toko</span>
            </h1>
            <p class="hero-subtitle">Sistem Kasir Modern untuk Usaha Anda</p>
        </div>
        
        <div class="form-container">
            <div class="form-wrapper" id="formWrapper">
                <!-- Login Form -->
                <div class="login-form animate__animated animate__fadeIn">
                    <h2 class="form-title">Masuk ke Sistem Kasir</h2>

                    @if($errors->any() && (session('form_type') === 'login' || !session('form_type')))
                    <div class="alert alert-danger">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <div class="alert-content">
                            <ul class="alert-list">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(session('success') && session('form_type') === 'login')
                    <div class="alert alert-success">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="alert-content">
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-grid">
                            <div class="form-full-width">
                                <div class="input-group">
                                    <label for="email" class="input-label">Email</label>
                                    <input type="email" name="email" id="email" placeholder="email@kasirtoko.com"
                                        value="{{ old('email') }}"
                                        class="input-field {{ $errors->has('email') && (session('form_type') === 'login' || !session('form_type')) ? 'error' : '' }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-full-width">
                                <div class="input-group">
                                    <label for="password" class="input-label">Password</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" placeholder="••••••••"
                                            class="input-field {{ $errors->has('password') && (session('form_type') === 'login' || !session('form_type')) ? 'error' : '' }}" required>
                                        <span class="password-toggle" onclick="togglePassword('password')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-full-width">
                                <div class="remember-forgot">
                                    <div class="remember-me">
                                        <input id="remember" name="remember" type="checkbox">
                                        <label for="remember">Ingat saya</label>
                                    </div>

                                    @if(Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password form-link">
                                        Lupa password?
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-full-width">
                                <button type="submit" class="btn btn-primary btn-full pulse">
                                    Masuk
                                </button>
                            </div>

                            <div class="form-full-width form-footer">
                                Belum punya akun?
                                <a href="#" onclick="slideToRegister()" class="form-link">Daftar Sekarang</a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Register Form -->
                <div class="register-form animate__animated animate__fadeIn">
                    <h2 class="form-title">Daftar Akun Kasir Baru</h2>

                    @if(session('success') && session('form_type') === 'register')
                    <div class="alert alert-success">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="alert-content">
                            {{ session('success') }}
                            @if(session('registered_email'))
                                <div class="mt-1 font-medium">Email: {{ session('registered_email') }}</div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($errors->any() && session('form_type') === 'register')
                    <div class="alert alert-danger">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <div class="alert-content">
                            <ul class="alert-list">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="form_type" value="register">
                        
                        <div class="form-grid">
                            <div>
                                <div class="input-group">
                                    <label for="name" class="input-label">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" placeholder="Nama Anda" value="{{ old('nama') }}" 
                                        class="input-field {{ $errors->has('nama') && session('form_type') === 'register' ? 'error' : '' }}" required>
                                </div>
                            </div>
                            
                            <div>
                                <div class="input-group">
                                    <label for="nama_toko" class="input-label">Nama Toko</label>
                                    <input type="text" name="nama_toko" id="nama_toko" placeholder="Nama Toko Anda" value="{{ old('nama_toko') }}" 
                                        class="input-field {{ $errors->has('nama_toko') && session('form_type') === 'register' ? 'error' : '' }}">
                                    <p class="input-hint">Biarkan kosong jika tidak memiliki toko</p>
                                </div>
                            </div>
                            
                            <div class="form-full-width">
                                <div class="input-group">
                                    <label for="reg_email" class="input-label">Email</label>
                                    <input type="email" name="email" id="reg_email" placeholder="email@kasirtoko.com" value="{{ old('email') }}" 
                                        class="input-field {{ $errors->has('email') && session('form_type') === 'register' ? 'error' : '' }}" required>
                                </div>
                            </div>
                            
                            <div>
                                <div class="input-group">
                                    <label for="reg_password" class="input-label">Password</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="reg_password" placeholder="Minimal 6 karakter" 
                                            class="input-field {{ $errors->has('password') && session('form_type') === 'register' ? 'error' : '' }}" required>
                                        <span class="password-toggle" onclick="togglePassword('reg_password')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="input-group">
                                    <label for="password_confirmation" class="input-label">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ketik ulang password" 
                                            class="input-field {{ $errors->has('password_confirmation') && session('form_type') === 'register' ? 'error' : '' }}" required>
                                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-full-width">
                                <button type="submit" class="btn btn-secondary btn-full pulse">
                                    Daftar Sekarang
                                </button>
                            </div>
                            
                            <div class="form-full-width form-footer">
                                Sudah punya akun? 
                                <a href="#" onclick="slideToLogin()" class="form-link">Masuk disini</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="copyright animate__animated animate__fadeInUp">
            &copy; {{ date('Y') }} KasirToko - Sistem Kasir Modern
        </div>
    </div>

    <script>
        // Check if we should show register form first
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('form_type') === 'register' || $errors->any() && session('form_type') === 'register')
                slideToRegister();
            @endif
            
            // Auto focus on first error field
            const errorField = document.querySelector('.input-field.error');
            if (errorField) {
                errorField.focus();
            }
        });

        function slideToRegister() {
            document.getElementById('formWrapper').classList.add('slide-to-register');
        }

        function slideToLogin() {
            document.getElementById('formWrapper').classList.remove('slide-to-register');
        }

        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            // Toggle eye icon
            const eyeIcon = passwordField.nextElementSibling.querySelector('svg');
            if (type === 'text') {
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }
    </script>
</body>
</html>