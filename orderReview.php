<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">

        <!-- Title Page-->
        <title>orderReview</title>

        <!-- Icons font CSS-->
        <link href="back/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="back/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <!-- Font special for pages-->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="back/vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="back/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="back/css/main.css" rel="stylesheet" media="all">
    </head>

    <body>
        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="title"><center>Result</center></h2>
                        <?php
                            $orderDate = $_POST["orderDate"];
                            // Create connection to Database
                            $servername = "localhost";
                            $username   = "root";
                            $password   = "";
                            $dbname     = "myDB";
                            $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

                            // Review sql
                            $sql  = 'select * from orders';
                            if (!empty($orderDate)){
                                $sql = $sql." where orderDate = '".$orderDate."'";  
                            }

                            $rtn  = $conn->query($sql);
                            $cnt  = $rtn->num_rows;
                            
                            echo  "There are " . $cnt . " rows of records in the orders table <BR><BR>";

                            echo  '<table border="1">';
                            echo "<TR>";
                                echo "<TH>Order No</TH>";
                                echo "<TH>Order Date</TH>";
                                echo "<TH>Customer ID</TH>";
                                echo "<TH>Product ID</TH>";
                                echo "<TH>Price</TH>";
                                echo "<TH>Quantity</TH>";
                                echo "<TH>Original Amount</TH>";
                                echo "<TH>Discount Percentage</TH>";
                                echo "<TH>Net Amount</TH>";
                            echo "</TR>";

                            $k = 0;
                            while ( $k < $cnt )
                            {
                                $myRow = $rtn->fetch_assoc();

                                echo "<TR>";
                                    echo "<TD>"    . $myRow["orderNo"]          . "</TD>";
                                    echo "<TD>"    . $myRow["orderDate"]        . "</TD>"; 
                                    echo "<TD>"    . $myRow["customerID"]       . "</TD>";
                                    echo "<TD>"    . $myRow["productID"]   . "</TD>";
                                    echo "<TD>"    . $myRow["price"] . "</TD>";
                                    echo "<TD>"    . $myRow["quantity"] . "</TD>";
                                    echo "<TD>"    . $myRow["originalAmount"] . "</TD>";
                                    echo "<TD>"    . $myRow["discountPercentage"] . "</TD>";
                                    echo "<TD>"    . $myRow["netAmount"] . "</TD>";
                                echo "</TR>";

                                $k = $k + 1;
                                }
                                echo  '</table>';

                        ?>
                    </div>
                </div>
            </div>
            <BR>
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="title"><center>Order Review</center></h2>
                        <h4>Review Specific Date Orders<BR>(Click Directly to Review all Orders)</h4><BR>
                        <form method="POST" action="orderReview.php" enctype="multipart/form-data">
                            <div class="row row-space">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label class="label">Order Date (YYYY-MM-DD)</label>
                                        <input class="input--style-4" type="text" name="orderDate">
                                    </div>
                                </div>
                            </div>

                            <div class="p-t-15">
                                <center><button class="btn btn--radius-2 btn--green" type="submit">Submit</button></center>
                            </div>
                            <BR>
                            <div class="p-t-15">
                                <center><button class="btn btn--radius-2 btn--blue" onclick='history.back()'>Go Back</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Jquery JS-->
        <script src="back/vendor/jquery/jquery.min.js"></script>
        <!-- Vendor JS-->
        <script src="back/vendor/select2/select2.min.js"></script>
        <script src="back/vendor/datepicker/moment.min.js"></script>
        <script src="back/vendor/datepicker/daterangepicker.js"></script>

        <!-- Main JS-->
        <script src="back/js/global.js"></script>

    </body>

</html>


