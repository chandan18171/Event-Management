<?php
session_start();
$pageTitle = "Sign Up";
include_once 'header.php';
?>

    <!-- Signup Form Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-700 to-indigo-800 py-6 px-6 text-white">
                    <h2 class="text-2xl font-bold text-center">Create Your Account</h2>
                    <p class="text-center text-indigo-100 mt-2">Join EventHub and start hosting amazing events</p>
                </div>
                <div class="p-8">
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
                    
                    <!-- Social Sign Up Options -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <button class="flex items-center justify-center py-3 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f mr-2"></i>
                            <span>Facebook</span>
                        </button>
                        <button class="flex items-center justify-center py-3 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition border border-gray-300">
                            <i class="fab fa-google mr-2 text-red-500"></i>
                            <span>Google</span>
                        </button>
                    </div>
                    
                    <div class="flex items-center my-6">
                        <div class="flex-grow h-px bg-gray-300"></div>
                        <span class="px-4 text-sm text-gray-500">or sign up with email</span>
                        <div class="flex-grow h-px bg-gray-300"></div>
                    </div>
                    
                    <!-- Signup Form -->
                    <form id="signupForm" action="register.php" method="POST">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Create a strong password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="mt-2 text-sm text-gray-600">Password must be at least 8 characters long and include a number and a special character.</div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">I want to sign up as:</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="user_type" value="user" class="form-radio h-5 w-5 text-indigo-600" checked>
                                    <span class="ml-2 text-gray-700">User</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="user_type" value="organizer" class="form-radio h-5 w-5 text-indigo-600">
                                    <span class="ml-2 text-gray-700">Organizer</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="terms" class="form-checkbox h-5 w-5 text-indigo-600">
                                <span class="ml-2 text-gray-700">I agree to the <a href="terms.php" class="text-indigo-600 hover:text-indigo-800">Terms of Service</a> and <a href="privacy.php" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>.</span>
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-300 font-semibold">
                            Create Account
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Already have an account? <a href="signin.php" class="text-indigo-600 hover:text-indigo-800 font-medium">Sign In</a></p>
                    </div>
                </div>
            </div>
            
            <!-- Benefits Section -->
            <div class="max-w-3xl mx-auto mt-16">
                <h3 class="text-2xl font-bold text-gray-800 text-center mb-6">Why Join EventHub?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-calendar-alt text-indigo-600 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Create Events</h4>
                        <p class="text-gray-600 text-center">Easily create and manage events of any size or type.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-ticket-alt text-purple-600 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Sell Tickets</h4>
                        <p class="text-gray-600 text-center">Set up ticket sales and manage registrations in one place.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-chart-line text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Track Performance</h4>
                        <p class="text-gray-600 text-center">Get insights and analytics about your event's performance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include_once 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check for success message and add redirect animation
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        setTimeout(function() {
            successMessage.classList.add('animate__fadeOut');
            setTimeout(function() {
                window.location.href = 'signin.php';
            }, 1000);
        }, 3000);
    }
    
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    }
    
    // Form validation
    const signupForm = document.getElementById('signupForm');
    
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            // Get form values
            const fullName = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const termsCheckbox = document.querySelector('input[name="terms"]');
            
            // Validate
            let valid = true;
            let errorMessage = '';
            
            if (!fullName) {
                valid = false;
                errorMessage += 'Please enter your full name.\n';
            }
            
            if (!email) {
                valid = false;
                errorMessage += 'Please enter your email address.\n';
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                valid = false;
                errorMessage += 'Please enter a valid email address.\n';
            }
            
            if (!password) {
                valid = false;
                errorMessage += 'Please create a password.\n';
            } else if (password.length < 8) {
                valid = false;
                errorMessage += 'Password must be at least 8 characters long.\n';
            } else if (!/[0-9]/.test(password) || !/[!@#$%^&*]/.test(password)) {
                valid = false;
                errorMessage += 'Password must include at least one number and one special character.\n';
            }
            
            if (termsCheckbox && !termsCheckbox.checked) {
                valid = false;
                errorMessage += 'Please agree to the Terms of Service and Privacy Policy.\n';
            }
            
            if (!valid) {
                e.preventDefault();
                
                // Create and show animated error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate__animated animate__shakeX';
                errorDiv.textContent = errorMessage;
                
                // Remove any existing error messages
                const existingErrors = document.querySelectorAll('.bg-red-100');
                existingErrors.forEach(el => el.remove());
                
                // Insert at the top of the form
                signupForm.parentNode.insertBefore(errorDiv, signupForm);
                
                // Scroll to the top of the form
                window.scrollTo({
                    top: errorDiv.offsetTop - 100,
                    behavior: 'smooth'
                });
                
                return;
            }
            
            // Animate form on submission
            signupForm.classList.add('animate__animated', 'animate__fadeOutUp');
            
            // Change button appearance
            const submitButton = signupForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Creating Account...';
        });
    }
});
</script> 