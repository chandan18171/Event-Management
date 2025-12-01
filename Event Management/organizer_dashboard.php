<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is an organizer
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'organizer') {
    header("Location: signin.php");
    exit();
}

// Get organizer information
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$organizer = $stmt->fetch();

// Check if event was just created
$event_created = isset($_GET['event_created']) && $_GET['event_created'] == 1;
$event_title = '';
if (isset($_SESSION['event_created']) && $_SESSION['event_created'] === true) {
    $event_title = $_SESSION['event_title'];
    // Clear the session variables
    unset($_SESSION['event_created']);
    unset($_SESSION['event_title']);
}

$pageTitle = "Organizer Dashboard";
include_once 'header.php';

// Check if is_premium column exists
try {
    $stmt = $pdo->query("SHOW COLUMNS FROM events LIKE 'is_premium'");
    $columnExists = $stmt->rowCount() > 0;
    
    if (!$columnExists) {
        // Redirect to update_db.php if column doesn't exist
        header("Location: update_db.php");
        exit();
    }
} catch (PDOException $e) {
    // If there's an error, continue but set a flag to show a warning
    $databaseError = true;
}

// Get organizer's events statistics
try {
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_events,
            SUM(CASE WHEN start_date >= CURDATE() THEN 1 ELSE 0 END) as upcoming_events,
            SUM(CASE WHEN start_date < CURDATE() THEN 1 ELSE 0 END) as past_events,
            SUM(CASE WHEN is_premium = 1 OR is_premium IS TRUE THEN 1 ELSE 0 END) as premium_events
        FROM events 
        WHERE organizer_id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Ensure all stats are set to avoid undefined index errors
    $stats['total_events'] = $stats['total_events'] ?? 0;
    $stats['upcoming_events'] = $stats['upcoming_events'] ?? 0;
    $stats['past_events'] = $stats['past_events'] ?? 0;
    $stats['premium_events'] = $stats['premium_events'] ?? 0;
} catch (PDOException $e) {
    $stats = ['total_events' => 0, 'upcoming_events' => 0, 'past_events' => 0, 'premium_events' => 0];
}

// Get upcoming events
try {
    $stmt = $pdo->prepare("
        SELECT e.*, 
               COUNT(r.id) as total_registrations,
               SUM(CASE WHEN r.status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_registrations
        FROM events e
        LEFT JOIN registrations r ON e.id = r.event_id
        WHERE e.organizer_id = ? AND e.start_date >= CURDATE()
        GROUP BY e.id
        ORDER BY e.start_date ASC
        LIMIT 3
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $upcomingEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $upcomingEvents = [];
}

// Get recent registrations
try {
    $stmt = $pdo->prepare("
        SELECT r.*, e.title as event_title, u.username as attendee_name
        FROM registrations r
        JOIN events e ON r.event_id = e.id
        JOIN users u ON r.user_id = u.id
        WHERE e.organizer_id = ?
        ORDER BY r.created_at DESC
        LIMIT 5
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $recentRegistrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $recentRegistrations = [];
}
?>

<!-- Welcome Message for First Login -->
<?php if(isset($_SESSION['animation']) && $_SESSION['animation'] == 'login_success'): ?>
<div id="welcomeMessage" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-70 z-50 animate__animated animate__fadeIn">
    <div class="bg-white rounded-lg p-8 max-w-md text-center animate__animated animate__zoomIn">
        <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome, <?php echo htmlspecialchars($organizer['name']); ?>!</h2>
        <p class="text-gray-600 mb-6">You've successfully logged in to your organizer account.</p>
        <button id="continueBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
            Continue to Dashboard
        </button>
    </div>
</div>
<?php unset($_SESSION['animation']); ?>
<?php endif; ?>

<!-- Event Creation Success Message -->
<?php if ($event_created): ?>
<div id="eventCreatedMessage" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-70 z-50 animate__animated animate__fadeIn">
    <div class="bg-white rounded-lg p-8 max-w-md text-center animate__animated animate__zoomIn">
        <i class="fas fa-calendar-check text-green-500 text-5xl mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Event Created!</h2>
        <p class="text-gray-600 mb-6">"<?php echo htmlspecialchars($event_title); ?>" has been successfully created. Your dashboard stats have been updated.</p>
        <button id="eventContinueBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition">
            Continue to Dashboard
        </button>
    </div>
</div>
<?php endif; ?>

<!-- Dashboard Content -->
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 animate__animated animate__fadeIn">
        <!-- Database Update Notice -->
        <?php if (isset($_GET['stats_issue'])): ?>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 animate__animated animate__fadeIn">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm">It seems there might be an issue with the database structure. Please run the <a href="update_db.php" class="font-medium underline">database update script</a> to fix it.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Welcome Section with Animation -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate__animated animate__fadeInUp">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back, <?php echo htmlspecialchars($organizer['name']); ?>! 👋</h1>
                    <p class="text-gray-600">Manage your events and track your success</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="create_event.php" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 animate__animated animate__pulse animate__infinite">
                        <i class="fas fa-plus mr-2"></i>
                        Create New Event
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-1s <?php echo $event_created ? 'animate__pulse' : ''; ?>">
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
            <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-2s <?php echo $event_created ? 'animate__pulse' : ''; ?>">
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
            <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-3s">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg mr-4">
                        <i class="fas fa-crown text-purple-600 text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-600">Premium Events</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?php echo $stats['premium_events']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="stats-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 animate__animated animate__fadeInUp animate__delay-4s">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                        <i class="fas fa-history text-yellow-600 text-2xl"></i>
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
                    <a href="create_event.php" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Create Event
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($upcomingEvents as $event): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="<?php echo !empty($event['image_url']) ? htmlspecialchars($event['image_url']) : 'images/default_event.jpg'; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-full">
                                        <?php echo date('M d', strtotime($event['start_date'])); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo htmlspecialchars($event['location']); ?>
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-1"></i>
                                        <?php echo isset($event['confirmed_registrations']) ? $event['confirmed_registrations'] : '0'; ?>/<?php echo isset($event['total_registrations']) ? $event['total_registrations'] : '0'; ?> confirmed
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                        View Details
                                    </a>
                                    <a href="manage_event.php?id=<?php echo $event['id']; ?>" class="text-green-600 hover:text-green-800 font-medium">
                                        Manage
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recent Registrations Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 animate__animated animate__fadeInUp animate__delay-3s">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Recent Registrations</h2>
                <a href="registrations.php" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <?php if (empty($recentRegistrations)): ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-600">No recent registrations</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($recentRegistrations as $registration): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($registration['event_title']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($registration['attendee_name']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500"><?php echo date('M d, Y', strtotime($registration['created_at'])); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php echo $registration['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <?php echo ucfirst($registration['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">
                                        <a href="manage_registration.php?id=<?php echo $registration['id']; ?>" class="hover:text-indigo-900">Manage</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Organizer Profile Info Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 animate__animated animate__fadeInUp animate__delay-4s">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Organizer Profile</h2>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 mb-6 md:mb-0">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <div class="w-24 h-24 bg-indigo-100 rounded-full mx-auto flex items-center justify-center mb-4">
                            <i class="fas fa-user-tie text-indigo-600 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-center text-gray-800 mb-2"><?php echo htmlspecialchars($organizer['name']); ?></h3>
                        <p class="text-gray-600 text-center"><?php echo htmlspecialchars($organizer['email']); ?></p>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-indigo-800 mb-2">Account Info</h4>
                            <p class="text-gray-600 mb-2"><strong>User Type:</strong> <?php echo ucfirst($_SESSION['user_type']); ?></p>
                            <p class="text-gray-600 mb-2"><strong>Joined:</strong> 
                                <?php echo isset($organizer['created_at']) ? date('M d, Y', strtotime($organizer['created_at'])) : 'N/A'; ?>
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
    // Force reload if coming from event creation to ensure latest stats
    <?php if ($event_created): ?>
    // Reload the page once to ensure stats are fresh
    if (!sessionStorage.getItem('reloaded')) {
        sessionStorage.setItem('reloaded', 'true');
        location.reload(true); // Force reload from server
    } else {
        sessionStorage.removeItem('reloaded');
        
        // Highlight the stats cards that changed
        const statsCards = document.querySelectorAll('.stats-card');
        if (statsCards.length > 0) {
            statsCards.forEach(card => {
                // Add pulsing highlight animation
                card.classList.add('animate__animated', 'animate__pulse');
                
                // Add a subtle background highlight
                card.style.backgroundColor = "rgba(237, 242, 255, 0.7)"; // Light indigo background
                
                // Return to normal after animation
                setTimeout(() => {
                    card.style.backgroundColor = "";
                }, 2000);
            });
        }
    }
    <?php endif; ?>

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
    
    // Handle event created message if it exists
    const eventCreatedMessage = document.getElementById('eventCreatedMessage');
    const eventContinueBtn = document.getElementById('eventContinueBtn');
    
    if (eventCreatedMessage && eventContinueBtn) {
        eventContinueBtn.addEventListener('click', function() {
            eventCreatedMessage.classList.remove('animate__fadeIn');
            eventCreatedMessage.classList.add('animate__fadeOut');
            setTimeout(function() {
                eventCreatedMessage.style.display = 'none';
            }, 500);
        });
    }
});
</script> 