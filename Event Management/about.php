<?php
session_start();
$pageTitle = "About Us";
include 'header.php';
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-600 to-purple-700 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">About EventHub</h1>
            <p class="text-xl text-indigo-100 mb-10">Transforming how the world creates, discovers, and experiences events.</p>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Team working together" class="rounded-lg shadow-lg w-full">
                        <div class="absolute -bottom-4 -right-4 bg-indigo-600 text-white text-sm py-2 px-4 rounded-lg">
                            Since 2020
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Story</h2>
                    <p class="text-gray-600 mb-6">EventHub was founded in 2020 with a simple mission: to make event planning and management accessible to everyone. What started as a small project among friends has grown into a comprehensive platform trusted by thousands of event organizers worldwide.</p>
                    <p class="text-gray-600 mb-6">In the midst of a global pandemic that changed how people gathered, we saw an opportunity to reimagine the event experience. We built EventHub to bridge the gap between virtual and in-person events, creating tools that work seamlessly for both formats.</p>
                    <p class="text-gray-600">Today, EventHub powers events of all sizes—from intimate meetups to large conferences—and continues to innovate at the intersection of technology and human connection.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Values Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Mission & Values</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Driven by purpose, guided by principles.</p>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm overflow-hidden p-8 border border-gray-200 mb-12">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/3 flex justify-center mb-8 md:mb-0">
                        <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-bullseye text-indigo-600 text-4xl"></i>
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                        <p class="text-gray-600">To empower event creators with intuitive tools that simplify planning, enhance attendee engagement, and create memorable experiences. We believe that when people come together, amazing things happen, and we're committed to making those gatherings as impactful as possible.</p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-heart text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">User-Centric</h3>
                    <p class="text-gray-600">We put our users first in every decision we make, building features that solve real problems for event organizers and attendees alike.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-lightbulb text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Innovation</h3>
                    <p class="text-gray-600">We constantly push the boundaries of what's possible in event technology, seeking creative solutions to complex challenges.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-globe text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Inclusivity</h3>
                    <p class="text-gray-600">We build tools that make events accessible to all, regardless of location, background, or ability, fostering diverse and inclusive communities.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Trust & Security</h3>
                    <p class="text-gray-600">We maintain the highest standards for data protection and security, ensuring our users and their attendees can participate with confidence.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-handshake text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Partnership</h3>
                    <p class="text-gray-600">We see ourselves as partners in our customers' success, providing not just software but ongoing support and guidance.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fas fa-leaf text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sustainability</h3>
                    <p class="text-gray-600">We're committed to environmentally responsible practices and helping event organizers reduce their ecological footprint.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">The passionate people behind EventHub, working together to transform the event industry.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/92.jpg" alt="Alex Thompson" class="w-full h-64 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-bold text-white">Alex Thompson</h3>
                            <p class="text-indigo-200">CEO & Co-Founder</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm">Former event organizer with a passion for technology. Alex leads our vision and strategy with 15+ years of industry experience.</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Sarah Chen" class="w-full h-64 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-bold text-white">Sarah Chen</h3>
                            <p class="text-indigo-200">CTO & Co-Founder</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm">Software engineer turned entrepreneur. Sarah leads our product development with a focus on creating intuitive, powerful solutions.</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Marcus Johnson" class="w-full h-64 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-bold text-white">Marcus Johnson</h3>
                            <p class="text-indigo-200">Head of Design</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm">Award-winning UX designer who ensures every interaction with EventHub is intuitive, beautiful, and purposeful.</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Priya Patel" class="w-full h-64 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-bold text-white">Priya Patel</h3>
                            <p class="text-indigo-200">Customer Success</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm">Event industry veteran who leads our customer success team, ensuring organizers get the most out of EventHub.</p>
                        <div class="mt-4 flex space-x-3">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-6">Interested in joining our team?</p>
                <a href="#" class="inline-block px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition duration-300">
                    View Open Positions
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">50,000+</div>
                    <p class="text-gray-600">Events Powered</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">2.5M+</div>
                    <p class="text-gray-600">Attendees Served</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">120+</div>
                    <p class="text-gray-600">Countries Reached</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">98%</div>
                    <p class="text-gray-600">Customer Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="py-16 bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Learn More?</h2>
            <p class="text-xl text-indigo-100 mb-8">Have questions about EventHub or want to see it in action? We'd love to hear from you.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="contact.php" class="px-8 py-4 bg-white text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition duration-300">
                    Contact Us
                </a>
                <a href="demo.php" class="px-8 py-4 bg-indigo-500 bg-opacity-30 text-white font-medium rounded-lg hover:bg-opacity-40 transition duration-300">
                    Request a Demo
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 