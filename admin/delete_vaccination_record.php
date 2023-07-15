<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "DELETE  FROM `vaccination` WHERE `vaccination_id` = '$selectedfarmer'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-vaccinations.php');</script>";
    }
