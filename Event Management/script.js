// EventHub JavaScript

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle
    const menuButton = document.querySelector('.md\\:hidden');
    
    if (menuButton) {
        // Create mobile menu elements if they don't exist
        if (!document.querySelector('.mobile-menu')) {
            const mobileMenu = document.createElement('div');
            mobileMenu.className = 'mobile-menu';
            mobileMenu.innerHTML = `
                <div class="p-5">
                    <div class="flex justify-between items-center mb-8">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-check text-2xl text-yellow-300"></i>
                            <span class="text-2xl font-bold text-white">EventHub</span>
                        </div>
                        <button class="text-white text-xl close-menu">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <a href="#" class="text-white hover:text-yellow-300 transition py-2">Home</a>
                        <a href="#" class="text-white hover:text-yellow-300 transition py-2">Events</a>
                        <a href="#" class="text-white hover:text-yellow-300 transition py-2">Create</a>
                        <a href="#" class="text-white hover:text-yellow-300 transition py-2">About</a>
                        <a href="#" class="text-white hover:text-yellow-300 transition py-2">Contact</a>
                        <a href="#" class="py-2 px-4 bg-yellow-500 hover:bg-yellow-400 text-indigo-900 rounded-lg shadow-md transition font-semibold text-center mt-4">Sign Up</a>
                    </div>
                </div>
            `;
            document.body.appendChild(mobileMenu);
            
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            document.body.appendChild(overlay);
        }
        
        const mobileMenu = document.querySelector('.mobile-menu');
        const overlay = document.querySelector('.overlay');
        const closeMenu = document.querySelector('.close-menu');
        
        menuButton.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        function closeMenuHandler() {
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        closeMenu.addEventListener('click', closeMenuHandler);
        overlay.addEventListener('click', closeMenuHandler);
    }
    
    // Add event card class for hover effects
    const eventCards = document.querySelectorAll('.bg-white.rounded-xl');
    eventCards.forEach(card => {
        card.classList.add('event-card');
        const img = card.querySelector('img');
        if (img) img.classList.add('event-img');
    });
    
    // Add testimonial card class
    const testimonialCards = document.querySelectorAll('.bg-white.p-6.rounded-xl.shadow-md.border');
    testimonialCards.forEach(card => {
        card.classList.add('testimonial-card');
    });
    
    // Add floating animation to feature cards
    const featureCards = document.querySelectorAll('.bg-white.p-6.rounded-xl.shadow-md.text-center');
    featureCards.forEach(card => {
        card.classList.add('float-animation');
    });
    
    // Add pulse animation to CTA buttons
    const ctaButtons = document.querySelectorAll('a[href="#"].py-3.px-8.bg-white');
    ctaButtons.forEach(button => {
        button.classList.add('pulse-animation');
    });
    
    // Apply gradient text to section titles
    const sectionTitles = document.querySelectorAll('h2.text-3xl.font-bold');
    sectionTitles.forEach(title => {
        title.classList.add('gradient-text');
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    // Event search functionality
    const setupSearch = () => {
        const searchBox = document.createElement('div');
        searchBox.className = 'mx-auto max-w-md px-4 mb-12';
        searchBox.innerHTML = `
            <div class="relative flex items-center bg-white rounded-full shadow-md overflow-hidden">
                <input type="text" placeholder="Search events..." class="w-full px-6 py-3 outline-none">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        `;
        
        const featuredSection = document.querySelector('.container .text-center.mb-12');
        if (featuredSection) {
            featuredSection.parentNode.insertBefore(searchBox, featuredSection.nextSibling);
        }
        
        const searchInput = searchBox.querySelector('input');
        
        searchInput.addEventListener('keyup', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const eventCards = document.querySelectorAll('.event-card');
            
            eventCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const location = card.querySelector('.fa-map-marker-alt').nextElementSibling.textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm) || location.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    };
    
    // Add search to featured events section
    setupSearch();
    
    // Countdown timer for upcoming events
    const addCountdown = () => {
        const upcomingEvent = document.createElement('div');
        upcomingEvent.className = 'bg-gradient-to-r from-purple-700 to-indigo-800 text-white p-4 text-center';
        upcomingEvent.innerHTML = `
            <div class="container mx-auto">
                <span class="font-semibold">Next big event: TechCon 2023</span>
                <span class="mx-2">|</span>
                <span class="countdown">Starting in: <span id="countdown">00:00:00:00</span></span>
            </div>
        `;
        
        const nav = document.querySelector('nav');
        if (nav) {
            nav.parentNode.insertBefore(upcomingEvent, nav.nextSibling);
        }
        
        // Set the date for the countdown (1 month from now)
        const countdownDate = new Date();
        countdownDate.setMonth(countdownDate.getMonth() + 1);
        
        // Update countdown every second
        const countdownElement = document.getElementById('countdown');
        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = countdownDate - now;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            countdownElement.textContent = `${days.toString().padStart(2, '0')}:${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        };
        
        setInterval(updateCountdown, 1000);
        updateCountdown();
    };
    
    addCountdown();
    
    // Intersection Observer for animation on scroll
    const animateOnScroll = () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        const sections = document.querySelectorAll('section');
        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
        
        // Define the animation in a style tag
        const style = document.createElement('style');
        style.textContent = `
            .animate-fade-in {
                opacity: 1 !important;
                transform: translateY(0) !important;
            }
        `;
        document.head.appendChild(style);
    };
    
    animateOnScroll();
    
    // Form validation for subscription
    const subscribeForm = document.querySelector('footer form');
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const emailInput = subscribeForm.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (email === '') {
                alert('Please enter your email address');
                return;
            }
            
            if (!/^\S+@\S+\.\S+$/.test(email)) {
                alert('Please enter a valid email address');
                return;
            }
            
            // Simulate form submission
            emailInput.value = '';
            
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'text-green-400 mt-2';
            successMessage.textContent = 'Thank you for subscribing!';
            
            // Remove existing success message if any
            const existingMessage = subscribeForm.nextElementSibling;
            if (existingMessage && existingMessage.classList.contains('text-green-400')) {
                existingMessage.remove();
            }
            
            subscribeForm.parentNode.insertBefore(successMessage, subscribeForm.nextSibling);
            
            // Hide success message after 3 seconds
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
        });
    }
}); 