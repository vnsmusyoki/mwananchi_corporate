<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "DELETE  FROM `artificial_insemination` WHERE `artificial_insemination_id` = '$selectedfarmer'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-a-inseminations.php');</script>";
    }
