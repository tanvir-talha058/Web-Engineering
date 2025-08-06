<?php
session_start();

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'biodata_system';

// Create connection without specifying database first
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$create_db = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($create_db) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);

// Create users table
$users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($users_table) === FALSE) {
    die("Error creating users table: " . $conn->error);
}

// Create biodata table
$biodata_table = "CREATE TABLE IF NOT EXISTS biodata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    mother_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    nationality VARCHAR(50) NOT NULL,
    religion VARCHAR(50) NOT NULL,
    marital_status ENUM('Single', 'Married') NOT NULL,
    division VARCHAR(50) NOT NULL,
    national_id VARCHAR(17) NOT NULL,
    blood_group ENUM('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-') NOT NULL,
    education_level ENUM('SSC', 'HSC', 'Diploma', 'Bachelor', 'Masters', 'PhD') NOT NULL,
    institution VARCHAR(100) NOT NULL,
    occupation VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    education VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($biodata_table) === FALSE) {
    die("Error creating biodata table: " . $conn->error);
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Function to sanitize input
function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}
?>
