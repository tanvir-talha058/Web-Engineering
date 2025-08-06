# Biodata Management System with CRUD Operations and Authentication

This is a complete biodata management system built with PHP and MySQL that includes user authentication and full CRUD (Create, Read, Update, Delete) operations.

## Features

- **User Authentication**
  - User registration
  - User login/logout
  - Session management
  - Password hashing for security

- **CRUD Operations for Biodata**
  - Create new biodata records
  - View biodata details
  - Edit existing biodata
  - Delete biodata records

- **User Dashboard**
  - View all personal biodata records
  - Quick access to create/edit/delete operations
  - User-specific data isolation

## Files Structure

```
lab 5/
├── index.php                 # Entry point (redirects to login)
├── config.php               # Database configuration and helper functions
├── login.php                # User login page
├── register.php             # User registration page
├── logout.php               # Logout functionality
├── dashboard.php            # User dashboard
├── biodata_form.php         # Create/Edit biodata form
├── view_biodata.php         # View biodata details
├── edit_biodata.php         # Edit biodata redirect
├── delete_biodata.php       # Delete biodata functionality
├── biodata_styles.css       # Styling for biodata forms and tables
├── auth_styles.css          # Styling for authentication pages
└── setup_database.sql       # Database setup script
```

## Setup Instructions

### 1. Prerequisites
- Web server (Apache/Nginx) with PHP support
- MySQL database
- XAMPP/WAMP/LAMP stack (recommended for local development)

### 2. Database Setup
1. Start your MySQL server
2. Import the database structure:
   ```sql
   mysql -u root -p < setup_database.sql
   ```
   Or run the SQL commands in phpMyAdmin

### 3. Configuration
1. Update database credentials in `config.php`:
   ```php
   $host = 'localhost';
   $username = 'root';  // Your MySQL username
   $password = '';      // Your MySQL password
   $database = 'biodata_system';
   ```

### 4. File Permissions
- Ensure all PHP files have proper read permissions
- Make sure the web server can write to session directories

### 5. Access the Application
1. Start your web server
2. Navigate to `http://localhost/[your-project-folder]/lab 5/`
3. You'll be redirected to the login page
4. Click "Register here" to create a new account

## Usage Guide

### 1. User Registration
- Fill out the registration form with username, email, and password
- Password must be at least 6 characters long
- Username and email must be unique

### 2. User Login
- Use your username/email and password to log in
- You'll be redirected to the dashboard upon successful login

### 3. Dashboard
- View all your biodata records
- Create new biodata using "Create New Biodata" button
- Use action buttons to View, Edit, or Delete existing records

### 4. CRUD Operations
- **Create**: Click "Create New Biodata" and fill out the form
- **Read**: Click "View" to see detailed biodata information
- **Update**: Click "Edit" to modify existing biodata
- **Delete**: Click "Delete" with confirmation to remove biodata

## Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection prevention with prepared statements
- Session management for user authentication
- Input sanitization and validation
- User isolation (users can only access their own data)

## Database Schema

### Users Table
- `id` (Primary Key)
- `username` (Unique)
- `email` (Unique)
- `password` (Hashed)
- `created_at`

### Biodata Table
- `id` (Primary Key)
- `user_id` (Foreign Key to users.id)
- All biodata fields (name, address, phone, etc.)
- `created_at`, `updated_at`

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check MySQL server is running
   - Verify database credentials in `config.php`
   - Ensure database `biodata_system` exists

2. **Permission Denied**
   - Check file permissions
   - Ensure web server has access to files

3. **Session Issues**
   - Check PHP session configuration
   - Ensure session directory is writable

4. **Styling Issues**
   - Verify CSS files are accessible
   - Check file paths in HTML links

## Browser Compatibility

This application works with all modern browsers including:
- Chrome
- Firefox  
- Safari
- Edge

## Future Enhancements

Possible improvements:
- File upload for profile pictures
- Email verification for registration
- Password reset functionality
- Advanced search and filtering
- Export biodata to PDF
- Admin panel for user management

## License

This project is for educational purposes.
