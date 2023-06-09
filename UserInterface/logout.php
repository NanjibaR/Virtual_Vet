<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION['loggedin'])) {
    header('http://localhost/signup_login/login/loginconnect.php'); // Redirect to the login page if not logged in
    exit;
}

// Perform logout
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

header('http://localhost/signup_login/login/loginconnect.php'); // Redirect to the login page after logout
exit;
?>
