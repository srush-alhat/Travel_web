<?php
    // include constants page
    include('../config/constants.php');

    // echo "delete trip page";

    if(isset($_GET['id']) && isset($_GET['image_name']))  //either use '&&' or 'AND'
    {
        // procee to delete
        // echo "Process to delete";

        // 1. get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        // 2. remove the image if available
        // check whether the image is available or not and delete only if available
        if($image_name !="")
        {
            // it has image and need to remove from folder
            // get the image path
            $path = "../images/trip/".$image_name;

            // remove image file from folder
            $remove = unlink($path);

            // check whether the image is removed or not
            if($remove==false)
            {
                // failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                header('location:'.SITEURL.'admin/manage-trip.php');

                // stop the process of deleting trip
                die();
            }
        }

        // 3. delete trip from database
        $sql = "DELETE FROM tbl_trip WHERE id=$id";
        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the query executed or not and set the session message respectively

        // 4. redirect to manage trip with session message
        if($res==true)
        {
            // trip deleted
            $_SESSION['delete'] = "<div class='success'>Trip Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-trip.php');
        }
        else
        {
            // failed ro delete trip
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Trip.</div>";
            header('location:'.SITEURL.'admin/manage-trip.php');
        }

        
    }
    else
    {
        // redirect to manage trip page
        // echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-trip.php');
    }
?>