<!-- This file aims to create a database -->

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    // Create Connection
    $conn = new mysqli($servername, $username, $password) or die("Connection Failed");
    // Create database
    $sql = "CREATE DATABASE myDB";
    if($conn->query($sql) == TRUE)
    {
      echo "Database created successfully";
    }
    else
    {
        echo "Error creating database: ".$conn->error;
    }
    $conn->close();
?>