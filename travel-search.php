<?php include('partials-front/menu.php');?>
    <!-- travel search section start here -->
     <section class= "travel-search text-center">
         <div class="container">
            <?php

              // get the search keyword
              // $search = $_POST['search'];
              $search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            <h2>Trips on your search<a href="#" class="text-black">"<?php echo $search; ?>"</a></h2>
           
         </div>
        

    </section>
     <!--travel search section ends here -->

     

    <!--Trip plans section start here -->
    <section class= "trip-plan">
        <div class="container">
          <h2 class="text-center">Explore trips</h2>

          <?php 
            // get the search keyword
            $search = $_POST['search'];

            // sql query to get trips based on search keyword
            // $search = hawai
            // "SELECT * FROM tbl_trip WHERE title LIKE '%hawai%' OR description LIKE '%hawai%'";

            $sql = "SELECT * FROM tbl_trip WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            // check whether trip available or not
            if($count>0)
            {
              // trip available
              while($row=mysqli_fetch_assoc($res))
              {
                // get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                  <div class="trip-plans-box">
                    <div class="trip-plans-img">
                      <?php
                        // chech whether image name is available or not
                        if($image_name=="")
                        {
                          // image not available
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
              echo "<div class='error text-center'>Trip Not Found.</div>";
            }
          ?>
          
              <div class="clearfix"></div>
              
          </div>

        </div>
   </section>
   <!--trip plan section ends here -->
   <?php include('partials-front/footer.php');?>