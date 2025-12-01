<?php
session_start();
$pageTitle = "Sign In";
include_once 'header.php';
?>

    <!-- Sign In Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                            <p class="text-gray-600 mt-2">Sign in to continue to your account</p>
                        </div>
                        
                        <!-- Display Error/Success Messages -->
                        <?php if(isset($_SESSION['error'])): ?>
                        <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate__animated <?php echo isset($_SESSION['animation']) && $_SESSION['animation'] == 'error' ? 'animate__shakeX' : ''; ?>">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); unset($_SESSION['animation']); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(isset($_SESSION['success'])): ?>
                        <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 animate__animated <?php echo isset($_SESSION['animation']) && $_SESSION['animation'] == 'success' ? 'animate__bounceIn' : ''; ?>">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); unset($_SESSION['animation']); ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Signin Form -->
                        <form id="signinForm" action="login.php" method="POST">
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                                <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" class="form-checkbox h-5 w-5 text-indigo-600">
                                    <span class="ml-2 text-gray-700">Remember me</span>
                                </label>
                                <a href="forgot_password.php" class="text-indigo-600 hover:text-indigo-800">Forgot Password?</a>
                            </div>
                            
                            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-300 font-semibold">
                                Sign In
                            </button>
                        </form>
                        
                        <!-- Social Sign In -->
                        <div class="mt-8">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-white text-gray-500">Or continue with</span>
                                </div>
                            </div>
                            
                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <button type="button" class="py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center">
                                    <i class="fab fa-google text-red-500 mr-2"></i>
                                    Google
                                </button>
                                <button type="button" class="py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center">
                                    <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
                                    Facebook
                                </button>
                            </div>
                        </div>
                        
                        <!-- Sign Up Link -->
                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-600">
                                Don't have an account? 
                                <a href="signup.php" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up for free</a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Benefits Section -->
                <div class="mt-8 bg-gradient-to-r from-indigo-700 to-purple-700 text-white rounded-xl shadow-md p-8">
                    <h3 class="text-xl font-bold mb-4">Why Sign In?</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-ticket-alt mt-1 mr-3 text-yellow-300"></i>
                            <span>Access tickets for your upcoming events</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-heart mt-1 mr-3 text-yellow-300"></i>
                            <span>Save your favorite events to revisit later</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-bell mt-1 mr-3 text-yellow-300"></i>
                            <span>Receive personalized event recommendations</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-calendar-alt mt-1 mr-3 text-yellow-300"></i>
                            <span>Manage your event schedule seamlessly</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php include_once 'footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate success message if present
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.classList.add('animate__bounceIn');
            setTimeout(function() {
                successMessage.classList.remove('animate__bounceIn');
                successMessage.classList.add('animate__fadeOut');
            }, 5000);
        }
        
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'text') {
                    togglePassword.querySelector('i').classList.remove('fa-eye');
                    togglePassword.querySelector('i').classList.add('fa-eye-slash');
                } else {
                    togglePassword.querySelector('i').classList.remove('fa-eye-slash');
                    togglePassword.querySelector('i').classList.add('fa-eye');
                }
            });
        }
        
        // Form submission
        const form = document.getElementById('signinForm');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value;
                
                // Basic validation
                if (!email || !password) {
                    e.preventDefault();
                    
                    // Create and show animated error message
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate__animated animate__shakeX';
                    errorDiv.textContent = 'Please enter both email and password';
                    
                    // Remove any existing error messages
                    const existingErrors = document.querySelectorAll('.bg-red-100');
                    existingErrors.forEach(el => el.remove());
                    
                    // Insert at the top of the form
                    form.parentNode.insertBefore(errorDiv, form);
                    
                    return;
                }
                
                // Animate form on submission
                form.classList.add('animate__animated', 'animate__fadeOutUp');
                
                // Show loading state
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Signing In...';
                submitButton.disabled = true;
            });
        }
    });
</script> 