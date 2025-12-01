<?php
session_start();
$pageTitle = "Pricing";
include 'header.php';
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Simple, Transparent Pricing</h1>
            <p class="text-xl text-indigo-100 mb-10">Choose the plan that best fits your event management needs</p>
            
            <div class="inline-flex bg-white p-1 rounded-full mb-8">
                <button id="monthlyBtn" class="px-6 py-2 rounded-full bg-indigo-600 text-white font-medium focus:outline-none">Monthly</button>
                <button id="annualBtn" class="px-6 py-2 rounded-full text-gray-700 font-medium focus:outline-none">Annual (Save 20%)</button>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Free Plan -->
                <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Free</h3>
                        <div class="text-indigo-600 my-6">
                            <span class="text-4xl font-bold" data-monthly="$0" data-annual="$0">$0</span>
                            <span class="text-gray-500 font-medium">/month</span>
                        </div>
                        <p class="text-gray-600 mb-8">Perfect for individuals and small events</p>
                        <a href="signup.php" class="inline-block w-full px-6 py-3 bg-white border border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition duration-300">Get Started</a>
                    </div>
                    <div class="bg-gray-50 p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Up to 3 events</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Basic event pages</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Up to 50 attendees per event</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Email notifications</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Community support</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Pro Plan -->
                <div class="border-2 border-indigo-600 rounded-xl overflow-hidden shadow-lg relative">
                    <div class="absolute top-0 right-0 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                        MOST POPULAR
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Pro</h3>
                        <div class="text-indigo-600 my-6">
                            <span class="text-4xl font-bold" data-monthly="$29" data-annual="$23">$29</span>
                            <span class="text-gray-500 font-medium">/month</span>
                        </div>
                        <p class="text-gray-600 mb-8">Ideal for growing businesses and organizations</p>
                        <a href="signup.php?plan=pro" class="inline-block w-full px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">Get Started</a>
                    </div>
                    <div class="bg-gray-50 p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Unlimited events</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Custom event pages</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Up to 500 attendees per event</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Ticketing & registration</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Event promotion tools</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Basic analytics</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Email & chat support</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Enterprise Plan -->
                <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Enterprise</h3>
                        <div class="text-indigo-600 my-6">
                            <span class="text-4xl font-bold" data-monthly="$99" data-annual="$79">$99</span>
                            <span class="text-gray-500 font-medium">/month</span>
                        </div>
                        <p class="text-gray-600 mb-8">For large organizations with advanced needs</p>
                        <a href="signup.php?plan=enterprise" class="inline-block w-full px-6 py-3 bg-white border border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition duration-300">Get Started</a>
                    </div>
                    <div class="bg-gray-50 p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Everything in Pro</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Unlimited attendees</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Advanced branding options</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Multi-user access</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Advanced analytics & reporting</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">API access</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">Dedicated account manager</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-600">24/7 priority support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Comparison -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Feature Comparison</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">A detailed look at what each plan offers to help you make the right choice.</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-6 py-4 text-left text-gray-700">Feature</th>
                            <th class="px-6 py-4 text-center text-gray-700">Free</th>
                            <th class="px-6 py-4 text-center text-gray-700 bg-indigo-50">Pro</th>
                            <th class="px-6 py-4 text-center text-gray-700">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Number of Events</td>
                            <td class="px-6 py-4 text-center">Up to 3</td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Unlimited</td>
                            <td class="px-6 py-4 text-center">Unlimited</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Attendees Per Event</td>
                            <td class="px-6 py-4 text-center">Up to 50</td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Up to 500</td>
                            <td class="px-6 py-4 text-center">Unlimited</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Custom Branding</td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Basic</td>
                            <td class="px-6 py-4 text-center">Advanced</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Event Registration</td>
                            <td class="px-6 py-4 text-center">Basic</td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Advanced</td>
                            <td class="px-6 py-4 text-center">Advanced</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Email Notifications</td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                            <td class="px-6 py-4 text-center bg-indigo-50"><i class="fas fa-check text-green-500"></i></td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Payment Processing</td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                            <td class="px-6 py-4 text-center bg-indigo-50"><i class="fas fa-check text-green-500"></i></td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Analytics & Reporting</td>
                            <td class="px-6 py-4 text-center">Basic</td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Standard</td>
                            <td class="px-6 py-4 text-center">Advanced</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">API Access</td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                            <td class="px-6 py-4 text-center bg-indigo-50"><i class="fas fa-times text-red-500"></i></td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-6 py-4 text-gray-600 font-medium">Multi-User Access</td>
                            <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Up to 3 users</td>
                            <td class="px-6 py-4 text-center">Unlimited</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-gray-600 font-medium">Customer Support</td>
                            <td class="px-6 py-4 text-center">Community</td>
                            <td class="px-6 py-4 text-center bg-indigo-50">Email & Chat</td>
                            <td class="px-6 py-4 text-center">24/7 Priority</td>
                        </tr>
                    </tbody>
                </table>
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
                <p class="text-gray-600 max-w-2xl mx-auto">Have questions about our pricing? Find answers to common questions below.</p>
            </div>
            
            <div class="space-y-6" x-data="{activeTab: 0}">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 1 ? 0 : 1" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">Can I upgrade or downgrade my plan at any time?</span>
                        <i class="fas" :class="activeTab === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 1" class="px-6 pb-4">
                        <p class="text-gray-600">Yes, you can upgrade or downgrade your plan at any time. If you upgrade, the new features will be available immediately, and you'll be charged the prorated difference. If you downgrade, the changes will take effect at the end of your current billing cycle.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 2 ? 0 : 2" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">Do you offer discounts for non-profits or educational institutions?</span>
                        <i class="fas" :class="activeTab === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 2" class="px-6 pb-4">
                        <p class="text-gray-600">Yes, we offer special pricing for non-profit organizations, educational institutions, and community groups. Please contact our sales team at sales@eventhub.com to learn more about our discount programs.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 3 ? 0 : 3" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">Is there a free trial available for paid plans?</span>
                        <i class="fas" :class="activeTab === 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 3" class="px-6 pb-4">
                        <p class="text-gray-600">Yes, we offer a 14-day free trial for both our Pro and Enterprise plans. No credit card is required to start your trial, and you can downgrade to the Free plan before the trial ends if you choose not to continue with a paid plan.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 4 ? 0 : 4" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">What payment methods do you accept?</span>
                        <i class="fas" :class="activeTab === 4 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 4" class="px-6 pb-4">
                        <p class="text-gray-600">We accept all major credit cards (Visa, Mastercard, American Express, Discover) and PayPal. For Enterprise customers, we also offer invoicing and bank transfer options.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <button @click="activeTab = activeTab === 5 ? 0 : 5" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">Do you offer custom plans for specific needs?</span>
                        <i class="fas" :class="activeTab === 5 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="activeTab === 5" class="px-6 pb-4">
                        <p class="text-gray-600">Yes, we understand that some organizations have unique requirements. If you need a customized solution, please contact our sales team to discuss your specific needs and we'll create a tailored plan for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-indigo-100 mb-8">Join thousands of event creators who trust EventHub to power their events.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="signup.php" class="px-8 py-4 bg-white text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition duration-300">
                    Sign Up for Free
                </a>
                <a href="contact.php" class="px-8 py-4 bg-indigo-500 bg-opacity-30 text-white font-medium rounded-lg hover:bg-opacity-40 transition duration-300">
                    Contact Sales
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Script for pricing toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthlyBtn = document.getElementById('monthlyBtn');
    const annualBtn = document.getElementById('annualBtn');
    const priceElements = document.querySelectorAll('[data-monthly]');
    
    // Set initial state
    showMonthlyPrices();
    
    // Toggle between monthly and annual prices
    monthlyBtn.addEventListener('click', function() {
        showMonthlyPrices();
    });
    
    annualBtn.addEventListener('click', function() {
        showAnnualPrices();
    });
    
    function showMonthlyPrices() {
        monthlyBtn.classList.add('bg-indigo-600', 'text-white');
        monthlyBtn.classList.remove('text-gray-700');
        annualBtn.classList.remove('bg-indigo-600', 'text-white');
        annualBtn.classList.add('text-gray-700');
        
        priceElements.forEach(el => {
            el.textContent = el.getAttribute('data-monthly');
        });
        
        document.querySelectorAll('.text-gray-500.font-medium').forEach(el => {
            el.textContent = '/month';
        });
    }
    
    function showAnnualPrices() {
        annualBtn.classList.add('bg-indigo-600', 'text-white');
        annualBtn.classList.remove('text-gray-700');
        monthlyBtn.classList.remove('bg-indigo-600', 'text-white');
        monthlyBtn.classList.add('text-gray-700');
        
        priceElements.forEach(el => {
            el.textContent = el.getAttribute('data-annual');
        });
        
        document.querySelectorAll('.text-gray-500.font-medium').forEach(el => {
            el.textContent = '/month (billed annually)';
        });
    }
});
</script>

<?php include 'footer.php'; ?> 