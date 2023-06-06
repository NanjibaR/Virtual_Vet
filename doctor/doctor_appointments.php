<?php
include('doctor_header.php');

// Check if the doctor is logged in
if (!isset($_SESSION['doctor'])) {
    header('location: doctor_login.php');
    exit();
}

// Get the logged-in doctor's email
$doctor_email = $_SESSION['doctor'];

// Fetch the appointments for the logged-in doctor
$sql = "SELECT * FROM tbl_appointments WHERE doctor_email = '$doctor_email'";
$result = mysqli_query($conn, $sql);

// Handle form submission
if (isset($_POST['update'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    // Update the appointment status in the database
    $updateSql = "UPDATE tbl_appointments SET status = '$status' WHERE id = $appointment_id";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        $_SESSION['success'] = "Appointment status updated successfully.";
        header("Location: doctor_appointments.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update appointment status.";
        header("Location: doctor_appointments.php");
        exit();
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Appointments</h1>

        <?php
        // Check if any appointments exist
        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="tbl-full">
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                // Loop through each appointment and display the details
                while ($row = mysqli_fetch_assoc($result)) {
                    $appointment_id = $row['id'];
                    $patient_name = $row['customer_name'];
                    $appointment_date = $row['appointment_date'];
                    $status = $row['status'];
                    ?>

                    <tr>
                        <td><?php echo $appointment_id; ?></td>
                        <td><?php echo $patient_name; ?></td>
                        <td><?php echo $appointment_date; ?></td>
                        <td>
                            <?php echo $status; ?>
                        </td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                <select name="status">
                                    <option value="Active" <?php if ($status == "Active") echo 'selected'; ?>>Active</option>
                                    <option value="Cancelled" <?php if ($status == "Cancelled") echo 'selected'; ?>>Cancelled</option>
                                </select>
                                <input type="submit" name="update" value="Update" class="btn-secondary">
                            </form>
                        </td>
                    </tr>

                    <?php
                }
                ?>

            </table>
        <?php
        } else {
            echo "<p>No appointments found for this doctor.</p>";
        }
        ?>

    </div>
</div>

<?php
include('footer.php');
?>
