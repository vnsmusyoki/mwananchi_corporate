<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "UPDATE  `milk_delivery` SET `pay_status`='paid' WHERE `milk_delivery_id` = '$selectedfarmer'";

    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {

        $updatepayment = "UPDATE  `payments` SET `payments_balance`=0 WHERE `payments_delivery_id` = '$selectedfarmer'";
        $updatepayment = mysqli_query($conn, $updatepayment);
        if ($updatepayment) {
            echo "<script>window.location.replace('all-deliveries.php');</script>";
        }
    }
