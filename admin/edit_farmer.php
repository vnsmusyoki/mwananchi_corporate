<?php

include 'admin-account.php';
$user_name = $farmer_location = $user_email = $user_mobile_no = $login_username = $login_password = $confirmpwd =  $msg = '';
$customerids = $_GET['id'];
include 'db-connection.php';
$data = "SELECT * FROM `farmers` WHERE `farmer_id` = '$customerids'";
$query = mysqli_query($conn, $data);
while ($fetch = mysqli_fetch_assoc($query)) {
    $id = $fetch['farmer_id'];
    $customernames = $fetch['farmer_name'];
    $customeremail = $fetch['email_address'];
    $customermobile = $fetch['contact_number'];
    $farmerlocation = $fetch['farmer_location'];


    global $customernames;
    global $customeremail;
    global $customermobile;
    global $farmerlocation;
}
$data = "SELECT * FROM `login` WHERE `login_farmer_id` = '$customerids'";
$query = mysqli_query($conn, $data);
while ($fetch = mysqli_fetch_assoc($query)) {
    $loginusername = $fetch['login_username'];
    global $loginusernme;
}

global $customerids;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creating Farmer Accounts</title>

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
                                $names = mysqli_real_escape_string($conn, $_POST['user_name']);
                                $email = mysqli_real_escape_string($conn, $_POST['user_email']);
                                $mobileno = mysqli_real_escape_string($conn, $_POST['user_mobile_no']);
                                $username = mysqli_real_escape_string($conn, $_POST['login_username']);
                                $farmlocation = mysqli_real_escape_string($conn, $_POST['farmer_location']);
                                $password = mysqli_real_escape_string($conn, $_POST['login_password']);
                                $cpassword = mysqli_real_escape_string($conn, $_POST['confirmpwd']);

                                $phonelength = strlen($mobileno);
                                $passlength = strlen($password);
                                $usernamelength = strlen($username);

                                if (empty($names) || empty($email) || empty($mobileno) || empty($username) || empty($farmlocation) || empty($password)) {
                                    $msg = "Provide all the details";
                                } elseif (!preg_match("/^[a-zA-z ]*$/", $names) || !preg_match("/^[a-zA-z0-9]*$/", $username)) {
                                    $msg = "Provide correct full names or username";
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $msg = "Invalid email address";
                                } elseif ($phonelength !== 10) {
                                    $msg = "Mobile number should have exactly 10 digits";
                                } elseif ($usernamelength < 4) {
                                    $msg = "Username must have more than 4 digits or characters";
                                } elseif ($passlength < 4) {
                                    $msg = "Password must have more than 4 digits or characters";
                                } elseif ($password !== $cpassword) {
                                    $msg = "Password failed to match";
                                } else {
                                   
                                       
                                            $checkphonenumber = "SELECT * FROM `farmers` WHERE `contact_number` = '$mobileno'";
                                            $queryphonenumber = mysqli_query($conn, $checkphonenumber);
                                            $phonenumberrows = mysqli_num_rows($queryphonenumber);

                                            if ($phonenumberrows >= 2) {
                                                $msg = "Mobile number already exists";
                                            } else {
                                                $customerids = $_GET['id'];
                                                $updateuser = "UPDATE `farmers` SET `farmer_name`='$names', `farmer_location`='$farmlocation', `contact_number`='$mobileno', `email_address`='$email' WHERE `farmer_id`='$customerids'";
                                                $queryupdateuser = mysqli_query($conn, $updateuser);

                                                if ($queryupdateuser) {
                                                    $password = md5($password);

                                                    $updatelogin = "UPDATE `login` SET `login_username`='$username', `login_password`='$password' WHERE `login_farmer_id`='$customerids'";
                                                    $queryupdatelogin = mysqli_query($conn, $updatelogin);

                                                    // Simulate an HTTP redirect:
                                                    echo "<script>window.location.replace('all-farmers.php');</script>";
                                                }
                                            }
                                        
                                    
                                }
                            }


                            ?>
                            <form action="" method="POST" autocomplete="off">
                                <center><span>Edit Farmer Account </span></center>
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
                                    <label>Full Names</label>
                                    <input type="text" name="user_name" value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : $customernames; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Farm Location</label>
                                    <input type="text" name="farmer_location" value="<?php echo isset($_POST['farmer_location']) ? htmlspecialchars($_POST['farmer_location']) : $farmerlocation; ?>" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input type="text" name="user_email" value="<?php echo isset($_POST['user_email']) ? htmlspecialchars($_POST['user_email']) : $customeremail; ?>" class="form-control">



                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input type="text" name="user_mobile_no" value="<?php echo isset($_POST['user_mobile_no']) ? htmlspecialchars($_POST['user_mobile_no']) : $customermobile; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="login_username" value="<?php echo isset($_POST['login_username']) ? htmlspecialchars($_POST['login_username']) : $loginusername; ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="login_password" value="<?php echo isset($_POST['login_password']) ? htmlspecialchars($_POST['login_password']) : ''; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <input type="password" name="confirmpwd" value="<?php echo isset($_POST['confirmpwd']) ? htmlspecialchars($_POST['confirmpwd']) : ''; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-danger" name="register_btn">Update Farmer Account</button>
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