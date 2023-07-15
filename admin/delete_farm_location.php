<?php
require 'admin-account.php';
?><?php

    $dietcheck = $_GET['id'];
    $checkproduct = "DELETE  FROM `farmer_locations` WHERE `farmer_locations_id` = '$dietcheck'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-locations.php');</script>";
    }
