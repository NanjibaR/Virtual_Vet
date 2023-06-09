<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "virtual_vet"; 

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());

}
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the submitted form data
        $username = $_POST['fullname'];
        $address = $_POST['address'];
        $mail = $_POST['email'];
        $phone = $_POST['number'];
        $password = $_POST['password'];
        $newPassword = $_POST['new-password'];
    
        // Update the user's information in the signup table
        $updateQuery = "UPDATE signup SET fullname = '$username', address = '$address', email = '$mail', number = '$phone'";
    
        // Check if a new password is provided and update it accordingly
        if (!empty($newPassword)) {
            $updateQuery .= ", password = '$newPassword'";
        }
    
        $updateQuery .= " WHERE id = <7>"; // Replace <user_id> with the actual user ID
    
        // Execute the update query
        $updateResult = mysqli_query($connection, $updateQuery);
    
        if ($updateResult) {
            // Redirect to the user profile page or display a success message
            echo("Successfully Updated!");
            exit();
        } else {
            // Handle error if the update query fails
        }
    }
    ?>
    
