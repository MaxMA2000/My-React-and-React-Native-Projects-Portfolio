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
        <title>customertMaint</title>

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
                            $action = $_POST["action"];
                            $customerID = $_POST["customerID"];
                            $customerName = $_POST["customerName"];
                            $customerClass = $_POST["customerClass"];
                            $AccumulatedBonusPoint = $_POST["AccumulatedBonusPoint"];
                            $customerEmail = $_POST["customerEmail"];

                            // Create connection to Database
                            $servername = "localhost";
                            $username   = "root";
                            $password   = "";
                            $dbname     = "myDB";
                            $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

                            // Action == Add
                            if  ($action == "A")
                            {
                                $sql = "INSERT INTO customer (customerID, customerName, customerClass, AccumulatedBonusPoint, customerEmail)
                                VALUES ('".$customerID."', '".$customerName."', ".$customerClass.", ".$AccumulatedBonusPoint.", '".$customerEmail."')";
                                // echo $sql . "<BR>";

                                $result = $conn->query($sql);
                                
                                if  ($result == TRUE){
                                    echo "Insert Succesful <BR>";
                                }else{
                                    echo "Insert Failure! Please Call IT Staff!<BR>";
                                }
                            }

                            // Action == Change
                            if  ($action == "C")
                            {
                                $sql =        "UPDATE customer ";
                                $sql = $sql . " SET customerName        = " . "'" . $customerName    . "'" . ","  ;
                                $sql = $sql . "     customerClass       = "       . $customerClass   .       ","  ;
                                $sql = $sql . "     AccumulatedBonusPoint   = "       . $AccumulatedBonusPoint     .       ","  ;
                                $sql = $sql . "     customerEmail = " . "'" . $customerEmail . "'"        ;
                                $sql = $sql . " WHERE customerID        = " . "'" . $customerID    . "'"        ;
                                // echo $sql . "<BR>";

                                $result = $conn->query($sql);

                                if  ($result == TRUE){
                                    echo "Update Succesful <BR>";
                                }else{
                                    echo "Update Failure! Please Call IT Staff!<BR>";
                                }
                            }

                            // Action == Delete
                            if  ($action == "D")
                            {
                                $sql = "DELETE FROM customer WHERE customerID= '".$customerID."'";
                                // echo $sql."<BR>";

                                $result = $conn->query($sql);

                                if  ($result == TRUE){
                                    echo "Delete Succesful <BR>";
                                }else{
                                    echo "Delete Failure! Please Call IT Staff!<BR>";
                                }
                            }

                            // Action == Review
                            if  ($action == "R")
                            {
                                $sql  = 'select * from customer';
                                $rtn  = $conn->query($sql);
                                $cnt  = $rtn->num_rows;
                                
                                echo  "There are " . $cnt . " rows of records in the customer table <BR><BR>";

                                echo  '<table border="1">';
                                echo "<TR>";
                                    echo "<TH>Customer ID</TH>";
                                    echo "<TH>Customer Name</TH>";
                                    echo "<TH>Customer Class</TH>";
                                    echo "<TH>Accumulated Bonus Point</TH>";
                                    echo "<TH>Customer Email</TH>";

                                echo "</TR>";

                                $k = 0;
                                while ( $k < $cnt )
                                {
                                $myRow = $rtn->fetch_assoc();

                                echo "<TR>";
                                    echo "<TD>"    . $myRow["customerID"]          . "</TD>";
                                    echo "<TD>"    . $myRow["customerName"]        . "</TD>"; 
                                    echo "<TD>"    . $myRow["customerClass"]       . "</TD>";
                                    echo "<TD>"    . $myRow["AccumulatedBonusPoint"]   . "</TD>";
                                    echo "<TD>"    . $myRow["customerEmail"] . "</TD>";
                                echo "</TR>";

                                $k = $k + 1;
                                }
                                echo  '</table>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <BR>
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h2 class="title"><center>Customer Maintance</center></h2>
                        <form method="POST" action="customerMaint.php">
                            <div class="row row-space">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label class="label">Action</label>
                                        <div class="p-t-10">
                                            <label class="radio-container m-r-45">Add
                                                <input type="radio" checked="checked" name="action" value="A">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-container m-r-45">Change
                                                <input type="radio" name="action" value="C">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-container m-r-45">Delete
                                                <input type="radio" name="action" value="D">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio-container m-r-45">Review
                                                <input type="radio" name="action" value="R">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Customer ID</label>
                                        <input class="input--style-4" type="text" name="customerID">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Customer Name</label>
                                        <input class="input--style-4" type="text" name="customerName">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Customer Class</label>
                                        <input class="input--style-4" type="text" name="customerClass">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Accumulated Bonus Point</label>
                                        <input class="input--style-4" type="text" name="AccumulatedBonusPoint">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label class="label">Email</label>
                                        <input class="input--style-4" type="text" name="customerEmail">
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

<!-- 
<html>
    <head>
        <title>customertMaint</title>
    </head>
    <body>
        <center><h3>Customer Maintance</h3></center>
        <form method="POST" action="http://127.0.0.1/webproject/customerMaint.php">
            <input type="radio" name="action" value="A" />Add  
            <input type="radio" name="action" value="C" />Change 
            <input type="radio" name="action" value="D" />Delete
            <input type="radio" name="action" value="R" />Review <BR>    

            Customer ID  : <input type="text" size="20" name="customerID" /><BR>
            Customer Name : <input type="text" size="20" name="customerName" /><BR>
            Customer Class: <input type="text" size="20" name="customerClass" /><BR>
            Accumulated Bonus Point   : <input type="text" size="20" name="AccumulatedBonusPoint" /><BR>
            Email   : <input type="text" size="20" name="customerEmail" /><BR>
            
            <input type="submit">
        </form>

        

        <button onclick='history.back()'>Go Back</button>
    </body>
</html> -->