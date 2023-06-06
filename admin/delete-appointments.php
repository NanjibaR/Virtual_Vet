<?php
// Include the database connection file
include('../config/constants.php');

// Start the session
session_start();

// Check if the appointment ID is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the appointment from the database
    $sql = "DELETE FROM tbl_appointments WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        // Appointment deleted successfully
        $_SESSION['delete'] = "Appointment deleted successfully.";
        header("Location: manage-appointments.php");
        exit();
    } else {
        // Failed to delete appointment
        $_SESSION['delete'] = "Failed to delete appointment. Please try again.";
        header("Location: manage-appointments.php");
        exit();
    }
} else {
    // Redirect if appointment ID is not set
    header("Location: manage-appointments.php");
    exit();
}
?>
