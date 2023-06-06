<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Appointments</h1>
        <br><br>

        <?php
        // Check whether id is set or not
        if (isset($_GET['id'])) {
            // Get the appointment details
            $id = $_GET['id'];
            // SQL query to get the appointment details
            $sql = "SELECT * FROM tbl_appointments WHERE id=$id";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            // Count rows
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                // Details available
                $row = mysqli_fetch_assoc($res);
                $doctor_name = $row['doctor_name'];
                $doctor_email = $row['doctor_email'];
                $fee = $row['fee'];
                $appointment_date = $row['appointment_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                // Redirect to manage appointments page
                header('location:' . SITEURL . 'admin/manage-appointments.php');
            }
        } else {
            // Redirect to manage appointments page
            header('location:' . SITEURL . 'admin/manage-appointments.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Doctor Name</td>
                    <td>
                        <input type="text" name="doctor_name" value="<?php echo $doctor_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Doctor Email</td>
                    <td>
                        <input type="text" name="doctor_email" value="<?php echo $doctor_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Fee</td>
                    <td>
                        <input type="number" name="fee" value="<?php echo $fee; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Appointment Date</td>
                    <td>
                        <input type="datetime" name="appointment_date" value="<?php echo $appointment_date; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Active") echo 'selected="selected"'; ?> value="Active">Active</option>
                            <option <?php if ($status == "Cancelled") echo 'selected="selected"'; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Appointment" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether update button is clicked or not
        if (isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $doctor_name = $_POST['doctor_name'];
            $doctor_email = $_POST['doctor_email'];
            $fee = $_POST['fee'];
            $appointment_date = $_POST['appointment_date'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // Update the values
            $sql2 = "UPDATE tbl_appointments SET 
                    doctor_name = '$doctor_name',
                    doctor_email = '$doctor_email',
                    fee = '$fee',
                    appointment_date = '$appointment_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the update was successful or not
            // And redirect to manage appointments page with a message
            if ($res2) {
                // Updated successfully
                $_SESSION['update'] = "<div class='success'>Appointment Updated Successfully</div>";
                header('location:' . SITEURL . 'admin/manage-appointments.php');
            } else {
                // Failed to update
                $_SESSION['update'] = "<div class='error'>Failed to update appointment</div>";
                header('location:' . SITEURL . 'admin/manage-appointments.php');
            }
        }
        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>
