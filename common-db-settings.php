<?php
// Ensure a session is started only if one is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itcs333project";

// Enable MySQLi error reporting for debugging during development
// Remove or comment out in production to avoid exposing sensitive information
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Set the character set for the connection
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Log the error for debugging purposes
    error_log("Database connection failed: " . $e->getMessage());

    // Display a generic user-friendly message
    die("We are experiencing technical issues. Please try again later.");
}
?>
