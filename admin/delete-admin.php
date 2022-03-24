<?php
    // include constants.php file here
    include('../config/constants.php');

    // 1. get the Id of Admin to be deleted
    $id = $_GET['id'];

    // 2. create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // chech weather the query executed successfully or not
    if($res==true)
    {
        // qurey executed successfully and admin deleted
        // echo "Admin Deleted";
        // create session variable to display message
        $_SESSION['delete']= "<div class='success'>Admin Deleted Successsfully.</div>";
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed to delete admin
        // echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3. Redirect to Manage Admin page with message
?>