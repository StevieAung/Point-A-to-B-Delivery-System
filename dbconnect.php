<?php
    $connect = mysqli_connect("localhost", "root", "", "delivery_site");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($connect, "utf8");
?>