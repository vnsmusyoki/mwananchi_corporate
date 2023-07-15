<?php
$date_scheduled = $insemination_details =  $msg = '';
?>
<?php

include 'admin-account.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Vaccination Schedule</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $globalmembername; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-xs-12 col-sm-12"></div>
                        <div class="col-lg-10 col-md-10 col-xs-12 col-sm-12" style="background-color: white;padding:20px;">
                            <?php


                            if (isset($_POST['register_btn'])) {
                                include 'db-connection.php';
                                $farmid = $_POST['farm_id'];
                                $milkquality = $_POST['milk_quality'];
                                $quantity = mysqli_real_escape_string($conn, $_POST['milk_quantity']);

                                if (empty($farmid) || empty($quantity) || empty($milkquality)) {
                                    $msg = "Provide all the details required";
                                } elseif (!preg_match("/^\d+(\.\d{1,2})?$/", $quantity)) {
                                    $msg = "Amount of milk delivered should only be anything more than 0 and upto 2 decimal places";
                                } else {

                                    if ($milkquality == "Best") {
                                        $amount = 60 *  $quantity;
                                    } else {
                                        $amount = 50 *  $quantity;
                                    }
                                    // Insert data into farmer_locations table
                                    $insert_location = "INSERT INTO milk_delivery (milk_delivery_farmer_id, milk_delivery_quantity, milk_delivery_quality,pay_status) VALUES ('$farmid', '$quantity', '$milkquality','unpaid')";
                                    $query_insert_location = mysqli_query($conn, $insert_location);

                                    if ($query_insert_location) {
                                        $lastid = mysqli_insert_id($conn);
                                        $addpayment = "INSERT INTO `payments`(`payments_farmer_id`, `payments_delivery_id`, `payments_amount`, `payments_balance`) VALUES ('$farmid','$lastid', '$amount', '$amount')";
                                        $queryaddpayment = mysqli_query($conn, $addpayment);
                                        if ($queryaddpayment) {
                                            // Success message or redirect to desired page
                                            echo "<script>alert('Record Added successfully');</script>";
                                            echo "<script>window.location.replace('all-deliveries.php');</script>";
                                        }
                                    } else {
                                        $msg = "Failed to  send message to the specified farmer";
                                    }
                                }
                            }

                            ?>
                            <form action="" method="POST" autocomplete="off">
                                <center><span>Each Liter delivered is charged at Ksh. 50 and Ksh. 60 for both Good & Best Milk Quality Respectively </span></center>
                                <hr>
                                <?php


                                if (!empty($msg)) {
                                ?>

                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php
                                }

                                ?>
                                <div class="form-group">
                                    <label>Send message to Farmer</label>
                                    <select name="farm_id" class="form-control" id="">
                                        <option value="">click to select Farmer</option>

                                        <?php
                                        $farmers = "SELECT * FROM `farmers`";
                                        $queryfarmers = mysqli_query($conn, $farmers);
                                        while ($fetch = mysqli_fetch_assoc($queryfarmers)) {
                                            $farmername = $fetch['farmer_name'];
                                            $phonenumber = $fetch['contact_number'];
                                            $emiailaddress = $fetch['email_address'];
                                            $farmerid = $fetch['farmer_id'];
                                        ?>
                                            <option value="<?php echo $farmerid; ?>">Selected Farmer: - <?php echo $farmername . ',' . $phonenumber; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Milk Quality</label>
                                    <select name="milk_quality" class="form-control" id="">
                                        <option value="">click to select Quality</option>
                                        <option value="Good">Good</option>
                                        <option value="Best">Best</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Amount Delivered in Liters</label>
                                    <input type="text" name="milk_quantity" value="<?php echo isset($_POST['milk_quantity']) ? htmlspecialchars($_POST['insemination_details']) : ''; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary" name="register_btn">Create Record </button>
                                </div>


                            </form>
                        </div>
                        <div class="col-lg-1 col-md-1 col-xs-12 col-sm-12"></div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Mwananchi Corporate 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>