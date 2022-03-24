<?php include('partials-front/menu.php');?>
    <!-- travel search section start here -->
     <section class= "travel-search text-center">
        <div class="container">
           <form action="<?php echo SITEURL; ?>travel-search.php" method="POST">
               <input type ="search"  name ="search" placeholder="Search for trip.." required>
               <input type="submit" name="submit" value="search" class="btn btn-primary">
              </form>
          
        </div>
    </section>
    <!--travel search section ends here -->




        <!--Trip plans section start here -->
    <section class= "trip-plan">
        <div class="container">
          <h2 class="text-center">Explore trips</h2>

          <?php 
            // display yrips that are active
            $sql = "SELECT * FROM tbl_trip WHERE active='Yes'";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            // check whether the trips are available or not
            if($count>0)
            {
              // trip available
              while($row=mysqli_fetch_assoc($res))
              {
                // get the values 
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
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
                        <img src="<?php echo SITEURL; ?>images/trip/<?php echo $image_name ?>" alt="india" class="img-responsive img-curve">
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
              echo "<div class='error'>Trip Not Found.</div>";
            }
          ?>
          


              <div class="clearfix"></div>
              
          </div>

        </div>
   </section>
   <!--trip plan section ends here -->
<?php include('partials-front/footer.php');?>