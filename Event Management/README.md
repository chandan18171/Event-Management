# EventHub - Event Hosting Website

EventHub is a responsive and modern website for event planning and hosting, built with HTML, Tailwind CSS, and JavaScript.

## Features

- Responsive design that works on all devices (mobile, tablet, desktop)
- Eye-catching UI with modern design elements and animations
- Multiple pages including Home, About, Contact and more
- Interactive elements powered by JavaScript
- Beautiful gradient color schemes and transitions
- FAQ accordion section with toggle functionality
- Contact form with validation
- Testimonials section
- Timeline visualization for About page
- User authentication (login, logout, signup)
- Role-based user types (user or organizer)
- Secure password hashing
- Session management
- Separate dashboards for users and organizers
- Responsive design with Tailwind CSS
- Animated notifications and transitions
- Interactive welcome screens
- Form validation with visual feedback

## Pages

1. **Home (index.html)**: Main landing page with featured events, testimonials, and benefits
2. **About (about.html)**: Information about the company, team members, and history
3. **Contact (contact.html)**: Contact form, location information, and FAQ

## Technologies Used

- **HTML5**: Semantic markup for structure
- **Tailwind CSS**: Utility-first CSS framework for styling
- **JavaScript**: For interactive elements and form validation
- **Font Awesome**: Icon library
- **Google Fonts**: Typography

## Getting Started

1. Clone this repository or download the ZIP file
2. Open any of the HTML files in your web browser to view the website
3. No build process required - everything works out of the box

## Customization

You can easily customize this template:

- Update images: Replace the placeholder images with your own
- Change colors: Modify the color classes in Tailwind (purple, indigo, etc.)
- Add content: Expand sections or add new ones as needed

## Browser Support

- Chrome
- Firefox
- Safari
- Edge
- Opera

## Credits

- Images from [Unsplash](https://unsplash.com)
- Icons from [Font Awesome](https://fontawesome.com)
- CSS Framework from [Tailwind CSS](https://tailwindcss.com)

## License

This project is open source and available for personal and commercial use.

## Preview

To see the website in action, open the `index.html` file in your web browser.

# EventHub Backend

This project contains the backend functionality for EventHub, including user authentication (login, logout, signup) with user/organizer role selection.

## Setup Instructions

1. Make sure you have XAMPP installed and running.
2. Place all files in your XAMPP htdocs directory (e.g., C:/xampp/htdocs/EventHub/).
3. Start Apache and MySQL services in XAMPP control panel.
4. Open your browser and navigate to:
   ```
   http://localhost/EventHub/setup_database.php
   ```
   This will automatically create the necessary database and tables.

5. After the database is set up, you can access the following pages:
   - Sign Up: `http://localhost/EventHub/signup.php`
   - Sign In: `http://localhost/EventHub/signin.php`

## Features

- User authentication (login, logout, signup)
- Role-based user types (user or organizer)
- Secure password hashing
- Session management
- Separate dashboards for users and organizers
- Responsive design with Tailwind CSS
- Animated notifications and transitions
- Interactive welcome screens
- Form validation with visual feedback

## Files Overview

- `config.php`: Database connection setup
- `setup_database.php`: Automatic database and table creation
- `register.php`: Handles user registration
- `login.php`: Handles user login
- `logout.php`: Handles user logout
- `signin.php`: Login page
- `signup.php`: Registration page
- `user_dashboard.php`: Dashboard for regular users
- `organizer_dashboard.php`: Dashboard for event organizers

## Database Structure

The system uses a MySQL database with the following structure:

- Database: `event_management`
- Tables:
  - `users`: Stores user information including name, email, password, and user type

## Security Features

- Passwords are securely hashed using PHP's password_hash() function
- PDO prepared statements to prevent SQL injection
- XSS prevention through htmlspecialchars()
- Session-based authentication

## Next Steps

You can extend this system by adding:
- Event creation functionality for organizers
- Event browsing for users
- Ticket purchasing functionality
- User profile management
- Event analytics for organizers 