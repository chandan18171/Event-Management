<?php
session_start();
$pageTitle = "Request a Demo";
include 'header.php';

// Initialize variables for form
$name = $email = $company = $phone = $role = $employees = $eventType = $message = "";
$nameErr = $emailErr = $companyErr = "";
$formSubmitted = false;

// Form processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }
    
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    
    // Validate company
    if (empty($_POST["company"])) {
        $companyErr = "Company name is required";
    } else {
        $company = htmlspecialchars($_POST["company"]);
    }
    
    // Other fields (optional)
    $phone = !empty($_POST["phone"]) ? htmlspecialchars($_POST["phone"]) : "";
    $role = !empty($_POST["role"]) ? htmlspecialchars($_POST["role"]) : "";
    $employees = !empty($_POST["employees"]) ? htmlspecialchars($_POST["employees"]) : "";
    $eventType = !empty($_POST["event_type"]) ? htmlspecialchars($_POST["event_type"]) : "";
    $message = !empty($_POST["message"]) ? htmlspecialchars($_POST["message"]) : "";
    
    // If no errors, process form
    if (empty($nameErr) && empty($emailErr) && empty($companyErr)) {
        // In a real application, you would send this to your CRM or email system
        // For this demo, we'll just display a success message
        $formSubmitted = true;
        
        // Reset form fields
        $name = $email = $company = $phone = $role = $employees = $eventType = $message = "";
    }
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">See EventHub in Action</h1>
            <p class="text-xl text-indigo-100 mb-10">Schedule a personalized demo with our product specialists and discover how EventHub can transform your event management</p>
        </div>
    </div>
</section>

<!-- Demo Form Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Success Message -->
            <?php if ($formSubmitted): ?>
            <div class="mb-12 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Thank you!</strong>
                <span class="block sm:inline"> Your demo request has been submitted successfully. One of our product specialists will contact you within 1 business day to schedule your personalized demo.</span>
            </div>
            <?php endif; ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Demo Information -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8">
                        <div class="bg-gray-50 p-8 rounded-xl shadow-sm mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">What to Expect</h2>
                            
                            <ul class="space-y-6">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-700">30-Minute Session</h3>
                                        <p class="text-gray-600 text-sm">A focused walkthrough of EventHub tailored to your needs</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-700">Expert Guidance</h3>
                                        <p class="text-gray-600 text-sm">Meet with a product specialist who understands your industry</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-700">Customized Presentation</h3>
                                        <p class="text-gray-600 text-sm">See features relevant to your specific event needs</p>
                                    </div>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                        <i class="fas fa-question-circle"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-700">Q&A Opportunity</h3>
                                        <p class="text-gray-600 text-sm">Get all your questions answered by our experts</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-indigo-50 p-8 rounded-xl border border-indigo-100">
                            <h3 class="text-xl font-bold text-indigo-800 mb-4">Our Customers Love Us</h3>
                            <div class="flex mb-3">
                                <i class="fas fa-star text-yellow-500"></i>
                                <i class="fas fa-star text-yellow-500"></i>
                                <i class="fas fa-star text-yellow-500"></i>
                                <i class="fas fa-star text-yellow-500"></i>
                                <i class="fas fa-star text-yellow-500"></i>
                            </div>
                            <blockquote class="text-indigo-700 italic mb-4">
                                "The demo was incredibly helpful. The specialist understood our needs and showed us exactly how EventHub could solve our challenges. We signed up the same day!"
                            </blockquote>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Customer" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <p class="font-medium text-indigo-900">Sarah Johnson</p>
                                    <p class="text-sm text-indigo-700">Event Director, TechConf</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Request Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Schedule Your Demo</h2>
                        <p class="text-gray-600 mb-8">Fill out the form below, and we'll contact you within 1 business day to set up your personalized demo.</p>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $nameErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="John Doe">
                                    <?php if ($nameErr): ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo $nameErr; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">Work Email *</label>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $emailErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                                    <?php if ($emailErr): ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo $emailErr; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="company" class="block text-gray-700 font-medium mb-2">Company Name *</label>
                                    <input type="text" name="company" id="company" value="<?php echo $company; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $companyErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Acme Inc.">
                                    <?php if ($companyErr): ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo $companyErr; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="+1 (555) 123-4567">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="role" class="block text-gray-700 font-medium mb-2">Your Role</label>
                                    <select name="role" id="role" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="" <?php echo $role == '' ? 'selected' : ''; ?>>Select your role</option>
                                        <option value="Event Manager" <?php echo $role == 'Event Manager' ? 'selected' : ''; ?>>Event Manager</option>
                                        <option value="Marketing" <?php echo $role == 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="Executive" <?php echo $role == 'Executive' ? 'selected' : ''; ?>>Executive</option>
                                        <option value="IT" <?php echo $role == 'IT' ? 'selected' : ''; ?>>IT</option>
                                        <option value="Other" <?php echo $role == 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="employees" class="block text-gray-700 font-medium mb-2">Company Size</label>
                                    <select name="employees" id="employees" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="" <?php echo $employees == '' ? 'selected' : ''; ?>>Select company size</option>
                                        <option value="1-10" <?php echo $employees == '1-10' ? 'selected' : ''; ?>>1-10 employees</option>
                                        <option value="11-50" <?php echo $employees == '11-50' ? 'selected' : ''; ?>>11-50 employees</option>
                                        <option value="51-200" <?php echo $employees == '51-200' ? 'selected' : ''; ?>>51-200 employees</option>
                                        <option value="201-500" <?php echo $employees == '201-500' ? 'selected' : ''; ?>>201-500 employees</option>
                                        <option value="501+" <?php echo $employees == '501+' ? 'selected' : ''; ?>>501+ employees</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="event_type" class="block text-gray-700 font-medium mb-2">Primary Event Type</label>
                                <select name="event_type" id="event_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" <?php echo $eventType == '' ? 'selected' : ''; ?>>Select event type</option>
                                    <option value="Conferences" <?php echo $eventType == 'Conferences' ? 'selected' : ''; ?>>Conferences</option>
                                    <option value="Workshops" <?php echo $eventType == 'Workshops' ? 'selected' : ''; ?>>Workshops</option>
                                    <option value="Webinars" <?php echo $eventType == 'Webinars' ? 'selected' : ''; ?>>Webinars</option>
                                    <option value="Corporate Events" <?php echo $eventType == 'Corporate Events' ? 'selected' : ''; ?>>Corporate Events</option>
                                    <option value="Networking" <?php echo $eventType == 'Networking' ? 'selected' : ''; ?>>Networking</option>
                                    <option value="Trade Shows" <?php echo $eventType == 'Trade Shows' ? 'selected' : ''; ?>>Trade Shows</option>
                                    <option value="Other" <?php echo $eventType == 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            
                            <div class="mb-8">
                                <label for="message" class="block text-gray-700 font-medium mb-2">What are you hoping to learn from the demo?</label>
                                <textarea name="message" id="message" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Tell us about your specific requirements or questions..."><?php echo $message; ?></textarea>
                            </div>
                            
                            <div class="mb-8">
                                <div class="flex items-start">
                                    <input id="consent" name="consent" type="checkbox" required class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mt-1">
                                    <label for="consent" class="ml-3 text-sm text-gray-600">
                                        I agree to receive communications from EventHub. You can unsubscribe at any time. View our <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>.
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300 inline-flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i> Request Your Demo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Highlights -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Why Choose EventHub?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover how our platform streamlines every aspect of event management</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-check text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Simplified Planning</h3>
                    <p class="text-gray-600">Create, customize, and manage events with our intuitive tools. From registration to follow-ups, we handle it all.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-ticket-alt text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Seamless Registration</h3>
                    <p class="text-gray-600">Deliver a frictionless registration experience that makes it easy for attendees to sign up and pay for your events.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Data-Driven Insights</h3>
                    <p class="text-gray-600">Access real-time analytics and reporting to make informed decisions and measure the success of your events.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-alt text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mobile Optimized</h3>
                    <p class="text-gray-600">Reach attendees anywhere with fully responsive event pages and mobile check-in capabilities.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-plug text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Powerful Integrations</h3>
                    <p class="text-gray-600">Connect with your favorite tools and services through our extensive integration ecosystem.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Enterprise Security</h3>
                    <p class="text-gray-600">Rest easy knowing your data and your attendees' information is protected by industry-leading security measures.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Trusted by Event Professionals</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Join thousands of organizers who use EventHub to create remarkable event experiences</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                    <blockquote class="text-gray-700 italic mb-6">
                        "EventHub transformed how we manage our annual conference. The platform is intuitive, powerful, and our attendees love the experience."
                    </blockquote>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900">Michael Roberts</p>
                            <p class="text-sm text-gray-600">Conference Director, Global Tech Summit</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                    <blockquote class="text-gray-700 italic mb-6">
                        "The analytics and reporting capabilities have given us insights we never had before. We've been able to grow our events by 40% year over year."
                    </blockquote>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900">Jennifer Patel</p>
                            <p class="text-sm text-gray-600">CEO, Horizon Events</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                    <blockquote class="text-gray-700 italic mb-6">
                        "Customer support is exceptional. Whenever we have questions or need assistance, the EventHub team is there for us every step of the way."
                    </blockquote>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/56.jpg" alt="Customer" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900">David Chen</p>
                            <p class="text-sm text-gray-600">Marketing Director, Innovate Group</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-16 bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Elevate Your Events?</h2>
            <p class="text-xl text-indigo-100 mb-8">Join thousands of successful event organizers who trust EventHub</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="#" onclick="document.querySelector('form').scrollIntoView({behavior: 'smooth'}); return false;" class="px-8 py-4 bg-white text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition duration-300">
                    Schedule Your Demo
                </a>
                <a href="pricing.php" class="px-8 py-4 bg-indigo-500 bg-opacity-30 text-white font-medium rounded-lg hover:bg-opacity-40 transition duration-300">
                    View Pricing
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 