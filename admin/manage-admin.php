<?php include('partials/menu.php');?>
        <!-- main content section start -->
        <div class=" main-content">
                <div class="wrapper">
                        <h1>Manage Admin</h1>

                        <br /><br />
                        <?php
                                if(isset($_SESSION['add']))
                                {
                                        echo $_SESSION['add'];      // displaying session message
                                        unset($_SESSION['add']);    // removing session meassage
                                }

                                if(isset($_SESSION['delete']))
                                {
                                        echo $_SESSION['delete'];      // displaying session message
                                        unset($_SESSION['delete']);    // removing session meassage
                                }

                                if(isset($_SESSION['update']))
                                {
                                        echo $_SESSION['update'];      // displaying session message
                                        unset($_SESSION['update']);    // removing session meassage
                                }

                                if(isset($_SESSION['user-not-found']))
                                {
                                        echo $_SESSION['user-not-found'];      // displaying session message
                                        unset($_SESSION['user-not-found']);    // removing session meassage
                                }

                                if(isset($_SESSION['pwd-not-match']))
                                {
                                        echo $_SESSION['pwd-not-match'];      // displaying session message
                                        unset($_SESSION['pwd-not-match']);    // removing session meassage
                                }

                                if(isset($_SESSION['change-pwd']))
                                {
                                        echo $_SESSION['change-pwd'];      // displaying session message
                                        unset($_SESSION['change-pwd']);    // removing session meassage
                                }
                        ?>
                        <br><br>
                        <!-- button to add admin -->
                        <a href="add-admin.php" class="btn-primary">Add Admin</a>
                        

                        <br /><br /><br />
                        <table class="tbl-full">
                                <tr>
                                        <th>S.N</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Actions</th>
                                </tr>
                                <?php
                                        $sql="SELECT * FROM tbl_admin";
                                        // execute the query
                                        $res=mysqli_query($conn, $sql);

                                        // check weather the query executed or not
                                        if($res==TRUE)
                                        {
                                                // count rows to check weather we have data in database or not
                                                $count=mysqli_num_rows($res);    // function to get all the rows in database

                                                $sn=1;                         // create a variable abd assign the value
                                                // check  the num of rows 
                                                if($count>0)
                                                {
                                                        // we have data in database
                                                        while($rows=mysqli_fetch_assoc($res))
                                                        {
                                                                // using while loop to get all the data from databse
                                                                // and while loop will run as long as we have data in datbase

                                                                // get indivisual data
                                                                $id=$rows['id'];
                                                                $full_name=$rows['full_name'];
                                                                $username=$rows['username'];
                                                                
                                                                // display value in our table
                                                                ?>
                                                                <tr>
                                                                        <td><?php echo $sn++;?></td>
                                                                        <td><?php echo $full_name;?></td>

                                                                        <td><?php echo $username;?></td>
                                                                        <td>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"class="btn-primary">change password</a>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                                
                                                                        </td>
                                                                </tr>
                                                                <?php
                                                        }

                                                }
                                                else
                                                {
                                                        // we do not have data in database
                                                }
                                        }
                                
                                
                                ?>
                        </table>
           
        

            </div>
           
        </div>
        <!-- main content section end -->
<?php include('partials/footer.php');?>