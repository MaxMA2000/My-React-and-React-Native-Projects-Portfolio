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
        <title>productMaint</title>

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
                            $productID = $_POST["productID"];
                            $productDesc = $_POST["productDesc"];
                            $productPrice = $_POST["productPrice"];
                            $productQtyOnHand = $_POST["productQtyOnHand"];
                            $scrPicName = $_FILES["rawfile"]["name"];
                            
                            // Move the picture to pic folder
                            $uploadPATH = "pic/";
                            if  ($action == "A" or $action == "C")
                            {
                                $rawfile    = $_FILES["rawfile"]["name"];
                                $scrPicName = $rawfile;
                                $temp_location = $_FILES["rawfile"]["tmp_name"];
                                $target_location = $uploadPATH . $_FILES["rawfile"]["name"];
                                // echo "temp location = $temp_location <BR>";
                                // echo "target loc = $target_location <BR>";
                                $moveResult = move_uploaded_file($temp_location , $target_location);
                            }

                            // Create connection to Database
                            $servername = "localhost";
                            $username   = "root";
                            $password   = "";
                            $dbname     = "myDB";
                            $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

                            // Action == Add
                            if  ($action == "A")
                            {
                                $sql = "INSERT INTO product(productID, productDesc, productPrice, ProductQtyOnHand, ProductPictureName)
                                VALUES ('".$productID."', '".$productDesc."', ".$productPrice.", ".$productQtyOnHand.", '".$scrPicName."')";
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
                                $sql =        "UPDATE product ";
                                $sql = $sql . " SET productDesc        = " . "'" . $productDesc    . "'" . ","  ;
                                $sql = $sql . "     productPrice       = "       . $productPrice   .       ","  ;
                                $sql = $sql . "     productQtyOnHand   = "       . $productQtyOnHand     .       ","  ;
                                $sql = $sql . "     ProductPictureName = " . "'" . $scrPicName . "'"        ;
                                $sql = $sql . " WHERE productID        = " . "'" . $productID    . "'"        ;
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
                                $sql = "DELETE FROM product WHERE productID= '".$productID."'";
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
                                $sql  = 'select * from product';
                                $rtn  = $conn->query($sql);
                                $cnt  = $rtn->num_rows;
                                
                                echo  "There are " . $cnt . " rows of records in the product table <BR><BR>";

                                echo  '<table border="1">';
                                echo "<TR>";
                                    echo "<TH>Product ID</TH>";
                                    echo "<TH>Product Description</TH>";
                                    echo "<TH>Product Price</TH>";
                                    echo "<TH>Product Quantity On Hand</TH>";
                                    echo "<TH>Product Picture Name</TH>";
                                echo "</TR>";

                                $k = 0;
                                while ( $k < $cnt )
                                {
                                $myRow = $rtn->fetch_assoc();

                                echo "<TR>";
                                    echo "<TD>"    . $myRow["productID"]          . "</TD>";
                                    echo "<TD>"    . $myRow["productDesc"]        . "</TD>"; 
                                    echo "<TD>"    . $myRow["productPrice"]       . "</TD>";
                                    echo "<TD>"    . $myRow["productQtyOnHand"]   . "</TD>";
                                    echo "<TD>"    . $myRow["productPictureName"] . "</TD>";
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
                        <h2 class="title"><center>Product Maintance</center></h2>
                        <form method="POST" action="productMaint.php" enctype="multipart/form-data">
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
                                        <label class="label">Product ID</label>
                                        <input class="input--style-4" type="text" name="productID">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Description</label>
                                        <input class="input--style-4" type="text" name="productDesc">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Price</label>
                                        <input class="input--style-4" type="text" name="productPrice">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Quantity On Hand</label>
                                        <input class="input--style-4" type="text" name="productQtyOnHand">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label class="label">Picture</label>
                                        <input class="input--style-4" type="file" name="rawfile" id="rawfile">
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
