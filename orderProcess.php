<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>OrderProcess</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
    
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    input[type=submit] {
        width: 100%;
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=submit]:hover {
        background-color: #45a049;
    }
    
    </style>
</head>

<body>
    <?php
        // step 1 capture input
        $scrProdID = $_POST["productID"];
        $scrQty = $_POST["quantity"];
        $scrCustID = $_POST["customerID"];
    
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "myDB";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

        //  step 2 validation
        $errorExist = "N";

        //  step 2.1 product validation
        //  step 2.1.1 product must exist
        $sql = "SELECT * FROM product WHERE productID = " . "'" . $scrProdID . "'";

        $rtn = $conn->query($sql);
        $cnt = $rtn->num_rows;

        if($cnt == 1)
        {
            $myRow = $rtn->fetch_assoc();
            $price = $myRow["productPrice"];
            $qtyOnHand = $myRow["productQtyOnHand"];
            $errorMessage = "";
        
            
            // step 2.1.2 Qty must be enough
            if ($scrQty > $qtyOnHand)
            {
                $errorMessage =  "Insufficient quantity! <BR>";
                $errorExist = "Y";
                $purchaseResult = "Payment Fail!";
            }
        }
        else
        {
            $errorMessage =  "Product does not exist <BR>";
            $errorExist = "Y";
            $purchaseResult = "Payment Fail!";
        }

        //  step 2.2 customer validation
        $sql = "SELECT * FROM customer WHERE customerID = " . "'" . $scrCustID . "'";

        $rtn = $conn->query($sql);
        $cnt = $rtn->num_rows;

        if($cnt == 1)
        {
            $myRow = $rtn->fetch_assoc();
            $class = $myRow["customerClass"];
            $point = $myRow["AccumulatedBonusPoint"];
        }
        else
        {
            $errorMessage =  "Customer does not exist <BR>";
            $errorExist = "Y";
            $purchaseResult = "Payment Fail!";
        }


        if ($errorExist == "N"){
            //  step 3 calculation
            $discount = 0;
            if ($class == 3)
            {
                $discount = 0.065;
            }
            else
            {
                if ($class == 2)
                {
                    $discount = 0.04;
                }
            }

            $originalAmt = $price * $scrQty;
            $netAmt = $originalAmt * (1 - $discount);

            $newPoint = $point + $netAmt;
            $newQty = $qtyOnHand - $scrQty;

            //  step 4 update database
            //  step 4.1 insert orders
            $sql = "INSERT INTO orders (orderDate, customerID, productID, price, quantity, originalAmount, discountPercentage, netAmount)
                    VALUES (CURDATE(), '" . $scrCustID . "', '" . $scrProdID . "', " . $price . ", " . $scrQty . ", " . $originalAmt . ", " . $discount . ", " . $netAmt . ")";
            $resultInsert = $conn->query($sql);

            //  step 4.2 update customer point and product qty
            $sql = "UPDATE customer SET AccumulatedBonusPoint = " . $newPoint . " WHERE customerID = '" . $scrCustID . "'";
            $resultUpdateC = $conn->query($sql);

            $sql = "UPDATE product SET productQtyOnHand = " . $newQty . " WHERE productID = '" . $scrProdID . "'";
            $resultUpdateP = $conn->query($sql);

            if ($resultInsert && $resultUpdateC && $resultUpdateP){
                $purchaseResult = "Payment successful! You paid $".$netAmt;
                $additionalInfo = "<p>Thank you for your purchase! Want to find out more?<BR><BR>We have updated your purhcase information!<BR><BR>The product will be delivered to you as soon as possible!</p>";
                $additionalInfo = $additionalInfo."<p>Purchase Details:";
                $additionalInfo = $additionalInfo."<BR>Price per item: ".$price;
                $additionalInfo = $additionalInfo."<BR>Quantity: ".$scrQty;
                $additionalInfo = $additionalInfo."<BR>Original amount: ".$originalAmt;
                $additionalInfo = $additionalInfo."<BR>Discount ".$discount;
                $additionalInfo = $additionalInfo."<BR>Gain new points: ".$netAmt;
                $additionalInfo = $additionalInfo."<BR>Net Amount ".$netAmt."</p>";

            }else{
                $purchaseResult = "Payment Fail!";
                $additionalInfo = "<p>We are really sorry for the failure of purchase<BR><BR>Please check the error message below or contact our customer service<BR><BR></p>";
                $additionalInfo = $additionalInfo."<p style='font-weight: bold;'>Error: ".$errorMessage."</p>";
            }
        }else{
            $purchaseResult = "Payment Fail!";
            $additionalInfo = "<p>We are really sorry for the failure of purchase<BR><BR>Please check the error message below or contact our customer service<BR><BR></p>";
            $additionalInfo = $additionalInfo."<p style='font-weight: bold;'>Error: ".$errorMessage."</p>";
        }

        // close connection
        $conn->close();
    ?>

    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?php echo $purchaseResult; ?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <?php echo $additionalInfo; ?>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Let's discover more intesting products!</h4>
              <form method="POST" action="index.html">
                <input type="submit" value="Go Back Shopping"> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>