<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "DELETE  FROM `farmers` WHERE `farmer_id` = '$selectedfarmer'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-farmers.php');</script>";
    }
