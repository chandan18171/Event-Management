<?php
session_start();
$pageTitle = "Blog";
include 'header.php';

// Sample blog posts - in a real site, these would come from a database
$blog_posts = [
    [
        'id' => 1,
        'title' => '10 Tips for Hosting a Successful Virtual Conference',
        'excerpt' => 'Virtual conferences are here to stay. Learn how to make your online event stand out with these expert tips for engagement, technical setup, and more.',
        'image' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        'category' => 'Event Planning',
        'date' => '2023-10-15',
        'author' => 'Sarah Johnson',
        'author_image' => 'https://randomuser.me/api/portraits/women/32.jpg'
    ],
    [
        'id' => 2,
        'title' => 'The Ultimate Guide to Event Marketing in 2023',
        'excerpt' => 'Discover the latest trends and strategies in event marketing to boost attendance and engagement for your next event.',
        'image' => 'https://images.unsplash.com/photo-1540317580384-e5d43616b9aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        'category' => 'Marketing',
        'date' => '2023-09-28',
        'author' => 'Michael Chen',
        'author_image' => 'https://randomuser.me/api/portraits/men/45.jpg'
    ],
    [
        'id' => 3,
        'title' => 'How to Choose the Perfect Venue for Your Event',
        'excerpt' => 'The venue can make or break your event. Follow our comprehensive guide to selecting the perfect location that meets all your requirements.',
        'image' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1300&q=80',
        'category' => 'Event Planning',
        'date' => '2023-09-15',
        'author' => 'Jessica Rodriguez',
        'author_image' => 'https://randomuser.me/api/portraits/women/68.jpg'
    ],
    [
        'id' => 4,
        'title' => 'Event Technology Trends to Watch in 2023',
        'excerpt' => 'From AI-powered matchmaking to virtual reality experiences, discover the latest technology trends revolutionizing the event industry.',
        'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        'category' => 'Technology',
        'date' => '2023-09-05',
        'author' => 'Alex Thompson',
        'author_image' => 'https://randomuser.me/api/portraits/men/22.jpg'
    ],
    [
        'id' => 5,
        'title' => 'How to Create an Effective Event Budget',
        'excerpt' => 'Learn the secrets to creating a comprehensive event budget that covers all expenses and helps you avoid costly surprises.',
        'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        'category' => 'Finance',
        'date' => '2023-08-22',
        'author' => 'David Wilson',
        'author_image' => 'https://randomuser.me/api/portraits/men/32.jpg'
    ],
    [
        'id' => 6,
        'title' => 'The Art of Networking at Events: A Comprehensive Guide',
        'excerpt' => 'Maximize your networking opportunities at events with these proven strategies for making meaningful connections.',
        'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
        'category' => 'Networking',
        'date' => '2023-08-10',
        'author' => 'Emily Rodriguez',
        'author_image' => 'https://randomuser.me/api/portraits/women/65.jpg'
    ],
];

// Get unique categories for filter
$categories = array_unique(array_column($blog_posts, 'category'));
sort($categories);

// Filter posts if category is selected
$selected_category = $_GET['category'] ?? '';
if (!empty($selected_category)) {
    $filtered_posts = array_filter($blog_posts, function($post) use ($selected_category) {
        return $post['category'] === $selected_category;
    });
} else {
    $filtered_posts = $blog_posts;
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-700 to-indigo-800 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 animate__animated animate__fadeIn">EventHub Blog</h1>
        <p class="text-xl max-w-3xl mx-auto animate__animated animate__fadeIn animate__delay-1s">
            Insights, tips, and best practices for event organizers and attendees
        </p>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Search and Filter -->
            <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <form action="" method="GET">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Search articles..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent shadow-sm">
                            <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="blog.php" class="px-4 py-2 <?php echo empty($selected_category) ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'; ?> rounded-full shadow-sm hover:shadow transition duration-300">
                        All Posts
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="blog.php?category=<?php echo urlencode($category); ?>" class="px-4 py-2 <?php echo $selected_category === $category ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700'; ?> rounded-full shadow-sm hover:shadow transition duration-300">
                            <?php echo htmlspecialchars($category); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <?php if (empty($filtered_posts)): ?>
                <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                    <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-search text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No Articles Found</h3>
                    <p class="text-gray-600">Try adjusting your search or filter criteria</p>
                </div>
            <?php else: ?>
                <!-- Featured Post -->
                <?php $featured_post = $filtered_posts[0]; ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
                    <div class="md:flex">
                        <div class="md:w-1/2">
                            <img src="<?php echo htmlspecialchars($featured_post['image']); ?>" alt="<?php echo htmlspecialchars($featured_post['title']); ?>" class="h-full w-full object-cover">
                        </div>
                        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                            <div class="flex items-center mb-4">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm font-medium rounded-full">
                                    <?php echo htmlspecialchars($featured_post['category']); ?>
                                </span>
                                <span class="ml-3 text-sm text-gray-500">
                                    <i class="far fa-calendar mr-1"></i> <?php echo date('M d, Y', strtotime($featured_post['date'])); ?>
                                </span>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($featured_post['title']); ?></h2>
                            <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($featured_post['excerpt']); ?></p>
                            <div class="flex items-center mb-6">
                                <img src="<?php echo htmlspecialchars($featured_post['author_image']); ?>" alt="<?php echo htmlspecialchars($featured_post['author']); ?>" class="w-10 h-10 rounded-full mr-3">
                                <span class="text-gray-700"><?php echo htmlspecialchars($featured_post['author']); ?></span>
                            </div>
                            <a href="blog-post.php?id=<?php echo $featured_post['id']; ?>" class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300 self-start">
                                Read Article
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Blog Posts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php 
                    // Skip the first post as it's featured
                    $other_posts = array_slice($filtered_posts, 1);
                    foreach ($other_posts as $post): 
                    ?>
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-shadow duration-300 hover:shadow-md">
                            <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="block">
                                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                        <?php echo htmlspecialchars($post['category']); ?>
                                    </span>
                                    <span class="ml-3 text-xs text-gray-500">
                                        <i class="far fa-calendar mr-1"></i> <?php echo date('M d, Y', strtotime($post['date'])); ?>
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">
                                    <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="hover:text-indigo-600 transition duration-300">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="<?php echo htmlspecialchars($post['author_image']); ?>" alt="<?php echo htmlspecialchars($post['author']); ?>" class="w-8 h-8 rounded-full mr-2">
                                        <span class="text-sm text-gray-700"><?php echo htmlspecialchars($post['author']); ?></span>
                                    </div>
                                    <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="text-indigo-600 text-sm font-medium hover:text-indigo-800">
                                        Read More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="inline-flex rounded-md shadow">
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-l-md text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="px-4 py-2 bg-indigo-600 border border-indigo-600 text-sm font-medium text-white">
                            1
                        </a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-500 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-r-md text-sm font-medium text-gray-500 hover:bg-gray-50">
                            Next
                        </a>
                    </nav>
                </div>
            <?php endif; ?>
            
            <!-- Newsletter Subscription -->
            <div class="bg-indigo-100 rounded-xl shadow-md p-8 mt-16">
                <div class="md:flex items-center">
                    <div class="md:w-2/3 mb-6 md:mb-0 md:pr-10">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Subscribe to Our Newsletter</h3>
                        <p class="text-gray-600">Stay updated with the latest event planning tips, industry trends, and exclusive content delivered straight to your inbox.</p>
                    </div>
                    <div class="md:w-1/3">
                        <form action="subscribe.php" method="POST" class="flex flex-col md:flex-row md:space-x-2">
                            <input type="email" name="email" placeholder="Your email address" class="w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 mb-2 md:mb-0">
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 