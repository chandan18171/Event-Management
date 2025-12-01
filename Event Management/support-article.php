<?php
session_start();
$pageTitle = "Support Article";
include 'header.php';

// Check if article ID is provided
if (!isset($_GET['id'])) {
    header('Location: support.php');
    exit;
}

$article_id = $_GET['id'];

// In a real application, you would fetch the article from a database
// This is sample data for demonstration
$articles = [
    1 => [
        'id' => 1,
        'title' => 'How to Create Your First Event',
        'category' => 'Getting Started',
        'category_id' => 'getting-started',
        'author' => 'EventHub Team',
        'date' => '2023-08-15',
        'views' => 2578,
        'content' => '<p class="mb-4">Creating your first event on EventHub is easy and straightforward. This guide will walk you through the process step by step.</p>
                     <h3 class="text-xl font-bold mb-3 mt-6">Step 1: Sign in to your account</h3>
                     <p class="mb-4">First, sign in to your EventHub account. If you don\'t have an account yet, you\'ll need to create one by clicking the "Sign Up" button and following the instructions.</p>
                     <h3 class="text-xl font-bold mb-3 mt-6">Step 2: Navigate to your dashboard</h3>
                     <p class="mb-4">Once you\'re signed in, you\'ll be taken to your dashboard. Look for the "Create Event" button, which should be prominently displayed.</p>
                     <h3 class="text-xl font-bold mb-3 mt-6">Step 3: Fill in your event details</h3>
                     <p class="mb-4">Click the "Create Event" button to access the event creation form. You\'ll need to provide the following information:</p>
                     <ul class="list-disc pl-6 mb-4">
                         <li class="mb-2">Event title: Choose a clear, compelling title that describes your event.</li>
                         <li class="mb-2">Description: Provide a detailed description of what attendees can expect.</li>
                         <li class="mb-2">Date and time: Set the date and time for your event.</li>
                         <li class="mb-2">Location: Specify whether your event is in-person or virtual, and provide the relevant details.</li>
                         <li class="mb-2">Event image: Upload an image that represents your event (optional but recommended).</li>
                         <li class="mb-2">Ticket information: Set up your ticket types, prices, and availability.</li>
                     </ul>
                     <h3 class="text-xl font-bold mb-3 mt-6">Step 4: Preview and publish</h3>
                     <p class="mb-4">Before publishing, preview your event to make sure everything looks right. Once you\'re satisfied, click the "Publish Event" button to make your event live.</p>
                     <h3 class="text-xl font-bold mb-3 mt-6">Step 5: Share your event</h3>
                     <p class="mb-4">After publishing, you\'ll receive a unique URL for your event. Share this link on social media, via email, or through other channels to promote your event and drive registrations.</p>
                     <div class="bg-blue-50 p-4 rounded-lg mt-6">
                         <h4 class="font-bold text-blue-800 mb-2">Pro Tip</h4>
                         <p class="text-blue-800">The more detail you include in your event description, the more likely attendees are to register. Be sure to highlight what makes your event unique and valuable.</p>
                     </div>'
    ],
    2 => [
        'id' => 2,
        'title' => 'Setting Up Payment Processing',
        'category' => 'Account & Billing',
        'category_id' => 'account',
        'author' => 'Finance Team',
        'date' => '2023-09-05',
        'views' => 2145,
        'content' => '<p class="mb-4">Before you can start selling tickets to your events, you\'ll need to set up payment processing on your EventHub account. This guide explains how to connect your payment accounts and manage your billing settings.</p>
                     <h3 class="text-xl font-bold mb-3 mt-6">Supported Payment Processors</h3>
                     <p class="mb-4">EventHub supports the following payment processors:</p>
                     <ul class="list-disc pl-6 mb-4">
                         <li class="mb-2">Stripe</li>
                         <li class="mb-2">PayPal</li>
                         <li class="mb-2">Square</li>
                     </ul>
                     <h3 class="text-xl font-bold mb-3 mt-6">Connecting Your Payment Account</h3>
                     <p class="mb-4">To connect a payment processor:</p>
                     <ol class="list-decimal pl-6 mb-4">
                         <li class="mb-2">Go to your Account Settings</li>
                         <li class="mb-2">Select the "Payment Methods" tab</li>
                         <li class="mb-2">Click "Connect" next to your preferred payment processor</li>
                         <li class="mb-2">Follow the instructions to authorize the connection</li>
                     </ol>
                     <h3 class="text-xl font-bold mb-3 mt-6">Setting Up Payout Information</h3>
                     <p class="mb-4">After connecting your payment processor, you\'ll need to set up your payout information to receive funds from ticket sales:</p>
                     <ol class="list-decimal pl-6 mb-4">
                         <li class="mb-2">In the Payment Methods tab, click "Manage Payouts"</li>
                         <li class="mb-2">Enter your bank account information</li>
                         <li class="mb-2">Select your preferred payout schedule (daily, weekly, or monthly)</li>
                         <li class="mb-2">Click "Save" to confirm your settings</li>
                     </ol>
                     <div class="bg-yellow-50 p-4 rounded-lg mt-6">
                         <h4 class="font-bold text-yellow-800 mb-2">Important Note</h4>
                         <p class="text-yellow-800">There is a standard processing fee of 2.9% + $0.30 per transaction for all payment processors. These fees are deducted automatically before funds are transferred to your account.</p>
                     </div>
                     <h3 class="text-xl font-bold mb-3 mt-6">Managing Tax Settings</h3>
                     <p class="mb-4">Depending on your location and business structure, you may need to collect taxes on ticket sales. To configure tax settings:</p>
                     <ol class="list-decimal pl-6 mb-4">
                         <li class="mb-2">Go to Account Settings > Tax Settings</li>
                         <li class="mb-2">Enter your tax ID or business number</li>
                         <li class="mb-2">Configure the applicable tax rates for your region</li>
                         <li class="mb-2">Save your changes</li>
                     </ol>'
    ]
];

// Find the article by ID
$article = isset($articles[$article_id]) ? $articles[$article_id] : null;

// If article not found, redirect to support center
if ($article === null) {
    header('Location: support.php');
    exit;
}

// Get related articles (in a real application, this would be based on category or tags)
$related_articles = [];
foreach ($articles as $related) {
    if ($related['id'] != $article_id && $related['category'] == $article['category']) {
        $related_articles[] = $related;
    }
}
?>

<!-- Article Header -->
<section class="bg-gradient-to-r from-indigo-700 to-purple-700 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center text-indigo-100 mb-4">
                <a href="support.php" class="hover:text-white transition duration-300">Support Center</a>
                <span class="mx-2">›</span>
                <a href="support-category.php?id=<?php echo $article['category_id']; ?>" class="hover:text-white transition duration-300"><?php echo $article['category']; ?></a>
                <span class="mx-2">›</span>
                <span class="text-white"><?php echo $article['title']; ?></span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4"><?php echo $article['title']; ?></h1>
            <div class="flex items-center text-indigo-100">
                <span>Written by <?php echo $article['author']; ?></span>
                <span class="mx-3">•</span>
                <span>Updated <?php echo date('M d, Y', strtotime($article['date'])); ?></span>
                <span class="mx-3">•</span>
                <span><i class="far fa-eye mr-1"></i> <?php echo number_format($article['views']); ?> views</span>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3 pr-0 lg:pr-12">
                <div class="bg-white rounded-lg overflow-hidden mb-8">
                    <div class="prose prose-lg max-w-none">
                        <?php echo $article['content']; ?>
                    </div>
                    
                    <!-- Article Feedback -->
                    <div class="mt-12 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Was this article helpful?</h3>
                        <div class="flex space-x-4">
                            <button class="px-6 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition duration-300">
                                <i class="far fa-thumbs-up mr-2"></i> Yes
                            </button>
                            <button class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-300">
                                <i class="far fa-thumbs-down mr-2"></i> No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="w-full lg:w-1/3">
                <!-- Related Articles -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Related Articles</h3>
                    <div class="space-y-4">
                        <?php foreach($related_articles as $related): ?>
                            <a href="support-article.php?id=<?php echo $related['id']; ?>" class="block hover:bg-gray-100 p-3 rounded-lg transition duration-300">
                                <h4 class="text-indigo-600 font-medium"><?php echo $related['title']; ?></h4>
                                <div class="text-sm text-gray-500 mt-1">
                                    <span><i class="far fa-eye mr-1"></i> <?php echo number_format($related['views']); ?> views</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        
                        <?php if (empty($related_articles)): ?>
                            <p class="text-gray-600">No related articles found.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Support Options -->
                <div class="bg-indigo-50 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Need More Help?</h3>
                    <div class="space-y-4">
                        <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <i class="fas fa-comments text-indigo-600"></i>
                            </div>
                            <div>
                                <span class="font-medium">Contact Support</span>
                                <p class="text-sm text-gray-600">Get help from our team</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <i class="fas fa-video text-indigo-600"></i>
                            </div>
                            <div>
                                <span class="font-medium">Video Tutorials</span>
                                <p class="text-sm text-gray-600">Watch guided walkthroughs</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <i class="fas fa-users text-indigo-600"></i>
                            </div>
                            <div>
                                <span class="font-medium">Community Forum</span>
                                <p class="text-sm text-gray-600">Connect with other users</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- More Help Articles -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Browse More Help Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="support-category.php?id=getting-started" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-rocket text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Getting Started</h3>
                    <p class="text-gray-600">Learn the basics of using EventHub</p>
                </a>
                <a href="support-category.php?id=events" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-plus text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Creating Events</h3>
                    <p class="text-gray-600">Tips for creating successful events</p>
                </a>
                <a href="support-category.php?id=tickets" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mb-4">
                        <i class="fas fa-ticket-alt text-yellow-600"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Ticketing</h3>
                    <p class="text-gray-600">Managing registrations and tickets</p>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 