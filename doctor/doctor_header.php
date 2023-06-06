<?php 
include('../config/constants.php'); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet</title>
    <link rel="stylesheet" href="../css/doctor.css?v=<?php echo time(); ?>">
</head>

<body>
    <h1 class="menu-top text-center">Doctor Panel</h1>
    <!-- Menu -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="doctor.php">Profile</a></li>
                <li><a href="doctor_appointments.php">Appointments</a></li>
                <li><a href="doctor_logout.php">Logout</a></li>

            </ul>
        </div>
    </div>