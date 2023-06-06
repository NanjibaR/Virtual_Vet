<?php
    //include constants file
    include('../config/constants.php');
    // echo "delete doctors"; 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //process to delete
        //echo process to delete

        
        //1. get id and image
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. remove image if available
        //check image is available or not and delete only if available
        if($image_name !="")
        {
            //it has image and need to remove from the folder
            //get the image path
            $path = '../images/doctors/'.$image_name;

            //remove image file from folder
            $remove = unlink($path);
            
            //check the image is removed or not 
            if($remove == false)
            {
                //failed to remove massage
                $_SESSION['upload'] = "<div class='error'>Failed to remove Image.</div>";
                //redirect to manage doctors
                header('location:'.SITEURL.'admin/manage-doctors.php');
                //stop the process
                die();
            }
        }
        

        //3. delete doctors from database
        $sql = "DELETE FROM tbl_doctors WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not
        //4. rederct to manage doctors with session message
        if($res == true)
        {
            //doctors delete
            $_SESSION['delete'] = "<div class='success'>doctors Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-doctors.php');
        }
        else
        {
            //fail to delete
             $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
             header('location:'.SITEURL.'admin/manage-doctors.php');
        }
    }
    else
    {
        //redirect to manage doctors page
        //echo 'riderct';
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-doctors.php');
    }
?>