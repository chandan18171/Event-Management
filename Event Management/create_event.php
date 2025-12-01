<?php
session_start();
require_once 'config.php';

// Check if user is logged in and is an organizer
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'organizer') {
    header("Location: signin.php");
    exit();
}

// Define variables and set to empty values
$title = $description = $category = $event_type = $location = $start_date = $start_time = $end_date = $end_time = $image_url = '';
$is_premium = false;
$errors = [];
$success_message = '';

// Define event categories
$categories = ['Business', 'Tech', 'Music', 'Food', 'Art', 'Sports', 'Education', 'Social', 'Other'];

// Default image URL to use if none provided
$default_image_url = 'images/default_event.jpg';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $event_type = trim($_POST['event_type']);
    $location = trim($_POST['location']);
    $start_date = trim($_POST['start_date']);
    $start_time = trim($_POST['start_time']);
    $end_date = trim($_POST['end_date'] ?? '');
    $end_time = trim($_POST['end_time'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $is_premium = isset($_POST['is_premium']) ? 1 : 0;
    
    // If image_url is empty, use default image
    if (empty($image_url)) {
        $image_url = $default_image_url;
    }
    
    // Validate form data
    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }
    
    if (empty($description)) {
        $errors['description'] = 'Description is required';
    }
    
    if (empty($category)) {
        $errors['category'] = 'Category is required';
    }
    
    if (empty($event_type)) {
        $errors['event_type'] = 'Event type is required';
    }
    
    if (empty($location)) {
        $errors['location'] = 'Location is required';
    }
    
    if (empty($start_date)) {
        $errors['start_date'] = 'Start date is required';
    } elseif (strtotime($start_date) < strtotime(date('Y-m-d'))) {
        $errors['start_date'] = 'Start date cannot be in the past';
    }
    
    if (empty($start_time)) {
        $errors['start_time'] = 'Start time is required';
    }
    
    // If no errors, insert event into database
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO events (title, description, category, event_type, location, start_date, start_time, end_date, end_time, image_url, organizer_id, is_premium, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $title, 
                $description, 
                $category, 
                $event_type, 
                $location, 
                $start_date, 
                $start_time, 
                $end_date ?: null, 
                $end_time ?: null, 
                $image_url, 
                $_SESSION['user_id'],
                $is_premium // Use the checkbox value instead of hardcoded 0
            ]);
            
            // Set a success message in session
            $_SESSION['event_created'] = true;
            $_SESSION['event_title'] = $title;
            
            // Redirect to organizer dashboard with success parameter
            header("Location: organizer_dashboard.php?event_created=1");
            exit();
            
        } catch (PDOException $e) {
            $errors['database'] = 'Database error: ' . $e->getMessage();
        }
    }
}

$pageTitle = "Create Event";
include_once 'header.php';
?>

<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Create a New Event</h1>
                    <a href="organizer_dashboard.php" class="text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                    </a>
                </div>
                
                <?php if (!empty($success_message)): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 animate__animated animate__fadeIn">
                        <p><?php echo $success_message; ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($errors['database'])): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                        <p><?php echo $errors['database']; ?></p>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title *</label>
                            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <?php if (!empty($errors['title'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['title']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select name="category" id="category" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat; ?>" <?php echo $category === $cat ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['category'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['category']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Event Type -->
                        <div>
                            <label for="event_type" class="block text-sm font-medium text-gray-700 mb-1">Event Type *</label>
                            <select name="event_type" id="event_type" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                                <option value="">Select event type</option>
                                <option value="In-person" <?php echo $event_type === 'In-person' ? 'selected' : ''; ?>>In-person</option>
                                <option value="Online" <?php echo $event_type === 'Online' ? 'selected' : ''; ?>>Online</option>
                                <option value="Hybrid" <?php echo $event_type === 'Hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                            </select>
                            <?php if (!empty($errors['event_type'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['event_type']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($location); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <?php if (!empty($errors['location'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['location']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                            <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($start_date); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <?php if (!empty($errors['start_date'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['start_date']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Start Time -->
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" value="<?php echo htmlspecialchars($start_time); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <?php if (!empty($errors['start_time'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['start_time']; ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date (Optional)</label>
                            <input type="date" name="end_date" id="end_date" value="<?php echo htmlspecialchars($end_date); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        
                        <!-- End Time -->
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time (Optional)</label>
                            <input type="time" name="end_time" id="end_time" value="<?php echo htmlspecialchars($end_time); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        
                        <!-- Premium Event Checkbox -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_premium" id="is_premium" <?php echo $is_premium ? 'checked' : ''; ?> class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <label for="is_premium" class="ml-2 block text-sm font-medium text-gray-700">
                                    Mark as Premium Event
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Premium events are highlighted on the homepage and appear in special listings.</p>
                        </div>
                        
                        <!-- Image URL (Optional) -->
                        <div class="md:col-span-2">
                            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Image URL (Optional)</label>
                            <input type="url" name="image_url" id="image_url" value="<?php echo htmlspecialchars($image_url); ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Leave empty to use default image">
                            <p class="text-sm text-gray-500 mt-1">If left empty, a default image will be used for your event.</p>
                        </div>
                        
                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required><?php echo htmlspecialchars($description); ?></textarea>
                            <?php if (!empty($errors['description'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo $errors['description']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            <i class="fas fa-calendar-plus mr-2"></i> Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Preview Box -->
        <div class="max-w-4xl mx-auto mt-8 bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Event Preview</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 max-w-md mx-auto">
                        <div class="relative">
                            <img src="<?php echo !empty($image_url) ? htmlspecialchars($image_url) : $default_image_url; ?>" alt="Event Preview" class="w-full h-48 object-cover" id="previewImage">
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-indigo-600 text-white text-sm rounded-full">
                                    <?php echo !empty($start_date) ? date('M d', strtotime($start_date)) : date('M d'); ?>
                                </span>
                            </div>
                            <div id="premiumBadge" class="<?php echo $is_premium ? 'block' : 'hidden'; ?> absolute top-4 left-4 bg-yellow-500 text-indigo-900 font-bold py-1 px-3 rounded-full">
                                Premium
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2" id="previewTitle"><?php echo !empty($title) ? htmlspecialchars($title) : 'Event Title'; ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-2" id="previewDescription"><?php echo !empty($description) ? htmlspecialchars($description) : 'Event description will appear here.'; ?></p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <span id="previewLocation"><?php echo !empty($location) ? htmlspecialchars($location) : 'Location'; ?></span>
                                </span>
                                <span class="text-sm text-indigo-600 font-medium">
                                    <span id="previewCategory"><?php echo !empty($category) ? htmlspecialchars($category) : 'Category'; ?></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview functionality
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const locationInput = document.getElementById('location');
    const categoryInput = document.getElementById('category');
    const imageUrlInput = document.getElementById('image_url');
    const startDateInput = document.getElementById('start_date');
    const isPremiumInput = document.getElementById('is_premium');
    
    const previewTitle = document.getElementById('previewTitle');
    const previewDescription = document.getElementById('previewDescription');
    const previewLocation = document.getElementById('previewLocation');
    const previewCategory = document.getElementById('previewCategory');
    const previewImage = document.getElementById('previewImage');
    const premiumBadge = document.getElementById('premiumBadge');
    
    // Update title preview
    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Event Title';
    });
    
    // Update description preview
    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Event description will appear here.';
    });
    
    // Update location preview
    locationInput.addEventListener('input', function() {
        previewLocation.textContent = this.value || 'Location';
    });
    
    // Update category preview
    categoryInput.addEventListener('change', function() {
        previewCategory.textContent = this.value || 'Category';
    });
    
    // Update premium status
    isPremiumInput.addEventListener('change', function() {
        if (this.checked) {
            premiumBadge.classList.remove('hidden');
            premiumBadge.classList.add('block');
        } else {
            premiumBadge.classList.remove('block');
            premiumBadge.classList.add('hidden');
        }
    });
    
    // Update image preview
    imageUrlInput.addEventListener('input', function() {
        if (this.value) {
            previewImage.src = this.value;
        } else {
            previewImage.src = '<?php echo $default_image_url; ?>';
        }
    });
    
    // Handle image load errors
    previewImage.addEventListener('error', function() {
        this.src = '<?php echo $default_image_url; ?>';
    });
});
</script>

<?php include_once 'footer.php'; ?> 