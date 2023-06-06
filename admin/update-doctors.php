<?php include("partials/menu.php")?>

<?php
ob_start();
            
// check whether the id is set or not
if(isset($_GET['id']))
{
    // get the id and all the details
    $id = $_GET['id'];
                
    //create sql query to get all other details
    $sql2 = "SELECT * FROM tbl_doctors WHERE id=$id";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual value of selected doctors
    $name = $row2['name'];
    $email = $row2['email'];
    $phone_number = $row2['phone_number'];
    $category = $row2['category'];
    $address = $row2['address'];
    $description = $row2['description'];
    $fee = $row2['fee'];
    $current_image = $row2['image_name'];
    $available = $row2['available'];
}
else
{
    //redirect to manage doctors
    header('location:'.SITEURL.'admin/manage-doctors.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Doctor</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" value="">
                    </td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td>
                        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <option value="General" <?php if($category == "General") echo "selected"; ?>>General</option>
                            <option value="Vet Dentist" <?php if($category == "Vet Dentist") echo "selected"; ?>>Vet Dentist</option>
                            <option value="Vet Cardiologist" <?php if($category == "Vet Cardiologist") echo "selected"; ?>>Vet Cardiologist</option>
                            <option value="Vet Surgeon" <?php if($category == "Vet Surgeon") echo "selected"; ?>>Vet Surgeon</option>
                            <option value="Vet Dermatologist" <?php if($category == "Vet Dermatologist") echo "selected"; ?>>Vet Dermatologist</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <textarea name="address" cols="25" rows="4"><?php echo $address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="25" rows="4"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Fee:</td>
                    <td>
                        <input type="number" name="fee" value="<?php echo $fee; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image == "")
                        {
                            // Image not available
                            echo '<div class="error">Image not available.</div>';
                        }
                        else
                        {
                            // Image available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/doctors/<?php echo $current_image; ?>" width="100px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Available:</td>
                    <td>
                        <input <?php if($available == "Yes"){echo "checked";}?> type="radio" name="available" value="Yes">Yes
                        <input <?php if($available == "No"){echo "checked";}?> type="radio" name="available" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Doctor" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            // Get all the details from the form
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone_number = $_POST['phone_number'];
            $category = $_POST['category'];
            $address = $_POST['address'];
            $description = $_POST['description'];
            $fee = $_POST['fee'];
            $current_image = $_POST['current_image'];
            $available = $_POST['available'];

            // Encrypt the password
            $encrypted_password = md5($password);

            // Upload the new image if selected
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name']; // New image name

                if($image_name != "")
                {
                    // Image available
                    $ext = end(explode('.', $image_name));
                    $image_name = 'doctors-Name_' . rand(000, 99999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/doctors/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                        header('location:' . SITEURL . 'admin/manage-doctors.php');
                        die();
                    }

                    // Remove the current image if a new image is selected and the current image exists
                    if($current_image != "")
                    {
                        $remove_path = "../images/doctors/" . $current_image;
                        $remove = unlink($remove_path);

                        if($remove == false)
                        {
                            $_SESSION['failed-remove'] = '<div class="error">Failed to remove current image.</div>';
                            header('location:' . SITEURL . 'admin/manage-doctors.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            // Update the data in the database
            $name = str_replace("'", "\'", $name);
            $email = str_replace("'", "\'", $email);
            $address = str_replace("'", "\'", $address);
            $description = str_replace("'", "\'", $description);

            $sql3 = "UPDATE tbl_doctors SET
                        name = '$name',
                        email = '$email',
                        password = '$encrypted_password',
                        phone_number = '$phone_number',
                        category = '$category',
                        address = '$address',
                        description = '$description',
                        fee = '$fee',
                        image_name = '$image_name',
                        available = '$available'
                        WHERE id = '$id'";

            $res3 = mysqli_query($conn, $sql3);

            if($res3 == true)
            {
                $_SESSION['update'] = '<div class="success">Doctor updated successfully.</div>';
                header('location:' . SITEURL . 'admin/manage-doctors.php');
            }
            else
            {
                $_SESSION['update'] = '<div class="error">Failed to update doctor.</div>';
                header('location:' . SITEURL . 'admin/manage-doctors.php');
            }
        }
        ?>

    </div>
</div>

<?php include("partials/footer.php");?>
