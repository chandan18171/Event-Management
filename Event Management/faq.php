<?php
session_start();
$pageTitle = "Frequently Asked Questions";
include 'header.php';
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-700 to-indigo-800 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 animate__animated animate__fadeIn">Frequently Asked Questions</h1>
        <p class="text-xl max-w-3xl mx-auto animate__animated animate__fadeIn animate__delay-1s">
            Find answers to common questions about EventHub
        </p>
    </div>
</section>

<!-- FAQ Categories -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <a href="#general" class="bg-indigo-50 p-6 rounded-xl hover:shadow-md transition-shadow duration-300 text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-info-circle text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">General</h3>
                    <p class="text-gray-600 text-sm">Basic information about EventHub</p>
                </a>
                <a href="#account" class="bg-blue-50 p-6 rounded-xl hover:shadow-md transition-shadow duration-300 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Account</h3>
                    <p class="text-gray-600 text-sm">Managing your EventHub account</p>
                </a>
                <a href="#events" class="bg-green-50 p-6 rounded-xl hover:shadow-md transition-shadow duration-300 text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Events</h3>
                    <p class="text-gray-600 text-sm">Creating and managing events</p>
                </a>
                <a href="#payment" class="bg-yellow-50 p-6 rounded-xl hover:shadow-md transition-shadow duration-300 text-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-credit-card text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Payments</h3>
                    <p class="text-gray-600 text-sm">Billing and payment information</p>
                </a>
            </div>
            
            <!-- Search Box -->
            <div class="max-w-3xl mx-auto mb-16">
                <div class="relative">
                    <input type="text" id="faq-search" placeholder="Search for answers..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent shadow-sm">
                    <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <!-- General FAQs -->
            <div id="general" class="mb-16">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 relative inline-block">
                        General Questions
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-indigo-600 rounded"></div>
                    </h2>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">What is EventHub?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub is a comprehensive event management platform that helps organizers create, promote, and manage events of all sizes. Our platform offers tools for event registration, attendee tracking, ticketing, and more to make event management simple and efficient.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Who can use EventHub?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub is designed for everyone involved in events:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li>Event organizers (companies, non-profits, individuals)</li>
                                <li>Event attendees looking for interesting events</li>
                                <li>Venues and service providers in the event industry</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                Whether you're organizing a small workshop or a large conference, EventHub provides the tools you need to succeed.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Is EventHub available in my country?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub is available worldwide. Our platform supports multiple currencies and languages to accommodate global events. However, some features like payment processing may have limitations in certain countries due to regulatory requirements. Please contact our support team for specific inquiries about availability in your region.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Account FAQs -->
            <div id="account" class="mb-16">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 relative inline-block">
                        Account Questions
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-600 rounded"></div>
                    </h2>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">How do I create an account?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                Creating an account is simple:
                            </p>
                            <ol class="list-decimal ml-6 mt-2 text-gray-600">
                                <li>Click the "Sign Up" button in the top-right corner</li>
                                <li>Enter your email address and create a password</li>
                                <li>Select your account type (attendee or organizer)</li>
                                <li>Complete your profile information</li>
                                <li>Verify your email address</li>
                            </ol>
                            <p class="text-gray-600 mt-2">
                                Once you've completed these steps, you'll have full access to EventHub based on your account type.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">What's the difference between an attendee and organizer account?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                There are two main account types on EventHub:
                            </p>
                            <p class="text-gray-600 mt-2">
                                <strong>Attendee account:</strong> Allows you to discover events, register for events, save favorites, and manage your event calendar. This account is free to create and use.
                            </p>
                            <p class="text-gray-600 mt-2">
                                <strong>Organizer account:</strong> Provides all the tools needed to create, publish, and manage events. Organizer accounts have access to dashboard analytics, attendee management, and promotional tools. Organizer accounts require a subscription plan after the free trial period.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">How do I reset my password?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                If you've forgotten your password:
                            </p>
                            <ol class="list-decimal ml-6 mt-2 text-gray-600">
                                <li>Click "Sign In" in the top-right corner</li>
                                <li>Click the "Forgot Password?" link below the sign-in form</li>
                                <li>Enter the email address associated with your account</li>
                                <li>Check your email for a password reset link</li>
                                <li>Follow the link to create a new password</li>
                            </ol>
                            <p class="text-gray-600 mt-2">
                                If you don't receive the email, check your spam folder or contact our support team for assistance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Events FAQs -->
            <div id="events" class="mb-16">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 relative inline-block">
                        Event Questions
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-green-600 rounded"></div>
                    </h2>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">How do I create an event?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                To create an event as an organizer:
                            </p>
                            <ol class="list-decimal ml-6 mt-2 text-gray-600">
                                <li>Sign in to your organizer account</li>
                                <li>Go to your dashboard</li>
                                <li>Click the "Create Event" button</li>
                                <li>Fill out the event details form (title, description, date, location, etc.)</li>
                                <li>Set up ticketing and registration options</li>
                                <li>Upload event images and customize the event page</li>
                                <li>Click "Publish" to make your event live</li>
                            </ol>
                            <p class="text-gray-600 mt-2">
                                You can save your event as a draft at any point if you're not ready to publish it yet.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">What types of events can I create?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub supports a wide variety of event types:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li>Conferences and conventions</li>
                                <li>Workshops and seminars</li>
                                <li>Networking events</li>
                                <li>Social gatherings</li>
                                <li>Virtual events and webinars</li>
                                <li>Classes and courses</li>
                                <li>Festivals and concerts</li>
                                <li>Fundraisers</li>
                                <li>And much more!</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                Our platform is flexible enough to handle both free and paid events, in-person and virtual events, one-time and recurring events.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">How do I track event registrations?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub provides comprehensive registration tracking:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li>Real-time dashboard showing registration numbers and trends</li>
                                <li>Exportable attendee lists with registration details</li>
                                <li>Automated email notifications for new registrations</li>
                                <li>Check-in tools for the day of the event</li>
                                <li>Post-event attendance reports</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                Pro and Enterprise plans include advanced analytics that provide deeper insights into your attendee demographics and registration patterns.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Payment FAQs -->
            <div id="payment" class="mb-16">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 relative inline-block">
                        Payment Questions
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-yellow-600 rounded"></div>
                    </h2>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">How much does EventHub cost?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                EventHub offers several pricing plans to meet different needs:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li><strong>Basic Plan:</strong> $19/month, ideal for small events and beginners</li>
                                <li><strong>Pro Plan:</strong> $49/month, for growing organizations and businesses</li>
                                <li><strong>Enterprise Plan:</strong> $99/month, for large organizations with custom needs</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                All plans include a 14-day free trial. Annual billing is available with a 20% discount. For detailed plan features, please visit our <a href="pricing.php" class="text-indigo-600 hover:text-indigo-800">Pricing page</a>.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">What payment methods do you accept?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                For EventHub subscriptions, we accept:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li>All major credit cards (Visa, MasterCard, American Express, Discover)</li>
                                <li>PayPal</li>
                                <li>Bank transfers (for annual plans only)</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                For event ticket payments, we support even more payment options including Apple Pay, Google Pay, and various regional payment methods depending on your location.
                            </p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden faq-item">
                        <button class="w-full px-6 py-4 text-left focus:outline-none flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">What fees are charged for paid events?</h3>
                            <i class="fas fa-chevron-down text-gray-400 transform transition-transform duration-300"></i>
                        </button>
                        <div class="px-6 pb-4 hidden faq-answer">
                            <p class="text-gray-600">
                                For paid events, EventHub charges a service fee based on your subscription plan:
                            </p>
                            <ul class="list-disc ml-6 mt-2 text-gray-600">
                                <li><strong>Basic Plan:</strong> 3.5% + $0.30 per transaction</li>
                                <li><strong>Pro Plan:</strong> 2.5% + $0.30 per transaction</li>
                                <li><strong>Enterprise Plan:</strong> 1.5% + $0.30 per transaction</li>
                            </ul>
                            <p class="text-gray-600 mt-2">
                                You can choose to absorb these fees yourself or pass them on to attendees during checkout. Payment processing fees (from Stripe, PayPal, etc.) apply separately and vary by payment method and country.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Still Have Questions -->
            <div class="text-center max-w-3xl mx-auto bg-indigo-50 rounded-xl py-10 px-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Still Have Questions?</h2>
                <p class="text-gray-600 mb-6">
                    Can't find the answer you're looking for? Our team is here to help.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="contact.php" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-envelope mr-2"></i> Contact Support
                    </a>
                    <a href="support.php" class="px-6 py-3 bg-white text-indigo-600 font-medium rounded-lg border border-indigo-200 hover:bg-indigo-50 transition duration-300">
                        <i class="fas fa-book mr-2"></i> Visit Support Center
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const button = item.querySelector('button');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('button i');
        
        button.addEventListener('click', () => {
            answer.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            
            // Close other open items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('button i');
                    
                    otherAnswer.classList.add('hidden');
                    otherIcon.classList.remove('rotate-180');
                }
            });
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('faq-search');
    
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        
        faqItems.forEach(item => {
            const question = item.querySelector('h3').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

<?php include 'footer.php'; ?> 