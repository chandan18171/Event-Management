<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'user') {
    header("Location: signin.php");
    exit();
}

// Get user information
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$pageTitle = "User Dashboard";
include_once 'header.php';

// Get user's upcoming events
try {
    $stmt = $pdo->prepare("
        SELECT e.*, r.status as registration_status 
        FROM events e 
        JOIN registrations r ON e.id = r.event_id 
        WHERE r.user_id = ? AND e.start_date >= CURDATE() 
        ORDER BY e.start_date ASC 
        LIMIT 3
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $upcomingEvents = [];
}

// Get user's past events
try {
    $stmt = $pdo->prepare("
        SELECT e.*, r.status as registration_status 
        FROM events e 
        JOIN registrations r ON e.id = r.event_id 
        WHERE r.user_id = ? AND e.start_date < CURDATE() 
        ORDER BY e.start_date DESC 
        LIMIT 3
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $pastEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $pastEvents = [];
}

// Get user's event statistics
try {
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_events,
            SUM(CASE WHEN e.start_date >= CURDATE() THEN 1 ELSE 0 END) as upcoming_events,
            SUM(CASE WHEN e.start_date < CURDATE() THEN 1 ELSE 0 END) as past_events
        FROM events e 
        JOIN registrations r ON e.id = r.event_id 
        WHERE r.user_id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $stats = ['total_events' => 0, 'upcoming_events' => 0, 'past_events' => 0];
}
?>

<!-- Welcome Message for First Login -->
<?php if(isset($_SESSION['animation']) && $_SESSION['animation'] == 'login_success'): ?>
<div id="welcomeMessage" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-70 z-50 animate__animated animate__fadeIn">
    <div class="bg-white rounded-lg p-8 max-w-md text-center animate__animated animate__zoomIn">
        <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <p class="text-gray-600 mb-6">You've successfully logged in to your user account.</p>
        <button id="continueBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
            Continue to Dashboard
        </button>
    </div>
</div>
<?php unset($_SESSION['animation']); ?>
<?php endif; ?>

<!-- Dashboard Content -->
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 animate__animated animate__fadeIn">
        <!-- Welcome Section with Animation -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate__animated animate__fadeInUp">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back, <?php echo htmlspecialchars($user['name']); ?>! 👋</h1>
                    <p class="text-gray-600">Here's what's happening with your events</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="events.php" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Find More Events
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="flex items-center">
                    <div class="p-3 bg-indigo-100 rounded-lg mr-4">
                        <i class="fas fa-calendar-check text-indigo-600 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Events</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['total_events']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg mr-4">
                        <i class="fas fa-calendar-day text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Upcoming Events</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['upcoming_events']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-3s">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg mr-4">
                        <i class="fas fa-history text-purple-600 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Past Events</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['past_events']; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate__animated animate__fadeInUp animate__delay-2s">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Upcoming Events</h2>
                <a href="events.php?filter=upcoming" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <?php if (empty($upcomingEvents)): ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-plus text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-600 mb-4">No upcoming events yet</p>
                    <a href="events.php" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-search mr-2"></i>
                        Find Events
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($upcomingEvents as $event): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="<?php echo !empty($event['image_url']) ? htmlspecialchars($event['image_url']) : 'https://via.placeholder.com/400x200?text=Event+Image'; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-full">
                                        <?php echo date('M d', strtotime($event['start_date'])); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars($event['description']); ?></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo htmlspecialchars($event['location']); ?>
                                    </span>
                                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Past Events Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Past Events</h2>
                <a href="events.php?filter=past" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <?php if (empty($pastEvents)): ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-history text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-600">No past events yet</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($pastEvents as $event): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="<?php echo !empty($event['image_url']) ? htmlspecialchars($event['image_url']) : 'https://via.placeholder.com/400x200?text=Event+Image'; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-gray-600 text-white text-sm rounded-full">
                                        Past Event
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p class="text-gray-600 mb-4 line-clamp-2"><?php echo htmlspecialchars($event['description']); ?></p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo htmlspecialchars($event['location']); ?>
                                    </span>
                                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Profile Info Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 animate__animated animate__fadeInUp animate__delay-4s">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Profile</h2>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <div class="w-24 h-24 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-4">
                            <i class="fas fa-user text-indigo-600 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-2"><?php echo htmlspecialchars($user['name']); ?></h3>
                        <p class="text-gray-600 text-center"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-indigo-800 mb-2">Account Info</h4>
                            <p class="text-gray-600 mb-2"><strong>User Type:</strong> <?php echo ucfirst($_SESSION['user_type']); ?></p>
                            <p class="text-gray-600 mb-2"><strong>Joined:</strong> 
                                <?php echo isset($user['created_at']) ? date('M d, Y', strtotime($user['created_at'])) : 'N/A'; ?>
                            </p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 mb-2">Actions</h4>
                            <a href="edit_profile.php" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 mb-2">
                                <i class="fas fa-user-edit mr-2"></i> Edit Profile
                            </a>
                            <a href="#" class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-300">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle welcome message if it exists
    const welcomeMessage = document.getElementById('welcomeMessage');
    const continueBtn = document.getElementById('continueBtn');
    
    if (welcomeMessage && continueBtn) {
        continueBtn.addEventListener('click', function() {
            welcomeMessage.classList.remove('animate__fadeIn');
            welcomeMessage.classList.add('animate__fadeOut');
            setTimeout(function() {
                welcomeMessage.style.display = 'none';
            }, 500);
        });
    }
});
</script> 