<?php 
include('../config/constants.php'); 
include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
</head>

<body>
    <h1 class="menu-top text-center">Admin Panel</h1>
    <!-- Menu -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-doctors.php">Doctors</a></li>
                <li><a href="manage-appointments.php">Appointments</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>

    </div>