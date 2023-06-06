<?php 
//Start Session
session_start();

// Create Constants to Store Non-repeating Values
define('SITEURL', 'http://localhost/Vet/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'vet');

// Connect to the Database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());

?>