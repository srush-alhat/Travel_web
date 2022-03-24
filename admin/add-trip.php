<?php include('partials/menu.php');?>
<div class="main-content">
    
    <div class="wrapper">
        <h1>Add Trip</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Destination.">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of Destination."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // create php code to display categories from database
                                // 1. create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // execute query
                                $res = mysqli_query($conn, $sql);

                                // count rows to check whether we have categories or not 
                                $count = mysqli_num_rows($res);

                                // if count is greater than zero we have categories else we do not have categories
                                if($count>0)
                                {
                                    // we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title;?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // we dont have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Trip" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php 
        ob_start();
            // check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // add the tripin database
                // echo "clicked";
                // 1. get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether radio button for featured and active are clicked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";   //setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";   //setting the default value
                }
                // 2. upload the image if selected
                // check whether the select image is clicked or not and upload the image only if image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];
                    // check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // image is selected 
                        // A. rename the image
                        // get the extension of selected image (jpg,png,gif,etc)
                        $ext = end(explode('.', $image_name));
                        // create new name for image
                        $image_name = "Trip-Name-".rand(0000,9999).".".$ext;   //new image may be Trip-Name-589.jpg

                        // B. upload the image
                        // get the src path and dst path

                        // source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // destination path for image to br uploaded
                        $dst = "../images/trip/".$image_name;

                        // finally uploaded the trip image
                        $upload = move_uploaded_file($src,$dst);
                        // check whether image is uploaded or not
                        if($upload==false)
                        {
                            // failed to upload the image
                            // redirect to add trip page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/add-trip.php');
                            // stop the process
                            die();
                        }


                    }
                }
                else
                {
                    $image_name = "";   //setting default value as blank
                }
                // 3. insert into database
                // create the sql query to save or add trip
                // for numerical we do not need to pass value '' but the string value it is compulsory to add quotes''
                $sql2 = "INSERT INTO tbl_trip SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);
                // check whether data inserted or not 
                // 4. redeirect the with message to manage trip page

                if($res2==true)
                {
                    // data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Trip Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-trip.php');
                    
                }
                else
                {
                    // failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed  to Add Trip.</div>";
                    header('location:'.SITEURL.'admin/manage-trip.php');
                    ob_end_flush();
                }
                

            }
        ?>
    </div>

</div>
<?php include('partials/footer.php')?>