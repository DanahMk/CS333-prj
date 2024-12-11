<?php

// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'itcs333project';

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if database exists, if not create it
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db($dbname);
    
    // SQL to create registration table
    $sql_registration = "CREATE TABLE IF NOT EXISTS registration (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(50) NOT NULL,
        number BIGINT(8) NOT NULL,
        gender ENUM('m','f') NOT NULL
    )";

    // Create tables
    $conn->query($sql_registration);
}
?>
