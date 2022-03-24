<?php include('partials-front/menu.php');?>
    <!-- travel search section start here -->
     <section class= "travel-search text-center">
         <div class="container">
            <form action="<?php echo SITEURL; ?>travel-search.php" method="POST">
                <input type ="search"  name ="search" placeholder="Search for Trip.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
               </form>
           
         </div>
        

    </section>
     <!--travel search section ends here -->

    <?php 
        if(isset($_SESSION['booking']))
        {
            echo $_SESSION['booking'];
            unset($_SESSION['booking']);
        }
    ?>

     <!--categories section start here -->
     <section class= "categories">
         <div class="container">
         
            <h2 class="text-center">Top Destinations</h2>

            <?php 
                // create sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
                // execute the query
                $res = mysqli_query($conn, $sql);
                // count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the values like title, image name,id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-trip.php?category_id=<?php echo $id;?>">
                                <div class="Box-3 float-container">
                                    <?php
                                        // check whether image is available or not 
                                        if($image_name=="")
                                        {
                                            // display message
                                            echo "<div class='error'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            // image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="india" class="SK img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    } 
                }
                else
                {
                    // categories not available
                    echo "<div class='error'>Category Not Added.</div>";
                }
            ?>
            

    

            <div class="clearfix"></div>
        </div>
    </section>
    <!--categories section ends here -->

    <!--Trip plans section start here -->
    <section class= "trip-plan">
        <div class="container">
            <h2 class="text-center">Top Selling</h2>
            
            <?php
            // getting trips from database that are active and featured
            // sql query
            $sql2 = "SELECT * FROM tbl_trip WHERE active='Yes' AND featured='Yes' LIMIT 8";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count rows
            $count2 = mysqli_num_rows($res2);

            // check whether trip available or not
            if($count2>0)
            {
                // trip available
                while($row=mysqli_fetch_assoc($res2))
                {
                    // get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    ?>
                    <div class="trip-plans-box">
                        <div class="trip-plans-img">
                            <?php
                                // check whether image available or not
                                if($image_name=="")
                                {
                                    // image not available
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/trip/<?php echo $image_name; ?>" alt="india" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="trip-plans-desc">
                            <h3><?php echo $title; ?></h3>
                            <p class="details">
                                <?php echo $description; ?>
                            </p>
                            <P class="price">$<?php echo $price; ?></P>
                            
                            <br>

                            <a href="<?php echo SITEURL; ?>booking.php?trip_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                // trip not available
                echo "<div class='error'>Trip Not Available.</div>";
            }
            ?>
            

              
            <div class="clearfix"></div>
              
          

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL;?>trips.php">Explore All Trips</a>
        </p>
   </section>
   <!--trip plan section ends here -->
<?php include('partials-front/footer.php');?>