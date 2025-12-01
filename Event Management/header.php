<?php
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$userType = $isLoggedIn ? $_SESSION['user_type'] : '';
$userName = $isLoggedIn ? $_SESSION['name'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - EventHub' : 'EventHub'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-purple-700 to-indigo-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fas fa-calendar-check text-2xl text-yellow-300"></i>
                <a href="index.php" class="text-2xl font-bold">EventHub</a>
            </div>
            <div class="hidden md:flex space-x-10">
                <a href="index.php" class="hover:text-yellow-300 transition">Home</a>
                <a href="events.php" class="hover:text-yellow-300 transition">Events</a>
                <?php if($isLoggedIn && $userType == 'organizer'): ?>
                <a href="create_event.php" class="hover:text-yellow-300 transition">Create Event</a>
                <?php endif; ?>
                <a href="about.php" class="hover:text-yellow-300 transition">About</a>
                <a href="contact.php" class="hover:text-yellow-300 transition">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <?php if($isLoggedIn): ?>
                    <span class="text-white hidden md:inline">Welcome, <?php echo htmlspecialchars($userName); ?></span>
                    <?php if($userType == 'organizer'): ?>
                        <a href="organizer_dashboard.php?t=<?php echo time(); ?>" class="py-2 px-4 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 rounded-lg shadow-md transition font-semibold">Dashboard</a>
                    <?php else: ?>
                        <a href="user_dashboard.php" class="py-2 px-4 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 rounded-lg shadow-md transition font-semibold">Dashboard</a>
                    <?php endif; ?>
                    <a href="logout.php" class="py-2 px-4 border border-white text-white hover:bg-white hover:text-indigo-800 rounded-lg transition font-semibold">Logout</a>
                <?php else: ?>
                    <a href="signin.php" class="py-2 px-4 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 rounded-lg shadow-md transition font-semibold">Sign In</a>
                    <a href="signup.php" class="py-2 px-4 border border-white text-white hover:bg-white hover:text-indigo-800 rounded-lg transition font-semibold">Sign Up</a>
                <?php endif; ?>
                <button class="md:hidden text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>
</body>
</html> 