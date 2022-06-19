<!-- This file aims to insert data to tables created before -->

<?php

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "myDB";

    // Create connection    
    $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

    // Insert data to product table
    echo "<BR>Inserting data to product table...<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P01', 'T-shirt', 100, 30, 'product_01.jpg')";
    $result = $conn->query($sql);
    echo "data1: result = " . $result . "<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P02', 'Simple Hoodie', 150, 40, 'product_02.jpg')";
    $result = $conn->query($sql);
    echo "data2: result = " . $result . "<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P03', 'Flower Hoodie', 200, 30, 'product_03.jpg')";
    $result = $conn->query($sql);
    echo "data3: result = " . $result . "<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P04', 'Girl Pant', 120, 50, 'product_04.jpg')";
    $result = $conn->query($sql);
    echo "data4: result = " . $result . "<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P05', 'Boy Pant', 120, 50, 'product_05.jpg')";
    $result = $conn->query($sql);
    echo "data5: result = " . $result . "<BR>";

    $sql = "INSERT INTO product (productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
            VALUES ('P06', 'Shoe', 200, 40, 'product_06.jpg')";
    $result = $conn->query($sql);
    echo "data6: result = " . $result . "<BR>";

    // Insert data to customer table
    echo "<BR>Inserting data to customer table...<BR>";

    $sql = "INSERT INTO customer (customerID, customerName, customerClass, AccumulatedBonusPoint, customerEmail)
            VALUES ('C01', 'Jack', 1, 0, 'jack@gmail.com')";  // class1 - no discount
    $result = $conn->query($sql);
    echo "data1: result = " . $result . "<BR>";

    $sql = "INSERT INTO customer (customerID, customerName, customerClass, AccumulatedBonusPoint, customerEmail)
            VALUES ('C02', 'Max', 2, 100, 'max@gmail.com')";  // class2 - 4% discount
    $result = $conn->query($sql);
    echo "data2: result = " . $result . "<BR>";
    
    $sql = "INSERT INTO customer (customerID, customerName, customerClass, AccumulatedBonusPoint, customerEmail)
            VALUES ('C03', 'Mary', 3, 200, 'mary@gmail.com')";  // class3 - 6.5% discount
    $result = $conn->query($sql);
    echo "data3: result = " . $result . "<BR>";

    $sql = "INSERT INTO customer (customerID, customerName, customerClass, AccumulatedBonusPoint, customerEmail)
            VALUES ('C04', 'Henry', 3, 300, 'henry@gmail.com')";  // class3 - 6.5% discount
    $result = $conn->query($sql);
    echo "data4: result = " . $result . "<BR>";

    // Insert data to orders table
    echo "<BR>orders table data will be added automatlly with transactions...<BR>";

    // Insert data to maintUser table
    echo "<BR>Inserting data to mainUser table...<BR>";

    $sql = "INSERT INTO maintUser (employeeID, employeePassword, employeeLevel)
            VALUES ('admin1', 'password1', 1)";         // 1 level employee can maint maintUser table
    $result = $conn->query($sql);
    echo "data1: result = " . $result . "<BR>";

    $sql = "INSERT INTO maintUser (employeeID, employeePassword, employeeLevel)
            VALUES ('admin2', 'password2', 2)";         // 2 level employee cannot maint maintUser table
    $result = $conn->query($sql);
    echo "data2: result = " . $result . "<BR>";

    $sql = "INSERT INTO maintUser (employeeID, employeePassword, employeeLevel)
    VALUES ('admin3', 'password3', 2)";                 // 2 level employee cannot maint maintUser table
    $result = $conn->query($sql);
    echo "data3: result = " . $result . "<BR>";

    $conn->close();
?> 

