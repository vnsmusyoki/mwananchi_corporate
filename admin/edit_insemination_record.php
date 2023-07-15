<?php
$date_scheduled = $insemination_details =  $msg = '';
?>
<?php

include 'admin-account.php';
$insid = $_GET['id'];
$data = "SELECT ai.artificial_insemination_id, ai.artificial_insemination_date, ai.artificial_insemination_details, vo.veterinary_officers_officer_name, vo.veterinary_officers_contact_number, fl.farmer_locations_latitude, fl.farmer_locations_longitude
FROM artificial_insemination ai
JOIN veterinary_officers vo ON ai.artificial_insemination_officer_id = vo.veterinary_officers_id
JOIN farmer_locations fl ON ai.artificial_insemination_location_id = fl.farmer_locations_id
WHERE ai.artificial_insemination_id = '$insid'";

$query = mysqli_query($conn, $data);

while ($fetch = mysqli_fetch_assoc($query)) {
    $id = $fetch['artificial_insemination_id'];
    $officername = $fetch['veterinary_officers_officer_name'];
    $officercontact = $fetch['veterinary_officers_contact_number'];
    $datescheduled = $fetch['artificial_insemination_date'];
    $description = $fetch['artificial_insemination_details'];
    $locationlatitude = $fetch['farmer_locations_latitude'];
    $locationlongitude = $fetch['farmer_locations_longitude'];

    global $datescheduled;
    global $description;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Updating Farmer Insemination Requests</title>

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
                                $officerid = $_POST['officer_id'];
                                $date = mysqli_real_escape_string($conn, $_POST['date_scheduled']);
                                $details = mysqli_real_escape_string($conn, $_POST['insemination_details']);

                                if (empty($farmid) || empty($date) || empty($details) || empty($officerid)) {
                                    $msg = "Provide all the details";
                                } else {
                                    $insid = $_GET['id'];
                                    // Insert data into farmer_locations table
                                    $insert_location = "UPDATE  artificial_insemination  SET artificial_insemination_officer_id='$officerid', artificial_insemination_location_id='$farmid', artificial_insemination_date='$date',artificial_insemination_details='$details' WHERE artificial_insemination_id='$insid'";
                                    $query_insert_location = mysqli_query($conn, $insert_location);

                                    if ($query_insert_location) {
                                        // Success message or redirect to desired page
                                        echo "<script>alert('Farm location updated successfully');</script>";
                                        echo "<script>window.location.replace('all-a-inseminations.php');</script>";
                                    } else {
                                        $msg = "Failed to schedule inseminations";
                                    }
                                }
                            }

                            ?>
                            <form action="" method="POST" autocomplete="off">
                                <center><span>Add new Farmer Artificial Insemination Request </span></center>
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
                                    <label>Select Farm Location</label>
                                    <select name="farm_id" class="form-control" id="">
                                        <option value="">click to select Farm</option>

                                        <?php
                                        $farmers = "SELECT * FROM `farmer_locations`";
                                        $queryfarmers = mysqli_query($conn, $farmers);
                                        while ($fetch = mysqli_fetch_assoc($queryfarmers)) {
                                            $latitude = $fetch['farmer_locations_longitude'];
                                            $longitude = $fetch['farmer_locations_latitude'];
                                            $farmerid = $fetch['farmer_locations_id'];
                                        ?>
                                            <option value="<?php echo $farmerid; ?>">Location: - <?php echo $latitude . ',' . $longitude; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Farm Location</label>
                                    <select name="officer_id" class="form-control" id="">
                                        <option value="">click to Veterinary Officer</option>

                                        <?php
                                        $farmers = "SELECT * FROM `veterinary_officers`";
                                        $queryfarmers = mysqli_query($conn, $farmers);
                                        while ($fetch = mysqli_fetch_assoc($queryfarmers)) {
                                            $name = $fetch['veterinary_officers_officer_name'];
                                            $phonenumber = $fetch['veterinary_officers_contact_number'];
                                            $farmerid = $fetch['veterinary_officers_id'];
                                        ?>
                                            <option value="<?php echo $farmerid; ?>">Officer Selected: - <?php echo $name . ',' . $phonenumber; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date Scheduled</label>
                                    <input type="datetime-local" name="date_scheduled" value="<?php echo isset($_POST['date_scheduled']) ? htmlspecialchars($_POST['date_scheduled']) : $datescheduled; ?>" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label>Insemination Details</label>
                                    <input type="text" name="insemination_details" value="<?php echo isset($_POST['insemination_details']) ? htmlspecialchars($_POST['insemination_details']) : $description; ?>" class="form-control">



                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary" name="register_btn">Schedule Insemination </button>
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