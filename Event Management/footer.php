    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-calendar-check text-2xl text-yellow-400"></i>
                        <span class="text-2xl font-bold">EventHub</span>
                    </div>
                    <p class="text-gray-400 mb-4">Creating memorable events made simple.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="about.php" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="events.php" class="text-gray-400 hover:text-white transition">Events</a></li>
                        <li><a href="pricing.php" class="text-gray-400 hover:text-white transition">Pricing</a></li>
                        <li><a href="contact.php" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="guide.php" class="text-gray-400 hover:text-white transition">Event Planning Guide</a></li>
                        <li><a href="blog.php" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="faq.php" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        <li><a href="support.php" class="text-gray-400 hover:text-white transition">Support Center</a></li>
                        <li><a href="api.php" class="text-gray-400 hover:text-white transition">API Documentation</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Subscribe</h4>
                    <p class="text-gray-400 mb-4">Stay updated with the latest events and news.</p>
                    <form class="flex" action="subscribe.php" method="POST">
                        <input type="email" name="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 rounded-r-lg px-4 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; <?php echo date('Y'); ?> EventHub. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="privacy.php" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <a href="terms.php" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                    <a href="cookies.php" class="text-gray-400 hover:text-white transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html> 