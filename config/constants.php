<?php
    // start session
    
    session_start();

    //  create constant to store nonrepeating values
    define('SITEURL', 'http://localhost/shy-web/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'trip-booking');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());               // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());        // select database    
?>