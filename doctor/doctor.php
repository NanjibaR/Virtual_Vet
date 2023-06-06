<?php include('doctor_header.php') ?>

<!-- main -->
<div class="main-content">
    <div class="wrapper">
        <!-- Display doctor details -->
        <?php
        // Retrieve doctor details from the tbl_doctors table
        $email = $_SESSION['doctor'];
        $sql = "SELECT * FROM tbl_doctors WHERE email = '$email'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $doctorName = $row['name'];
                $phoneNumber = $row['phone_number'];
                $category = $row['category'];
                $address = $row['address'];
                $description = $row['description'];
                $fee = $row['fee'];
                $imageName = $row['image_name'];
                $available = $row['available'];
                ?>
                <div class="doctor-details">
                    <h2>Doctor Details</h2>
                    <div class="doctor-info">
                        <div class="doctor-image">
                            <img src="../images/doctors/<?php echo $imageName; ?>" alt="Doctor Image">
                        </div>
                        <div class="doctor-data">
                            <p><strong>Name:</strong> <?php echo $doctorName; ?></p>
                            <p><strong>Email:</strong> <?php echo $email; ?></p>
                            <p><strong>Phone Number:</strong> <?php echo $phoneNumber; ?></p>
                            <p><strong>Category:</strong> <?php echo $category; ?></p>
                            <p><strong>Address:</strong> <?php echo $address; ?></p>
                            <p><strong>Description:</strong> <?php echo $description; ?></p>
                            <p><strong>Fee:</strong> <?php echo $fee; ?></p>
                            <p><strong>Availability:</strong> <?php echo $available; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "<p>No doctor details found.</p>";
            }
        } else {
            echo "<p>Failed to retrieve doctor details.</p>";
        }
        ?>
    </div>
</div>

<!-- footer -->
<?php include('footer.php') ?>
