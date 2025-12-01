<?php
session_start();
$pageTitle = "Events";
include 'header.php';
include 'database.php';

// Fetch categories for filter
$stmt = $pdo->query("SELECT DISTINCT category FROM events ORDER BY category");
$categories = $stmt->fetchAll();

// Default filters
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$dateFilter = isset($_GET['date']) ? $_GET['date'] : '';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Build query based on filters
$sql = "SELECT * FROM events WHERE 1=1";
$params = [];

if (!empty($categoryFilter)) {
    $sql .= " AND category = ?";
    $params[] = $categoryFilter;
}

if (!empty($dateFilter)) {
    if ($dateFilter === 'today') {
        $sql .= " AND start_date = CURDATE()";
    } elseif ($dateFilter === 'tomorrow') {
        $sql .= " AND start_date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)";
    } elseif ($dateFilter === 'this-week') {
        $sql .= " AND YEARWEEK(start_date, 1) = YEARWEEK(CURDATE(), 1)";
    } elseif ($dateFilter === 'this-weekend') {
        $sql .= " AND (DAYOFWEEK(start_date) = 1 OR DAYOFWEEK(start_date) = 7) 
                 AND start_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
    } elseif ($dateFilter === 'next-week') {
        $sql .= " AND YEARWEEK(start_date, 1) = YEARWEEK(DATE_ADD(CURDATE(), INTERVAL 1 WEEK), 1)";
    } elseif ($dateFilter === 'this-month') {
        $sql .= " AND MONTH(start_date) = MONTH(CURDATE()) AND YEAR(start_date) = YEAR(CURDATE())";
    }
}

if (!empty($searchTerm)) {
    $sql .= " AND (title LIKE ? OR description LIKE ? OR location LIKE ?)";
    $params[] = "%$searchTerm%";
    $params[] = "%$searchTerm%";
    $params[] = "%$searchTerm%";
}

$sql .= " ORDER BY start_date ASC";

// Prepare and execute the query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$events = $stmt->fetchAll();
?>

<!-- Page Header -->
<div class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4 animate__animated animate__fadeIn">Discover Events</h1>
        <p class="text-xl max-w-3xl animate__animated animate__fadeIn animate__delay-1s">Find the perfect events to attend, connect with like-minded people, and create unforgettable memories.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-10">
        <form action="events.php" method="GET" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-gray-700 font-medium mb-2">Search Events</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search by name, description, or location" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select id="category" name="category" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['category']); ?>" <?php echo $categoryFilter === $category['category'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['category']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Date Filter -->
                <div>
                    <label for="date" class="block text-gray-700 font-medium mb-2">When</label>
                    <select id="date" name="date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Any Time</option>
                        <option value="today" <?php echo $dateFilter === 'today' ? 'selected' : ''; ?>>Today</option>
                        <option value="tomorrow" <?php echo $dateFilter === 'tomorrow' ? 'selected' : ''; ?>>Tomorrow</option>
                        <option value="this-week" <?php echo $dateFilter === 'this-week' ? 'selected' : ''; ?>>This Week</option>
                        <option value="this-weekend" <?php echo $dateFilter === 'this-weekend' ? 'selected' : ''; ?>>This Weekend</option>
                        <option value="next-week" <?php echo $dateFilter === 'next-week' ? 'selected' : ''; ?>>Next Week</option>
                        <option value="this-month" <?php echo $dateFilter === 'this-month' ? 'selected' : ''; ?>>This Month</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="py-3 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">Apply Filters</button>
            </div>
        </form>
    </div>
    
    <!-- Events Grid -->
    <div class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            <?php 
            if (count($events) > 0) {
                echo count($events) . ' Events Found';
            } else {
                echo 'No Events Found';
            }
            ?>
        </h2>
        
        <?php if (count($events) === 0): ?>
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <i class="fas fa-calendar-times text-indigo-400 text-5xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Events Found</h3>
                <p class="text-gray-600 mb-6">Try adjusting your search or filter criteria.</p>
                <a href="events.php" class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">View All Events</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($events as $event): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 animate__animated animate__fadeIn">
                        <div class="h-48 overflow-hidden">
                            <?php if (!empty($event['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($event['image_url']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=869&q=80" alt="Default Event Image" class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm font-semibold rounded-full"><?php echo htmlspecialchars($event['category']); ?></span>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full"><?php echo htmlspecialchars($event['event_type']); ?></span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($event['title']); ?></h3>
                            <div class="flex items-center text-gray-600 mb-2">
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
                            <div class="flex items-center text-gray-600 mb-2">
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
                            <div class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span><?php echo htmlspecialchars($event['location']); ?></span>
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars(substr($event['description'], 0, 150)) . (strlen($event['description']) > 150 ? '...' : ''); ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-800 font-semibold"><?php echo !empty($event['price']) ? htmlspecialchars($event['price']) : 'Free'; ?></span>
                                <a href="event_details.php?id=<?php echo $event['id']; ?>" class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?> 