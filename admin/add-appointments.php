<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Appointments</h1>

        <br><br>

        <?php
        ob_start();
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Doctor Name: </td>
                    <td><input type="text" name="doctor_name" placeholder="Enter Doctor Name"></td>
                </tr>
                <tr>
                    <td>Doctor Email: </td>
                    <td><input type="text" name="doctor_email" placeholder="Enter Doctor Email"></td>
                </tr>
                <tr>
                    <td>Fee: </td>
                    <td><input type="number" name="fee" placeholder="Enter Fee"></td>
                </tr>
                <tr>
                    <td>Appointment Date and Time: </td>
                    <td><input type="datetime-local" name="appointment_date"></td>
                </tr>
                <tr>
                    <td>Patient Name: </td>
                    <td><input type="text" name="customer_name" placeholder="Enter Patient Name"></td>
                </tr>
                <tr>
                    <td>Patient Contact: </td>
                    <td><input type="text" name="customer_contact" placeholder="Enter Patient Contact"></td>
                </tr>
                <tr>
                    <td>Patient Email: </td>
                    <td><input type="text" name="customer_email" placeholder="Enter Patient Email"></td>
                </tr>
                <tr>
                    <td>Patient Address: </td>
                    <td><textarea name="customer_address" cols="30" rows="5" placeholder="Enter Patient Address"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Appointment" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $doctorName = $_POST['doctor_name'];
            $doctorEmail = $_POST['doctor_email'];
            $fee = $_POST['fee'];
            $appointmentDate = $_POST['appointment_date'];
            $customerName = $_POST['customer_name'];
            $customerContact = $_POST['customer_contact'];
            $customerEmail = $_POST['customer_email'];
            $customerAddress = $_POST['customer_address'];

            $sql = "INSERT INTO tbl_appointments (doctor_name, doctor_email, fee, appointment_date, status, customer_name, customer_contact, customer_email, customer_address)
                    VALUES ('$doctorName', '$doctorEmail', $fee, '$appointmentDate', 'Active', '$customerName', '$customerContact', '$customerEmail', '$customerAddress')";
            $res = mysqli_query($conn, $sql);

            if($res == true)
            {
                $_SESSION['add'] = "<div class='success'>Appointment added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-appointments.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add appointment.</div>";
                header('location:'.SITEURL.'admin/add-appointments.php');
            }
        }
        ob_end_flush();
        ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>
