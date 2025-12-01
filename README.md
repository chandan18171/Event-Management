# Event-Management
A full-stack event management and hosting platform built with HTML, TailwindCSS, JavaScript, and PHP, featuring authentication, dashboards, event creation, pricing, support center, and a responsive UI.



EventHub – Complete Event Management & Hosting Platform

EventHub is a fully responsive, modern, and feature-rich platform designed for creating, managing, and hosting events.
This project integrates a polished TailwindCSS frontend, dynamic JavaScript interactions, and a secure PHP + MySQL backend supporting authentication, dashboards, event creation, and support tools.

This is a perfect full-stack project for portfolios, academic submissions, or real-world event management systems.






🚀 Features Overview
🎨 Frontend (UI/UX)

Built using TailwindCSS, custom CSS animations (styles.css), responsive layouts, and dynamic JavaScript (script.js):

Animated hero sections

Mobile navigation menu

Event listings + filter/search

Countdown timer for upcoming events

Pricing page with plans

FAQ page with accordion

Support Center with categories & help topics

Blog page

About page

Contact form

Smooth scroll & scroll-triggered animations

Gradient text, hover effects, floating cards

🔐 Backend (PHP + MySQL)

Backend includes all necessary endpoints:

User signup (signup.html → signup.php)

User login (signin.html → signin.php)

Session-based authentication

Secured password hashing

User dashboard (user_dashboard.php)

Organizer dashboard (organizer_dashboard.php)

Event creation (create_event.php)

Event details page (event_details.php)

Support center dynamic modules (support.php, support-category.php, etc.)

Automatic database setup (setup_database.php)

Database update scripts (update_db.php)










🎟️ Event Management

Users and organizers can:

Create events

View events

Explore categories & locations

Check event details

Filter and search events (from JS logic)





💬 Support & Help System

Support center UI (support.html) includes:

Knowledge base

Contact support

Community forum

Popular help topics

Support article templates (support-article.php)





🔧 JavaScript Features

From script.js:

Dynamic mobile menu

Search bar with live filtering

Event animations & hover effects

Countdown timer

Fade-in scroll animations

Subscription form validation

Section-based animations








📁 Project Structure
EventHub/
│── index.html

│── about.html

│── events.html

│── blog.html

│── pricing.html

│── faq.html

│── contact.html

│── support.html

│── create.html

│── signin.html

│── signup.html

│── styles.css

│── script.js

│── favicon.png

│── event_details.php

│── create_event.php

│── header.php

│── footer.php

│── login.php

│── register.php

│── signin.php

│── signup.php

│── logout.php

│── user_dashboard.php

│── organizer_dashboard.php

│── support.php

│── support-article.php

│── support-category.php

│── config.php

│── database.php

│── update_db.php

│── setup_database.php

└── assets/






🛠️ Tech Stack
Technology	Purpose
HTML5	Structure
TailwindCSS	Responsive styling
JavaScript	Interactive behavior & animations
Custom CSS	Animations and enhancements
PHP	Backend logic & authentication
MySQL	Database management
FontAwesome	Icons








🧩 Installation & Setup
▶ Frontend Preview Only

Simply open in browser:

index.html

▶ Full Backend (Localhost)

Install XAMPP/WAMP

Move project into:

htdocs/EventHub/


Start Apache & MySQL

In browser open:

http://localhost/EventHub/setup_database.php


This auto-creates database + tables.

Access main pages:

Login → /signin.html

Signup → /signup.html

User Dashboard → /user_dashboard.php

Organizer Dashboard → /organizer_dashboard.php

🎯 Future Enhancements

Full event CRUD (edit/delete)

Ticket purchasing system

Payment gateway integration

Email notifications

Admin panel

User profiles

Analytics dashboard
