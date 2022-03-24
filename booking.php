<?php
ob_start();
?>
<?php include('partials-front/menu.php');?>

    <?php 
        // check whether trip id is set or not
        if(isset($_GET['trip_id']))
        {
            // get the trip id and details of the selected trip
            $trip_id = $_GET['trip_id'];
            // get the details of the selected trip
            $sql = "SELECT * FROM tbl_trip WHERE id=$trip_id";
            // execute the query
            $res = mysqli_query($conn, $sql);
            // $count the rows
            $count = mysqli_num_rows($res);
            // check whether the data is available or not
            if($count==1)
            {
                // we have data
                // get the data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $description =$row['description'];
                $image_name = $row['image_name'];
            }
            else
            {
                // trip not available
                // redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            // redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- trip booking section starts here -->

    <section class="trip-search">
        <div class="container">

            <h2 class="text-center">Fill this form to confirm your booking.</h2>

            <form action="" method="POST" class="booking">
                <fieldset>
                    <legend>Selected Places</legend>
                    <div class="trip-plans-img">
                        <?php 
                            // check whether the image is available or not
                            if($image_name=="")
                            {
                                // image not available
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                // image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/trip/<?php echo $image_name ?>" alt="india" class="images responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>

                    <div class="trip-plans-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="trip" value="<?php echo $title; ?>">

                        <p class="price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="details"><?php echo $description; ?></p>
                        <div class="booking-label"> Number of travelers:</div>
                        <input type="number" name="number_of_travelers" class="input-responsive" value="1" required>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Booking Details</legend>
                    <div class="booking-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Harshada Awhale" class="input-responsive" required>

                    <div class="booking-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="booking-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hap.0012@mail.com" class="input-responsive" required>

                    <div class="booking-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="booking-label">Booking Date</div>
                    <input type="date" name="booking_date" placeholder="E.g. sunday ,oct30 ,2021" class="input-responsive" required>

                    <div class="booking-label">Select Date</div>
                    <input type="date" name="select_date" placeholder="E.g. sunday ,oct30 ,2021" class="input-responsive" required>


                    <input type="submit" name="submit" value="Confirm Booking" class="btn btn-primary">
                    
                    <!-- <a href="thank-you.html" >
                        <input type="submit" name="submit"  class="btn btn-primary"  value="Confirm Booking"/>
                    
                   </a>  -->
              
                </fieldset>
            </form>
            <?php 
                // check whether submit button is clicked or not
                if(isset($_POST ['submit']))
                {
                    // get all the details from the form

                    $trip = $_POST['trip'];
                    $price = $_POST['price'];
                    $number_of_travelers = $_POST['number_of_travelers'];

                    $total = $price * $number_of_travelers;    //total = price * number_of_travelers

                    $booking_date = date("Y-m-d h:i:sa");  //booking date
                    $status = "Booked";    //Booked, cancelled

                    $customer_name = $_POST['full_name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $select_date = $_POST['select_date'];
                    
                    // save the booking in database
                    // create sql to save the data
                    $sql2 = "INSERT INTO tbl_booking SET
                        trip = '$trip',
                        price = $price,
                        number_of_travelers = $number_of_travelers,
                        total = $total,
                        booking_date = '$booking_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        select_date = '$select_date'
                    ";

                    // echo $sql2; die();

                    // execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // check whether query executed successfully or not
                    if($res2==true)
                    {
                        // query executed and booking save
                        $_SESSION['booking'] = "<div class='success text-center'>Trip Booked Successfully.<br><br>Thank You For Booking.Keep Travelling With Us.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        // failed to save booking
                        $_SESSION['booking'] = "<div class='error text-center'>Failed to Booking Trip.</div>";
                        header('location:'.SITEURL);
                        ob_end_flush();
                    }

                }
            ?>
        </div>

    </section>
    <?php include('partials-front/footer.php');?>