<?php
session_start();
include 'database.php';

// Check if an event ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: events.php");
    exit;
}

$eventId = $_GET['id'];

// Fetch event details
$stmt = $pdo->prepare("SELECT e.*, u.name as organizer_name 
                      FROM events e 
                      INNER JOIN users u ON e.organizer_id = u.id 
                      WHERE e.id = ?");
$stmt->execute([$eventId]);
$event = $stmt->fetch();

// If event not found, redirect to events page
if (!$event) {
    header("Location: events.php");
    exit;
}

$pageTitle = $event['title'];
include 'header.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userId = $isLoggedIn ? $_SESSION['user_id'] : 0;

// Check if user has already registered for this event
$isRegistered = false;
if ($isLoggedIn) {
    $stmt = $pdo->prepare("SELECT id FROM registrations WHERE event_id = ? AND user_id = ?");
    $stmt->execute([$eventId, $userId]);
    $isRegistered = $stmt->rowCount() > 0;
}

// Handle registration
$registrationMessage = '';
$registrationStatus = '';

if (isset($_POST['register']) && $isLoggedIn) {
    // Check if the user is not already registered
    if (!$isRegistered) {
        try {
            $stmt = $pdo->prepare("INSERT INTO registrations (event_id, user_id) VALUES (?, ?)");
            $stmt->execute([$eventId, $userId]);
            $isRegistered = true;
            $registrationMessage = "You've successfully registered for this event!";
            $registrationStatus = 'success';
        } catch (PDOException $e) {
            $registrationMessage = "An error occurred during registration. Please try again later.";
            $registrationStatus = 'error';
        }
    } else {
        $registrationMessage = "You're already registered for this event.";
        $registrationStatus = 'warning';
    }
}

// Handle cancellation
if (isset($_POST['cancel']) && $isLoggedIn) {
    try {
        $stmt = $pdo->prepare("DELETE FROM registrations WHERE event_id = ? AND user_id = ?");
        $stmt->execute([$eventId, $userId]);
        $isRegistered = false;
        $registrationMessage = "Your registration has been cancelled.";
        $registrationStatus = 'success';
    } catch (PDOException $e) {
        $registrationMessage = "An error occurred. Please try again later.";
        $registrationStatus = 'error';
    }
}
?>

<!-- Event Details Header -->
<div class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="mb-6 md:mb-0 md:mr-6 animate__animated animate__fadeIn">
                <h1 class="text-3xl md:text-4xl font-bold mb-2"><?php echo htmlspecialchars($event['title']); ?></h1>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-indigo-500 bg-opacity-30 text-white text-sm font-semibold rounded-full">
                        <?php echo htmlspecialchars($event['category']); ?>
                    </span>
                    <span class="px-3 py-1 bg-yellow-500 bg-opacity-30 text-white text-sm font-semibold rounded-full">
                        <?php echo htmlspecialchars($event['event_type']); ?>
                    </span>
                </div>
                <div class="flex items-center mb-2">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>
                        <?php 
                        echo date('d M Y', strtotime($event['start_date']));
                        if (!empty($event['end_date']) && $event['end_date'] !== $event['start_date']) {
                            echo ' - ' . date('d M Y', strtotime($event['end_date']));
                        }
                        ?>
                    </span>
                </div>
                <div class="flex items-center mb-2">
                    <i class="far fa-clock mr-2"></i>
                    <span>
                        <?php 
                        echo date('g:i A', strtotime($event['start_time']));
                        if (!empty($event['end_time'])) {
                            echo ' - ' . date('g:i A', strtotime($event['end_time']));
                        }
                        ?>
                    </span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span><?php echo htmlspecialchars($event['location']); ?></span>
                </div>
            </div>
            
            <div class="animate__animated animate__fadeIn animate__delay-1s">
                <?php if ($isLoggedIn): ?>
                    <?php if (!$isRegistered): ?>
                        <form method="POST" action="">
                            <button type="submit" name="register" class="py-3 px-8 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 font-semibold rounded-lg shadow-md transition">
                                Register for Event
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <div class="bg-green-500 bg-opacity-20 text-white px-4 py-2 rounded-lg mb-3">
                                <i class="fas fa-check-circle mr-2"></i> You're registered!
                            </div>
                            <form method="POST" action="">
                                <button type="submit" name="cancel" class="py-2 px-4 border border-white text-white hover:bg-white hover:text-indigo-800 rounded-lg transition">
                                    Cancel Registration
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="signin.php?redirect=event_details.php?id=<?php echo $eventId; ?>" class="py-3 px-8 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 font-semibold rounded-lg shadow-md transition">
                        Sign In to Register
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Registration Message -->
<?php if (!empty($registrationMessage)): ?>
    <div class="container mx-auto px-4 pt-6">
        <div class="animate__animated animate__fadeIn px-4 py-3 rounded-lg 
            <?php if ($registrationStatus === 'success'): ?>
                bg-green-100 text-green-800 border border-green-200
            <?php elseif ($registrationStatus === 'error'): ?>
                bg-red-100 text-red-800 border border-red-200
            <?php else: ?>
                bg-yellow-100 text-yellow-800 border border-yellow-200
            <?php endif; ?>">
            <?php echo $registrationMessage; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Event Details -->
        <div class="lg:col-span-2">
            <!-- Event Image -->
            <div class="mb-8 rounded-xl overflow-hidden shadow-md">
                <?php if (!empty($event['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($event['image_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-96 object-cover">
                <?php else: ?>
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=869&q=80" alt="Default Event Image" class="w-full h-96 object-cover">
                <?php endif; ?>
            </div>
            
            <!-- Event Description -->
            <div class="bg-white rounded-xl shadow-md p-8 mb-8 animate__animated animate__fadeIn">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Event</h2>
                <div class="prose max-w-none text-gray-600">
                    <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                </div>
            </div>
            
            <!-- Organizer Information -->
            <div class="bg-white rounded-xl shadow-md p-8 animate__animated animate__fadeIn">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Organizer</h2>
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($event['organizer_name']); ?></h3>
                        <p class="text-gray-600">Event Organizer</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div>
            <!-- Event Details Card -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 animate__animated animate__fadeIn">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Event Details</h3>
                
                <!-- Date and Time -->
                <div class="mb-4">
                    <h4 class="text-gray-700 font-semibold mb-2">Date and Time</h4>
                    <div class="flex items-start">
                        <i class="far fa-calendar-alt mt-1 mr-3 text-indigo-600"></i>
                        <div>
                            <p class="text-gray-600">
                                <?php 
                                echo date('D, M d, Y', strtotime($event['start_date']));
                                if (!empty($event['end_date']) && $event['end_date'] !== $event['start_date']) {
                                    echo ' - ' . date('D, M d, Y', strtotime($event['end_date']));
                                }
                                ?>
                            </p>
                            <p class="text-gray-600">
                                <?php 
                                echo date('g:i A', strtotime($event['start_time']));
                                if (!empty($event['end_time'])) {
                                    echo ' - ' . date('g:i A', strtotime($event['end_time']));
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Location -->
                <div class="mb-4">
                    <h4 class="text-gray-700 font-semibold mb-2">Location</h4>
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-600"></i>
                        <div>
                            <p class="text-gray-600"><?php echo htmlspecialchars($event['location']); ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="mb-4">
                    <h4 class="text-gray-700 font-semibold mb-2">Price</h4>
                    <div class="flex items-start">
                        <i class="fas fa-tag mt-1 mr-3 text-indigo-600"></i>
                        <div>
                            <p class="text-gray-600"><?php echo !empty($event['price']) ? htmlspecialchars($event['price']) : 'Free'; ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Capacity -->
                <?php if (!empty($event['capacity'])): ?>
                <div>
                    <h4 class="text-gray-700 font-semibold mb-2">Capacity</h4>
                    <div class="flex items-start">
                        <i class="fas fa-users mt-1 mr-3 text-indigo-600"></i>
                        <div>
                            <p class="text-gray-600"><?php echo htmlspecialchars($event['capacity']); ?> people</p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Registration Card -->
            <div class="bg-white rounded-xl shadow-md p-6 animate__animated animate__fadeIn">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Register for this Event</h3>
                
                <?php if ($isLoggedIn): ?>
                    <?php if (!$isRegistered): ?>
                        <p class="text-gray-600 mb-4">Secure your spot at this event today!</p>
                        <form method="POST" action="">
                            <button type="submit" name="register" class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition">
                                Register Now
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center">
                            <i class="fas fa-check-circle text-green-500 text-4xl mb-3"></i>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">You're Registered!</h4>
                            <p class="text-gray-600 mb-4">We look forward to seeing you at the event.</p>
                            <form method="POST" action="">
                                <button type="submit" name="cancel" class="w-full py-2 px-4 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition">
                                    Cancel Registration
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-gray-600 mb-4">Please sign in to register for this event.</p>
                    <a href="signin.php?redirect=event_details.php?id=<?php echo $eventId; ?>" class="block w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition text-center">
                        Sign In to Register
                    </a>
                    <p class="text-center mt-4 text-gray-600">
                        Don't have an account? 
                        <a href="signup.php?redirect=event_details.php?id=<?php echo $eventId; ?>" class="text-indigo-600 hover:text-indigo-800">Sign Up</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Back to Events Button -->
    <div class="mt-12 text-center">
        <a href="events.php" class="inline-flex items-center py-3 px-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to All Events
        </a>
    </div>
</div>

<?php include 'footer.php'; ?> 