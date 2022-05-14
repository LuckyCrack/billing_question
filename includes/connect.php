<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "products");
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>