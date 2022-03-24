<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Booking</h1>
        <br><br>

        <?php
            // check whether id is set or not
            if(isset($_GET['id']))
            {
                // get the booking details
                $id=$_GET['id'];

                // get all booking details based on this id
                // sql query to get the booking details
                $sql = "SELECT * FROM tbl_booking WHERE id=$id";
                // executeing query 
                $res = mysqli_query($conn, $sql);
                // count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // details available
                    $row = mysqli_fetch_assoc($res);

                    $trip = $row['trip'];
                    $price = $row['price'];
                    $number_of_travelers = $row['number_of_travelers'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $select_date = $row['select_date'];
                    

                }
                else
                {
                    // details not available
                    // redirect to manage booking
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
            }
            else
            {
                // redirect to manage trip page
                header('location:'.SITEURL.'admin/manage-booking.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Trip Name:</td>
                    <td><h3> <?php echo $trip; ?> </h3></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td> $ <?php echo $price; ?></td>
                </tr>

                <tr>
                    <td>Number_Of_Travelers:</td>
                    <td>
                        <input type="number" name="number_of_travelers" value="<?php echo $number_of_travelers; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="On Booking"){echo "selected";} ?>value="On Booking">On Booking</option>
                            <option <?php if($status=="Confirm Booking"){echo "selected";} ?>value="Confirm Booking">Confirm Booking</option>
                            <option <?php if($status=="Booked"){echo "selected";} ?> value="Booked">Booked</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Select Date: </td>
                    <td>
                        <input type="date" name="select_date" value="<?php echo $select_date; ?>">
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Booking" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            // check whether update nbutton is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // get all the values from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $number_of_travelers = $_POST['number_of_travelers'];

                $total = $price * $number_of_travelers;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                $select_date = $_POST['select_date'];

                // update the values
                $sql2 = "UPDATE tbl_booking SET
                    number_of_travelers = $number_of_travelers,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address',
                    select_date = '$select_date'
                    WHERE id=$id
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether update or not
                // and redirect to manage trip with message
                if($res2==true)
                {
                    // updated
                    $_SESSION['update'] = "<div class='success'>Booking Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }
                else
                {
                    // failed to update
                    $_SESSION['update'] = "<div class='error'>Failed To Update Booking.</div>";
                    header('location:'.SITEURL.'admin/manage-booking.php');
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>