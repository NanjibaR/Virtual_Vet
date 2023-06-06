<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login - Product Order System</title>
    <link rel="stylesheet" href="../css/doctor.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Doctor Login</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
         <br>

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            Email: <br>
            <input type="text" name="email" placeholder="Enter Email"> <br> <br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br> <br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br> <br>
        </form>

        <p class="text-center">Created By - <a href="WWW.google.com"> Nasim Ahmed</a> </p>
    </div>

</body>

</html>

<?php

//Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //Process for login
    //1. Get the Data from login form
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the doctor with email and password exists or not
    $sql = "SELECT * FROM tbl_doctors WHERE email = '$email' AND password = '$password'";

    //3. Execute the query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the doctor exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {

        //Doctor Available and login success
        $_SESSION['login'] = "<div class='success'> Login Successful. </div>";
        $_SESSION['doctor'] = $email; // To check whether the doctor is logged in or not and logout will unset it.

        // Redirect to doctor page
        header('Location:'.SITEURL.'doctor/doctor.php');
    } else {

        //Doctor Not Available
        $_SESSION['login'] = "<div class='error text-center'> Email or Password did not match. Try again. </div>";
        // Redirect to doctor login page
        header('Location:'.SITEURL.'doctor/doctor-login.php');
    }
}

?>
