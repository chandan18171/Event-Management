<?php
session_start();
$pageTitle = "EventHub - Host Amazing Events";
include 'header.php';
?>

<!-- Hero Section -->
<header class="relative">
    <div id="hero-slideshow" class="absolute inset-0">
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');"></div>
        <div class="hero-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');"></div>
        <div class="absolute inset-0 bg-black opacity-60 z-10"></div>
    </div>
    
    <!-- Arrow Controls -->
    <button type="button" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-30 bg-black bg-opacity-50 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-75 focus:outline-none transition-all duration-300" id="prev-slide" onclick="changeSlide(-1)">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-30 bg-black bg-opacity-50 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-opacity-75 focus:outline-none transition-all duration-300" id="next-slide" onclick="changeSlide(1)">
        <i class="fas fa-chevron-right"></i>
    </button>
    
    <!-- Slider Controls -->
    <div class="absolute bottom-5 left-0 right-0 z-30 flex justify-center">
        <div class="flex space-x-3" id="slider-bullets">
            <button type="button" class="slider-bullet w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none hover:bg-opacity-100 transition-all duration-300" onclick="goToSlide(0)"></button>
            <button type="button" class="slider-bullet w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none hover:bg-opacity-100 transition-all duration-300" onclick="goToSlide(1)"></button>
            <button type="button" class="slider-bullet w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none hover:bg-opacity-100 transition-all duration-300" onclick="goToSlide(2)"></button>
            <button type="button" class="slider-bullet w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none hover:bg-opacity-100 transition-all duration-300" onclick="goToSlide(3)"></button>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-28 relative z-20 text-center text-white">
        <h1 class="text-5xl md:text-6xl font-bold mb-4 animate-fade-in">Create Unforgettable Events</h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto animate-fade-in-delay">The perfect platform to plan, promote, and host your events. From conferences to concerts, we've got you covered.</p>
        <div class="mt-8 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-center animate-fade-in-delay-2">
            <a href="events.php" class="py-3 px-8 bg-white text-indigo-700 font-bold rounded-full shadow-lg hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition-all duration-300">Browse Events</a>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'organizer'): ?>
                <a href="create_event.php" class="py-3 px-8 bg-yellow-500 text-indigo-900 font-bold rounded-full shadow-lg hover:bg-yellow-400 hover:scale-105 hover:shadow-xl transition-all duration-300">Create Your Event</a>
            <?php else: ?>
                <a href="signup.php" class="py-3 px-8 bg-yellow-500 text-indigo-900 font-bold rounded-full shadow-lg hover:bg-yellow-400 hover:scale-105 hover:shadow-xl transition-all duration-300">Get Started</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Featured Events Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 animate-fade-in">Featured Events</h2>
            <p class="text-gray-600 mt-2 animate-fade-in-delay">Discover amazing events happening around you</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="event-cards-container">
            <?php
            // Database connection
            require_once 'config.php';
            
            try {
                $stmt = $pdo->query("SELECT * FROM events ORDER BY created_at DESC LIMIT 6");
                while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $categoryClass = '';
                    switch ($event['category']) {
                        case 'Tech':
                            $categoryClass = 'bg-purple-100 text-purple-800';
                            break;
                        case 'Music':
                            $categoryClass = 'bg-blue-100 text-blue-800';
                            break;
                        case 'Business':
                            $categoryClass = 'bg-green-100 text-green-800';
                            break;
                        case 'Food':
                            $categoryClass = 'bg-yellow-100 text-yellow-800';
                            break;
                        default:
                            $categoryClass = 'bg-gray-100 text-gray-800';
                    }
                    ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:transform hover:scale-105 hover:shadow-xl animate-fade-in">
                        <div class="relative">
                            <img src="<?php echo htmlspecialchars($event['image_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-48 object-cover">
                            <?php if (isset($event['is_premium']) && $event['is_premium'] == 1): ?>
                                <div class="absolute top-4 right-4 bg-yellow-500 text-indigo-900 font-bold py-1 px-3 rounded-full">
                                    Premium
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-3">
                                <span class="<?php echo $categoryClass; ?> text-sm font-semibold py-1 px-3 rounded-full">
                                    <?php echo htmlspecialchars($event['category']); ?>
                                </span>
                                <span class="text-sm text-gray-600">
                                    <i class="far fa-calendar mr-1"></i> <?php echo date('d M Y', strtotime($event['start_date'])); ?>
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($event['description']); ?></p>
                            <div class="my-2">
                                <p class="text-gray-500">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> <?php echo htmlspecialchars($event['location']); ?>
                                </p>
                                <p class="text-gray-500">
                                    <i class="far fa-calendar text-blue-500 mr-1"></i> <?php echo date('M d, Y', strtotime($event['start_date'])); ?>
                                </p>
                            </div>
                            <a href="event_details.php?id=<?php echo $event['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">View Details</a>
                        </div>
                    </div>
                    <?php
                }
            } catch (PDOException $e) {
                echo '<div class="col-span-3 text-center text-red-500">Error loading events. Please try again later.</div>';
            }
            ?>
        </div>
        <div class="text-center mt-12">
            <a href="events.php" class="py-3 px-8 bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200 hover:scale-105 hover:shadow-lg transition-all duration-300 font-semibold inline-flex items-center">
                View All Events
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-16 bg-indigo-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 animate-fade-in">Why Choose EventHub</h2>
            <p class="text-gray-600 mt-2 animate-fade-in-delay">The best platform for your event management needs</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-xl transition-shadow duration-300 animate-fade-in">
                <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-rocket text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Easy to Use</h3>
                <p class="text-gray-600">Our platform is designed to be intuitive and user-friendly, making event creation a breeze.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-xl transition-shadow duration-300 animate-fade-in-delay">
                <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Powerful Analytics</h3>
                <p class="text-gray-600">Track attendance, engagement, and success metrics to optimize your events.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-xl transition-shadow duration-300 animate-fade-in-delay-2">
                <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Community Focused</h3>
                <p class="text-gray-600">Connect with attendees and build lasting relationships through our platform.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 animate-fade-in">What Our Users Say</h2>
            <p class="text-gray-600 mt-2 animate-fade-in-delay">Hear from our satisfied event organizers and attendees</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 animate-fade-in">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Sarah Johnson</h4>
                        <p class="text-gray-600">Event Organizer</p>
                    </div>
                </div>
                <p class="text-gray-600">"EventHub has transformed how I manage my events. The platform is intuitive and the support team is amazing!"</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 animate-fade-in-delay">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Michael Chen</h4>
                        <p class="text-gray-600">Tech Conference Attendee</p>
                    </div>
                </div>
                <p class="text-gray-600">"I've attended multiple events through EventHub and each experience has been seamless. Highly recommended!"</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 animate-fade-in-delay-2">
                <div class="flex items-center mb-4">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Emily Rodriguez</h4>
                        <p class="text-gray-600">Music Festival Organizer</p>
                    </div>
                </div>
                <p class="text-gray-600">"The analytics tools have helped me understand my audience better and improve my events significantly."</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-purple-700 to-indigo-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4 animate-fade-in">Ready to Get Started?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto animate-fade-in-delay">Join thousands of event organizers and attendees who trust EventHub for their event needs.</p>
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-center animate-fade-in-delay-2">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="signup.php" class="py-3 px-8 bg-white text-indigo-700 font-bold rounded-full shadow-lg hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition-all duration-300">Sign Up Now</a>
                <a href="signin.php" class="py-3 px-8 border border-white text-white hover:bg-white hover:text-indigo-800 rounded-full transition duration-300 transform hover:scale-105 font-semibold">Sign In</a>
            <?php else: ?>
                <a href="events.php" class="py-3 px-8 bg-white text-indigo-700 font-bold rounded-full shadow-lg hover:bg-gray-100 hover:scale-105 hover:shadow-xl transition-all duration-300">Browse Events</a>
                <?php if ($_SESSION['user_type'] === 'organizer'): ?>
                    <a href="create_event.php" class="py-3 px-8 border border-white text-white hover:bg-white hover:text-indigo-800 rounded-full transition duration-300 transform hover:scale-105 font-semibold">Create Event</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Event Search -->
<script>
// Hero Slideshow
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');
const bullets = document.querySelectorAll('.slider-bullet');

function showSlide(index) {
    slides.forEach(slide => slide.style.opacity = '0');
    bullets.forEach(bullet => bullet.classList.remove('bg-opacity-100'));
    
    slides[index].style.opacity = '1';
    bullets[index].classList.add('bg-opacity-100');
    currentSlide = index;
}

function changeSlide(direction) {
    let newIndex = currentSlide + direction;
    if (newIndex < 0) newIndex = slides.length - 1;
    if (newIndex >= slides.length) newIndex = 0;
    showSlide(newIndex);
}

function goToSlide(index) {
    showSlide(index);
}

// Auto-advance slides
setInterval(() => changeSlide(1), 5000);

// Show first slide
showSlide(0);
</script>

<?php include 'footer.php'; ?> 