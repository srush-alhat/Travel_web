<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Login-Trip Bookin System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- login forms start here -->
            <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter password"><br><br>

           
            <input type="submit" name="submit" value="login" class="btn-primary">
            <br><br>
            </form>
            <!-- login forms ends here -->


            <p class="text-center">created by- <a href="www.shy-travels.com">SHY TRAVELS</a></p>
        </div>
    </body>
</html>
<?php

    // check whether the submit button clicked or not
    if(isset($_POST['submit']))
    {
        // process for login
        // 1. get teh data from login form
        // $username=$_POST['username'];
        // $password=md5($_POST['password']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password=md5($_POST['password']);
        $password=mysqli_real_escape_string($conn,$raw_password);
        
        // 2. sql to check wether the username & password is exist or not
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. execute the query
        $res=mysqli_query($conn,$sql);

        // 4. count rows to check whether the user exist or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            // user available and login success
            $_SESSION['login']="<div class='success'>Login Successful</div>";
            $_SESSION['user']=$username;              // to check wether user is logged in or not and logout will unset it
            // redirect to homepage or dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // user not available and login failed
            $_SESSION['login']="<div class='error text-center'>Invalid username & password</div>";
            // redirect to homepage or dashboard
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>