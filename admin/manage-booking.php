<?php include('partials/menu.php');?>

<div class="main-content">
    
    <div class="wrapper">
        <h1>Manage Booking</h1>

        <br /><br />

        <?php
                if(isset($_SESSION['update']))
                {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                }
        ?>
        <br><br>

                        <!-- button to add admin -->
                        

                        
                        <table class="tbl-full">
                                <tr>
                                        <th>S.N</th>
                                        <th>Trip</th>
                                        <th>Price</th>
                                        <th>No travelers</th>
                                        <th>Total</th>
                                        <!-- <th>Booking<br>Date</th> -->
                                        <th>Status</th>
                                        <th>Customer<br>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th> 
                                        <th>Address</th>
                                        <th>Select Date</th>
                                        <th>Actions</th>

                                </tr>

                                <?php
                                        // get alll the booking from database
                                        $sql = "SELECT * FROM tbl_booking ORDER BY id DESC";    //display the lastest order at first
                                        // executing query
                                        $res = mysqli_query($conn, $sql);
                                        // count the rows
                                        $count = mysqli_num_rows($res);

                                        $sn = 1;  //create a serial number and set itsinitial values as 1

                                        if($count>0)
                                        {
                                                // booking available
                                                while($row=mysqli_fetch_assoc($res))
                                                {
                                                        // get all the booking details
                                                        $id = $row['id'];
                                                        $trip = $row['trip'];
                                                        $price = $row['price'];
                                                        $number_of_travelers = $row['number_of_travelers'];
                                                        $total = $row['total'];
                                                        // $booking_date = $row['booking_date'];
                                                        $status = $row['status'];
                                                        $customer_name = $row['customer_name'];
                                                        $customer_contact = $row['customer_contact'];
                                                        $customer_email = $row['customer_email'];
                                                        $customer_address = $row['customer_address'];
                                                        $select_date = $row['select_date'];
                                                        
                                                        
                                                        ?>
                                                                <tr>
                                                                        <td><?php echo $sn++; ?>.</td>
                                                                        <td><?php echo $trip; ?></td>
                                                                        <td><?php echo $price; ?></td>
                                                                        <td><?php echo $number_of_travelers; ?></td>
                                                                        <td><?php echo $total; ?></td>
                                                                        

                                                                        <td>
                                                                                <?php
                                                                                        // booked, on booking, confirm booking, cancelled
                                                                                        if($status=="On Booking")
                                                                                        {
                                                                                                echo "<lable>$status</lable>";
                                                                                        }
                                                                                        elseif($status=="Confirm Booking")
                                                                                        {
                                                                                                echo "<lable style='color: green;'>$status</lable>";
                                                                                        }
                                                                                        elseif($status=="Booked")
                                                                                        {
                                                                                                echo "<lable style='color: blue;'>$status</lable>";
                                                                                        }
                                                                                        elseif($status=="Cancelled")
                                                                                        {
                                                                                                echo "<lable style='color: red;'>$status</lable>";
                                                                                        }
                                                                                ?>
                                                                        </td>

                                                                        <td><?php echo $customer_name; ?></td>
                                                                        <td><?php echo $customer_contact; ?></td>
                                                                        <td><?php echo $customer_email; ?></td>  
                                                                        <td><?php echo $customer_address; ?></td>
                                                                        <td><?php echo $select_date; ?></td>

                                                                        

                                                                        <td>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-booking.php?id=<?php echo $id; ?>" class="btn-secondary">Update Booking</a>
                                                                                
                                                                        </td>
                                                                </tr>
                                                        <?php
                                                }
                                        }
                                        else
                                        {
                                                // booking not available
                                                echo "<tr><td colspan='12' class='error'>Booking Not Available.</td></tr>";
                                        }
                                ?>
                                

                                

                                
                        </table>
    </div>

</div>


<?php include('partials/footer.php')?>