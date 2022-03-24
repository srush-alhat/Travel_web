<?php include('partials-front/menu.php');?>

<?php
  // check whether the id is passed or not
  if(isset($_GET['category_id']))
  {
    // category id is set and get the id
    $category_id = $_GET['category_id'];
    // get the category title based on category id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // get the value from database
    $row = mysqli_fetch_assoc($res);
    // get the title
    $category_title = $row['title'];
  }
  else
  {
    // category not passed
    // redirect to home page
    header('location:'.SITEURL);
  }
?>
    <!-- travel search section start here -->
     <section class= "travel-search text-center">
        <div class="container">

           <h3>Trips on your search<a href="#" class="text-black">"<?php echo $category_title; ?>"</a></h3>

        </div>
       

   </section>
    <!--travel search section ends here -->

    
    <!--Trip plans section start here -->
    <section class= "trip-plan">
        <div class="container">
          <h2 class="text-center">Explore trips</h2>

          <?php 

            // create sql query to get trip based om selected category
            $sql2 = "SELECT * FROM tbl_trip WHERE category_id=$category_id";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count the rows
            $count2 = mysqli_num_rows($res2);

            // check whether trip is available or not
            if($count2>0)
            {
              // trip is available
              while($row2=mysqli_fetch_assoc($res2))
              {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];

                ?>
                  <div class="trip-plans-box">
                    <div class="trip-plans-img">
                      <?php
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

        </div>
   </section>
   <!--trip plan section ends here -->
<?php include('partials-front/footer.php');?>