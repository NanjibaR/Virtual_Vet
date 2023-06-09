<?php
// Database connection
$servername = "localhost"; 
$username = "root";      
$password = "";     
$dbname = "virtual_vet";  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pet = $_POST['pet'];
    $doctor = $_POST['doctor'];

    // appointment data into database
    $sql = "INSERT INTO Appointments (full_name, email, phone, pet, doctor) VALUES ('$fullName', '$email', '$phone', '$pet', '$doctor')";
    if ($conn->query($sql) === TRUE) {
        echo "Appointment created successfully. Please check your mail.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>



