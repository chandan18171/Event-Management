<?php
session_start();
$pageTitle = "Contact Us";
include 'header.php';

// Initialize variables for form
$name = $email = $subject = $message = "";
$nameErr = $emailErr = $subjectErr = $messageErr = "";
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
    
    // Validate subject
    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = htmlspecialchars($_POST["subject"]);
    }
    
    // Validate message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = htmlspecialchars($_POST["message"]);
    }
    
    // If no errors, process form
    if (empty($nameErr) && empty($emailErr) && empty($subjectErr) && empty($messageErr)) {
        // In a real application, you would send an email here
        // For this demo, we'll just display a success message
        $formSubmitted = true;
        
        // Reset form fields
        $name = $email = $subject = $message = "";
    }
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Contact Us</h1>
            <p class="text-xl text-indigo-100 mb-10">Have questions or feedback? We'd love to hear from you!</p>
        </div>
    </div>
</section>

<!-- Contact Info & Form Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Success Message -->
            <?php if ($formSubmitted): ?>
            <div class="mb-12 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Thank you!</strong>
                <span class="block sm:inline"> Your message has been sent successfully. We'll get back to you as soon as possible.</span>
            </div>
            <?php endif; ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-8 rounded-xl shadow-sm h-full">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                        
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Our Office</h3>
                            <p class="text-gray-600 mb-1">123 Event Avenue</p>
                            <p class="text-gray-600 mb-1">Suite 456</p>
                            <p class="text-gray-600 mb-1">San Francisco, CA 94103</p>
                            <p class="text-gray-600">United States</p>
                        </div>
                        
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Contact Details</h3>
                            <p class="text-gray-600 mb-1">
                                <i class="fas fa-envelope text-indigo-600 mr-2"></i> 
                                <a href="mailto:info@eventhub.com" class="hover:text-indigo-600">info@eventhub.com</a>
                            </p>
                            <p class="text-gray-600 mb-1">
                                <i class="fas fa-phone text-indigo-600 mr-2"></i> 
                                <a href="tel:+14155552671" class="hover:text-indigo-600">+1 (415) 555-2671</a>
                            </p>
                            <p class="text-gray-600">
                                <i class="fas fa-headset text-indigo-600 mr-2"></i> 
                                <a href="#" class="hover:text-indigo-600">Live Chat (9am-5pm PST)</a>
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Connect With Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 hover:bg-indigo-600 hover:text-white transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
                        
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-gray-700 font-medium mb-2">Your Name *</label>
                                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $nameErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="John Doe">
                                    <?php if ($nameErr): ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo $nameErr; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="email" class="block text-gray-700 font-medium mb-2">Your Email *</label>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $emailErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
                                    <?php if ($emailErr): ?>
                                        <p class="text-red-500 text-sm mt-1"><?php echo $emailErr; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject *</label>
                                <input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" class="w-full px-4 py-3 rounded-lg border <?php echo $subjectErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="How can we help?">
                                <?php if ($subjectErr): ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo $subjectErr; ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message *</label>
                                <textarea name="message" id="message" rows="5" class="w-full px-4 py-3 rounded-lg border <?php echo $messageErr ? 'border-red-500' : 'border-gray-300'; ?> focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Your message here..."><?php echo $message; ?></textarea>
                                <?php if ($messageErr): ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo $messageErr; ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div>
                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300 inline-flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Find Us</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Visit our headquarters to learn more about EventHub and meet our team.</p>
            </div>
            
            <div class="rounded-xl overflow-hidden shadow-lg h-96">
                <!-- Replace with actual Google Maps embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.7457889223597!2d-122.41941708522377!3d37.7749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858085404c0001%3A0x7c118fe3d8a532!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1635452477283!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600">Quick answers to questions you may have. Need more help? Contact us directly.</p>
            </div>
            
            <div class="space-y-6" x-data="{activeTab: 0}">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 1 ? 0 : 1" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">What is the best way to contact customer support?</span>
                        <i class="fas" :class="activeTab === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 1" class="px-6 pb-4">
                        <p class="text-gray-600">The fastest way to get support is through our live chat available Monday through Friday, 9am-5pm PST. You can also email support@eventhub.com or call our toll-free number for urgent issues.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 2 ? 0 : 2" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">How quickly will I receive a response?</span>
                        <i class="fas" :class="activeTab === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 2" class="px-6 pb-4">
                        <p class="text-gray-600">We typically respond to all inquiries within 24 hours during business days. For urgent matters, please use our live chat or phone support for the fastest response.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 3 ? 0 : 3" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">Can I schedule a demo of EventHub?</span>
                        <i class="fas" :class="activeTab === 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 3" class="px-6 pb-4">
                        <p class="text-gray-600">Yes! We offer personalized demos for organizations interested in using EventHub. Please fill out the contact form or email sales@eventhub.com with your requirements, and a representative will schedule a demo at your convenience.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 text-center">
                <a href="faq.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                    View all FAQs <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 