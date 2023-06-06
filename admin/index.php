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

    <div class="wrapper wrapper2">
        <h1 style="padding-top: 50px">DASHBOARD</h1>
        <br><br><br><br>


        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>

        <div class="col-4 text-center">
            <?php 
            //sql query
               $sql="SELECT * FROM tbl_admin";
                //execute query
                $res=mysqli_query($conn,$sql);
                //count rows
                $count=mysqli_num_rows($res);

             ?>
            <h1><?php echo $count; ?></h1>
            <br>
            Admin
        </div>
        <div class="col-4 text-center">
            <?php 
            //sql query
               $sql="SELECT * FROM tbl_user";
                //execute query
                $res=mysqli_query($conn,$sql);
                //count rows
                $count=mysqli_num_rows($res);

             ?>
            <h1><?php echo $count; ?></h1>
            <br>
            User
        </div>
        <div class="col-4 text-center">
            <?php 
            //sql query
               $sql2="SELECT * FROM tbl_doctors";
                //execute query
                $res2=mysqli_query($conn,$sql2);
                //count rows
                $count2=mysqli_num_rows($res2);

             ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Doctors
        </div>
        <div class="col-4 text-center">
            <?php 
            //sql query
               $sql2="SELECT * FROM tbl_appointments";
                //execute query
                $res2=mysqli_query($conn,$sql2);
                //count rows
                $count2=mysqli_num_rows($res2);

             ?>
            <h1><?php echo $count2; ?></h1>
            <br>
            Appointments
        </div>

       
        <!-- <div class="clearfix"></div> -->
    </div>
</div>
<!-- footer -->


<?php include('partials/footer.php') ?>