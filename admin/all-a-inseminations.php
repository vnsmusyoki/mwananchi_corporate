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

    <title>All Farmer Artificial Inserminations</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">


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
                            <div class="d-flex justify-content-between">
                                <h2 class="title-1 m-b-25">All Farmers Artificial Insemination Requests</h2>
                                <a href="create-farmer-insemination.php" class="btn btn-primary">Add New Farm Location</a>
                            </div>

                            <div class="table-responsive table--no-card m-b-40" style="background-color: #fff;padding:1rem .4rem;">
                                <table class="table table-bordered" id="example">
                                    <thead>
                                        <tr>

                                            <th>Officer</th>
                                            <th>Phone Number</th>
                                            <th>Date Scheduled</th>
                                            <th>Description </th>
                                            <th>Farm Location </th>
                                            <th class="text-right">Edit</th>
                                            <th class="text-right">Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db-connection.php';

                                        $data = "SELECT ai.artificial_insemination_id, ai.artificial_insemination_date, ai.artificial_insemination_details, vo.veterinary_officers_officer_name, vo.veterinary_officers_contact_number, fl.farmer_locations_latitude, fl.farmer_locations_longitude
                                        FROM artificial_insemination ai
                                        JOIN veterinary_officers vo ON ai.artificial_insemination_officer_id = vo.veterinary_officers_id
                                        JOIN farmer_locations fl ON ai.artificial_insemination_location_id = fl.farmer_locations_id";

                                        $query = mysqli_query($conn, $data);

                                        while ($fetch = mysqli_fetch_assoc($query)) {
                                            $id = $fetch['artificial_insemination_id'];
                                            $officername = $fetch['veterinary_officers_officer_name'];
                                            $officercontact = $fetch['veterinary_officers_contact_number'];
                                            $datescheduled = $fetch['artificial_insemination_date'];
                                            $description = $fetch['artificial_insemination_details'];
                                            $locationlatitude = $fetch['farmer_locations_latitude'];
                                            $locationlongitude = $fetch['farmer_locations_longitude'];

                                            echo "
                                                    <tr>
                                                        <td>$officername</td>
                                                        <td>$officercontact</td>
                                                        <td>$datescheduled</td> 
                                                        <td>$description</td> 
                                                        <td>($locationlatitude, $locationlongitude)</td> 
                                                        <td><a href='edit_insemination_record.php?id=$id' class='btn btn-primary btn-block'>Edit</td>
                                                        <td><a href='delete_insemination_record.php?id=$id' class='btn btn-danger btn-block'>Delete</td>
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
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        text: 'Export to Excel'
                    },
                    {
                        extend: 'csv',
                        text: 'Export to CSV'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export to PDF'
                    },
                    {
                        extend: 'copy',
                        text: 'Copy'
                    },
                    {
                        extend: 'print',
                        text: 'Print'
                    }
                ]
            });
        });
    </script>
</body>

</html>