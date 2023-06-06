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

        <h1>Manage Doctors</h1>
        <br><br><br>
        <a href="<?php echo SITEURL; ?>admin/add-doctors.php" class="btn-primary">Add Doctors</a>
        <br> <br> <br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Category</th>
                <th>Address</th>
                <th>Fee</th>
                <th>Image</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>

            <?php
            // Create sql to get the data
            $sql = "SELECT * FROM tbl_doctors";

            // Execute query
            $res = mysqli_query($conn, $sql);

            // Count rows to check whether we have data or not
            $count = mysqli_num_rows($res);

            // Create serial number variable and assign value 1
            $sn = 1;

            if ($count > 0) {
                // We have data in the database
                // Get the data and display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone_number = $row['phone_number'];
                    $category = $row['category'];
                    $address = $row['address'];
                    $fee = $row['fee'];
                    $image_name = $row['image_name'];
                    $available = $row['available'];
                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone_number; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $fee; ?></td>

                        <td>
                            <?php
                            // Check if image name is available or not
                            if ($image_name == "") {
                                echo "<div class ='error'>Image not added.</div>";

                            } else {
                                // Display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/doctors/<?php echo $image_name; ?>"
                                     width='60px'>
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $available; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-doctors.php?id=<?php echo $id; ?>"
                               class="btn-secondary">Update Doctors</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-doctors.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                               class="btn-danger">Delete Doctors</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                // We don't have data
                echo "<tr><td colspan='10' class='error'>Doctors not added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>
