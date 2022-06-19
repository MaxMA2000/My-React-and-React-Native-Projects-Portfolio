<html>
    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">

        <!-- Title Page-->
        <title>Maint</title>

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
        <?php
            // receive user input and check with maintUser table in the DB
            $employeeID = $_POST["employeeID"];
            $employeePassword = $_POST["employeePassword"];

            $servername = "localhost";
            $username   = "root";
            $password   = "";
            $dbname     = "myDB";
            $conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed");

            $sql  = 'SELECT * FROM maintuser WHERE ';
            $sql = $sql."employeeID = '".$employeeID."'";
            $sql = $sql." AND employeePassword = '".$employeePassword."'";

            $rtn  = $conn->query($sql);
            $cnt  = $rtn->num_rows;

            // check whether login is successful
            if ($cnt>=1) {
                $message = "Login Successfully!<BR>Hello, ".$employeeID."!<BR>"."Please choose the function you need<BR>";
                $message = $message."<BR>"."<form action='productMaint.html'><button class='btn btn--radius-2 btn--green' type='submit'>Product Maintance</button></form>";
                $message = $message."<BR>"."<form action='orderReview.html'><button class='btn btn--radius-2 btn--green' type='submit'>Order Review</button></form>";
                $message = $message."<BR>"."<form action='customerMaint.html'><button class='btn btn--radius-2 btn--green' type='submit'>Customer Maintance</button></form>";
                
                // if employee level is 1, he/she has the access to Maint User Maintance
                $k=0;
                while ($k<$cnt){
                    $row = $rtn->fetch_assoc();
                    $employeeLevel = $row["employeeLevel"];
                    $k+=1;
                }
                if ($employeeLevel == 1){  
                    $message = $message."<BR>"."<form action='maintUserMaint.html'><button class='btn btn--radius-2 btn--green' type='submit'>Maint User Maintance</button></form>";
                }  
                $message = $message."<BR>"."<form action='MaintAccess.html'><button class='btn btn--radius-2 btn--blue' type='submit'>Log Out</button></form>";
            }else{
                $message = "<BR>Login Unsuccessfully! <BR> Please confirm your employee ID and Passowrd<BR>";
                $message = $message."<BR>"."<form action='MaintAccess.html'><button class='btn btn--radius-2 btn--blue' type='submit'>Log Out</button></form>";
            }
        ?>

        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h4 class="title"><center><?php echo $message ?></center></h4>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>