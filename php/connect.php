<?php
// Check if a session has already been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Enable detailed error reporting for debugging during development
// Remove or comment out in production to avoid exposing sensitive information
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create a new MySQL connection
    $conn = new mysqli('localhost', 'root', '', 'itcs333project', 3306); // Adjust the port if necessary

    // Check the connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

} catch (Exception $e) {
    // Log the error to a file (or handle it as needed)
    error_log("Database connection error: " . $e->getMessage());

    // Display a generic error message to the user
    die("We are experiencing technical issues. Please try again later.");
}

// You can add additional code here, such as setting character encoding
$conn->set_charset("utf8mb4");
?>
