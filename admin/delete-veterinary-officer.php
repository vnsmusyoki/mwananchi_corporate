<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "DELETE  FROM `veterinary_officers` WHERE `veterinary_officers_id` = '$selectedfarmer'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-veterinary-officers.php');</script>";
    }
