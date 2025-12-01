<?php
session_start();
$pageTitle = "Support Category";
include 'header.php';

// Check if category ID is provided
if (!isset($_GET['id'])) {
    header('Location: support.php');
    exit;
}

$category_id = $_GET['id'];

// Sample categories data
$categories = [
    'getting-started' => [
        'id' => 'getting-started',
        'name' => 'Getting Started',
        'icon' => 'fas fa-rocket',
        'color' => 'bg-indigo-100 text-indigo-600',
        'description' => 'Learn the basics of setting up your EventHub account and creating your first event.'
    ],
    'account' => [
        'id' => 'account',
        'name' => 'Account & Billing',
        'icon' => 'fas fa-user-circle',
        'color' => 'bg-blue-100 text-blue-600',
        'description' => 'Manage your account settings, subscription plans, and payment details.'
    ],
    'events' => [
        'id' => 'events',
        'name' => 'Creating Events',
        'icon' => 'fas fa-calendar-plus',
        'color' => 'bg-green-100 text-green-600',
        'description' => 'Everything you need to know about creating and managing successful events.'
    ],
    'tickets' => [
        'id' => 'tickets',
        'name' => 'Ticketing & Registration',
        'icon' => 'fas fa-ticket-alt',
        'color' => 'bg-yellow-100 text-yellow-600',
        'description' => 'Learn how to set up tickets, manage registrations, and track attendance.'
    ]
];

// Find the category by ID
$category = isset($categories[$category_id]) ? $categories[$category_id] : null;

// If category not found, redirect to support center
if ($category === null) {
    header('Location: support.php');
    exit;
}

// Sample articles for the category
$articles = [
    'getting-started' => [
        [
            'id' => 1,
            'title' => 'How to Create Your First Event',
            'excerpt' => 'A step-by-step guide to creating your first event on EventHub.',
            'views' => 2578,
            'date' => '2023-08-15'
        ],
        [
            'id' => 11,
            'title' => 'Setting Up Your Organizer Profile',
            'excerpt' => 'Learn how to complete your organizer profile to build trust with attendees.',
            'views' => 1856,
            'date' => '2023-08-20'
        ],
        [
            'id' => 12,
            'title' => 'Navigating the EventHub Dashboard',
            'excerpt' => 'An overview of the EventHub dashboard and its key features.',
            'views' => 1645,
            'date' => '2023-08-25'
        ],
        [
            'id' => 13,
            'title' => 'Understanding Event Types and Categories',
            'excerpt' => 'Learn about the different event types and how to categorize your events properly.',
            'views' => 1523,
            'date' => '2023-09-01'
        ],
        [
            'id' => 14,
            'title' => 'EventHub Glossary: Key Terms Explained',
            'excerpt' => 'A comprehensive glossary of terms commonly used in EventHub.',
            'views' => 1342,
            'date' => '2023-09-05'
        ]
    ],
    'account' => [
        [
            'id' => 2,
            'title' => 'Setting Up Payment Processing',
            'excerpt' => 'Learn how to connect payment processors to start selling tickets.',
            'views' => 2145,
            'date' => '2023-09-05'
        ],
        [
            'id' => 21,
            'title' => 'Understanding Subscription Plans',
            'excerpt' => 'A comparison of different subscription plans and their features.',
            'views' => 1876,
            'date' => '2023-09-10'
        ],
        [
            'id' => 22,
            'title' => 'Managing User Permissions and Team Access',
            'excerpt' => 'How to add team members and set appropriate access levels.',
            'views' => 1654,
            'date' => '2023-09-15'
        ],
        [
            'id' => 23,
            'title' => 'Tax Settings and Financial Reporting',
            'excerpt' => 'Configure tax settings and generate financial reports for your events.',
            'views' => 1543,
            'date' => '2023-09-20'
        ],
        [
            'id' => 24,
            'title' => 'Upgrading or Downgrading Your Plan',
            'excerpt' => 'How to change your subscription plan based on your needs.',
            'views' => 1324,
            'date' => '2023-09-25'
        ]
    ],
    'events' => [
        [
            'id' => 4,
            'title' => 'Customizing Event Pages',
            'excerpt' => 'Learn how to create attractive and effective event pages.',
            'views' => 1845,
            'date' => '2023-08-10'
        ],
        [
            'id' => 31,
            'title' => 'Creating Multi-Day Events',
            'excerpt' => 'Setting up events that span multiple days with different schedules.',
            'views' => 1735,
            'date' => '2023-08-15'
        ],
        [
            'id' => 32,
            'title' => 'Managing Event Capacity and Waitlists',
            'excerpt' => 'How to set capacity limits and manage waitlists for popular events.',
            'views' => 1623,
            'date' => '2023-08-20'
        ],
        [
            'id' => 9,
            'title' => 'How to Export Attendee Data',
            'excerpt' => 'Learn how to export and use attendee data for your events.',
            'views' => 1532,
            'date' => '2023-10-01'
        ],
        [
            'id' => 10,
            'title' => 'Setting Up Multi-Day Events',
            'excerpt' => 'Everything you need to know about creating multi-day events.',
            'views' => 1421,
            'date' => '2023-09-28'
        ]
    ],
    'tickets' => [
        [
            'id' => 3,
            'title' => 'Managing Attendee Registrations',
            'excerpt' => 'How to track and manage registrations for your events.',
            'views' => 1982,
            'date' => '2023-08-25'
        ],
        [
            'id' => 8,
            'title' => 'Creating Discount Codes for Your Event',
            'excerpt' => 'Learn how to create and manage promotional discount codes.',
            'views' => 1765,
            'date' => '2023-10-05'
        ],
        [
            'id' => 41,
            'title' => 'Setting Up Different Ticket Types',
            'excerpt' => 'How to create VIP, early bird, and other specialized ticket types.',
            'views' => 1654,
            'date' => '2023-10-10'
        ],
        [
            'id' => 42,
            'title' => 'Managing Check-ins at Your Event',
            'excerpt' => 'Tools and techniques for streamlining the check-in process.',
            'views' => 1543,
            'date' => '2023-10-15'
        ],
        [
            'id' => 6,
            'title' => 'Using QR Codes for Event Check-ins',
            'excerpt' => 'How to implement QR code scanning for efficient check-ins.',
            'views' => 1432,
            'date' => '2023-10-12'
        ]
    ]
];

// Get articles for the current category
$categoryArticles = isset($articles[$category_id]) ? $articles[$category_id] : [];
?>

<!-- Category Header -->
<section class="bg-gradient-to-r from-indigo-700 to-purple-700 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center text-indigo-100 mb-4">
                <a href="support.php" class="hover:text-white transition duration-300">Support Center</a>
                <span class="mx-2">›</span>
                <span class="text-white"><?php echo $category['name']; ?></span>
            </div>
            <div class="flex items-center">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mr-6 bg-white bg-opacity-20">
                    <i class="<?php echo $category['icon']; ?> text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2"><?php echo $category['name']; ?></h1>
                    <p class="text-indigo-100"><?php echo $category['description']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="relative">
                <input type="text" placeholder="Search in <?php echo $category['name']; ?>..." class="w-full px-6 py-4 rounded-lg shadow-sm border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-search mr-1"></i> Search
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">All <?php echo $category['name']; ?> Articles</h2>
            
            <?php if (empty($categoryArticles)): ?>
                <div class="bg-gray-50 p-8 rounded-lg text-center">
                    <p class="text-gray-600">No articles found in this category.</p>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach($categoryArticles as $article): ?>
                        <a href="support-article.php?id=<?php echo $article['id']; ?>" class="block bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                            <h3 class="text-xl font-bold text-indigo-600 mb-2"><?php echo $article['title']; ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $article['excerpt']; ?></p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span><i class="far fa-calendar-alt mr-1"></i> Updated <?php echo date('M d, Y', strtotime($article['date'])); ?></span>
                                <span class="mx-3">•</span>
                                <span><i class="far fa-eye mr-1"></i> <?php echo number_format($article['views']); ?> views</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Other Categories -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Explore Other Categories</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach($categories as $cat): ?>
                    <?php if ($cat['id'] != $category_id): ?>
                        <a href="support-category.php?id=<?php echo $cat['id']; ?>" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                            <div class="w-12 h-12 rounded-full <?php echo $cat['color']; ?> flex items-center justify-center mb-4">
                                <i class="<?php echo $cat['icon']; ?>"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2"><?php echo $cat['name']; ?></h3>
                            <p class="text-gray-600 text-sm"><?php echo $cat['description']; ?></p>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Contact Support -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-indigo-50 rounded-lg overflow-hidden shadow-sm">
            <div class="p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Still Need Help?</h2>
                    <p class="text-gray-600">Our support team is here to assist you with any questions you may have.</p>
                </div>
                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                    <a href="support.php#contact" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-envelope mr-2"></i> Contact Support
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-300">
                        <i class="fas fa-comments mr-2"></i> Live Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 