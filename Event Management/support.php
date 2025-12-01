<?php
session_start();
$pageTitle = "Support Center";
include 'header.php';

// Sample support categories
$categories = [
    [
        'id' => 'getting-started',
        'name' => 'Getting Started',
        'icon' => 'fas fa-rocket',
        'color' => 'bg-indigo-100 text-indigo-600',
        'description' => 'Learn the basics of setting up your EventHub account and creating your first event.',
        'articles' => [
            ['id' => 1, 'title' => 'How to Create Your First Event'],
            ['id' => 11, 'title' => 'Setting Up Your Organizer Profile'],
            ['id' => 12, 'title' => 'Navigating the EventHub Dashboard']
        ]
    ],
    [
        'id' => 'account',
        'name' => 'Account & Billing',
        'icon' => 'fas fa-user-circle',
        'color' => 'bg-blue-100 text-blue-600',
        'description' => 'Manage your account settings, subscription plans, and payment details.',
        'articles' => [
            ['id' => 2, 'title' => 'Setting Up Payment Processing'],
            ['id' => 21, 'title' => 'Understanding Subscription Plans'],
            ['id' => 22, 'title' => 'Managing User Permissions and Team Access']
        ]
    ],
    [
        'id' => 'events',
        'name' => 'Creating Events',
        'icon' => 'fas fa-calendar-plus',
        'color' => 'bg-green-100 text-green-600',
        'description' => 'Everything you need to know about creating and managing successful events.',
        'articles' => [
            ['id' => 4, 'title' => 'Customizing Event Pages'],
            ['id' => 31, 'title' => 'Creating Multi-Day Events'],
            ['id' => 32, 'title' => 'Managing Event Capacity and Waitlists']
        ]
    ],
    [
        'id' => 'tickets',
        'name' => 'Ticketing & Registration',
        'icon' => 'fas fa-ticket-alt',
        'color' => 'bg-yellow-100 text-yellow-600',
        'description' => 'Learn how to set up tickets, manage registrations, and track attendance.',
        'articles' => [
            ['id' => 3, 'title' => 'Managing Attendee Registrations'],
            ['id' => 8, 'title' => 'Creating Discount Codes for Your Event'],
            ['id' => 41, 'title' => 'Setting Up Different Ticket Types']
        ]
    ]
];

// Sample popular articles
$popular_articles = [
    [
        'id' => 1,
        'title' => 'How to Create Your First Event',
        'category' => 'Getting Started',
        'views' => 2578
    ],
    [
        'id' => 2,
        'title' => 'Setting Up Payment Processing',
        'category' => 'Account & Billing',
        'views' => 2145
    ],
    [
        'id' => 3,
        'title' => 'Managing Attendee Registrations',
        'category' => 'Ticketing & Registration',
        'views' => 1982
    ],
    [
        'id' => 4,
        'title' => 'Customizing Event Pages',
        'category' => 'Creating Events',
        'views' => 1845
    ],
    [
        'id' => 8,
        'title' => 'Creating Discount Codes for Your Event',
        'category' => 'Ticketing & Registration',
        'views' => 1765
    ]
];

// Sample recent articles
$recent_articles = [
    [
        'id' => 6,
        'title' => 'Using QR Codes for Event Check-ins',
        'category' => 'Technical Support',
        'date' => '2023-10-12'
    ],
    [
        'id' => 7,
        'title' => 'Setting Up Custom Email Notifications',
        'category' => 'Technical Support',
        'date' => '2023-10-08'
    ],
    [
        'id' => 9,
        'title' => 'How to Export Attendee Data',
        'category' => 'Creating Events',
        'date' => '2023-10-01'
    ],
    [
        'id' => 10,
        'title' => 'Setting Up Multi-Day Events',
        'category' => 'Creating Events',
        'date' => '2023-09-28'
    ]
];
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">How Can We Help?</h1>
            <p class="text-xl text-indigo-100 mb-10">Find answers to your questions about EventHub</p>
            
            <!-- Search Box -->
            <div class="relative mx-auto max-w-3xl">
                <input type="text" placeholder="Search for articles, topics, and more..." class="w-full px-6 py-4 rounded-lg text-lg focus:outline-none focus:ring-4 focus:ring-indigo-300">
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-search mr-1"></i> Search
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Popular Articles Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Popular Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($popular_articles as $article): ?>
                    <a href="support-article.php?id=<?php echo $article['id']; ?>" class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition duration-300">
                        <h3 class="text-lg font-bold text-indigo-600 mb-2"><?php echo $article['title']; ?></h3>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="far fa-eye mr-1"></i> 
                            <span><?php echo number_format($article['views']); ?> views</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-10 text-center">Browse by Category</h2>
            
            <?php foreach($categories as $index => $category): ?>
                <div class="mb-12 <?php echo $index % 2 == 1 ? 'md:flex-row-reverse' : ''; ?> md:flex items-stretch bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="md:w-1/3 p-8 flex flex-col justify-center <?php echo explode(' ', $category['color'])[0]; ?> bg-opacity-20">
                        <div class="w-16 h-16 rounded-full <?php echo $category['color']; ?> flex items-center justify-center mb-4">
                            <i class="<?php echo $category['icon']; ?> text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3"><?php echo $category['name']; ?></h3>
                        <p class="text-gray-600 mb-6"><?php echo $category['description']; ?></p>
                        <a href="support-category.php?id=<?php echo $category['id']; ?>" class="inline-block px-6 py-3 bg-white border border-gray-300 rounded-lg text-indigo-600 hover:bg-gray-50 transition duration-300 mt-auto">
                            View All Articles <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <div class="md:w-2/3 p-8">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">Popular Articles in This Category</h4>
                        <div class="space-y-4">
                            <?php foreach($category['articles'] as $article): ?>
                                <a href="support-article.php?id=<?php echo $article['id']; ?>" class="block hover:bg-gray-50 p-3 rounded-lg transition duration-300 border-l-4 border-transparent hover:border-indigo-500">
                                    <h5 class="text-indigo-600 font-medium"><?php echo $article['title']; ?></h5>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Self-Help Resources -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-10 text-center">Additional Resources</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-indigo-50 rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                            <i class="fas fa-play-circle text-indigo-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Video Tutorials</h3>
                        <p class="text-gray-600 mb-4">Watch step-by-step guides on how to use EventHub's features.</p>
                        <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition duration-300">
                            Browse Videos <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="bg-green-50 rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center mb-4">
                            <i class="fas fa-users text-green-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Community Forum</h3>
                        <p class="text-gray-600 mb-4">Connect with other EventHub users to share tips and get advice.</p>
                        <a href="#" class="text-green-600 font-medium hover:text-green-800 transition duration-300">
                            Join the Community <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                
                <div class="bg-yellow-50 rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center mb-4">
                            <i class="fas fa-graduation-cap text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">EventHub Academy</h3>
                        <p class="text-gray-600 mb-4">Take interactive courses to become an EventHub expert.</p>
                        <a href="#" class="text-yellow-600 font-medium hover:text-yellow-800 transition duration-300">
                            Start Learning <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Support -->
<section id="contact" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Still Need Help?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Can't find what you're looking for? Our support team is here to help with any questions or issues you may have.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Email Support</h3>
                    <p class="text-gray-600 mb-4">Send us an email and we'll get back to you within 24 hours.</p>
                    <a href="mailto:support@eventhub.com" class="text-indigo-600 font-medium hover:text-indigo-800 transition duration-300">
                        support@eventhub.com
                    </a>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center mb-4">
                        <i class="fas fa-comments text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Live Chat</h3>
                    <p class="text-gray-600 mb-4">Chat with our support team in real-time during business hours.</p>
                    <button class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                        Start Chat
                    </button>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-phone-alt text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Phone Support</h3>
                    <p class="text-gray-600 mb-4">Available Monday to Friday, 9am - 5pm PST for Pro and Enterprise plans.</p>
                    <a href="tel:+18005551234" class="text-blue-600 font-medium hover:text-blue-800 transition duration-300">
                        +1 (800) 555-1234
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600">Quick answers to common questions</p>
            </div>
            
            <div class="space-y-6" x-data="{active: null}">
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <button @click="active = active === 1 ? null : 1" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">How do I create an event?</span>
                        <i class="fas" :class="active === 1 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="active === 1" class="px-6 pb-4">
                        <p class="text-gray-600">To create an event, log in to your EventHub account and click the "Create Event" button on your dashboard. Follow the step-by-step form to add event details, set up tickets, and customize your event page. Once you're satisfied with your event setup, click "Publish" to make it live.</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <button @click="active = active === 2 ? null : 2" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">How do I process refunds?</span>
                        <i class="fas" :class="active === 2 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="active === 2" class="px-6 pb-4">
                        <p class="text-gray-600">To process a refund, go to your event's dashboard and click on "Attendees." Find the attendee you want to refund and click the "Refund" button. You can choose between a full or partial refund. Note that refund policies are set during event creation and can impact your ability to issue refunds after certain dates.</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <button @click="active = active === 3 ? null : 3" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">What payment methods do you accept?</span>
                        <i class="fas" :class="active === 3 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="active === 3" class="px-6 pb-4">
                        <p class="text-gray-600">EventHub supports major credit cards (Visa, Mastercard, American Express, Discover) and PayPal for event ticket purchases. If you're an event organizer, you can receive payouts via direct deposit to your bank account, PayPal, or other supported payment methods depending on your country.</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <button @click="active = active === 4 ? null : 4" class="flex justify-between items-center w-full px-6 py-4 text-left">
                        <span class="text-lg font-semibold text-gray-700">How do I contact customer support?</span>
                        <i class="fas" :class="active === 4 ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="active === 4" class="px-6 pb-4">
                        <p class="text-gray-600">You can reach our customer support team via email at support@eventhub.com, through live chat on our website during business hours (9am-5pm PST, Monday-Friday), or by phone at +1 (800) 555-1234 if you're on a Pro or Enterprise plan.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <a href="faq.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                    View all FAQs <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 