@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-3 bg-blue-100 dark:bg-blue-900 rounded-full mb-4 transition-colors duration-300">
                <svg class="w-12 h-12 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">Welcome Back</h2>   
            <p class="text-gray-600 dark:text-gray-400 transition-colors duration-300">Sign in to your account</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 backdrop-blur-sm bg-opacity-95 transition-colors duration-300">
            <div class="px-8 py-10">
                <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors">
                            {{ __('E-Mail Address') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-blue-500 dark:group-focus-within:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500 @error('email') border-red-400 ring-2 ring-red-100 dark:ring-red-900 @enderror"
                                placeholder="john@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-2 flex items-center animate-shake">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="group">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors">
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-blue-500 dark:group-focus-within:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500 @error('password') border-red-400 ring-2 ring-red-100 dark:ring-red-900 @enderror"
                                placeholder="••••••••"
                                oninput="validatePassword()">
                            
                            <!-- Show/Hide Password Toggle -->
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center z-10 focus:outline-none">
                                <svg id="eye-open" class="h-5 w-5 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eye-closed" class="h-5 w-5 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>

                            <!-- Validation Icon -->
                            <div id="validation-icon" class="absolute inset-y-0 right-12 flex items-center pr-3 pointer-events-none hidden">
                                <svg id="check-icon" class="h-5 w-5 text-green-500 dark:text-green-400 hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <svg id="x-icon" class="h-5 w-5 text-red-500 dark:text-red-400 hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div id="password-strength" class="mt-2 hidden">
                            <div class="flex items-center justify-between text-xs mb-1">
                                <span id="strength-text" class="font-medium"></span>
                                <span id="strength-requirements" class="text-gray-500 dark:text-gray-400"></span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                                <div id="strength-bar" class="h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>

                        @error('password')
                            <p class="text-red-500 dark:text-red-400 text-sm mt-2 flex items-center animate-shake">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-400 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition-colors cursor-pointer">
                            <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-3">
                        <button type="submit" id="submit-btn"
                            class="w-full relative bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 text-white font-bold px-6 py-4 rounded-xl hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-200 shadow-lg hover:shadow-2xl group overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center" id="button-text">
                                {{ __('Login') }}
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-800 dark:from-blue-600 dark:to-blue-700 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-8 py-5 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors hover:underline">
                        Sign up →
                    </a>
                </p>
            </div>
        </div>

        <!-- Security badge -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center justify-center transition-colors duration-300">
                <svg class="w-4 h-4 mr-1 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Secure login with encryption
            </p>
        </div>
    </div>
</div>

<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>

<script>
// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}

// Validate password strength
function validatePassword() {
    const password = document.getElementById('password').value;
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    const strengthRequirements = document.getElementById('strength-requirements');
    const validationIcon = document.getElementById('validation-icon');
    const checkIcon = document.getElementById('check-icon');
    const xIcon = document.getElementById('x-icon');
    
    if (password.length === 0) {
        strengthIndicator.classList.add('hidden');
        validationIcon.classList.add('hidden');
        passwordInput.classList.remove('border-green-500', 'border-red-500', 'border-yellow-500', 'ring-green-100', 'ring-red-100', 'ring-yellow-100', 'dark:ring-green-900', 'dark:ring-red-900', 'dark:ring-yellow-900');
        passwordInput.classList.add('border-gray-200', 'dark:border-gray-600');
        return;
    }
    
    strengthIndicator.classList.remove('hidden');
    validationIcon.classList.remove('hidden');
    
    // Calculate password strength
    let strength = 0;
    const checks = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[^A-Za-z0-9]/.test(password)
    };
    
    Object.values(checks).forEach(check => {
        if (check) strength++;
    });
    
    let color, text, width, borderColor;
    
    if (strength <= 2) {
        color = 'bg-red-500 dark:bg-red-600';
        text = 'Weak';
        width = '33%';
        borderColor = 'red';
        strengthText.className = 'font-medium text-red-600 dark:text-red-400';
        checkIcon.classList.add('hidden');
        xIcon.classList.remove('hidden');
    } else if (strength <= 3) {
        color = 'bg-yellow-500 dark:bg-yellow-600';
        text = 'Medium';
        width = '66%';
        borderColor = 'yellow';
        strengthText.className = 'font-medium text-yellow-600 dark:text-yellow-400';
        checkIcon.classList.add('hidden');
        xIcon.classList.remove('hidden');
    } else {
        color = 'bg-green-500 dark:bg-green-600';
        text = 'Strong';
        width = '100%';
        borderColor = 'green';
        strengthText.className = 'font-medium text-green-600 dark:text-green-400';
        checkIcon.classList.remove('hidden');
        xIcon.classList.add('hidden');
    }
    
    strengthBar.className = `h-1.5 rounded-full transition-all duration-300 ${color}`;
    strengthBar.style.width = width;
    strengthText.textContent = text;
    
    passwordInput.classList.remove('border-gray-200', 'dark:border-gray-600', 'border-green-500', 'border-red-500', 'border-yellow-500', 'ring-green-100', 'ring-red-100', 'ring-yellow-100', 'dark:ring-green-900', 'dark:ring-red-900', 'dark:ring-yellow-900');
    
    if (borderColor === 'green') {
        passwordInput.classList.add('border-green-500', 'ring-2', 'ring-green-100', 'dark:ring-green-900');
    } else if (borderColor === 'red') {
        passwordInput.classList.add('border-red-500', 'ring-2', 'ring-red-100', 'dark:ring-red-900');
    } else {
        passwordInput.classList.add('border-yellow-500', 'ring-2', 'ring-yellow-100', 'dark:ring-yellow-900');
    }
    
    const requirementsMet = Object.values(checks).filter(check => check).length;
    strengthRequirements.textContent = `${requirementsMet}/5 requirements met`;
}

// Form submission with loading state
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const button = document.getElementById('submit-btn');
    const buttonText = document.getElementById('button-text');
    
    button.disabled = true;
    button.classList.add('opacity-75', 'cursor-not-allowed');
    buttonText.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Logging in...
    `;
});
</script>
@endsection
