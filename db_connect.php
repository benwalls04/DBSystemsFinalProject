<?php
// Database connection parameters
$servername = 'localhost';
$username = 'root';
$password = 'Bg053104!';
$dbname = 'GP25';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>