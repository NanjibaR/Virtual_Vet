<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add doctors</h1>

        <br><br>

        <?php
        ob_start();
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST" enctype='multipart/form-data'>
            <table class="tbl-30">
                <tr>
                    <td>name: </td>
                    <td><input type="text" name="name" placeholder="name of the doctors"></td>
                </tr>
                <tr>
                    <td>email: </td>
                    <td><input type="text" name="email" placeholder="email of the doctors"></td>
                </tr>
                <tr>
                    <td>password: </td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td>phone number: </td>
                    <td><input type="number" name="phone_number"></td>
                </tr>
                <tr>
                    <td>category: </td>
                    <td>
                        <select name="category">
                            <option value="General">General</option>
                            <option value="Vet Dentist">Vet Dentist</option>
                            <option value="Vet Cardiologist">Vet Cardiologist</option>
                            <option value="Vet Surgeon">Vet Surgeon</option>
                            <option value="Vet Dermatologist">Vet Dermatologist</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>address: </td>
                    <td><textarea name="address" cols="30" rows="5" placeholder="Address of the Doctor"></textarea></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Doctor"></textarea></td>
                </tr>
                <tr>
                    <td>fee: </td>
                    <td><input type="number" name="fee"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>available: </td>
                    <td>
                        <input type="radio" name="available" value="Yes">Yes
                        <input type="radio" name="available" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add doctors" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone_number = $_POST['phone_number'];
            $category = $_POST['category'];
            $address = $_POST['address'];
            $description = $_POST['description'];
            $fee = $_POST['fee'];

            if(isset($_POST['available']))
            {
                $available = $_POST['available'];
            }
            else
            {
                $available = 'No';
            }

            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name != "")
                {
                    $ext = end(explode('.', $image_name));
                    $image_name = 'doctor-Name_'.rand(000,99999).'.'.$ext;
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/doctors/".$image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                        header('location:'.SITEURL.'admin/add-doctors.php');
                        die();
                    }
                }
            }
            else
            {
                $image_name = "";
            }

            $name = str_replace("'", "\'", $name);
            $description = str_replace("'", "\'", $description);

            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $sql2 = "INSERT INTO tbl_doctors SET
                name = '$name',
                email = '$email',
                password = '$encrypted_password',
                phone_number = $phone_number,
                category = '$category',
                address = '$address',
                description = '$description',
                fee = $fee,
                image_name = '$image_name',
                available = '$available'";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true)
            {
                $_SESSION['add'] = "<div class='success'>doctors Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-doctors.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to Add doctors.</div>";
                header('location:'.SITEURL.'admin/add-doctors.php');
            }
        }
        ob_end_flush();
        ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>
