<!-- This file aims create tables in the database created previously -->

<?php

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "myDB";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

    // Drop previous created tables if exists
    $sql = "DROP table product, customer, orders, maintUser";
    if ($conn->query($sql) === TRUE){
        echo "Drop Table 'product','customer','order','maintUser' successfully <BR>";
    }else{
        echo "Error Drop Table: "   .$conn->error."<BR>";
    }

    // Create product table
    $sql = "CREATE TABLE product (
        productID           VARCHAR(30) NOT NULL PRIMARY KEY,
        productDesc         VARCHAR(30) NOT NULL,
        productPrice        DECIMAL(6,2),
        productQtyOnHand    INT,
        productPictureName VARCHAR(30)
        )"; 

    if ($conn->query($sql)===TRUE){
        echo "Table 'product' created successfully <BR>";
    }else{
        echo "Error creating 'product' table: ".$conn->error."<BR>";
    }

    // Create customer table
    $sql = "CREATE TABLE customer (
        customerID              VARCHAR(30) NOT NULL PRIMARY KEY,
        customerName            VARCHAR(30) NOT NULL,
        customerClass           DECIMAL(6,2) NOT NULL,
        AccumulatedBonusPoint   DECIMAL(6,2) NOT NULL,
        customerEmail           VARCHAR(30)
        )";
    if ($conn->query($sql)==TRUE){
        echo "Table 'customer' created successfully <BR>";
    }else{
        echo "Error creating 'customer' table: ".$conn->error."<BR>";
    }

    // Create order table
    $sql = "CREATE TABLE orders (
        orderNo             INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        orderDate           DATE,
        customerID          VARCHAR(30),
        productID           VARCHAR(30),
        price               DECIMAL(6,2),
        quantity            INT,
        originalAmount      DECIMAL(6,2),
        discountPercentage  DECIMAL(6,2),
        netAmount           DECIMAL(6,2)
        )";

    if ($conn->query($sql)==TRUE){
        echo "Table 'order' created successfully <BR>";
    }else{
        echo "Error creating 'order' table: ".$conn->error."<BR>";
    }

    // Create maintUser table
    $sql = "CREATE TABLE maintUser (
        employeeID          VARCHAR(30) NOT NULL PRIMARY KEY,
        employeePassword    VARCHAR(30) NOT NULL,
        employeeLevel       INT
        )";
    if ($conn->query($sql)==TRUE){
        echo "Table 'maintUser' created successfully <BR>";
    }else{
        echo "Error creating 'maintUser' table: ".$conn->error."<BR>";
    }

    // close connection
    $conn->close();
?> 

