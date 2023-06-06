<?php
include('partials/menu.php');

// Retrieve admin details
$adminUsername = $_SESSION['user'];

$sql = "SELECT * FROM tbl_admin WHERE username = '$adminUsername'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$adminEmail = $row['email'];
$adminFullName = $row['full_name'];
?>
<!-- main -->
<div class="main-content">
<div class="wrapper">
            <h3>Logged in as:</h3>
            <p>Username: <?php echo $adminUsername; ?></p>
            <p>Email: <?php echo $adminEmail; ?></p>
            <p>Full Name: <?php echo $adminFullName; ?></p>
       
    </div>
    
    <div class="wrapper">

        <h1>Manage Appointments</h1>

        <br> <br> <br>
        <?php

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update']; // Display session message
            unset($_SESSION['update']); // Remove session message
        }

        ?>
        <!-- button to add admin -->
        <a href="add-appointments.php" class="btn-primary">Add Appointments</a>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Doctor Name</th>
                <th>Doctor Email</th>
                <th>Fee</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Patient Name</th>
                <th>Patient Contact</th>
                <th>Patient Email</th>
                <th>Patient Address</th>
                <th>Actions</th>
            </tr>

            <?php
            // Get all the appointments from the database
            $sql = "SELECT * FROM tbl_appointments";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1; // Create a Serial Number and set the value to 1

            if($count > 0)
            {
                // Appointments available
                while($row = mysqli_fetch_assoc($res))
                {
                    // Get all the appointment details
                    $id = $row['id'];
                    $doctor_name = $row['doctor_name'];
                    $doctor_email = $row['doctor_email'];
                    $fee = $row['fee'];
                    $appointment_date = $row['appointment_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $doctor_name; ?></td>
                        <td><?php echo $doctor_email; ?></td>
                        <td><?php echo $fee; ?></td>
                        <td><?php echo $appointment_date; ?></td>
                        <td>
                            <?php
                            // Appointments pending, confirmed, cancelled
                            if($status == "Pending")
                            {
                                echo "<label style='color: orange;'>$status</label>";
                            }
                            else if($status == "Confirmed")
                            {
                                echo "<label style='color: green;'>$status</label>";
                            }
                            else if($status == "Cancelled")
                            {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            else
                            {
                                echo "<label style='color: orange;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-appointments.php?id=<?php echo $id; ?>"
                               class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL;?>admin/delete-appointments.php?id=<?php echo $id; ?>"
                               class="btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                // Appointments not available
                echo "<tr><td colspan='12' class='error'>Appointments Not Available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>
