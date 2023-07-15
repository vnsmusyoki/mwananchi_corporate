<?php

include 'admin-account.php';
$farm_latitude = $farm_longitude =  $msg = '';
$employeeids = $_GET['id'];
include 'db-connection.php';
$data = "SELECT * FROM `farmer_locations` WHERE `farmer_locations_id` = '$employeeids'";
$query = mysqli_query($conn, $data);
while ($fetch = mysqli_fetch_assoc($query)) {
    $id = $fetch['farmer_locations_farmer_id'];
    $globallatitude = $fetch['farmer_locations_latitude'];
    $globallongitude = $fetch['farmer_locations_longitude'];

    global $employeenames;
    global $globallatitude;
    global $globallongitude;
}
$data = "SELECT * FROM `login` WHERE `login_farmer_id` = '$employeeids'";
$query = mysqli_query($conn, $data);
while ($fetch = mysqli_fetch_assoc($query)) {
    $loginusername = $fetch['login_username'];
    global $loginusernme;
}

global $employeeids;


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Editing Farm Locations</title>

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

                            // ini_set('display_errors', 1);
                            // ini_set('display_startup_errors', 1);
                            // error_reporting(E_ALL);
                            if (isset($_POST['register_btn'])) {
                                include 'db-connection.php';
                                $farmer_id = $_POST['farmer_id'];
                                $farm_latitude = mysqli_real_escape_string($conn, $_POST['farm_latitude']);
                                $farm_longitude = mysqli_real_escape_string($conn, $_POST['farm_longitude']);

                                if (empty($farmer_id) || empty($farm_latitude) || empty($farm_longitude)) {
                                    $msg = "Provide all the details";
                                } else if (!preg_match("/^-?\d+(\.\d{1,3})?$/", $farm_latitude)) {
                                    $msg = "Invalid farm latitude. Only positive or negative numbers with up to 3 decimal places are allowed.";
                                } else if (!preg_match("/^-?\d+(\.\d{1,3})?$/", $farm_longitude)) {
                                    $msg = "Invalid farm longitude. Only positive or negative numbers with up to 3 decimal places are allowed.";
                                } else {
                                    // Check if farmer_id exists in farmers table
                                    $check_farmer = "SELECT * FROM farmers WHERE farmer_id = '$farmer_id'";
                                    $result = mysqli_query($conn, $check_farmer);
                                    $num_rows = mysqli_num_rows($result);

                                    if ($num_rows < 1) {
                                        $msg = "Invalid farmer selected";
                                    } else {
                                        // Insert data into farmer_locations table
                                        $employeeids = $_GET['id'];
                                        $insert_location = "UPDATE farmer_locations SET  `farmer_locations_latitude`='$farm_latitude', `farmer_locations_longitude`='$farm_longitude' , `farmer_locations_farmer_id`= '$farmer_id' WHERE `farmer_locations_id`='$employeeids'";
                                        $query_insert_location = mysqli_query($conn, $insert_location);

                                        if ($query_insert_location) {
                                            // Success message or redirect to desired page
                                            echo "<script>alert('Farm location updated successfully');</script>";
                                            echo "<script>window.location.replace('all-locations.php');</script>";
                                        } else {
                                            $msg = "Failed to update farm location";
                                        }
                                    }
                                }
                            }

                            ?>
                            <form action="" method="POST" autocomplete="off">
                                <center><span>Add new Farmer Account </span></center>
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
                                    <label>Select Farmer</label>
                                    <select name="farmer_id" class="form-control" id="">
                                        <option value="">click to select farmer</option>

                                        <?php
                                        $farmers = "SELECT * FROM `farmers`";
                                        $queryfarmers = mysqli_query($conn, $farmers);
                                        while ($fetch = mysqli_fetch_assoc($queryfarmers)) {
                                            $farmername = $fetch['farmer_name'];
                                            $farmerid = $fetch['farmer_id'];
                                            $selected = ($farmerid == $_POST['farmer_id']) ? 'selected' : '';

                                            echo "<option value='$farmerid' $selected>$farmername</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Farm Latitude</label>
                                    <input type="text" name="farm_latitude" value="<?php echo isset($_POST['farm_latitude']) ? htmlspecialchars($_POST['farm_latitude']) : $globallatitude; ?>" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label>Farm Longitude</label>
                                    <input type="text" name="farm_longitude" value="<?php echo isset($_POST['farm_longitude']) ? htmlspecialchars($_POST['farm_longitude']) : $globallongitude; ?>" class="form-control">



                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary" name="register_btn">Mark Farm Location </button>
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