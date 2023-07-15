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

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

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




                        <div class="topbar-divider d-none d-sm-block"></div>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Unpaid Milk Records</h2> 
                            <div class="table-responsive table--no-card m-b-40" style="background-color: #fff;padding:1rem .4rem;">
                            <table class="table table-bordered" id="example">
                                    <thead>
                                        <tr>
                                            <th>Farmer</th>
                                            <th>Date Received</th>
                                            <th>Total Litres</th>
                                            <th>Amount </th>
                                            <th>Paid </th>
                                            <th>Balance </th>
                                            <th>Payment </th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db-connection.php';
                                        $data = "SELECT * FROM milk_delivery WHERE pay_status='unpaid'" ;

                                        $query = mysqli_query($conn, $data);

                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                            $id = $fetch['milk_delivery_id'];
                                            $farmerid = $fetch['milk_delivery_farmer_id'];
                                            $quantity = $fetch['milk_delivery_quantity'];
                                            $quality = $fetch['milk_delivery_quality'];
                                            $date = $fetch['milk_delivery_date'];
                                            $status = $fetch['pay_status'];

                                            $farmer = "SELECT * FROM farmers WHERE farmer_id = $farmerid";
                                            $quertfarmer = mysqli_query($conn, $farmer);
                                            while($fetchfarmer = mysqli_fetch_assoc($quertfarmer)) {
                                                $farmername = $fetchfarmer['farmer_name'];
                                            }
                                            $payments = "SELECT * FROM payments WHERE payments_delivery_id = $id";
                                            $quertpayments = mysqli_query($conn, $payments);
                                            while($fetchpayments = mysqli_fetch_assoc($quertpayments)) {
                                                $totalamount = $fetchpayments['payments_amount'] ?? 0;
                                                $totalbalance = $fetchpayments['payments_balance'] ?? 0;
                                                $totalpaid = $totalamount - $totalbalance;
                                            }
                                            echo "
                                                <tr>
                                                    <td>$farmername</td>
                                                    <td>$date</td>
                                                    <td>$quantity</td>
                                                    <td>Ksh. $totalamount </td> 
                                                    <td>Ksh. $totalpaid </td> 
                                                    <td>Ksh. $totalbalance </td>  
                                                    <td>$status</td>  
                                                    <td><a href='make_payment.php?id=$id' class='btn btn-primary btn-block'>Pay Now</td>
                                                </tr>
                                            ";
                                        }

                                        mysqli_close($conn);
                                        ?>

                                    </tbody>
                                </table>
                        </div>

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
    <!-- End custom js for this page -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ]
        });
    });
</script>
</html>