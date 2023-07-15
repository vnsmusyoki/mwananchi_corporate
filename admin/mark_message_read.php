<?php
require 'admin-account.php';
?><?php

    $selectedfarmer = $_GET['id'];
    $checkproduct = "UPDATE  `communication` SET `communication_status`='read' WHERE `communication_id` = '$selectedfarmer'";
    $querycheckproduct = mysqli_query($conn, $checkproduct);
    if ($querycheckproduct) {
        echo "<script>window.location.replace('all-messages.php');</script>";
    }
